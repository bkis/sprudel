<div class="centerBox">

	<h2><?php echo SPR_COMMENT_HEADING ?></h2>
	
	<br>

	<?php
		if (sizeof($poll->getComments()) > 0){
			foreach ($poll->getComments() as $comment) {
				echo "<div class='comment-container'>";
				echo "<span class='comment-name'>" . $comment["name"] . "</span>";
				echo "<div class='comment-date'>" . $comment["date"] . "</div>";
				echo "<div class='comment-text'>" . nl2br($comment["text"]) . "</div>";
				echo "</div>";
			}
		} else {
			echo SPR_COMMENT_NONE;
		}
	?>

</div>