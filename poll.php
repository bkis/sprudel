<?php

	if(!isset($_GET["poll"]) || $_GET["poll"] == "")
		header("Location: 404.php");

	require_once 'util.php';
	require_once 'db.php';

	$id = htmlspecialchars($_GET["poll"]);
	$poll = $database->get("polls", "*", ["poll" => $id]);
	$persons = transformPollEntries($database->select("entries", "*", ["poll" => $id]));
	$dates = transformPollDates($database->select("dates", "*", ["poll" => $id]));

	if(!$poll)
		header("Location: 404.php");

	include "header.php";
?>


<!-- POLL TABLE -->
<table class="schedule">

	<!-- TABLE HEADER / DATES -->
	<tr>
		<td class="schedule-blank"></td>
		<?php
			foreach ($dates as $date) {
				echo "<td class='schedule-header'><div class='schedule-header-date'>";
				echo $date["date"];
				echo "</div></td>";
			}
		?>
	</tr>


	<!-- EXISTING ENTRIES -->
	<?php
		foreach ($persons as $pName => $pDates) {

			echo "<tr class='valign-middle'>";
			echo "<td class='schedule-names'>" . $pName . "</td>";

			for ($i=0; $i < sizeof($dates); $i++) {
				$value = "maybe";
				switch ($pDates[$dates[$i]["date"]]) {
				    case 0: $value = "no"; break;
				    case 1: $value = "yes"; break;
				    case 2: $value = "maybe"; break;
				}

				echo "<td class='schedule-entry schedule-entry-" . $value . "'>";
				//echo "<img src='img/icon-" . $value . ".png' alt=''/>";
				
				echo "</td>";

				//count result
				if ($value == "yes")
					$dates[$i]["count"] += 1;
				elseif ($value == "maybe")
					$dates[$i]["count"] += 0.5;
			}

			echo "<td class='schedule-delete' data-poll='$id' data-name='$pName'>";
			echo "<img src='img/icon-delete.png' alt='delete row'/></td>";
			echo "</tr>";
		}
	?>


	<!-- NEW ENTRY -->
	<tr class="schedule-new valign-middle">
		<form action="entry.php" method="post">
			<input type="hidden" name="poll" value="<?php echo $id ?>"/>
			<td class="schedule-name-input">
				<input type="text" id='name-input' name="name" maxlength="32" placeholder="<?php echo P_POLL_NAME ?>" required="true" />
			</td>
			<?php
				foreach ($dates as $date) {
					echo "<td class='new-entry-box new-entry-choice-maybe'>";
					echo "<input class='entry-value' type='hidden' name='values[]' value='2'/>";
					echo "<input class='entry-date' type='hidden' name='dates[]' value='" . $date["date"] . "'/>";
					echo "</td>";
				}
			?>
			<td class="schedule-submit">
				<input type="submit" value="" class="save" />
			</td>
		</form>
	</tr>

	<!-- RESULTS -->
	<?php
		$max = 0;
		foreach ($dates as $date) $max = max($max, $date["count"]);
	?>
	<tr class="schedule-results valign-middle">
		<td>
			<?php echo P_RESULTS ?>
		</td>
		<?php
			foreach ($dates as $date) {
				if ($max == $date["count"] && $date["count"] > 0){
					echo "<td class='top'>" . $date["count"] . "</td>";
				} else {
					echo "<td>" . $date["count"] . "</td>";
				}
			}
		?>
	</tr>

</table>
<br>



<!-- COMMENTS LIST -->
<div class="centerBox">
	<h2><?php echo P_COMMENT_HEADING ?></h2><br>
	<?php
		$comments = $database->select("comments", "*", ["poll" => $id]);
		if (sizeof($comments) > 0){
			foreach ($comments as $comment) {
				echo "<div class='comment-container'>";
				echo "<span class='comment-name'>" . $comment["name"] . "</span>";
				echo "<div class='comment-date'>" . $comment["date"] . "</div>";
				echo "<div class='comment-text'>" . nl2br($comment["text"]) . "</div>";
				echo "</div>";
			}
		} else {
			echo P_COMMENT_NONE;
		}
		
	?>
</div><br>

<!-- COMMENTS FORM -->
<div class="centerBox">
	<form action="comment.php" method="post" class="pudelform">
		<input type="hidden" name="poll" value="<?php echo $id ?>"/>
		<ul class="pudelform">
		    <li>
		        <label><?php echo P_COMMENT_NAME ?> <span class="required">*</span></label>
		        <input type="text" name="name" maxlength="32" class="field-long" required="true" />
		    </li>
		    <li>
		        <label><?php echo P_COMMENT_TEXT ?> <span class="required">*</span></label>
		        <textarea name="text" maxlength="512" class="field-long field-textarea" required="true"></textarea>
		    </li>
		    <li class="content-right">
		        <input type="submit" value="<?php echo P_COMMENT_SUBMIT ?>" />
		    </li>
		</ul>
	</form>
</div><br>




<!-- JS -->
<script type="text/javascript">

	$(document).ready(function() {
		//show url
		$("#urlInfo").text(window.location.href);

		//url clipboard copy feature
		var clipboard = new Clipboard('#btnCopy');
		clipboard.on('success', function(e) {
		    $("#btnCopy").attr("src", "img/icon-copied.png");
		    $("#name-input").focus();
		});
		clipboard.on('error', function(e) {
		    alert("<?php echo P_URL_COPY_ERROR ?>");
		    $("#name-input").focus();
		});

		//delete button functionality
		$(".schedule-delete").click(function(){
			if (confirm("<?php echo P_REMOVE_CONFIRM ?> '" + $(this).attr("data-name") + "' ?")){
				$.post( "delete.php", { poll: $(this).attr("data-poll"), name: $(this).attr("data-name") } ).done( function() {
					location.href = location.href;
				});
			}
		});

		//cycle throug options
		$(".new-entry-box").click(function(){
			if ($(this).hasClass("new-entry-choice-maybe")){
				$(this).removeClass("new-entry-choice-maybe");
				$(this).addClass("new-entry-choice-yes");
				$(this).children(".entry-value").attr("value", "1");
			} else if ($(this).hasClass("new-entry-choice-yes")){
				$(this).removeClass("new-entry-choice-yes");
				$(this).addClass("new-entry-choice-no");
				$(this).children(".entry-value").attr("value", "0");
			} else if ($(this).hasClass("new-entry-choice-no")) {
				$(this).removeClass("new-entry-choice-no");
				$(this).addClass("new-entry-choice-maybe");
				$(this).children(".entry-value").attr("value", "2");
			}
			
		});

	});

</script>



<?php include "footer.php" ?>
