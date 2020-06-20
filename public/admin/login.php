<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
  redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!
if (isset($_POST['submit'])) { // Form has been submitted.

	
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  
  // Check database to see if username/password exist.
	$found_user = User::authenticate($username, $password);
	
  if ($found_user) {
    $session->login($found_user);
		log_action('Login', "{$found_user->username} logged in.");
    redirect_to("index.php");
  } else {
    // username/password combo was not found in the database
    $message = "Username/password combination incorrect.";
  }
  
} else { // Form has not been submitted.
  $username = "";
  $password = "";
}

?>
<?php include_layout_template('admin_header.php'); ?>

<div class="container">
<h1 class="login-heading">
      <strong>Welcome.</strong> Please login.</h1>
  <div class="login">
      
		<form action="login.php" method="post">
        	             
            
            		<?php echo output_message($message); ?>
            
		      Username:
		     
		        <input type="text" name="username" maxlength="30" required class="input-txt"
                 value="<?php echo htmlentities($username); ?>" />
                 
             
		      Password:
		     
		        <input type="password" name="password" maxlength="30" required class="input-txt"
                 value="<?php echo htmlentities($password); ?>" />
              <div class="login-footer">
		        <button type="submit" class="btn btn--right" name="submit">Login</button>
		      
           </div>
  
		  </div>
      </form>
  </div>
</div>

<?php // include_layout_template('admin_footer.php'); ?>
