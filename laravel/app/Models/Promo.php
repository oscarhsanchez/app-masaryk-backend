<?PHP namespace App\Models;
	
use Intervention\Image\ImageManagerStatic as Image;

class Promo extends Content {
			
	protected $table 	= 'promos';
	protected $filepath = "assets/uploads/promos";
         
    public function store() {
        return $this->belongsTo('App\Models\Store');
    }
    
    public function beacon() {
        return $this->belongsTo('App\Models\Beacon');
    }
    
    public function thumb($w, $h) {
		$tb = $this->getPath("c", $w."x".$h);
		if (!file_exists($tb)) {
			$or    = $this->getPath("o");
			$image = Image::make($or)->resize($w, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($tb);
		}
		return "http://".$_SERVER['SERVER_NAME']."/".$tb;
	}
	     
}