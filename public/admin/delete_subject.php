<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
$current_subject = Subjects::find_by_id($_GET["subject"],false);
if(!$current_subject){
//subject ID was misssing or invalid
//subject couldn't be found in the database
	$session->message("No subject ID was provided.");
    redirect_to('manage_content.php');

}

	/*if(empty($_GET['id'])) {
  	$session->message("No photograph ID was provided.");
    redirect_to('manage_content.php');
  	}*/
$subject = Subjects::find_by_id($_GET['subject']);
  if($subject && $subject->delete()) {
    $session->message("The subject was deleted.");
    redirect_to('manage_content.php');
  } else {
    $session->message("The subject could not be deleted.");
    redirect_to('manage_content.php');
  }

/* $pages_set = find_pages_for_subject($current_subject['id']);
if (mysqli_num_rows($pages_set) > 0){
	$_SESSION["message"] = "can't delete a subject with pages";
	redirect_to("manage_content.php?subject={$current_subject["id"]}");
}
$id = $current_subject["id"];
$query = "DELETE FROM subjects WHERE id = {$id} LIMIT 1";
$result = mysqli_query($connection , $query);				

if($result && mysqli_affected_rows($connection) == 1){
	$_SESSION["message"] = "Subject deleted";
	redirect_to("manage_content.php");
}else{
	$_SESSION["message"] = "Subject deletion failed";
	redirect_to("manage_content.php?subject={$id}");
} */
?>