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
	.dark-bg {
		height: 24px;
		width: 24px;
		text-align: center;
		background-color: #232323;
		border-radius: 50%;
	}
	table, h1 {
		margin-left: 20px;
	}
	td {
		padding: 4px 8px;
	}
</style>



<h1 class="fail">You are the master of <?php echo sizeof($polls) ?> polls</h1>

<!-- POLLS OVERVIEW TABLE -->
<table>
	<!-- EXISTING POLLS -->
	<?php
		if (sizeof($polls) > 0){
			foreach ($polls as $poll) {
	?>
		<tr class='valign-middle'>
			<td><?php echo $poll["title"] ?></td>
			<td><?php echo $poll["pollId"] ?></td>
			<td class="dark-bg">
				<a href="../poll.php?poll=<?php echo $poll["pollId"] ?>" target="_blank">
					<img src="../img/icon-eye.png" alt="view"/>
				</a>
			</td>
			<td class="dark-bg">
				<a href="../poll.php?poll=<?php echo $poll["pollId"] ?>&adm=<?php echo $poll["pollAdminId"] ?>" target="_blank">
					<img src="../img/icon-pen.png" alt="edit"/>
				</a>
			</td>
			<td class="admin-schedule-delete dark-bg" poll-id="<?php echo $poll["pollId"] ?>" poll-adminId="<?php echo $poll["pollAdminId"] ?>">
				<a href="javascript:void(0)">
					<img src="../img/icon-delete.png" alt="edit"/>
				</a>
			</td>
		</tr>
	<?php
			}
		} else {
	?>
		<tr class="valign-middle"><td height="24" colspan="5">No polls found in database!</td></tr>
	<?php } ?>

</table>


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
