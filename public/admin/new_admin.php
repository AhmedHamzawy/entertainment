<?php require_once("../../includes/initialize.php"); if (!$session->is_logged_in()) { redirect_to("login.php"); } 
include_layout_template('admin_header.php'); 

	if(isset($_POST['submit'])){
		
		//process the form
		
		
		$user = new User();	
		$user->username = $_POST["username"];
		$user->first_name = $_POST["firstname"];
		$user->last_name = $_POST["lastname"];
		$user->hashed_password = User::password_encrypt($_POST["password"]);
	
		//validations
		$required_fields = array('username' , 'firstname' , 'lastname' , 'password');
		Validation::validate_presence($required_fields);
		
		$fields_with_max_length =array("username" => 30 , "firstname" => 30 , "lastname" => 30);
		Validation::validate_max_length($fields_with_max_length);
			
			
			
			
			if(!empty(Validation::$errors)){		
			     
				 $session->message(Validation::$errors);
				 redirect_to("new_admin.php");
		}
		
		if($user->save()){
			
			$session->message("Admin created");
			
			redirect_to("manage_admins.php");
		}
		else{
			
			$session->message("Admin creation failed");
		}
			
		}
	
	
	
?>


        <div id="main">
        <div id="navigation">
        &nbsp;
        </div>
        

        <div id="page">
        <?php $errors = $session->message;  echo  Validation::form_errors($errors);  ?>

        
        <div class="container">
        
        <h1 class="login-heading">
        Create Admin</h1>
     
       <div class="login">
        
        <form action="new_admin.php" method="post">
        <br/>
        <p>User Name :
        <input type="text" name="username" value="" class="input-txt"  />
        </p>
        <br/>
        <p>First Name :
        <input type="text" name="firstname" value="" class="input-txt"  />
        </p>
        <br/>
        <p>Last Name :
        <input type="text" name="lastname" value="" class="input-txt"  />
        </p>
        <br/>
        <p>Password:
         <input type="password" name="password" value="" class="input-txt"  />
        </p>
        <br/>
        <br/>
        <input type="submit" name="submit" value="create Admin" class="btn"/>
        <br/><br/>
        </form>
        <br/>
       
        </div>      
         </div>
          <a href="manage_admins.php" class="btn">cancel</a>
<?php include_layout_template('admin_footer.php'); ?>
