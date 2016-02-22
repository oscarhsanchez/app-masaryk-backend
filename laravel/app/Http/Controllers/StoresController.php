<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User, App\Models\Store, App\Models\StoreType;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class StoresController extends Controller {

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
	 * @description Elimina una tienda de la base de datos 	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function getDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/stores');
		}
		
		return View::make('admin.stores.delete')->with("data", $data->title);
	}
	
	public function postDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/stores');
		}
			
		$data->delete();
		
		return Redirect::to('admin/stores')->with("message", "¡Tienda eliminada!");
	}
	
    
    
	/**
	 * add function.
	 * 
	 * @description Agrega una tienda a la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getAdd() {
		
		$types = array("-------------------") + StoreType::lists("name", "id")->toArray();
		return View::make('admin.stores.add')->with("types", $types);			
		
	}
	
	public function postAdd() {

		$input = Input::all();
		$rules = array("title" 	   => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/stores/add')->withErrors($validation)->withInput();
			
		} else {

			$data = new Store();
			$data->title  	= Input::get('title');
			$data->address  = Input::get('address');
			$data->description = Input::get('description');
			$data->phone  	= Input::get('phone');
			$data->lat  	= Input::get('latitude');
			$data->lng  	= Input::get('longitude');
			$data->type_id  = Input::get('type');	
			$data->active 	= Input::get("active", 0);	
			$data->save();
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$data->image = Input::file('image')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/stores')->with("message", "El local ha sido creado");	
		}
		
	}
    
    
    
	/**
	 * edit function.
	 * 
	 * @description Edita una tienda de la base de datos	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	 	
	public function getEdit($id = null) {
	
		if (!$data = $this->_validate($id)) {
			return Redirect::to('stores');
		}
		
		$types = array("-------------------") + StoreType::lists("name", "id")->toArray();										   		
		return View::make('admin.stores.edit')->with("data", $data)
											  ->with("types", $types);			
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('stores');
		}	
			
		$input = Input::all();
		$rules = array("title" => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/stores/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {

			$data->title  	= Input::get('title');
			$data->address  = Input::get('address');
			$data->description = Input::get('description');
			$data->phone  	= Input::get('phone');
			$data->lat  	= Input::get('latitude');
			$data->lng  	= Input::get('longitude');
			$data->type_id  = Input::get('type');	
			$data->active 	= Input::get("active", 0);	
			$data->save();
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$data->image = Input::file('image')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/stores/edit/'.$id)->with("message", "El local ha sido guardado");	
		}
		
	}
    
       
    
	/**
	 * index function.
	 * 
	 * @description Listado de tiendas de la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getIndex() {
	
		$limit 	= Input::get('limit', 20);
		$page 	= Input::get('page' , 1) - 1;
		$search = Input::get('search' , '');
		$order 	= Input::get('order' , 'id|asc');
			
			
		$rows   = Store::where("id", ">", 0);
										   
		if ($search != "") {
			$where_search = '(title LIKE ? && description LIKE  ?)';
			$rows->whereRaw($where_search, array("%$search%", "%$search%"));
			$total = $rows->count();			
		} else {
			$total = $rows->count();
		}
		
		$order = explode("|", $order);
		$rows->take($limit)->skip($page * $limit)->orderBy($order[0], $order[1]);
		$rows = $rows->get();
			   								   
		return View::make('admin.stores.index')->with("rows",   $rows)
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

		$data = Store::find($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}