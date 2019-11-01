<?php
	require_once '../db.php';
	
	if (SPR_ADMIN_INTERFACE != 1){
		header("Location: ../index.php");
		exit();
	}

	$db = new DB();
	$polls = $db->getPollsOverviewData();
	
	include "header.php";
?>

<!-- POLLS OVERVIEW TABLE -->
<table class="schedule">

	<!-- TABLE HEADER -->
	<tr class='valign-middle'>
			<td class="schedule-names" height="24" colspan="5">Polls</td>
	</tr>

	<!-- EXISTING POLLS -->
	<?php
		if (sizeof($polls) > 0){
			foreach ($polls as $poll) {
				echo "<tr class='valign-middle'>";
				echo "<td class='schedule-names'>" . $poll["title"] . "</td>";
				echo "<td class='schedule-names'>" . $poll["pollId"] . "</td>";
				$id = $poll["pollId"];
				echo "<td class='schedule-entry, schedule-names'><a href='../poll.php?poll=$id' target='_blank'><img src='../img/icon-eye.png' alt='view'/></a></td>";
				$adminId = $poll["pollAdminId"];
				echo "<td class='schedule-entry, schedule-names'><a href='../poll.php?poll=$id&adm=$adminId' target='_blank'><img src='../img/icon-pen.png' alt='edit'/></a></td>";
				echo "<td class='schedule-delete' poll-id='$id' poll-adminId='$adminId'></td>";
				echo "</tr>";
			}
		} else {
			echo "<tr class='valign-middle'><td class='schedule-names' height='24' colspan='5'>No polls found in database!</td></tr>";
		}
	?>

</table>
<br>

<!-- JS -->
<script type="text/javascript">

	$(document).ready(function() {

		//delete poll
		$(".schedule-delete").click(function(){
			if (confirm("<?php echo SPR_DELETE_POLL_CONFIRM ?>")){
				$.post( "../delete-poll.php", { poll: $(this).attr("poll-id"), adm: $(this).attr("poll-adminId") } ).done( function() {
					location.href = location.href;
				});
			}
		});

	});

</script>

<?php include "../footer.php" ?>
