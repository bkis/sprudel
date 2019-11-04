<div class="center-box">
	<form action="comment.new.php" method="post" class="form">
		<input type="hidden" name="pollId" value="<?php echo $poll->getId() ?>"/>
		<ul class="form">
		    <li>
		        <label><?php echo SPR_COMMENT_NAME ?> <span class="required">*</span></label>
		        <input type="text" name="name" maxlength="32" class="field-long" required="true" />
		    </li>
		    <li>
		        <label><?php echo SPR_COMMENT_TEXT ?> <span class="required">*</span></label>
		        <textarea name="text" maxlength="512" class="field-long field-textarea" required="true"></textarea>
		    </li>
		    <li class="content-right">
		        <input type="submit" value="<?php echo SPR_COMMENT_SUBMIT ?>" />
		    </li>
		</ul>
	</form>
</div>