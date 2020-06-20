<?php require_once('../../includes/initialize.php'); if (!$session->is_logged_in()) { redirect_to("login.php"); }
include_layout_template('admin_header.php'); Pages::find_selected_page(false,true) ;

	$max_file_size = 1048576;
	 	
	if(!$current_subject){
		
			// subject id was missing or invalid 	
			// or subject couldn't be found in the database
			redirect_to("manage_content.php");
			
	}
	
	
	if(isset($_POST['submit'])){
			
			
				
			$page = new Pages();
			$photo = new Photograph();	
			$page->subject_id = $_GET['subject'];
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
				 redirect_to("new_page.php?subject=".urlencode($page->subject_id));	
			}
			     
			if($page->save()){
				$session->message("Page created");
				redirect_to("manage_content.php?subject=".urlencode($page->subject_id));
			}
			
			else{
				$session->message("Page creation failed");
				redirect_to("new_page.php");
			}
			}
		
			else{
			
				//This is probably a get request
				//redirect_to("new_subject.php");	
				
			}
	
			


?>
        <div id="main">
        
        <!-- The Navigation -->
    
        <div id="navigation">
            <?php  echo Navigation::navigation_admin(Pages::$current_subject ,Pages::$current_page) ; ?>
        </div>
        
        <!-- End The Navigation  -->

        <div id="page">
        
      		<?php $errors = $session->message;  echo  Validation::form_errors($errors);   ?>


                 <div class="container">
        
        <h1 class="login-heading">
       Create Page</h1>
     
       <div class="login">          
	       <form action="new_page.php?subject=<?php echo urlencode($current_subject->id); ?>" 
           enctype = "multipart/form-data"  method="POST">

        <br/>
                <p>Page Name :
                <br/><br/>
                <input type="text" name="menu_name" value="" class="input-txt" />
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
                <input type="radio" name="visible" value="0"/> No
                &nbsp;
                <input type="radio" name="visible" value="1"/> Yes
                </p>
                <br/>
                <p>Content</p>
                <br/>
                <textarea name="content" id="mytextarea" rows="40" cols="80" >
                </textarea>
                <br/>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
                <p><input type="file" name="file_upload" /></p>
                <br/><br/>
                <p>Caption: <input type="text" name="caption" value="" class="input-txt" /></p>
        		<br/>
                <br/>
                <input type="submit" name="submit" class="btn" value="create page"/>
                <br/><br/>
        		</form>
        
                <br/>
                
            </div>       
            </div>
                <a href="manage_content.php?subject=<?php echo urlencode($Subject_id); ?>" class="btn">cancel</a>

<?php include_layout_template('admin_footer.php'); ?>
