<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	*/
	
	
	public $restful  = true;
	public $redirect = "admin/users";
	
	
	/**
	 * getIndex function.
	 * 
	 * @access public
	 * @return void
	 */
	 
	public function getIndex() {
				
		if ($user = Sentinel::check()) {
			if ($user->hasAccess(['access.admin'])) {
				return Redirect::to($this->redirect);
			}
    	} 
    	
    	return View::make('home.index');
	}
	
	public function postIndex() {
    	
    	$username    = Input::get('username');
		$password    = Input::get('password');
		$credentials = array('email' => $username, 'password' => $password);
		
		if (Sentinel::authenticateAndRemember($credentials)) {
			return Redirect::to($this->redirect);
		}
			
		return Redirect::to('')->with('login_errors', true);
    	
    }
    
    
    
    /**
     * getLogout function.
     * 
     * @access public
     * @return void
     */
     
    public function getLogout() {
		 Sentinel::logout();
		 return Redirect::to('');
	}	
	
	
	    
    
    
    /**
     * getAdmin function.
     * 
     * @access public
     * @return void
     */
     
    public function getAdmin() {
		
		if ($user = Sentinel::check()) {
			if ($user->hasAccess(['access.admin'])) {
				return Redirect::to($this->redirect);
			}
    	} 
    	
		return Redirect::to('');
	}

}