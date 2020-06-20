<?php 

	 // initializing variables
	 
	 $latest_news = Pages::find_all();
	 $No_of_news = Pages::count_all();
	 $photo = new photograph();
	 
 ?>
<div class="side grid-4">

     <div class="block">
     
         <h1 class="blocktitle ct contitle">popular Posts</h1>
         
         <?php
		 
            $i = 0;
            echo "<div class=\"wrapper\">";
            echo "<div class=\"carousel\">";
            echo "<div class=\"inner\">";
            foreach ($latest_news as $latest){
            echo "<div class=\"slide \">";	
            echo "<h2 class=\"slidetitle\"><a href=\"index.php?page=$latest->id \">"
			.$latest->menu_name."</a><div class=\"extra\"><i class=\"fa fa-clock-o\"></i>"
            .$latest->date."<i class=\"fa fa-comment\"></i>0</div></h2>";
            $photo->id = $latest->photo_id;
            $photos = $photo->find_by_id($photo->id,true,false);
        
        ?>
            
            
        
        	<img src="<?php echo $photos->image_path(); ?>" />
       
        
        <?php
		
			++$i;
			 if($i == 5){break;} 
			 echo "</div>";
			}
			echo "</div>";
			echo "</div>";
			echo "<div class=\"arrow arrow-left\"></div>";
			echo "<div class=\"arrow arrow-right\"></div>"; 
			echo "</div>"; 	
			echo "</div>"; 	
        
        ?>
         
     </div>
     
     
     <div class="block">
     	<h1 class="blocktitle ct contitle">ADS.</h1>
     	<img src="images/icons/ads/sum.jpg" width="338" height="150" />
     </div>
     
     
    <div class="block">
        <div class="tabbed">
        <input name="tabbed" id="tabbed1" type="radio" checked>
            <section>
                <h1>
                  <label for="tabbed1">About</label>
                </h1>
                <div>
                  All Exclusives Related To HollyWood Entertainment you'll Figure About Right Here
                </div>
            </section>
        <input name="tabbed" id="tabbed2" type="radio">
            <section>
                <h1>
                  <label for="tabbed2">Contact</label>
                </h1>
                <div>
                  <i class="fa fa-envelope"></i>Entertainment@gmail.com
                </div>
            </section>
        <input name="tabbed" id="tabbed3" type="radio">
            <section>
                <h1>
                  <label for="tabbed3">Comments</label>
                </h1>
                <div>
                  <?php Comment::find_all(true,false); ?>
                </div>
            </section>
        </div>
    </div>
    
  
    <div class="block">
    <div class="accordion">
			<div class="accordion-section">
				<a class="accordion-section-title" href="#accordion-1">Recent Posts</a>
				<div id="accordion-1" class="accordion-section-content">
					<?php
		
					$i = 0;
					foreach ($latest_news as $latest){
					echo "<article class=\"post\">";	
					$photo->id = $latest->photo_id;
					$photos = $photo->find_by_id($photo->id,true,false);
					
					?>
					
						<img src="<?php echo $photos->image_path(); ?>" width="280" height="170" />

						 <h2 class="posttitle">
						 <a href="index.php?page=<?php echo $latest->id; ?>">
						 <?php echo $latest->menu_name; ?>
                         </a>
                         <div class="extra">
                         <i class="fa fa-clock-o"></i><?php echo $latest->date; ?>
						 <i class="fa fa-comment-o"></i>0</div></h2>
					  </article>
					
					 <?php
					 
					 ++$i;
					 if($i == 5){break;} 
					}
	
					?>
				</div><!--end .accordion-section-content-->
			</div><!--end .accordion-section-->

			
		</div><!--end .accordion-->
    </div>
    
    
    <div class="block">
         <h1 class="blocktitle ct contitle">ADS.</h1>
         <img src="images/icons/ads/res.jpg" width="338" height="150" />
     </div>
     
     
    <div class="block">
        <h1 class="blocktitle ct contitle">VIDEOS</h1>
        <iframe width="337" height="240" src="https://www.youtube.com/embed/Jgk3u44W2i4" frameborder="0" allowfullscreen>
        </iframe>
    </div>
    
    
    <div class="block">
         <h1 class="blocktitle ct contitle">ADS.</h1>
         <img src="images/icons/ads/gar.jpg" width="338" height="150" />
    </div>
    
    	
    </div>