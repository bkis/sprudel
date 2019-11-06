<?php
	require_once "../db.php";
	require_once "../config/config.features.php";
	
	if (SPR_ADMIN_INTERFACE != 1){
		header("Location: ../404.php");
		exit();
	}

	$db = new DB();
	$polls = $db->getPollsOverviewData();
	
	include "../header.php";
?>


<!-- Admin Area Styles (quick and dirty) -->
<style>
	#admin-page {
		padding: 2rem;
	}
	td {
		padding: 4px 4px;
	}
</style>


<div id="admin-page">
	<h1 class="fail">You are the master of <?php echo sizeof($polls) ?> polls</h1>

	<!-- POLLS OVERVIEW TABLE -->
	<table>
		<!-- EXISTING POLLS -->
		<?php
			if (sizeof($polls) > 0){
				foreach ($polls as $poll) {
		?>
			<tr>
				<td><em><?php echo $poll["title"] ?></em></td>
				<td><?php echo $poll["pollId"] ?></td>
				<td>
					<!-- BTN: VIEW -->
					<a href="../poll.php?poll=<?php echo $poll["pollId"] ?>" target="_blank">
						<button type="button">View</button>
					</a>
				</td>
				<td>
					<!-- BTN: EDIT -->
					<a href="../poll.php?poll=<?php echo $poll["pollId"] ?>&adm=<?php echo $poll["pollAdminId"] ?>" target="_blank">
						<button type="button">Edit</button>
					</a>
				</td>
				<td>
					<!-- BTN: DELETE -->
					<a href="javascript:void(0)">
						<button
						type="button"
						class="admin-schedule-delete"
						poll-id="<?php echo $poll["pollId"] ?>"
						poll-adminId="<?php echo $poll["pollAdminId"] ?>">
							Delete
						</button>
					</a>
				</td>
			</tr>
		<?php
				}
			} else {
		?>
			<tr><td height="24" colspan="5">No polls found in database!</td></tr>
		<?php } ?>

	</table>
</div>

<!-- JS -->
<script type="text/javascript">

	$(document).ready(function() {

		//delete poll
		$(".admin-schedule-delete").click(function(){
			if (confirm("<?php echo SPR_DELETE_POLL_CONFIRM ?>")){
				$.post( "../poll.delete.php", { pollId: $(this).attr("poll-id"), adm: $(this).attr("poll-adminId") } ).done( function() {
					location.href = location.href;
				});
			}
		});

	});

</script>

<?php include "../footer.php" ?>
