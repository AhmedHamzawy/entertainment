<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class Photograph extends DatabaseObject {
	
	protected static $table_name="photographs";
	protected static $db_fields=array('id', 'filename', 'type', 'size', 'caption');
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;
	
	private $temp_path;
  protected $upload_dir="images";
 
	// Pass in $_FILE(['uploaded_file']) as an argument
  public function attach_file($file) {
		// Perform error checking on the form parameters
		if(!$file || empty($file) || !is_array($file)) {
		  // error: nothing uploaded or wrong argument usage
		  Validation::$errors[] = "No file was uploaded.";
		  return false;
		} elseif($file['error'] != 0) {
		  // error: report what PHP says went wrong
		  Validation::$errors[] = Validation::$upload_errors[$file['error']];
		  return false;
		} else {
			// Set object attributes to the form parameters.
		  $this->temp_path  = $file['tmp_name'];
		  $this->filename   = basename($file['name']);
		  $this->type       = $file['type'];
		  $this->size       = $file['size'];
			// Don't worry about saving anything to the database yet.
			return true;

		}
	}
  
	public function save() {
		// A new record won't have an id yet.
		if(isset($this->id)) {
			// Really just to update the caption
			$this->update();
		} else {
			// Make sure there are no errors
			
			// Can't save if there are pre-existing errors
		  if(!empty(Validation::$errors)) { return false; }
		  
			// Make sure the caption is not too long for the DB
		  if(strlen($this->caption) > 255) {
				Validation::$errors[] = "The caption can only be 255 characters long.";
				return false;
			}
		
		  // Can't save without filename and temp location
		  if(empty($this->filename) || empty($this->temp_path)) {
		    Validation::$errors[] = "The file location was not available.";
		    return false;
		  }
			
			// Determine the target_path
		  $target_path = SITE_ROOT .DS. 'public' .DS. $this->upload_dir .DS. $this->filename;
		  
		  // Make sure a file doesn't already exist in the target location
		  if(file_exists($target_path)) {
		    Validation::$errors[] = "The file {$this->filename} already exists.";
		    return false;
		  }
		
			// Attempt to move the file 
			if(move_uploaded_file($this->temp_path, $target_path)) {
		  	// Success
				// Save a corresponding entry to the database
				if($this->create()) {
					// We are done with temp_path, the file isn't there anymore
					unset($this->temp_path);
					return true;
				}
			} else {
				// File was not moved.
		    Validation::$errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
		    return false;
			}
		}
	}
	
	public function destroy() {
		// First remove the database entry
		if($this->delete()) {
			// then remove the file
		  // Note that even though the database entry is gone, this object 
			// is still around (which lets us use $this->image_path()).
			$target_path = SITE_ROOT.DS.'public'.DS.$this->image_path();
			return unlink($target_path) ? true : false;
		} else {
			// database delete failed
			return false;
		}
	}

	public function image_path() {
	  return $this->upload_dir.DS.$this->filename;
	}
	
	public function size_as_text() {
		if($this->size < 1024) {
			return "{$this->size} bytes";
		} elseif($this->size < 1048576) {
			$size_kb = round($this->size/1024);
			return "{$size_kb} KB";
		} else {
			$size_mb = round($this->size/1048576, 1);
			return "{$size_mb} MB";
		}
	}
	
	
}
?>