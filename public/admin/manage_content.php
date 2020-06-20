<?php require_once('../../includes/initialize.php'); if (!$session->is_logged_in()) { redirect_to("login.php"); }
include_layout_template('admin_header.php'); Pages::find_selected_page(false,true); ?>




<div id="main">



	<!-- The Navigation -->

    <div id="navigation">
        <?php  echo Navigation::navigation_admin($current_subject ,$current_page) ; ?>
    </div>
    
    <!-- End The Navigation  -->
   
   
   <div class="mainoptions">
   
    <!-- Main Menu -->
    
    <a href="index.php">&laquo; Main Menu</a>
    
    <!-- End Main Menu -->
 
    
    
    
    <!-- Adding Subject -->
    
    <a href="new_subject.php">+ Add a subject</a>
    
    <!-- End Adding Subject -->
    
    </div>
    
    
	<div id="page">
		<?php echo output_message($message);  if($current_subject) { ?>
        
        
        <h2>Manage Subject</h2>
        
        <div class="adminlist data">
        
        Menu Name: <?php echo htmlentities($current_subject->menu_name); ?><br/>
        <hr/>
        Position: <?php echo htmlentities($current_subject->position); ?><br/>
        <hr/>
        Visible: <?php echo htmlentities($current_subject->visible == 1 ? 'Yes' : 'No'); ?><br/>
        
        </div>
        
        <a href="edit_subject.php?subject=<?php echo $current_subject->id; ?>" class="btn">Edit subject</a>
        
        <br/><br/><br/><br/><br/><br/>
        <hr />
        
        <div class="pagesinsub">
        <h2>Pages in this subject :</h2>
        
        <div class="adminlist data">
            <ul>
                <?php        
                $Subject_pages = Pages::find_pages_for_subject($current_subject->id,false);
                    foreach($Subject_pages as $Subject_page){
                        echo "<li>";
                        $safe_page_id = urlencode($Subject_page->id);
                        echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
                        echo htmlentities($Subject_page->menu_name);
                        echo "</a>";
                        echo "</li>";
                    }  
                ?>
            </ul>
         </div>
            
       </div>     
            
       <a href="new_page.php?subject=<?php echo urlencode($current_subject->id); ?>" class="btn">
      + Add a new page for this subject</a>
        
		
		<?php } elseif ($current_page) { ?>
        
        
            <h2>Manage Page</h2>
            
            <div class="adminlist data">
                <?php $photo = Photograph::find_by_id($current_page->photo_id , false , false); ?>
                Menu Name: <?php echo htmlentities($current_page->menu_name); ?><br/>
                <hr/>
                Position: <?php echo htmlentities($current_page->position); ?><br/>
                <hr/>
                Visible: <?php echo htmlentities($current_page->visible == 1 ? "Yes" : "No"); ?><br/>
                <hr/>
                Content:<br/><div class="view_content"><?php echo $current_page->content; ?></div>
                <hr/>
                Comments:<br/><div class="comments">
                <a href="comments.php?id=<?php echo $current_page->id; ?>">
				<?php echo count($current_page->comments()); ?>
				</a>
				</div>
                <hr/>
                photo:  
                <?php if($photo){ ?>
                <img src="../<?php echo $photo->image_path(); ?>" width="100" />
                <br/>
                        <?php echo $photo->filename; ?>
                <br/>       
                        <?php echo $photo->caption; ?>
                <br/><br/>
                <?php } else { echo 'no photo'; } ?>
            </div>    
                
                <a href="edit_page.php?page=<?php echo urlencode($current_page->id); ?>" class="btn">Edit Page</a>
                
                
                <?php } else { ?>
                Please select a subject or a page.
                <?php }?>
    </div>
</div>      
 
<?php include_layout_template('admin_footer.php'); ?>
