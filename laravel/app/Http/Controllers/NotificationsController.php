<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User, App\Models\Notification;

class NotificationsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Notifications Controller
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
	 * @description Elimina una notificacion de la base de datos 	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	public function getDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/notifications');
		}
		
		return View::make('admin.notifications.delete')->with("data", $data->title);
	}
	
	public function postDelete($id = null) {	
		
		if (!$data = $this->_validate($id)) {
			return Redirect::to('admin/notifications');
		}
			
		$data->delete();
		
		return Redirect::to('admin/notifications')->with("message", "¡Notificación eliminada!");
	}
	
    
    
	/**
	 * add function.
	 * 
	 * @description Agrega una notificacion a base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getAdd() {
										   		
		return View::make('admin.notifications.add');			
		
	}
	
	public function postAdd() {

		$input = Input::all();
		$rules = array("message" => "required|min:10|max:100");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/notifications/add')->withErrors($validation)->withInput();
			
		} else {

			$data = new Notification();
			$data->message   = Input::get('message');	
			$data->scheduled = Input::get("scheduled", "0000-00-00 00:00:00");
			$data->current 	 = 0;
			$data->completed = 0;
			$data->active 	 = 0;	
			$data->save();
			
			return Redirect::to('admin/notifications')->with("message", "La notificación ha sido agreada");	
		}
		
	}
    
    
    
	/**
	 * edit function.
	 * 
	 * @description Edita una notificacion de la base de datos	 
	 * @access public
	 * @param mixed $id (default: null)
	 * @return void
	 */
	 	
	public function getEdit($id = null) {
	
		if (!$data = $this->_validate($id)) {
			return Redirect::to('notifications');
		}
												   		
		return View::make('admin.notifications.edit')->with("data", $data);			
		
	}
	
	public function postEdit($id = null) {
			
		if (!$data = $this->_validate($id)) {
			return Redirect::to('notifications');
		}	
			
		$input = Input::all();
		$rules = array("message" => "required|min:10|max:100");
		
		$validation = Validator::make($input, $rules);
		if ($validation->fails()) {
			return Redirect::to('admin/notifications/edit/'.$id)->withErrors($validation)->withInput();
			
		} else {

			$data->message   = Input::get('message');	
			$data->scheduled = Input::get("scheduled", "0000-00-00 00:00:00");			
			$data->active 	 = Input::get("active", 0);
			$data->save();
			
			return Redirect::to('admin/notifications/edit/'.$id)->with("message", "La notificación ha sido guardada");	
		}
		
	}
    
       
    
	/**
	 * index function.
	 * 
	 * @description Listado de notificaciones de la base de datos	 
	 * @access public
	 * @return void
	 */
	 	
	public function getIndex() {
	
		$limit 	= Input::get('limit', 20);
		$page 	= Input::get('page' , 1) - 1;
		$search = Input::get('search' , '');
		$order 	= Input::get('order' , 'id|asc');
			
			
		$rows   = Notification::where("id", ">", 0);
										   
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
			   								   
		return View::make('admin.notifications.index')->with("rows",  $rows)
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

		$data = Notification::find($id);
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}