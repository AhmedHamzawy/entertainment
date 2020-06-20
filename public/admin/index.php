<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php'); ?>


	<?php echo output_message($message); ?>
	    <div id="main">
        <div id="navigation">
        &nbsp;
        </div>
        <div id="page">
        <p class="welcomemsg">Welcome to the admin area</p>
        <br/>
        <ul class="adminlist">
        <li><a href="manage_content.php">Manage Website Content</a></li>
        <li><a href="manage_admins.php">Manage Admin Users</a></li>
		<li><a href="list_photos.php">List Photos</a></li>
		<li><a href="logfile.php">View Log file</a></li>
		<li><a href="logout.php">Logout</a></li>
		</ul>
        </div>
        </div>

<?php include_layout_template('admin_footer.php'); ?>
		
