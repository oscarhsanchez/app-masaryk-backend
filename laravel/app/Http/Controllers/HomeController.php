<?php namespace App\Http\Controllers;

use Input, Validator, View, Redirect, Auth, File, App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Foundation\Auth\ResetsPasswords;

class HomeController extends Controller {
	
	use ResetsPasswords;

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
				
		if ($user = Auth::user()) {
			if ($user->hasRole('admin')) {
				return Redirect::to($this->redirect);
			}
		}
    	
    	return View::make('home.index');
	}
	
	public function postIndex() {
    	
    	$username    = Input::get('username');
		$password    = Input::get('password');
		
		if (Auth::attempt(['email' => $username, 'password' => $password, 'active' => 1], true)) {
			if (Auth::user()->hasRole('admin')) {
				return Redirect::to($this->redirect);
			}
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
		 Auth::logout();
		 return Redirect::to('');
	}	
	
	
	    
    
    
    /**
     * getAdmin function.
     * 
     * @access public
     * @return void
     */
     
    public function getAdmin() {
		
		if ($user = Auth::user()) {
			if ($user->hasRole('admin')) {
				return Redirect::to($this->redirect);
			}
		} 
    	
		return Redirect::to('');
	}

}