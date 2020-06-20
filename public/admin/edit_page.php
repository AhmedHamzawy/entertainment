<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php Pages::find_selected_page(false,true); ?>

<?php
				$page = new Pages();
if(!$current_page){
	// page id was missing or invalid 
	// page couldn't be found in the database
	redirect_to("manage_content.php");
}
if(isset($_POST['submit'])){


				$photo = new Photograph();
				$page->id = $current_page->id;
				$page->subject_id = $current_page->subject_id; 
				$page->menu_name = $_POST['menu_name'];
				$page->position = (int) $_POST['position'];
				$page->visible = (int) $_POST['visible'];
				$page->content = $_POST['content'];
				$page->datetime = date("Y-m-d h:i:sa");
				$page->date = date("Y-m-d"); 
				$photo->attach_file($_FILES['file_upload']);
				$photo->caption = $_POST['caption'];
				
				//validations
				$required_fields = array('menu_name', 'content' , 'position' , 'visible');
				Validation::validate_presence($required_fields);
				
				$fields_with_max_length =array("menu_name" => 1500);
				Validation::validate_max_length($fields_with_max_length);
				
				$photo->save()  ? $page->photo_id = $photo->id :  $session->message(Validation::$errors) ;
				
			    
			if(!empty(Validation::$errors)){		
			     
				 $session->message(Validation::$errors);
				 redirect_to("edit_page.php?page=".urlencode($current_page->id));
			}
	
		
			if($page->update()){
				$session->message("Page updated");
				redirect_to("manage_content.php?subject=".urlencode($page->subject_id));
			}
				else{
					$_SESSION["message"] = "page update failed".mysql_error();
					redirect_to("new_page.php");
				}
					
				}else{
				
				//This is probably a get request
				} end: isset($_POST['submit'])

?>

<?php
if(!$current_page){
//subject ID was misssing or invalid
//subject couldn't be found in the database

redirect_to("manage_content.php");	
}

?>

<?php include_layout_template('admin_header.php'); ?>


        <div id="main">
        <div id="navigation">
        <?php echo Navigation::navigation_admin (Pages::$current_subject ,Pages::$current_page) ?>
        </div>
        <div id="page">
        
        <?php $errors = $session->message;  echo  Validation::form_errors($errors);  ?>


        
        <div class="container">

		<h1 class="login-heading">
        Edit Page : <?php echo htmlentities($current_page->menu_name); ?></h1>
     
       <div class="login">
       
        <form action="edit_page.php?page=<?php echo urlencode($current_page->id); ?>"
        enctype = "multipart/form-data" method="post">
        <br/>
        <p>Page Name :
        <br/><br/>
        <input type="text" name="menu_name" value="<?php echo htmlentities($current_page->menu_name); ?>" class="input-txt" />
        </p>
        <br/>
        <p>Position :
        <select name="position" class="input-txt">
        <?php
		   
		  
		   $page_count = pages::count_all();
		   for($count = 1 ; $count <= ($page_count + 1) ; $count++){
			   
			  echo "<option value=\"{$count}\">{$count}</option>";
			  
			   
		   }
		
		?>
        </select>
        </p>
        <br/>
        <p>Visible :
        <input type="radio" name="visible" value="0" <?php if($current_page->visible == 0){echo "checked" ;} ?>/> No
        &nbsp;
        <input type="radio" name="visible" value="1" <?php if($current_page->visible == 1){echo "checked" ;} ?>/> Yes
        </p>
        <br/>
        <p> content :<br/>
        <textarea name="content" id="mytextarea" rows="40" cols="80" >
        <?php echo htmlentities($current_page->content); ?>
        </textarea>
        </p>
        
        <br/><br/>
        <?php $photo = Photograph::find_by_id($current_page->photo_id , false , false); ?>
        photo:  
		<?php if($photo){ ?>
		<img src="../<?php echo $photo->image_path(); ?>" width="100" />
        <?php echo $photo->filename; ?>
        <?php } else { echo 'no photo'; } ?>
       <br/><br/>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
        <p><input type="file" name="file_upload"  /></p>
        <br/><br/>
        <p>Caption: <input type="text" name="caption" value=<?php if($photo){ echo $photo->caption; } ?>""
        class="input-txt" /></p>
        <br/><br/>
        <input type="submit" name="submit" value="Edit Page" class="btn"/>
        <br/><br/>
        </form>
        <br/>
        
        </div>       
</div>
<a href="manage_content.php" class="btn">cancel</a>
        
         <a href="delete_page.php?page=<?php echo urlencode($current_page->id); ?>" onclick="return confirm('Are you sure?');"
         class="btn">Delete Page</a>
<?php include_layout_template('admin_footer.php'); ?>
