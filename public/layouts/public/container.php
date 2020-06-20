<div class="containerone grid-2">


	<!-- title -->

    <h1 class="ct contitle">Recent Posts</h1>
    
    <?php
	
	 // initializing vars
	
		$latest_news = Pages::find_all();
		$No_of_news = Pages::count_all();
		$photo = new photograph();
		$i = 0;
		
		
		
		
		foreach ($latest_news as $latest){
			
			
		echo "<article class=\"post grid-3\">";	
		$photo->id = $latest->photo_id;
		$photos = $photo->find_by_id($photo->id,true,false);
		
		
	
		?>
        
        
		<!-- Feature image of page -->
        

        <img src="<?php echo $photos->image_path(); ?>" width="260" height="190" />
            
            
         <h2 class="posttitle">
        
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
        
      </article>

         <?php
		 
		 ++$i;
		 if($i == 10){break;} 
		}
	
	     ?>
    </div>