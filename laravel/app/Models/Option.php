<?PHP namespace App\Models;

use Illuminate\Database\Eloquent\Model;	

class Option extends Model {
		
	protected $table 	  = 'options';
	protected $primaryKey = 'key';
    public $timestamps = false;
    
    public static function set($key, $value) {
        $option = Option::find($key);
        if (!$option) {
	        $option = new Option();
	        $option->key = $key;
        }
        $option->value = $value;
        $option->save();
    }
    
    public static function get($key, $default = "-") {
        $option = Option::find($key);
        if (!$option) {
	        return $default;
        }
        return $option->value;
    }	
    
    public static function remove($key) {
        $option = Option::find($key);
        if ($option) {
	        $option->delete();
        }
    }
    
}