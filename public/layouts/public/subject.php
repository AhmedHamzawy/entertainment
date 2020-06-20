<?php 
	
	// initializing vars
	
	$latest_news = Pages::find_pages_for_subject($_GET['subject']);
	$photo = new photograph();


	// 1. the current page number ($current_page)
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

	// 2. records per page ($per_page)
	$per_page = 3;

	// 3. total record count ($total_count)
	$total_count = count($latest_news);
	

	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sqli = "SELECT * FROM pages ";
	$sqli .= "WHERE subject_id = {$_GET['subject']} ";
	$sqli .= "LIMIT {$per_page} ";
	$sqli .= "OFFSET {$pagination->offset()}";
	$latest_news = Pages::find_by_sqli($sqli);
	
	// Need to add ?page=$page to all links we want to 
	// maintain the current page (or store $page in $session)
	

	
	 ?>
            
            <?php
            
            foreach ($latest_news as $latest){
            echo "<article class=\"post grid-3\">";	
            $photo->id = $latest->photo_id;
            $photos = $photo->find_by_id($photo->id,true,false);
            
            ?>
            
                <img src="<?php echo $photos->image_path(); ?>" width="260" height="190" />

                 <h2 class="posttitle">
                 
                 
				 <a href="index.php?page=<?php echo $latest->id; ?>">
				 <?php echo $latest->menu_name; ?>
                 </a>
                 
                 <div class="extra"><i class="fa fa-clock-o"></i>
                 <?php echo $latest->date; ?>
                 <i class="fa fa-comment-o"></i>0</div></h2>
              </article>
            <?php } ?>
            <div id="pagination" style="clear: both;">
            <?php
            if($pagination->total_pages() > 1) {
            
            if($pagination->has_previous_page()) { 
            echo "<a href=\"index.php?subject=";
            echo $_GET['subject'];
            echo "&page=";
            echo $pagination->previous_page();
            echo "\"> &laquo Previous</a> "; 
            }
            
            for($i=1; $i <= $pagination->total_pages(); $i++) {
                if($i == $page) {
                    echo " <span class=\"selected\">{$i}</span> ";
                } else {
                    echo " <a href=\"index.php?subject={$_GET['subject']}&page={$i}\">{$i}</a> "; 
                }
            }
            
            if($pagination->has_next_page()) { 
                echo "<a href=\"index.php?subject=";
                echo $_GET['subject'];
                echo "&page=";
                echo $pagination->next_page();
                echo "\">next &raquo</a> ";
            }
            
            }
            
            ?>
            </div>
        </div>