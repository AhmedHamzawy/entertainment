<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>


<?php
$admin = user::find_by_id($_GET['id'],false,false);
$admin_number = user::count_all();
if(!$admin){
//subject ID was misssing or invalid
//subject couldn't be found in the database
redirect_to('manage_admins.php');	
}

if ($admin_number > 1){
if($admin && $admin->delete()){
	$session->message("Admin deleted");
	redirect_to("manage_admins.php");
}else{
	$session->message("Admin deletion failed");
	redirect_to("manage_admins.php");
}
}else{ 
    $session->message("The Cpanel Requires at least one admin");
    redirect_to("manage_admins.php");
}
?>