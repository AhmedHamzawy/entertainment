<?php require_once("../../includes/initialize.php");  if (!$session->is_logged_in()) { redirect_to("login.php"); } 


$admin = User::find_by_id($_GET["id"],false,false);
$id = $admin->id;
if(!$admin){
//subject ID was misssing or invalid
//subject couldn't be found in the database

redirect_to("manage_admins.php");	
}



if(isset($_POST['submit'])){
	
	
	//validations
	$required_fields = array('username','firstname' , 'lastname' , 'password');
    Validation::validate_presence($required_fields);
	
	$fields_with_max_length =array("username" => 30);
	Validation::validate_max_length($fields_with_max_length);
	
	//perform update
	$user = new user();	
	$user->id = $id;	
	$user->username = $_POST["username"];
	$user->first_name = $_POST["firstname"];
	$user->last_name = $_POST["lastname"];
	$user->hashed_password = User::password_encrypt($_POST["password"]);	
	
	if(!empty(Validation::$errors)){		
			     
		$session->message(Validation::$errors);
		redirect_to("edit_admin.php?id=".urlencode($id));
	}
	
						

if($user->update()){
	
	$session->message("Admin updated");
	
	redirect_to("manage_admins.php");
}
else{

	$session->message("Admin update failed");
}
	}
else{

//This is probably a get request
} // end: isset($_POST['submit'])

?>


<?php include_layout_template('admin_header.php'); ?>

  <div id="main">
        <div id="navigation">
        &nbsp;
        </div>
        

        <div id="page">
                <?php $errors = $session->message;  echo  Validation::form_errors($errors);  ?>

        
        <div class="container">

		<h1 class="login-heading">
        Edit Admin</h1>
     
       <div class="login">
       
        <form action="edit_admin.php?id=<?php echo urlencode($admin->id); ?>" method="post">
        <br/>
        <p>User Name :
        <input type="text" name="username" value="<?php echo htmlentities($admin->username); ?>" class="input-txt" />
        </p>
        <br/>
        <p>First Name :
        <input type="text" name="firstname" value="<?php echo htmlentities($admin->first_name); ?>" class="input-txt" />
        </p>
        <br/>
        <p>Last Name :
        <input type="text" name="lastname" value="<?php echo htmlentities($admin->last_name); ?>"  class="input-txt" />
        </p>
        <br/>
        <p>Password:
         <input type="password" name="password" value="" class="input-txt" />
        </p>
        <br/>
        <input type="submit" name="submit" class="btn" value="Edit Admin"/>
        <br/><br/>
        </form>
        <br/>
        </div>
        </div>  
        <a href="manage_admins.php" class="btn">cancel</a>                
<?php include_layout_template('admin_footer.php'); ?>
