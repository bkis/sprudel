<div class="centerBox">

	<h2><a name="comments"><?php echo SPR_COMMENT_HEADING ?></a></h2>
	
	<br>

	<?php
		if (sizeof($poll->getComments()) > 0){
			foreach ($poll->getComments() as $comment) {
	?>
		<div class='comment-container'>
			<span class='comment-name'><?php echo $comment["name"] ?></span>
			<div class='comment-date'><?php echo $comment["date"] ?></div>
			<div class='comment-text'><?php echo nl2br($comment["text"]) ?></div>
		</div>
	<?php
			}
		} else {
			echo SPR_COMMENT_NONE;
		}
	?>

</div>