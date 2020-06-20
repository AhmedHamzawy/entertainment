<?php
// If it's going to need the database, then it's 
// probably smart to require it before we start.
require_once(LIB_PATH.DS.'database.php');

class User extends DatabaseObject {
	
	protected static $table_name="users";
	protected static $db_fields = array('id', 'username' , 'first_name', 'last_name' , 'hashed_password');
	
	public $id;
	public $username;
	public $first_name;
	public $last_name;
	public $hashed_password;
	
  public function full_name() {
    if(isset($this->first_name) && isset($this->last_name)) {
      return $this->first_name . " " . $this->last_name;
    } else {
      return "";
    }
  }
	public function password_encrypt($password){
	$hash_format = "$2y$10$"; // tell PHP to use  blowfish with a 'cost' of 10 
    $salt_length = 22;  // Blowfish salts should be 22 chars or more
	$salt = self::generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt ;
	$hash = crypt($password , $format_and_salt);
	return $hash;	
	}
	public function generate_salt($length){
		// not 100% unique not 100% random , but good enough for a salt
		// MD5 returns 32 chars
		$unique_random_string = md5(uniqid(mt_rand(),true));
		// valid chars for a salt are [a-zA-z0-9./]
		$base64_string = base64_encode($unique_random_string);
		// but not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+' , '.' , $base64_string);
		// truncate string to the correct length
		$salt = substr($modified_base64_string , 0 , $length);
		return $salt;  
	}
	public function password_check($password , $existing_hash){
		// Existing hash contains format and salt at start
		$hash = crypt($password , $existing_hash);
		if($hash == $existing_hash){
		 return true;	
		}else{
			return false;
		}
	}
	public static function authenticate($username="", $hashed_password="") {
    global $database;
    $username = $database->escape_value($username);
    $hashed_password = $database->escape_value($hashed_password);
    $sqli  = "SELECT * FROM users ";
    $sqli .= "WHERE username = '{$username}' ";
    $sqli .= "LIMIT 1";
    $result_array = self::find_by_sqli($sqli);
	!empty($result_array) ? $username= array_shift($result_array) : false;
	return self::password_check($hashed_password , $username->hashed_password) ? $username : false ;
	}
	 
}
?>