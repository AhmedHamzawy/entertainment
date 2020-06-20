<div class="firstcontainer">

    <?php 
	
	// initializing vars
	
	$latest_news = Pages::find_all();
    $No_of_news = Pages::count_all();
    $photo = new photograph();
    $i=0;
	
	
	//slide
	
	 
	echo '<div class="galleryContainer grid-2">';
	echo '<div class="galleryPreviewContainer">';
	echo '<div class="galleryPreviewImage">';
  

	foreach($latest_news as $latest){
		
		
		$photo->id = $latest->photo_id;
		$photos = $photo->find_by_id($photo->id,true,false);
	
	?>
     
     	<!-- Feature image of page -->
        
        <img class="previewImage<?php echo $i ?>" src="<?php echo $photos->image_path(); ?>" width="100%" height="430" />
        
        
        <h2 class="title<?php echo $i ?> grid-1">
        
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
        
        
   <?php
   
		 ++$i;
		 if($i == 5){break;}
		
	}
	
	echo '</div>';
	
	// Arrows of slide
	
	echo '<div class="galleryPreviewArrows">';
	echo '<a href="#" class="previousSlideArrow">&lt;</a>';
	echo '<a href="#" class="nextSlideArrow">&gt;</a>';
	echo '</div>';
	
	echo '</div>';
	
	
	// Bullets of slide
	
	
	echo '<div class="galleryNavigationBullets">';
	
	for ($j = 0; $j < $i; $j++) {
		echo '<a href="javascript: changeimage(' . $j . ')" class="galleryBullet' . $j . '"><span>Bullet</span></a> ';
	}
		
	echo '</div>';
	echo '</div>';
	
	?>