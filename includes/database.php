<?php
require_once(LIB_PATH.DS."config.php");
/* notes 
  
  $result = mysqli_query($this->connection , $sqli);
  $output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";  $this->connection

*/
class MySQLIDatabase {
	
	private $connection;
	public  $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;
	
  function __construct() {
   $this->getSomething();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists( "mysqli_real_escape_string" );
  }

	public function open_connection() {
		if($this->connection == Null) { $this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME); }
		if (!$this->connection) {
			die("Database connection failed: " .  mysqli_connect_errno() .  mysqli_error($this->connection) .  PHP_EOL);
		} 
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysqli_close($this->connection);
			unset($this->connection);
		}
	}
       
      public function getSomething(){
		
		   $this->open_Connection();
		   
	}

	public function query($sqli) {
		$this->last_query = $sqli;
		$result = mysqli_query($this->connection , $sqli);
		$this->confirm_query($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		if( $this->real_escape_string_exists ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysqli_real_escape_string can do the work
			if( $this->magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysqli_real_escape_string( $this->connection , $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$this->magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	// "database-neutral" methods
  public function fetch_array($result_set) {
    return mysqli_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysqli_num_rows($result_set);
  }
  
  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysqli_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mysqli_affected_rows($this->connection);
  }

	private function confirm_query($result) {
		if (!$result) {
	    $output = "Database query failed: " . mysqli_error($this->connection) . "<br /><br />";
	    $output .= "Last SQLI query: " . $this->last_query;
	    die( $output );
		}
	}
	
}

$database = new MySQLIDatabase();
$db =& $database;


?>	