<!-- PAGE HEADER -->
<?php include "header.php" ?>

<!-- POLL CONTROLS -->
<div id="poll-controls">
	<!-- MINI VIEW TOGGLE -->
	<button id="btnMiniView" type="button" data-miniview="off">
		Mini View
	</button>
	<!-- DELETE POLL BUTTON -->
	<?php if (strcmp($poll->getAdminId(), $adminId) == 0) { ?>
		<button id="btnDeletePoll" type="button">
			Delete Poll
		</button>
	<?php } ?>
</div>

<!-- POLL TABLE -->
<table class="schedule">

	<!-- TABLE HEADER / DATES -->
	<tr>
		<td class="schedule-blank"></td>
		<?php
			foreach ($poll->getDates() as $date) {
				echo "<td class='schedule-header'><div><div>";
				echo $date["date"];
				echo "</div></div></td>";
			}
		?>
	</tr>


	<!-- EXISTING ENTRIES -->
	<?php include "entry.list.php" ?>

	<!-- SPACER ROW -->
	<tr class="table-spacer-row"><td></td></tr>

	<!-- NEW ENTRY FORM ROW -->
	<tr class="schedule-new valign-middle">
		<?php include 'entry.form.php' ?>
	</tr>

	<!-- SPACER ROW -->
	<tr class="table-spacer-row table-spacer-row-big"><td></td></tr>

	<!-- RESULTS -->
	<tr class="schedule-results valign-middle">
		<td>
			<div class="r r-legend r-yes"><?php echo SPR_POLL_RESULTS_YES ?></div>
			<div class="r r-legend r-maybe"><?php echo SPR_POLL_RESULTS_MAYBE ?></div>
			<div class="r r-legend r-no"><?php echo SPR_POLL_RESULTS_NO ?></div>
		</td>
		<?php
			foreach ($displayDates as $date) {
				echo "<td class='results-cell'>";
				echo "<div class='r r-yes'>" . $date["yes"] . "</div>";
				echo "<div class='r r-maybe'>" . $date["maybe"] . "</div>";
				echo "<div class='r r-no'>" . $date["no"] . "</div>";
				echo "</td>";
			}
		?>
	</tr>

</table>

<!-- COMMENTS LIST -->
<?php include "comment.list.php" ?>

<!-- COMMENTS FORM -->
<?php include "comment.form.php" ?>

<!-- POLL JS -->
<?php include "poll.js.php" ?>

<!-- PAGE FOOTER -->
<?php include "footer.php" ?>
