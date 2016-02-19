<?PHP namespace App\Models;

use URL;	
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Database\Eloquent\SoftDeletes;

class Content extends Model {
	
	use SoftDeletes;
	
	public $timestamps 	= true;
	
	protected $table 	= '';
	protected $filepath = "";
    protected $hidden 	= array('created_at', 'updated_at', 'deleted_at');
             
    public function setImageAttribute($image) {
	    if ($this->id) {
			Image::make($image)->save($this->filepath."/o/".$this->id.".png");
			$this->flush();
		}
	}
	
	public function getImageAttribute() {
		if ($this->id) {
			$path = $this->getPath("o");
			return file_exists($path) ? $path : null;
		} else {
			return null;
		}
	}
	
	public function thumb($w, $h) {
		$tb = $this->getPath("c", "thumb.".$w."x".$h);
		if (!file_exists($tb)) {
			$or    = $this->getPath("o");
			$image = Image::make($or)->resize($w, null, function ($constraint) {
				$constraint->aspectRatio();
			})->save($tb);
		}
		return URL::to($tb);
	}
	
	public function crop($w, $h) {
		$tb = $this->getPath("c", "crop.".$w."x".$h);
		if (!file_exists($tb)) {
			$or    = $this->getPath("o");
			$image = Image::make($or)->resize($w, null, function ($constraint) {
				$constraint->aspectRatio();
			})->crop($w, $h)->save($tb);
		}
		return URL::to($tb);
	}
	
	public function getPath($type, $sufix = "") {
		return $this->filepath."/$type/".$this->id.($sufix==""?"":".$sufix").".png";
	}
    
    public function flush() {
		
		$dir = $this->filepath."/c/";
		
		$prefix = $this->id.".";
		
		$dir = rtrim($dir, '\\/');
		$result = array();

		$h = opendir($dir);
		
		while (($f = readdir($h)) !== false) {
			if ($f !== '.' and $f !== '..') {
				if (strpos($f, $prefix, 0) === 0) {
					$result[] = $dir."/".$f;
					unlink($dir."/".$f);
				}
			}
		}
		closedir($h);
		return $result;
		
	}
     
}