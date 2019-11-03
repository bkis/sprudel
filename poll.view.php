
<!-- PAGE HEADER -->
<?php include "header.php" ?>

<!-- POLL CONTROLS -->
<div id="poll-controls">
	<!-- MINI VIEW TOGGLE -->
	<button id="btnMiniView" type="button" data-miniview="off">
		<?php echo SPR_POLL_CONTROL_MINI_VIEW ?>
	</button>
	<!-- DELETE POLL BUTTON -->
	<?php if (strcmp($poll->getAdminId(), $adminId) == 0) { ?>
		<button id="btnDeletePoll" type="button">
			<?php echo SPR_POLL_CONTROL_DELETE ?>
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
			<div class="r r-legend"></div>
		</td>
		<?php foreach ($displayDates as $date) { ?>
			<td class='results-cell'>
				<div class="r r-yes"><?php echo $date["yes"] ?></div>
				<div class="r r-maybe"><?php echo $date["maybe"] ?></div>
				<div class="r r-no"><?php echo $date["no"] ?></div>
				<!-- date/option strength value visualization -->
				<div class="r r-total" style="opacity: <?php echo ($date["total"] / (sizeof($poll->getEntries())*2)) ?>"></div>
			</td>
		<?php }	?>
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
