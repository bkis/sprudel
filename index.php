<?php
	$currDate = date("Y-m-d");
	$btnDateHTML = "<input type='text' name='dates[]' maxlength='32' class='dateInput field-with-btn'
		data-toggle='datepicker' required='true' style='margin-top: 4px;' /><button class='btn-in-field'>D</button>";
	include "header.php";
?>


<div class="centerBox">

	<h2><?php echo SPR_INDEX_HEADING ?></h2><br/>

	<form action="poll.new.php" method="post">
		<ul class="form">
		    <li>
		        <label><?php echo SPR_NEW_FORM_TITLE ?> <span class="required">*</span></label>
		        <input type="text" name="title" class="field-long" required="true" id="titleInput" placeholder="<?php echo SPR_NEW_FORM_TITLE_PLACEHOLDER ?>" />
		    </li>
		    <li>
		        <label><?php echo SPR_NEW_FORM_DESCRIPTION ?> </label>
		        <textarea name="details" class="field-long field-textarea" placeholder="<?php echo SPR_NEW_FORM_DETAILS_PLACEHOLDER ?>"></textarea>
		    </li>
				<?php if (SPR_ADMIN_LINKS == 1) {
						echo "<li>";
						echo "<label>" . SPR_NEW_FORM_ADMIN . "</label>";
						echo "<input type='checkbox' name='adminLink' value='true' id='adminInput' /> " . SPR_NEW_FORM_ADMIN_CHECKBOX;
						echo "</li><br/>";
				}
				?>
		    <li>
		        <label><?php echo SPR_NEW_FORM_DATES ?> <span class="required">*</span></label>
				<input
					type="text" name="dates[]" maxlength="32"
					class="dateInput field-long datepicker-here"
					required="true" placeholder="<?php echo SPR_NEW_FORM_DATES_PLACEHOLDER ?>"
					style="margin-bottom: 8px;" />
		    </li>
		    <li>
		    	<img src="img/icon-more.png" class="btnFormDate" id="btnMore"/>
		    	<img src="img/icon-less-disabled.png" class="btnFormDate" id="btnLess"/>
			</li>
			<li>
				<br/><span class="pale"><?php echo preg_replace("/\bn\b/", SPR_DELETE_AFTER, SPR_LIFESPAN) ?></span>
			</li>
		    <li class="content-right">
		        <input type="submit" value="<?php echo SPR_NEW_FORM_SUBMIT ?>" />
		    </li>
		</ul>
	</form>

</div>

<!-- INDEX PAGE JS -->
<?php include "index.js.php" ?>

<!-- PAGE FOOTER -->
<?php include "footer.php" ?>
