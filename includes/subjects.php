<?php


class Subjects extends DatabaseObject {
	
	protected static $table_name="subjects";
	protected static $db_fields=array('id', 'menu_name', 'position', 'visible');
	public  $id; 
	public  $menu_name;
	public  $position;
	public  $visible;

	
  /* 	public static function find_all_subjects($public = true){
	global $database;	
	$sqli="SELECT * FROM " . self::$table_name ;
	if($public){
		$sqli .= " WHERE visible = 1";
	}
	$sqli .= " ORDER BY position DESC";			
	$result = self::find_by_sqli($sqli);
	return $result;	
	}
	
	public static function count_all_subjects(){
		
		global $database;
		$sqli="SELECT * FROM " . self::$table_name ;
		$query = $database->query($sqli);
		$result = $database->num_rows($query);
		return $result;
		
	}
	
	public static function find_subject_by_id($subject_id,$public = true){
	global $database;
	
	$sqli = "SELECT * FROM " . self::$table_name ;
	$sqli .= " WHERE id= "   . $database->escape_value($subject_id);
	if($public){
	$sqli .=" AND visible = 1"; 	
	}
	$sqli .=" LIMIT 1";			
	if($subject = self::find_by_sqli($sqli)){
		return $subject;	
		}
		else{
			return null;
		}
	} */
	
}

 
?>