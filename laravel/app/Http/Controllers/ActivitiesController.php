<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User, App\Models\Activity, App\Models\ActivityType;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class ActivitiesController extends Controller {

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
			return Redirect::to('admin/activities');
		}
		
		return View::make('admin.activities.delete')->with("data", $data->title);
	}
	
	public function postDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/activities');
		}
			
		$data->delete();
		
		return Redirect::to('admin/activities')->with("message", "¡Actividad eliminada!");
	}
	
    
    
	/**
	 * add function.
	 * 
	 * @description Agrega una actividad a la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getAdd() {
		
		$types = array("-------------------") + ActivityType::lists("name", "id")->toArray();
		return View::make('admin.activities.add')->with("types", $types);			
		
	}
	
	public function postAdd() {

		$input = Input::all();
		$rules = array("title" 	   => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/activities/add')->withErrors($validation)->withInput();
			
		} else {
			
			$data = new Activity();
			$data->title  		= Input::get('title');
			$data->description  = Input::get('description');
			$data->address  	= Input::get('address');
			$data->date_from  	= Input::get('date_from');
			$data->date_to  	= Input::get('date_to');
			$data->lat  		= Input::get('latitude');
			$data->lng  		= Input::get('longitude');
			$data->type_id  	= Input::get('type');	
			$data->active 		= Input::get("active", 0);	
			$data->save();
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$data->image = Input::file('image')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/activities')->with("message", "El local ha sido creado");	
		}
		
	}
    
    
    
	/**
	 * edit function.
	 * 
	 * @description Edita una actividad de la base de datos	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	 	
	public function getEdit($id = null) {
	
		if (!$data = $this->_validate($id)) {
			return Redirect::to('activities');
		}
		
		$types = array("-------------------") + ActivityType::lists("name", "id")->toArray();										   		
		return View::make('admin.activities.edit')->with("data", $data)
											  ->with("types", $types);			
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('activities');
		}	
			
		$input = Input::all();
		$rules = array("title" => "required|min:6");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/activities/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {

			$data->title  		= Input::get('title');
			$data->address  	= Input::get('address');
			$data->date_from  	= Input::get('date_from');
			$data->date_to  	= Input::get('date_to');
			$data->phone  		= Input::get('phone');
			$data->lat  		= Input::get('latitude');
			$data->lng  		= Input::get('longitude');
			$data->type_id  	= Input::get('type');	
			$data->active 		= Input::get("active", 0);	
			$data->save();
			
			if (Input::hasFile('file')) {
				if (getimagesize(Input::file('file')->getRealPath())) {
					$data->image = Input::file('file')->getRealPath();
					$data->flush();
				}	
			}
			
			return Redirect::to('admin/activities/edit/'.$id)->with("message", "El local ha sido guardado");	
		}
		
	}
    
       
    
	/**
	 * index function.
	 * 
	 * @description Listado de actividad de la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getIndex() {
	
		$limit 	= Input::get('limit', 20);
		$page 	= Input::get('page' , 1) - 1;
		$search = Input::get('search' , '');
		$order 	= Input::get('order' , 'id|asc');
			
			
		$rows   = Activity::where("id", ">", 0);
										   
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
			   								   
		return View::make('admin.activities.index')->with("rows",   $rows)
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

		$data = Activity::find($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}