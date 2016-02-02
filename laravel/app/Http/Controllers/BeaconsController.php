<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User, App\Models\Beacon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class BeaconsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Beacons Controller
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
	 * @description Elimina una beacon de la base de datos 	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function getDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/beacons');
		}
		
		return View::make('admin.beacons.delete')->with("data", $data->title);
	}
	
	public function postDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/beacons');
		}
			
		$data->delete();
		
		return Redirect::to('admin/beacons')->with("message", "¡Beacon eliminada!");
	}
	
    
    
	/**
	 * add function.
	 * 
	 * @description Agrega una promoción a base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getAdd() {
										   		
		return View::make('admin.beacons.add');			
		
	}
	
	public function postAdd() {

		$input = Input::all();
		$rules = array("uuid" => "required|min:10");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/beacons/add')->withErrors($validation)->withInput();
			
		} else {

			$data = new Beacon();
			$data->uuid   = Input::get('uuid');	
			$data->active = Input::get("active", 0);	
			$data->save();
			
			return Redirect::to('admin/beacons')->with("message", "El beacon ha sido agreado");	
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
												   		
		return View::make('admin.beacons.edit')->with("data", $data);			
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('promos');
		}	
			
		$input = Input::all();
		$rules = array("uuid" => "required|min:10");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/beacons/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {

			$data->uuid   = Input::get('uuid');			
			$data->active = Input::get("active", 0);
			$data->save();
			
			return Redirect::to('admin/beacons/edit/'.$id)->with("message", "El beacon ha sido guardado");	
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
			
			
		$rows   = Beacon::where("id", ">", 0);
										   
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
			   								   
		return View::make('admin.beacons.index')->with("rows",  $rows)
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

		$data = Beacon::find($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}