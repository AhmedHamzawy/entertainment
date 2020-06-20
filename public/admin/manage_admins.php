<?php require_once("../../includes/initialize.php");  if (!$session->is_logged_in()) { redirect_to("login.php"); } 
include_layout_template('admin_header.php'); ?>


        <div id="main">
        <div id="navigation">
        &nbsp;
        </div>
        <div id="page">
        <?php echo output_message($message); ?>
        <h2>Manage Admins</h2>
        
        <div class="adminlist data">
        
        <h3>User Name</h3>
        <?php $admin_set = user::find_all(false,false); ?> 
        <?php foreach($admin_set as $admin) : 
			echo htmlentities($admin->username);
		 ?>
       
        
        </div>
        <?php endforeach ?>
        <br/>
        
        <h3>Actions</h3>
        <a href="edit_admin.php?id=<?php echo urlencode($admin->id); ?>" class="btn">Edit</a>
        <a href="delete_admin.php?id=<?php echo urlencode($admin->id); ?>" onclick="return confirm ('Are you sure?');"
        class="btn">
        Delete</a>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <a href="new_admin.php" class="btn">Add New Admin</a>      
        </div>
        
         
<?php include_layout_template('admin_footer.php'); ?>
