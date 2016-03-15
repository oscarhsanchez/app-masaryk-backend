<?php namespace App\Http\Controllers;

use Input, Validator, View, Response, DB, Mail, URL, Auth, Session;
use App\User, App\Models\Promo, App\Models\Store, App\Models\Beacon, App\Models\Activity, App\Models\UserNotification, App\Models\Option;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;

class ApiController extends Controller {

	use ResetsPasswords;

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
	    
    	$email    = Input::get('email');
		$password = Input::get('password');
		
		if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1], true)) {
			
			$user = Auth::user();
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
			
			$data = new User();
			$data->facebook_id  = Input::get('fb_id', '');
			$data->email 		= Input::get('email');
			$data->password 	= bcrypt(Input::get('password'));	
			$data->first_name 	= Input::get('first_name');	
			$data->last_name	= Input::get('last_name');	
			$data->birthday 	= Input::get('birthday');	
			$data->city 		= Input::get('city');	
			$data->remember_token = $remember_token;
			$data->facebook_token = Input::get('token', '');

			$data->save();
			Auth::loginUsingId($data->id);

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
		    		    
		    if ($user) {
			    
			    $user = User::findById($user->id);
				Auth::loginUsingId($user->id);
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
    public function anyRecover() {
	    	    
	    $email = Input::get("email", '');
		$rules = [ "email" => "required|email"];
					 			
		$validation = Validator::make(Input::all(), $rules);
		if ($validation->fails()) {
			return Response::json(array("success"=>false, "service"=>"recover", "error_code"=>400, "error_message"=>"Verifica el formato de tu correo."));
			
		} else {
						
			$broker   = $this->getBroker();
			$response = Password::broker($broker)->sendResetLink(["email"=>$email], function (Message $message) use ($email) {
				Session::set("reset.password.email", $email);
            	$message->subject('Camina Masarik - Recuperar Contraseña');
			});
			
			switch ($response) {
            	case Password::RESET_LINK_SENT:
                	return Response::json(array("success"=>true, "service"=>"recover", "response"=>$response));

				case Password::INVALID_USER:
            		default:
					return Response::json(array("success"=>false, "service"=>"recover", "error_code"=>403, "error_message"=>"Correo no encontrado."));
			}
		
	    }	
    }  
    
          
    
    
    /**
     * code function.
     * 
     * @access public
     * @return void
    */
    public function getCode() {
	    
	    $token  = Input::get("t", "");
	    $email  = Input::get("e", "");
	    $psswrd = strtolower(str_random(8));
	    $broker = $this->getBroker();
	    $params = ["email" => $email, "token" => $token, "password" => $psswrd, "password_confirmation" => $psswrd];

        $response = Password::broker($broker)->reset($params, function ($user, $password) {
            $this->resetPassword($user, $password);
        });
		
		if ($response == Password::PASSWORD_RESET) {
			
			$user = User::where("email", "=", $email)->first();
			$name = trim($user->first_name)." ".trim($user->last_name);
			
			$user->password = bcrypt($psswrd);
			$user->save();
			
			Mail::send('emails.reset', ['email' => $email, 'password' => $psswrd], function($message) use ($email, $name) {
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
			$data = array("splash"=>$this->_splash());
			return Response::json(array("success"=>true, "service"=>"verify", "data"=>$data));
		}
	  	
    }  
        
          
    
    
    /**
     * renew function.
     * 
     * @access public
     * @return void
     */
    public function anyRenew() {
	    
	    $token = Input::get("renew_token", "");
	    $email = Input::get("email", "");
	    
	    $user  = User::where("remember_token", "=", trim($token))
	   			     ->where("remember_token", "!=", "")->first();
	   			     	  	
	  	if ($user) {
		  	$data = array("splash" => $this->_splash());
		  	Auth::loginUsingId($user->id);
		  	return Response::json(array("success"=>true, "service"=>"renew", "data"=>$data));
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
			
			$user->email 		= Input::get('email');	
			$user->first_name 	= Input::get('first_name');	
			$user->last_name	= Input::get('last_name');	
			$user->birthday 	= Input::get('birthday');	
			$user->city 		= Input::get('city', 'Mexico');
			$user->phone 		= Input::get('phone');	
			
			if ($password_validate) {
				$user->password = bcrypt(Input::get('password'));
			}
			
			if (Input::hasFile('image')) {
				if (getimagesize(Input::file('image')->getRealPath())) {
					$user->image = Input::file('image')->getRealPath();
					$user->flush();
				}	
			}
			
			$user->save();

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
	   				  			  "stores.lat", "stores.lng", "stores_type.name AS type",
	   				  			  "stores.description"));
	   					
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
	   				  ->leftJoin("users_activities", "activities.id", "=", "users_activities.activity_id")
	   				  ->where("active", "=", 1)
	   				  ->get(array("activities.id", "activities.title", "activities.address", "activities.description", 
	   				  			  "activities.lat", "activities.lng", "activities.url", "activities.type_id", 
	   				  			  "activities.status_id AS status", "activities_type.name AS type", "activities.date_from", 
	   				  			  "activities.date_to", DB::raw("IF(`users_activities`.`user_id`=1,1,0) AS scheduled")));
	   					
	   	foreach ($items as $item) {		   	
		   	$thumb = $item->crop(100, 100);
		   	$full  = $item->crop(800, 400);
		   	$item->thumb  = array("src"=>$thumb, "width"=>100, "height"=>100);
		   	$item->full   = array("src"=>$full,  "width"=>800, "height"=>400);
	   	}
		
		return Response::json(array("success"=>true, "service"=>"activities", "data"=>$items));
		
    }
    
    
    
    /**
     * activity register function.
     * 
     * @access public
     * @return void
     */
    public function anyActivityRegister() {
	    	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"activity-register", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
		
		$activity = Input::get("activity_id", 0);
		$activity = Activity::find($activity);
		
		if (!$activity) {
			return Response::json(array("success"=>false, "service"=>"activity-register", "error_code"=>402, "error_message"=>"Actividad no encontrada."));
		}
		
		$exists = DB::table("users_activities")->where("activity_id", "=", $activity->id)->where("user_id", "=", $user->id)->first();
		if (!$exists) {
			DB::table("users_activities")->insert( array('user_id' => 1, 'activity_id' => $activity->id) );
		}
	   	
		
		return Response::json(array("success"=>true, "service"=>"activity-add", "data"=>$this->getActivities()));
		
    }
          
    
    
    /**
     * activity unregister function.
     * 
     * @access public
     * @return void
     */
    public function anyActivityUnregister() {
	    	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"activity-unregister", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
		
		$activity = Input::get("activity_id", 0);
		$activity = Activity::find($activity);
		
		if (!$activity) {
			return Response::json(array("success"=>false, "service"=>"activity-unregister", "error_code"=>402, "error_message"=>"Actividad no encontrada."));
		}
		
		DB::table("users_activities")->where("activity_id", "=", $activity->id)->where("user_id", "=", $user->id)->delete();
		
		return Response::json(array("success"=>true, "service"=>"activity-add", "data"=>$this->getActivities()));
		
    }  
    
        
    
    
    /**
     * activity register function.
     * 
     * @access public
     * @return void
     */
    public function anyNotification() {
	    	    
	    if (!$user = $this->_validate()) {
			return Response::json(array("success"=>false, "service"=>"notification", "error_code"=>403, "error_message"=>"Sesión no válida."));
		}
		
		$token  = Input::get("token", "");
		$device = Input::get("device", "");
		$notification = UserNotification::where("device", "=", trim($device))->where("token", "=", trim($token))->first();
				
		if (!$notification) {
			$notification = new UserNotification();
			$notification->user_id = $user->id;
			$notification->device  = trim($device);
			$notification->token   = trim($token);
			$notification->save();
		} else {
			$notification->user_id = $user->id;
			$notification->save();
		}
	   	
		return Response::json(array("success"=>true, "service"=>"notification"));
		
    }
    
    
    
    
    /**
     * getLogout function.
     * 
     * @access public
     * @return void
     */
     
    public function getLogout() {
		 Auth::logout();
		 return Response::json(array("success"=>true, "service"=>"logout"));
	}
	
	
    
    
	/**************************
	     MÉTODOS PRIVADOS
	***************************/
	
	private function _validate() {

		$data = Auth::user();
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
	
	private function _splash() {		
		$splash = Promo::find(Option::get("splash", 0));
		//print_r($splash);
		return $splash->thumb(800, 1200);
	}
	
}