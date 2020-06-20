<?php require_once("../../includes/initialize.php"); pages::find_selected_page(false,true);


if(isset($_POST['submit'])){
	
	
	//validations
	$required_fields = array('menu_name', 'position' , 'visible');
	Validation::validate_presence($required_fields);
			
	$fields_with_max_length =array("menu_name" => 30);
	Validation::validate_max_length($fields_with_max_length);
	
	
	//perform update
    $subject = new Subjects();	
	$subject->id = $current_subject->id;
	$subject->menu_name = $_POST['menu_name'];
	$subject->position = (int) $_POST['position'];
	$subject->visible = (int) $_POST['visible'];
	
	
	
	
	
	if(!empty(Validation::$errors)){		
			     
		$session->message(Validation::$errors);
		redirect_to("edit_subject.php?subject=".urlencode($current_subject->id));
	}

	if($subject->save()){
		$session->message("Subject Updated");
		redirect_to("manage_content.php");
		
	}
	
	 else{
		
		$session->message("Subject Update failed");				
		redirect_to("new_subject.php");
	} 
	}else{

//This is probably a get request
} end: isset($_POST['submit'])

?>

<?php
if(!$current_subject){
//subject ID was misssing or invalid
//subject couldn't be found in the database

redirect_to("manage_content.php");	
}

?>
<?php include_layout_template('admin_header.php'); ?>


<div id="main">



	<!-- The Navigation -->

    <div id="navigation">
        <?php  echo Navigation::navigation_admin($current_subject ,$current_page) ; ?>
    </div>
    
    <!-- End The Navigation  -->
    
    
    
        <div id="page">
        
  		<?php  $errors = $session->message;  echo   Validation::form_errors($errors);  ?>

       
        
        <div class="container">

		<h1 class="login-heading">
        Edit Subject : <?php echo htmlentities($current_subject->menu_name); ?></h1>
     
       <div class="login">
        
        <form action="edit_subject.php?subject=<?php echo urlencode($current_subject->id); ?>" method="post">
        <br/>
        <p>Subject Name :
        <input type="text" name="menu_name" value="<?php echo htmlentities($current_subject->menu_name); ?>" class="input-txt"
         />
        </p>
        <br/>
        <p>Position :
        <select name="position" class="input-txt">
        <?php
		   
		   $subject_count = Subjects::count_all();
		   for($count = 1 ; $count <= $subject_count ; $count++){
			   
			  echo "<option value=\"{$count}\"";
			  if($current_subject->position == $count){
				  echo " selected";
			  }
			  echo ">{$count}</option>";
		   }
		?>
        </select>
        </p>
        <br/>
        <p>Visible :
        <input type="radio" name="visible" value="1" <?php if($current_subject->visible == 1){echo "checked" ;} ?>/> Yes
        &nbsp;
        <input type="radio" name="visible" value="0" <?php if($current_subject->visible == 0){echo "checked" ;} ?>/> No
        </p>
        
        <br/>
        <input type="submit" name="submit" value="Edit subject" class="btn"/>
        <br/><br/>
        
        </form>
        
       
        </div>    
        </div>
        
         <a href="manage_content.php" class="btn">cancel</a>
        
         <a href="delete_subject.php?subject=<?php echo urlencode($current_subject->id); ?>" 
         onclick="return confirm('Are you sure?');" class="btn">Delete subject</a>
<?php include_layout_template('admin_footer.php'); ?>
