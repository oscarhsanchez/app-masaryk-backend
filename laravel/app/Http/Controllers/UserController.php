<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class UserController extends Controller {
	
	
	/*
	|--------------------------------------------------------------------------
	| User Controller
	|--------------------------------------------------------------------------
	*/
	
	
	public $restful = true;

	
	/**
	 * edit function.
	 * 
	 * @description Edita un usuario administrativo de la base de datos	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	 	
	public function getEdit($id = null) {
	
		if (!$data = $this->_validate($id)) {
			return Redirect::to('users');
		}
												   		
		return View::make('admin.users.edit')->with("data", $data);			
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('users');
		}	
			
		$input = Input::all();
		$rules = array("first_name" => "required|between:3,50",
					   "last_name"  => "required|between:3,50");
					   
		if ($input["email"] != $data->email ) {
			$rules["email"] = "required|email|unique:users,email,".Input::get('email');
		}
		
		$password_validate = strlen(Input::get('password')) > 0 || strlen(Input::get('password'));
		if ($password_validate) {
			$rules["password"] 	= "required|between:6,16";
			$rules["cpassword"] = "required|same:password";
		}
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/users/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {
			
			$fields = [	
				"email" 	 	 => Input::get('email'),
				"first_name" 	 => Input::get('first_name'),
				"last_name"  	 => Input::get('last_name'),
				"birthday"  	 => Input::get('birthday', ''),
				"city"  		 => Input::get('city', 'Mexico'),
			];		
			
			if ($password_validate) {
				$fields['password'] = Input::get('password');
			}		
			
			Sentinel::update($data, $fields);

			return Redirect::to('admin/users/edit/'.$id)->with("message", "El usuario ha sido guardado");	
		}
		
	}



	/**
	 * me function.
	 * 
	 * @description Edita el usuario logueado	 
	 * @access public
	 * @return void
	 */
	 	
	public function getMe() {
	
		if (!$data = Sentinel::getUser()) {
			return Redirect::to('users');
		}
		return View::make('admin.users.me')->with("data", $data);			
		
	}
	
	public function postMe() {
			
		if (!$data = Sentinel::getUser()) {
			return Redirect::to('users');
		}	
			
		$input = Input::all();
		$rules = array("email" => "required|email");
		
		$password_validate = strlen(Input::get('password')) > 0 || strlen(Input::get('password'));
		if ($password_validate) {
			$rules["password"] 	= "required|between:6,16";
			$rules["cpassword"] = "required|same:password";
		}
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/users/me')->withErrors($validation)->withInput();
			
		} else {

			$fields = ["email" => Input::get('email'),];		
			if ($password_validate) {
				$fields['password'] = Input::get('password');
			}		
			
			Sentinel::update($data, $fields);

			return Redirect::to('admin/users/me')->with("message", "Tus datos han sido actualizados");	
		}
		
	}
	
	
	
	/**
	 * get_list function.
	 * 
	 * @description Listado de usuarios administrativos de la base de datos	 
	 * @access public
	 * @return void
	 */
	 
	public function getIndex() {
	
		$limit 	= Input::get('limit', 20);
		$page 	= Input::get('page' , 1) - 1;
		$search = Input::get('search' , '');
		$order 	= Input::get('order' , 'email|asc');
			
			
		$rows   = User::where("id", ">", 1);
										   
		if ($search != "") {
			$where_search = '(email LIKE ?)';
			$rows->whereRaw($where_search, array("%$search%"));
			$total = $rows->count();			
		} else {
			$total = $rows->count();
		}
		
		$order = explode("|", $order);
		$rows->take($limit)->skip($page * $limit)->orderBy($order[0], $order[1]);
		$rows = $rows->get(array("users.*"));
			   								   
		return View::make('admin.users.index')->with("rows",   $rows)
											  ->with("search", $search)
											  ->with("page",   $page)
											  ->with("limit",  $limit)
											  ->with("total",  $total)
											  ->with("show",   min(($page + 1) * $limit, $total))
											  ->with("torder", $order[1] == "asc" ? "desc" : "asc");
	}



	/**************************
	     MÉTODOS PRIVADOS
	***************************/
	
	private function _validate($id) {

		if ($id == null) {
			return false;
		}

		$data = Sentinel::findById($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}