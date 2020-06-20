<?php require_once("../includes/initialize.php"); Pages::find_selected_page(true,true); 
include_layout_template('public/header.php'); 


	if($current_subject){
		
	 echo '<div class="containerone grid-2">';
	 
	 	
	 // title of subject
	 echo '<h1 class="contitle">'.$current_subject->menu_name.'</h1>';
	 
	 
     include_layout_template('public/subject.php');
     include_layout_template('public/side.php');
	 
	 
	 echo '</div>';

	}else if ($current_page){
		
     include_layout_template('public/page.php');
     include_layout_template('public/side.php');
	 
	 
	 echo '</div>';

	}else{
	include_layout_template('public/slide.php');
	//echo '<div class="slideTimer"></div>'; 
	/*include_layout_template('public/socsearch.php');*/ 
    include_layout_template('public/Featureposts.php');
	echo '<div class="clear" style="clear:both;"></div>';
	echo '<div class="containertwo">';
    include_layout_template('public/container.php');
    include_layout_template('public/side.php');
	echo '</div>';
	echo '</div>';
	
	}
    	
 include_layout_template('public/footer.php'); ?>         