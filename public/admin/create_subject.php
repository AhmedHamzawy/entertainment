<?php require_once('../../includes/initialize.php'); if (!$session->is_logged_in()) { redirect_to("login.php"); }


if(isset($_POST['submit'])){
	
	$subject = new Subjects();
	$subject->menu_name = $_POST['menu_name'];
	$subject->position = (int) $_POST['position'];
	$subject->visible =  (int) $_POST['visible'];
	
	

	//validations
	$required_fields = array('menu_name', 'position' , 'visible');
	Validation::validate_presence($required_fields);
			
	$fields_with_max_length =array("menu_name" => 30);
	Validation::validate_max_length($fields_with_max_length);
	
	
	if(!empty(Validation::$errors)){		
			     
		$session->message(Validation::$errors);
		redirect_to("new_subject.php");
	}
	

				
 if($subject->save()){
	$session->message("Subject created");
	redirect_to("manage_content.php");
		
	}
	else{
		$session->message("Subject Creation failed");
		redirect_to("new_subject.php");
	}
		
	}else{
	
		//This is probably a get request
		redirect_to("new_subject.php");	
		
	}

?>


