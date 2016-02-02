<?php namespace App\Http\Controllers;

use Input, Validator, View, Response, DB, Mail, App\User, App\Models\Promo, App\Models\Store, App\Models\Beacon, App\Models\Activity;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;

class ApiController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| API Controller
	|--------------------------------------------------------------------------
	*/
	

	public $restful  = true;
	public $errorMsg = [
	    	'email.unique' 			=> 'El correo ya ha sido registrado previamente',
	    	'first_name.between' 	=> 'El nombre debe tener entre :min y :max caracteres.',
	    	'last_name.between' 	=> 'Los apellidos deben tener entre :min y :max caracteres.',
	    	'password.between'      => 'La contraseña debe tener entre :min y :max caracteres.',
	    	'cpassword.same'    	=> 'Los campos confirmar y contraseña deben coincidir.',
		];

		
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	 
	 
	public function __construct () {
	}
    
    
   	/**
   	 * index function.
   	 * 
   	 * @access public
   	 * @return void
   	 */
   	public function getIndex() {
	   	return "";
   	} 
   
   
       
    /**
     * login function.
     * 
     * @access public
     * @return void
     */
    public function postLogin() {
	    
	    $email    	 = Input::get('email');
		$password 	 = Input::get('password');
		$credentials = array('email' => $email, 'password' => $password);
		
		if ($user = Sentinel::authenticateAndRemember($credentials)) {
			
			unset($user->password);
			unset($user->facebook_token);
			unset($user->created_at);
			unset($user->updated_at);
			unset($user->deleted_at);
			unset($user->last_login);
			
			return Response::json(array("status"=>true, "service"=>"login", "data"=>$user));
		}
		
		return Response::json(array("status"=>false, "service"=>"login", "error_code"=>503, "error_message"=>"Bad credentials"));
		
    }
    
    
    
    /**
     * register function.
     * 
     * @access public
     * @return void
     */
    public function postRegister() {
	    	    
	    $input = Input::all();
	    
		$rules = [	
			"email" 	 => "required|email|unique:users,email,".$input["email"],
			"password" 	 => "required|between:6,16",
			"cpassword"  => "required|same:password",
			"first_name" => "required|between:3,50",
			"last_name"  => "required|between:3,50"
		];
					 			
		$validation = Validator::make($input, $rules, $this->errorMsg);
		if ($validation->fails()) {
			$errors = $validation->errors();
			return Response::json(array("status"=>false, "service"=>"register", "error_code"=>503, "error_message"=>$errors));
			
		} else {
			
			$remember_token = bcrypt(str_random(20));
			
			$fields = [	
				"email" 	 	 => Input::get('email'),
				"password" 	 	 => Input::get('password'),
				"first_name" 	 => Input::get('first_name'),
				"last_name"  	 => Input::get('last_name'),
				"facebook_token" => Input::get('facebook_token', ''),
				"birthday"  	 => Input::get('birthday', ''),
				"city"  		 => Input::get('city', 'Mexico'),
				"remember_token" => $remember_token,
			];			
			
			$user = Sentinel::registerAndActivate($fields);
			Sentinel::login($user);

			return Response::json(array("status"=>true, "service"=>"register", "data"=>array("remember_token"=>$remember_token)));
						
		}
		
    }
      
    
    
    /**
     * recover function.
     * 
     * @access public
     * @return void
     */
    public function postRecover() {
	    	    
	    $email = Input::get("email", '');
		$rules = [ "email" => "required|email"];
					 			
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return Response::json(array("status"=>false, "service"=>"recover", "error_code"=>503, "error_message"=>"Bad credentials"));
			
		} else {
			
			$user = Sentinel::findByCredentials(['login' => $email]);
			
			if (!$user) {
				return Response::json(array("status"=>false, "service"=>"recover", "error_code"=>503, "error_message"=>"Bad credentials"));
			}
			
			$reminder = Reminder::create($user);
			$link     = "http://".$_SERVER['SERVER_NAME']."/api/code?email=".$email."&amp;code=".$reminder->code;
			$name 	  = trim($user->first_name)." ".trim($user->last_name);
			
			Mail::send('emails.recover', ['email' => $email, 'link' => $link], function($message) use ($email, $name) {
				$message->to($email, $name)->subject('Camina Masarik - Recuperar Contraseña');
			});
		
			return Response::json(array("status"=>true, "service"=>"recover"));
	    }	
    }  
    
          
    
    
    /**
     * code function.
     * 
     * @access public
     * @return void
     */
    public function postCode() {
	    
	    $email = Input::get("email", '');
	    $code  = Input::get("code",  '');
	    
	    $user  = Sentinel::findByCredentials(['login' => $email]);
	    if (!$user) {
		    return "Bad credentials";
	    }
	    
	    $password     = str_random(8);
	    if ($reminder = Reminder::complete($user, $code, $password)) {
		    
		    $name = trim($user->first_name)." ".trim($user->last_name);
			Mail::send('emails.reset', ['email' => $email, 'password' => $password], function($message) use ($email, $name) {
				$message->to($email, $name)->subject('Camina Masarik - Contraseña Nueva');
			});
			
			return "Check your email";
		
		} else {
			return "Bad credentials";		
		}
	  	
    }
    
          
    
    
    /**
     * code function.
     * 
     * @access public
     * @return void
     */
    public function getVerify() {
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"verify", "error_code"=>501, "error_message"=>"User not logged"));
		} else {
			return Response::json(array("status"=>true, "service"=>"verify"));
		}
	  	
    }  
        
          
    
    
    /**
     * renew function.
     * 
     * @access public
     * @return void
     */
    public function postRenew() {
	    
	    $token = Input::get("remember_token", "");
	    $email = Input::get("email", "");
	    
	    $user  = User::where("remember_token", "=", trim($token))
	   			     ->where("remember_token", "!=", "")
	    			 ->where("email", "=", $email)->first();
	  	
	  	if ($user) {
		  	Sentinel::login(Sentinel::findById($user->id));
		  	return Response::json(array("status"=>true, "service"=>"verify"));
	  	}
	  	
	  	return Response::json(array("status"=>false, "service"=>"verify", "error_code"=>501, "error_message"=>"User not logged"));
	  	
    } 
      
    
    
    /**
     * profile function.
     * 
     * @access public
     * @return void
     */
    public function getProfile() {
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"profile", "error_code"=>501, "error_message"=>"User not logged"));
		}
		
		unset($user->password);
		unset($user->remember_token);
		unset($user->facebook_token);
		unset($user->created_at);
		unset($user->updated_at);
		unset($user->deleted_at);
		unset($user->last_login);
		
		return Response::json($user);
		
    }
    
    public function postProfile() {
	    
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"profile", "error_code"=>501, "error_message"=>"User not logged"));
		}
		
		$input = Input::all();
		$rules = [
					"first_name" => "required|between:3,50",
					"last_name"  => "required|between:3,50"
				];
					   
		if ($input["email"] != $data->email ) {
			$rules["email"] = "required|email|unique:users,email,".$input["email"];
		}
		
		$password_validate = strlen($input["password"]) > 0 || strlen($input["password"]);
		if ($password_validate) {
			$rules["password"] 	= "required|between:6,16";
			$rules["cpassword"] = "required|same:password";
		}
		
		$validation = Validator::make($input, $rules, $this->errorMsg);
		if ($validation->fails()) {
			$errors = $validation->errors();
			return Response::json(array("status"=>false, "service"=>"register", "error_code"=>503, "error_message"=>$errors));
			
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
			
			Sentinel::update($user, $fields);
			return Response::json(array("status"=>true, "service"=>"register"));
						
		}

		
    }

    
    
    /**
     * promos function.
     * 
     * @access public
     * @return void
     */
    public function getPromos() {
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"promos", "error_code"=>501, "error_message"=>"User not logged"));
		}
	    
	   	$items = Promo::where("active", "=", 1)->get(array("id", "title"));
	   	foreach ($items as $item) {
		   	$item->thumb = $item->thumb(100, 600);
	   	}
		
		return Response::json(array("status"=>true, "promos"=>"stores", "data"=>$items));
		
    }
    
    
    
    /**
     * stores function.
     * 
     * @access public
     * @return void
     */
    public function getStores() {
	    
	   	if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"stores", "error_code"=>501, "error_message"=>"User not logged"));
		}

	   	$items = Store::leftJoin("stores_type", "stores_type.id", "=", "stores.type_id")
	   				  ->where("active", "=", 1)
	   				  ->get(array("stores.id", "stores.title", "stores.address", "stores.phone", 
	   				  			  "stores.lat", "stores.lng", "stores_type.name AS type"));
	   					
	   	foreach ($items as $item) {		   	
		   	$item->thumb = $item->thumb(100, 600);
	   	}
		
		return Response::json(array("status"=>true, "service"=>"stores", "data"=>$items));
		
    }
    
    
    
    /**
     * activities function.
     * 
     * @access public
     * @return void
     */
    public function getActivities() {
	    
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("status"=>false, "service"=>"activities", "error_code"=>501, "error_message"=>"User not logged"));
		}

	   	$items = Activity::leftJoin("activities_type", "activities_type.id", "=", "activities.type_id")
	   				  ->where("active", "=", 1)
	   				  ->get(array("activities.id", "activities.title", "activities.address", "activities.description", 
	   				  			  "activities.lat", "activities.lng", "activities_type.name AS type", "activities.date_from", "activities.date_to"));
	   					
	   	foreach ($items as $item) {		   	
		   	$item->thumb = $item->thumb(100, 600);
	   	}
		
		return Response::json(array("status"=>true, "service"=>"activities", "data"=>$items));
		
    }
    
    
    
	/**************************
	     MÉTODOS PRIVADOS
	***************************/
	
	private function _validate() {

		$data = Sentinel::check();
		if ($data === null) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}