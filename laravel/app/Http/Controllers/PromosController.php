<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User, App\Models\Promo, App\Models\Store, App\Models\Option;

class PromosController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Promos Controller
	|--------------------------------------------------------------------------
	*/
	

	public $restful = true;
	
		
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	 
	public function __construct () {
	}
    
       
    		
	/**
	 * delete function.
	 * 
	 * @description Elimina una promoción de la base de datos 	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function getDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/promos');
		}
		
		return View::make('admin.promos.delete')->with("data", $data->title);
	}
	
	public function postDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/promos');
		}
			
		$data->delete();
		
		return Redirect::to('admin/promos')->with("message", "¡Promoción eliminada!");
	}
	
    
    
	/**
	 * add function.
	 * 
	 * @description Agrega una promoción a base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getAdd() {
		
		$stores  = array("-------------------") + Store::lists("title", "id")->toArray();
										   		
		return View::make('admin.promos.add')->with("stores",  $stores);			
		
	}
	
	public function postAdd() {

		$input = Input::all();
		$rules = array("title" => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/promos/add')->withErrors($validation)->withInput();
			
		} else {

			$data = new Promo();
			$data->title 	 = Input::get('title');
			$data->store_id  = Input::get('store');
			$data->active 	 = Input::get("active", 0);	
			$data->save();
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$data->image = Input::file('image')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/promos')->with("message", "La promoción ha sido creada");	
		}
		
	}
    
    
    
	/**
	 * edit function.
	 * 
	 * @description Edita una promoción de la base de datos	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	 	
	public function getEdit($id = null) {
	
		if (!$data = $this->_validate($id)) {
			return Redirect::to('promos');
		}
		
		$stores  = array("-------------------") + Store::lists("title", "id")->toArray();
												   		
		return View::make('admin.promos.edit')->with("data", 	$data)
											  ->with("stores",  $stores);		
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('promos');
		}	
			
		$input = Input::all();
		$rules = array("title" => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/promos/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {

			$data->title  	 = Input::get('title');	
			$data->store_id  = Input::get('store');
			$data->active 	 = Input::get("active", 0);
			$data->save();
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$data->image = Input::file('image')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/promos/edit/'.$id)->with("message", "La promoción ha sido guardada");	
		}
		
	}
    
       
    
	/**
	 * index function.
	 * 
	 * @description Listado de promociones de la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getIndex() {
	
		$limit 	= Input::get('limit', 20);
		$page 	= Input::get('page' , 1) - 1;
		$search = Input::get('search' , '');
		$order 	= Input::get('order' , 'id|asc');
			
			
		$rows   = Promo::where("id", ">", 0);
										   
		if ($search != "") {
			$where_search = '(title LIKE ?)';
			$rows->whereRaw($where_search, array("%$search%"));
			$total = $rows->count();			
		} else {
			$total = $rows->count();
		}
		
		$order = explode("|", $order);
		$rows->take($limit)->skip($page * $limit)->orderBy($order[0], $order[1]);
		$rows = $rows->get();
		
		$promos = Promo::lists("title", "id");
		$splash = Option::get("splash", 0);
					   								   
		return View::make('admin.promos.index')->with("rows",   $rows)
											  ->with("search",  $search)
											  ->with("page",    $page)
											  ->with("limit",   $limit)
											  ->with("total",   $total)
											  ->with("show",    min(($page + 1) * $limit, $total))
											  ->with("torder",  $order[1] == "asc" ? "desc" : "asc")
											  ->with("promos",  $promos)
											  ->with("splash",  $splash);
	}
	
	public function postIndex() {
		Option::set("splash", Input::get('splash', 0));
		return Redirect::to('admin/promos')->with("message", "La promoción destacada ha sido actualizada");
	}
    
    
    
	/**************************
	     MÉTODOS PRIVADOS
	***************************/
	
	private function _validate($id) {

		if ($id == null) {
			return false;
		}

		$data = Promo::find($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}