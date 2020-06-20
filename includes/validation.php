<?php


class Validation extends DatabaseObject {
	
  public $required_fields;
  public $fields_with_max_length;
  public static $errors = array();
  
  public function fieldname_as_text($field_name){
  $field_name = str_replace("_"," ",$field_name);
  $field_name = ucfirst($field_name);
  return $field_name;
  }
  // * presence
  // use trim() so empty spaces don't count
  // use === to avoid false positives
  // empty() would condsider "0" to be empty
  public static function has_presence($value){
	return isset($value) && $value !== "";  
  }
  public static function validate_presence($required_fields){

  foreach($required_fields as $field){
		$value = trim($_POST[$field]);
		if(!self::has_presence($value)){
	    self::$errors[$field] = self::fieldname_as_text($field)." can't be blank";
		echo self::$errors[$field];
   }
  }
  }
  // * string length
  // * max length
  public static function has_max_length($value , $max){
	 return strlen($value) <= $max;
  }
  public static function validate_max_length($fields_with_max_length){

  foreach($fields_with_max_length as $field => $max){
		$value = trim($_POST[$field]);
		if(!self::has_max_length($value , $max)){
	   self::$errors[$field] = self::fieldname_as_text($field)."  is too long";
   }
  }
  }
  
  // * inclusion in a set
  public static function has_inclusion_in($value , $set){
      return in_array($value , $set);
  }
  
   public static $upload_errors = array(
		// http://www.php.net/manual/en/features.file-upload.errors.php
	  UPLOAD_ERR_OK 				=> "No errors.",
	  UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	
	public static function form_errors($errors){
		  $output = "";
	  if(!empty($errors)){
		  $output .= "<div class=\"error\">";
		  $output .= "please fix the following errors:";
		  $output .= "<ul>";
		  foreach($errors as $key => $error){
			  $output .= "<li>";
			  $output .= htmlentities($error);
			  $output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
	  }
	  return $output ;
	  }
}
 ?>      