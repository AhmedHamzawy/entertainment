<?php

class Comment extends DatabaseObject {

  protected static $table_name="comments";
  protected static $db_fields=array('id', 'page_id', 'created', 'author', 'body');

  public $id;
  public $page_id;
  public $created;
  public $author;
  public $body;

  // "new" is a reserved word so we use "make" (or "build")
	public static function make($page_id, $author="Anonymous", $body="") {
    if(!empty($page_id) && !empty($author) && !empty($body)) {
			$comment = new Comment();
	    $comment->page_id = (int)$page_id;
	    $comment->created = strftime("%Y-%m-%d %H:%M:%S", time());
	    $comment->author = $author;
	    $comment->body = $body;
	    return $comment;
		} else {
			return false;
		}
	}
	
	public static function find_comments_on($page_id=0) {
    global $database;
    $sqli = "SELECT * FROM " . self::$table_name;
    $sqli .= " WHERE page_id=" .$database->escape_value($page_id);
    $sqli .= " ORDER BY created ASC";
    return self::find_by_sqli($sqli);
	}
	
	public function try_to_send_notification() {
		$mail = new PHPMailer();

		$mail->IsSMTP();
		$mail->Host     = "your.host.com";
		$mail->Port     = 25;
		$mail->SMTPAuth = false;
		$mail->Username = "your_username";
		$mail->Password = "your_password";

		$mail->FromName = "page Gallery";
		$mail->From     = "hamzawyahmed@yahoo.com";
		$mail->AddAddress("ahmedhamzawy3@gmail.com", "page Gallery Admin");
		$mail->Subject  = "New page Gallery Comment";
    $created = datetime_to_text($this->created);
		$mail->Body     =<<<EMAILBODY

	A new comment has been received in the page Gallery.
	
	  At {$created}, {$this->author} wrote:
	
	{$this->body}

EMAILBODY;

		$result = $mail->Send();
		return $result;
		
	}
}

?>