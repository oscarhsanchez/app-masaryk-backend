<?PHP namespace App\Models;

class Store extends Content {
		
	protected $table 	= 'stores';
	protected $filepath = "assets/uploads/stores";
    
    public function type() {
        return $this->belongsTo('App\Models\StoreType');
    }	
     
}