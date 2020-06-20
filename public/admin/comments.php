<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
	  $session->message("No page ID was provided.");
	  redirect_to('index.php');
	}
	
  $page = pages::find_by_id($_GET['id']);
  if(!$page) {
    $session->message("The page could not be located.");
    redirect_to('index.php');
  }

	$comments = $page->comments();
	
?>
<?php include_layout_template('admin_header.php'); ?>

<a href="manage_content.php?page=<?php echo $page->id ?>">&laquo; Back</a><br />
<br />

<h2>Comments on <?php echo $page->menu_name; ?></h2>

<?php echo output_message($message); ?>
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
			<div class="actions" style="font-size: 0.8em;">
				<a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete Comment</a>
			</div>
    </div>
  <?php endforeach; ?>
  <?php if(empty($comments)) { echo "No Comments."; } ?>
</div>


<?php include_layout_template('admin_footer.php'); ?>
