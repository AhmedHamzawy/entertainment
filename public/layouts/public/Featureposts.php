<div class="FP grid-3">


	<!-- title -->
    
    <h5 class="fptitle">Featured Posts</h1>
    	
	<?php
	
	
	 // initializing vars
	
	
	 $latest_news = Pages::find_all();
	 $No_of_news = Pages::count_all();
	 $photo = new photograph();
	 $i = 0;
	 
	 
	foreach ($latest_news as $latest){
		
		
	$photo->id = $latest->photo_id;
	$photos = $photo->find_by_id($photo->id,true,false);

	?>
	
    <div class="pic">
    
        
        <!-- Feature image of page -->
        
        <img src="<?php echo $photos->image_path(); ?>" />
        
            
        <h2 class="title">
        
            <!-- page name -->
            
            <a href="index.php?page=<?php echo $latest->id; ?>">
            	<?php echo $latest->menu_name; ?>
            </a>
            
             
            <!-- date && comment -->
            
            <div class="extra"> 
            
                
                <i class="fa fa-clock-o"></i>
                <?php echo $latest->date; ?>
                
                <i class="fa fa-comment"></i>
                <?php echo  count($latest->comments()); ?>
                
            </div>
            
        </h2>
        
    </div>
    
         <?php
         ++$i;
         if($i == 2){break;} 
        }
        ?>
  </div>
 
        
      