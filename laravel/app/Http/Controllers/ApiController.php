<?php namespace App\Http\Controllers;

use Input, Validator, View, Response, DB, Mail, URL, App\User, App\Models\Promo, App\Models\Store, App\Models\Beacon, App\Models\Activity;
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
	   	return View::make("api.form");
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
			
			return Response::json(array("success"=>true, "service"=>"login", "data"=>$user));
		}
		
		return Response::json(array("success"=>false, "service"=>"login", "error_code"=>403, "error_message"=>"Verifica tu usuario y/o contraseña."));
		
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
			$errors  = $validation->errors()->all();
			return Response::json(array("success"=>false, "service"=>"register", "error_code"=>400, "error_message"=>$errors));
			
		} else {
			
			$remember_token = bcrypt(str_random(20));
			
			$fields = [	
				"facebook_id" 	 => Input::get('fb_id', ''),
				"email" 	 	 => Input::get('email'),
				"password" 	 	 => Input::get('password'),
				"first_name" 	 => Input::get('first_name'),
				"last_name"  	 => Input::get('last_name'),
				"facebook_token" => Input::get('facebook_token', ''),
				"birthday"  	 => Input::get('birthday', ''),
				"city"  		 => Input::get('city', 'Mexico'),
				"remember_token" => $remember_token,
				"facebook_token" => Input::get('token', ''),
			];		
			
			$user = Sentinel::registerAndActivate($fields);
			Sentinel::login($user);

			return Response::json(array("success"=>true, "service"=>"register", "data"=>array("remember_token"=>$remember_token)));
						
		}
		
    }
         
    
    
    /**
     * register function.
     * 
     * @access public
     * @return void
     */
    public function postFacebook() {
	    	    
	    $token = Input::get("token", "");
	    $graph = "https://graph.facebook.com/me/?fields=email,id,birthday,hometown,first_name,last_name&access_token=".$token;
	    $data  = json_decode(file_get_contents($graph));
	    
	    if (isset($data->error)) {
		    return Response::json(array("success"=>false, "service"=>"facebook", "error_code"=>403, "error_message"=>"No se pudieron obtener los datos de Facebook."));
	    } else {
		    
		    $user = User::where("facebook_id", "=", $data->id)->first();
		    		    
		    if (!$user) {
			    
			    $user = Sentinel::findById($user->id);
				Sentinel::loginAndRemember($user);
				return Response::json(array("success"=>true, "service"=>"facebook", "data"=>array("logged"=>true)));
				 
		    } else {
			    
			    $data->logged = false;
			    $data->token  = $token;
			    
			    if (isset($data->birthday)) {
				    $birthday = explode("/", $data->birthday);
				    $data->birthday = $birthday[2]."-".$birthday[0]."-".$birthday[1];
			    } else {
				    $data->birthday = "0000-00-00";
			    }
			    
			    if (isset($data->hometown)) {
				    $hometown = explode(",", $data->hometown->name);
				    $data->hometown = trim($hometown[0]);
			    } else {
				    $data->hometown = "";
			    }
			    
			    return Response::json(array("success"=>true, "service"=>"facebook", "data"=>$data));
			    
		    }
		    
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
			return Response::json(array("success"=>false, "service"=>"recover", "error_code"=>400, "error_message"=>"Verifica el formato de tu correo."));
			
		} else {
			
			$user = Sentinel::findByCredentials(['login' => $email]);
			
			if (!$user) {
				return Response::json(array("success"=>false, "service"=>"recover", "error_code"=>403, "error_message"=>"Correo no encontrado."));
			}
			
			$reminder = Reminder::create($user);
			$link     = "http://".$_SERVER['SERVER_NAME']."/api/code?email=".$email."&amp;code=".$reminder->code;
			$name 	  = trim($user->first_name)." ".trim($user->last_name);
			
			Mail::send('emails.recover', ['email' => $email, 'link' => $link], function($message) use ($email, $name) {
				$message->to($email, $name)->subject('Camina Masarik - Recuperar Contraseña');
			});
		
			return Response::json(array("success"=>true, "service"=>"recover"));
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
			return Response::json(array("success"=>false, "service"=>"verify", "error_code"=>403, "error_message"=>"Sesión no válida."));
		} else {
			return Response::json(array("success"=>true, "service"=>"verify"));
		}
	  	
    }  
        
          
    
    
    /**
     * renew function.
     * 
     * @access public
     * @return void
     */
    public function anyRenew() {
	    
	    $token = Input::get("remember_token", "");
	    $email = Input::get("email", "");
	    
	    $user  = User::where("remember_token", "=", trim($token))
	   			     ->where("remember_token", "!=", "")->first();
	   			     
	   			     //->where("email", "=", $email)
	  	
	  	if ($user) {
		  	Sentinel::login(Sentinel::findById($user->id));
		  	return Response::json(array("success"=>true, "service"=>"renew"));
	  	}
	  	
	  	return Response::json(array("success"=>false, "service"=>"renew", "error_code"=>403, "error_message"=>"Sesión no válida."));
	  	
    } 
      
    
    
    /**
     * profile function.
     * 
     * @access public
     * @return void
     */
    public function getProfile() {
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"profile", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
		
		if (!$user->image) {
			if ($user->facebook_id) {
				$user->avatar = "http://graph.facebook.com/".$user->facebook_id."/picture?type=large";
			} else {
				$user->avatar = URL::to("assets/images/avatar.jpg");
			}
		} else {
			$user->avatar = $user->crop(300, 300);
		}
		
		
		
		//$user->avatar = array();
		
		unset($user->password);
		unset($user->remember_token);
		unset($user->facebook_token);
		unset($user->created_at);
		unset($user->updated_at);
		unset($user->deleted_at);
		unset($user->last_login);
		
		return Response::json(array("success"=>true, "service"=>"profile", "data"=>$user));
		
    }
    
    public function postProfile() {
	    
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"profile", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
		
		$input = Input::all();
		$rules = [
					"first_name" => "required|between:3,50",
					"last_name"  => "required|between:3,50"
				];
					   
		if ($input["email"] != $user->email) {
			$rules["email"] = "required|email|unique:users,email,".$input["email"];
		}
		
		$password_validate = false;
		if (isset($input["password"])) {
			$password_validate = strlen($input["password"]) > 0 || strlen($input["password"]);
			if ($password_validate) {
				$rules["password"] 	= "required|between:6,16";
				$rules["cpassword"] = "required|same:password";
			}
		}
		
		$validation = Validator::make($input, $rules, $this->errorMsg);
		if ($validation->fails()) {
			$errors = $validation->errors()->all();
			return Response::json(array("success"=>false, "service"=>"profile", "error_code"=>400, "error_message"=>$errors));
			
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
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$user->image = Input::file('image')->getRealPath();
					$user->flush();
				}	
			}
			
			Sentinel::update($user, $fields);
			return $this->getProfile();
						
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
			return Response::json(array("success"=>false, "service"=>"promos", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
	    
	   	$items = Promo::where("active", "=", 1)->get(array("id", "title"));
	   	foreach ($items as $item) {
		   	
			$thumb = $item->thumb(400, 400);
		   	$full  = $item->thumb(800, 1200);
		   	$sizet = getimagesize($item->getPath("c", "thumb.400x400"));
		   	$sizef = getimagesize($item->getPath("c", "thumb.800x1200"));
		   	
		   	$item->thumb  = array("src"=>$thumb, "width"=>$sizet[0], "height"=>$sizet[1]);
		   	$item->full   = array("src"=>$full,  "width"=>$sizef[0], "height"=>$sizef[1]);
		   
	   	}
		
		return Response::json(array("success"=>true, "service"=>"promos", "data"=>$items));
		
    }
    
    
    
    /**
     * stores function.
     * 
     * @access public
     * @return void
     */
    public function getStores() {
	    
	   	if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"stores", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}

	   	$items = Store::leftJoin("stores_type", "stores_type.id", "=", "stores.type_id")
	   				  ->where("active", "=", 1)
	   				  ->get(array("stores.id", "stores.title", "stores.address", "stores.phone", 
	   				  			  "stores.lat", "stores.lng", "stores_type.name AS type"));
	   					
	   	foreach ($items as $item) {		   	
		   	
		   	$thumb = $item->crop(100, 100);
		   	$full  = $item->crop(800, 400);
		   	$item->thumb  = array("src"=>$thumb, "width"=>100, "height"=>100);
		   	$item->full   = array("src"=>$full,  "width"=>800, "height"=>400);
		   	
	   	}
		
		return Response::json(array("success"=>true, "service"=>"stores", "data"=>$items));
		
    }
    
    
    
    /**
     * activities function.
     * 
     * @access public
     * @return void
     */
    public function getActivities() {
	    
	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"activities", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}

	   	$items = Activity::leftJoin("activities_type", "activities_type.id", "=", "activities.type_id")
	   				  ->where("active", "=", 1)
	   				  ->get(array("activities.id", "activities.title", "activities.address", "activities.description", 
	   				  			  "activities.lat", "activities.lng", "activities_type.name AS type", "activities.date_from", "activities.date_to"));
	   					
	   	foreach ($items as $item) {		   	
		   	$item->thumb = $item->thumb(100, 600);
	   	}
		
		return Response::json(array("success"=>true, "service"=>"activities", "data"=>$items));
		
    }
    
    
    
	/**************************
	     MÉTODOS PRIVADOS
	***************************/
	
	private function _validate() {

		$data = Sentinel::check();
		if ($data === null) {
			return false;
		}
		
		if (!is_object($data)) {
			return false;
		}
		
		if ($data->deleted_at != NULL) {
			return false;
		}
		
		return $data;
	}
	
}