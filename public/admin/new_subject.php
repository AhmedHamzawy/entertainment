<?php require_once('../../includes/initialize.php'); if (!$session->is_logged_in()) { redirect_to("login.php"); }
include_layout_template('admin_header.php');  pages::find_selected_page(true,true); ?>


<div id="main">



	<!-- The Navigation -->

    <div id="navigation">
        <?php  echo Navigation::navigation_admin(Pages::$current_subject ,Pages::$current_page) ; ?>
    </div>
    
    <!-- End The Navigation  -->
   
   
       
    <div id="page">
    
        
		<?php $errors = $session->message;  echo  Validation::form_errors($errors);  ?>
        
        
        
        <div class="container">
        
        <h1 class="login-heading">
        Create Subject</h1>
     
       <div class="login">
        
        
        <form action="create_subject.php" method="post">
        <br/>
        
            <p>Subject Name :<input type="text" name="menu_name" value=""  class="input-txt" /></p>
            <br/>
            
            <p>Position :
            <select name="position" class="input-txt">
            <?php
               $subject_count = Subjects::count_all();
               for($count = 1 ; $count <= ($subject_count + 1) ; $count++){
                   
                  echo "<option value=\"{$count}\">{$count}</option>";
               }
            ?>
            </select>
            </p>
            <br/>
            
            <p>Visible :
            <input type="radio" name="visible" value="0"/><span> No </span>
            &nbsp;
            <input type="radio" name="visible" value="1"/><span> Yes </span>
            </p>
            
             <br/>
            <input type="submit" name="submit" value="create subject" class="btn"/>
        	<br/><br/>
        	
        </form>
        <br/>
        
        
       
        
        </div>
        
    </div>
    
    <a href="manage_content.php" class="btn">cancel</a>
           
<?php include_layout_template('admin_footer.php'); ?>