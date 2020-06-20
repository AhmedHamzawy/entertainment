<?php

class Pages extends DatabaseObject {
	
	protected static $table_name="pages";
	protected static $db_fields=array('id', 'subject_id', 'menu_name', 'position' , 'visible' , 'content' , 'datetime' , 'date' , 'photo_id' );
	
	public $id;
	public $subject_id;
	public $menu_name;
	public $position;
	public $visible;
	public $content;
    public $datetime;
	public $date;
	public $photo_id;
	public static $current_subject;
	public static $current_page;
	
	
	public static function find_pages_for_subject($subject_id , $public = true){
	global $database;	
	 $sqli = "SELECT * FROM " . self::$table_name; 
	 $safe_subject_id = $database->escape_value($subject_id);
	 $sqli .= " WHERE subject_id= '$safe_subject_id'";
	 if($public){
	 $sqli .= " AND visible = 1 ";
	 }
	 $sqli .= " ORDER BY position ASC";			
	 $result = self::find_by_sqli($sqli);
	 return $result;		
	}

	 public static function find_default_page_for_subject($subject_id){
		
		$page_set = Pages::find_pages_for_subject($subject_id);
		return !empty($page_set) ? array_shift($page_set) : null;

	} 
	
	public static function find_selected_page($public,$priv){
		global  $current_subject;
		global  $current_page;
	if(isset($_GET["subject"])){
		$current_subject = Subjects::find_by_id($_GET["subject"],$public,$priv);
		if($current_subject && $public){
		$current_page = pages::find_default_page_for_subject($current_subject->id);
		}else{
		$current_page = null;	
		}
	}elseif (isset($_GET["page"])){
		$current_page = pages::find_by_id($_GET["page"],$public,$priv);
		$current_subject = null; 
	}
	else
	{
	
		$current_page = null;
		$current_subject = null;
	}
		
	}
	public function comments() {
		return Comment::find_comments_on($this->id);
	}	
		
}