<?php

	 // initializing vars
    
    $latest_news = Pages::find_by_id($_GET['page']);	
    $No_of_news = Pages::count_all();
    $photo = new photograph();
	
	
	if(isset($_POST['submit'])) {
	$author = trim($_POST['author']);
	$body = trim($_POST['body']);
	
	$new_comment = Comment::make($latest_news->id, $author, $body);
	if($new_comment && $new_comment->save()) {
	// comment saved
	// No message needed; seeing the comment is proof enough.
	
	// Send email
	$new_comment->try_to_send_notification();
	
	// Important!  You could just let the page render from here. 
	// But then if the page is reloaded, the form will try 
	// to resubmit the comment. So redirect instead:
	redirect_to("index.php?page={$latest_news->id}");
	
	} else {
	// Failed
	$message = "There was an error that prevented the comment from being saved.";
	}
	} else {
	$author = "";
	$body = "";
	}
	
	$comments = $latest_news->comments();
?>	
<div class="containerone grid-2">
    
	<?php
	
	
    // initializing vars
    
    $i = 0;
	
    
	echo "<article class=\"post single\">";	
	
	$photo->id = $latest_news->photo_id;
	$photos = $photo->find_by_id($photo->id,true,false);
	
	?>
    
     <!-- page name -->
            
    <h1 class="contitle"><?php echo $latest_news->menu_name; ?></h1>
	<img src="<?php echo $photos->image_path(); ?>" class="pageimg"  />
	<h2>
       
            
            
             
            <!-- date && comment -->
            
            <div class="extra"> 
            
                
                <i class="fa fa-clock-o"></i>
                <?php echo $latest_news->date; ?>
                
                <i class="fa fa-comment"></i>
                <?php echo  count($latest_news->comments()); ?>
                
            </div>
            
            
    </h2>
    
    <br/><br/><br/>
    <?php echo $latest_news->content; ?>


	<div id="comments">
  <?php foreach($comments as $comment): ?>
    <div class="comment" style="margin-bottom: 2em;">
	    <div class="author">
	      <?php echo htmlentities($comment->author); ?> wrote:
	    </div>
      <div class="body">
				<?php echo strip_tags($comment->body, '<strong><em><p>'); ?>
			</div>
	    <div class="meta-info" style="font-size: 0.8em;">
	      <?php echo datetime_to_text($comment->created); ?>
	    </div>
    </div>
  <?php endforeach; ?>
  <?php if(empty($comments)) { echo "<p>No Comments.</p>"; } ?>
</div>
    
    <br/><br/>
    <div id="comment-form">
    
        
        <?php //echo output_message($message); ?>
        <form action="index.php?page=<?php echo $latest_news->id; ?>" method="post" class="basic-grey">
       
       		<h1>New Comment</h1>
            
            
       		<label>
            <span>Your name:</span>
            <input type="text" name="author" value="<?php echo $author; ?>" />
         	</label>
       
         
         	<label>
            <span>Your comment:</span>
           <textarea name="body" cols="40" rows="8"><?php echo $body; ?></textarea>
           </label>
            
         <br/>    
            
          <input type="submit" name="button submit" class="button" value="Send" />
          
          
        </form>
    </div>
    
</article>
	
	
</div>