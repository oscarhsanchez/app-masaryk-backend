<?PHP namespace App\Models;

class Activity extends Content {
		
	protected $table 	= 'activities';
	protected $filepath = "assets/uploads/activities";
    
    public function type() {
        return $this->belongsTo('App\Models\ActivityType');
    }	
    
    public function status() {
        return $this->belongsTo('App\Models\ActivityStatus');
    }	
}