<?php require_once("../../includes/initialize.php"); if (!$session->is_logged_in()) { redirect_to("login.php"); } 

$current_page = Pages::find_by_id($_GET["page"],false);
if(!$current_page){
//subject ID was misssing or invalid
//subject couldn't be found in the database
echo "failed";
redirect_to('manage_content.php');	
}


if($current_page->delete()){
	$session->message("Page deleted");
	redirect_to("manage_content.php");
}else{
	$session->message("Page deletion failed");
	redirect_to("manage_content.php?page={$id}");
}


?>