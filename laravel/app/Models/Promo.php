<?PHP namespace App\Models;

class Promo extends Content {
			
	protected $table 	= 'promos';
	protected $filepath = "assets/uploads/promos";
         
    public function store() {
        return $this->belongsTo('App\Models\Store');
    }
    
    public function beacon() {
        return $this->belongsTo('App\Models\Beacon');
    }
	     
}