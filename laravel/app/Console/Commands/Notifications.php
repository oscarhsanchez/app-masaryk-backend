<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity, App\Models\Option, App\Models\UserToken, App\Models\Notification;
use Mail, Carbon, DB;

class Notifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifications';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
	    
	    $date  = Carbon\Carbon::now();
		$date->setTimezone('America/Mexico_City');
		$time   = $date->toDateTimeString();
		
		$notification = Notification::where("scheduled", "<=", $time)
									->where("scheduled", "!=", "0000-00-00 00:00:00")
									->where("active", 	 "=", 1)
									->where("completed", "=", 0)
									->first();
	   	    
	    if ($notification) {
		    
		    $lstid = $notification->current;
		    $mssgs = $notification->message;
		    $users = UserToken::where("id", ">", $lstid)
		    						 ->orderBy("id", "asc")
		    						 ->take(50)
		    						 ->get();
		    
		    foreach ($users as $n) {
				if ($n->device == "Android") {
					$result[] = $this->android($mssgs, $n->token);
				} else if ($n->device == "iOS") {
					$result[] = $this->ios($mssgs, $n->token);
				}
				$lstid = $n->id;
			}
			
			$last = UserToken::orderBy("id", "desc")->first();
			
			$notification->current   = $lstid;
			$notification->completed = $last->id == $lstid;
			
			$notification->save();
		    
	    }
	    
    }
    
    public function android($message, $token) {
	    
		$apiKey = "AIzaSyDQ1CcVquQBJHMLc8xsuid8YHXsgu7VSi0";		
		$regids = array();
		$regids[] = $token;
 
        $fields = array(
            'registration_ids' 		  => $regids,
            'data' => array("message" => $message),
        );
 
        $headers = array('Authorization: key=' . $apiKey, 'Content-Type: application/json');
        $ch      = curl_init();
 
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send'); 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
 
        $result = curl_exec($ch);
        if ($result === FALSE) {
            return ('Curl failed: ' . curl_error($ch));
        }
 
        curl_close($ch);
	    return $result;
    }
    
    
    public function ios($message, $token) {
	    
	    $ouput = file_get_contents("http://apps.tangamampilia.net/masaryk/index.php?token=".$token."&message=".$message);
	    return $ouput;
	    
	    
		$passphrase = '123456';
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', public_path('certificates/notifications.pem'));
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);


		if (!$fp) return("Failed to connect: $err $errstr" . PHP_EOL);


		$body['aps'] = array('alert' => $message, 'title' => 'Masaryk');
		$payload = json_encode($body);

		$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
		$result = fwrite($fp, $msg, strlen($msg));
		
		fclose($fp);

		if (!$result) return 'Message not delivered' . PHP_EOL;
		else return 'Message successfully delivered' . PHP_EOL;
	
		
    }
    
}
