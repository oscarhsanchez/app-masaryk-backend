<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity, App\Models\Option, App\Models\UserNotification;
use Mail;
use Carbon;

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
    protected $description = 'Activities notifications';

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
    public function handle()
    {
		
		$email = "tangamampilia@gmail.com";
		$date  = Carbon\Carbon::now();
		
		$date->setTimezone('America/Mexico_City');
		$time   = $date->toDateTimeString();
		
		$notifications = UserNotification::all();
		$result = array();
		
		foreach ($notifications as $n) {
			if ($n->device == "Android") {
				$result[] = $this->android("Hola Mundo", $n->token);
			}
		}
		
		Option::set("last", $time);
	    Mail::send('emails.notification', ["time"=>$time], function($message) use ($email) {
			$message->to($email)->subject('CRONJOB');
		});

	    $this->info(var_export($result, true));
        //
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
            die('Curl failed: ' . curl_error($ch));
        }
 
        curl_close($ch);
	    return $result;
    }
    
    
    public function ios($message, $token) {
	    
		$passphrase = '123456';
		$ctx = stream_context_create();
		stream_context_set_option($ctx, 'ssl', 'local_cert', 'libraries/notifications.pem');
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);


		if (!$fp) return("Failed to connect: $err $errstr" . PHP_EOL);


		$body['aps'] = array('alert' => $message, 'title' => 'Curso iOS Development', 'mensaje' => 'Hola' );
		$payload = json_encode($body);

		$msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
		$result = fwrite($fp, $msg, strlen($msg));
		
		fclose($fp);

		if (!$result) return 'Message not delivered' . PHP_EOL;
		else return 'Message successfully delivered' . PHP_EOL;
	
		
    }
    
}
