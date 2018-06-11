<?php
	require_once '../db.php';

	include "header.php";

	if (SPR_ADMIN_INTERFACE != 1){
		header("Location: ../index.php");
		exit();
	}
?>

<!-- POLL TABLE -->
<table class="schedule">

	<!-- TABLE HEADER -->
	<tr class='valign-middle'>
			<td class="schedule-names" height="24" colspan="5">Polls</td>
	</tr>

	<!-- EXISTING ENTRIES -->
	<?php
			$pollslist = $database->select("polls", ["poll", "polladm", "title"]);
			if (sizeof($pollslist) > 0){
				foreach ($pollslist as $mypoll) {
					echo "<tr class='valign-middle'>";
					echo "<td class='schedule-names'>" . $mypoll["title"] . "</td>";
					echo "<td class='schedule-names'>" . $mypoll["poll"] . "</td>";
					$id = $mypoll["poll"];
					echo "<td class='schedule-entry, schedule-names'><a href='../poll.php?poll=$id' target='_blank'><img src='../img/icon-eye.png' alt='view'/></a></td>";
					$admid = $mypoll["polladm"];
					echo "<td class='schedule-entry, schedule-names'><a href='../poll.php?poll=$id&adm=$admid' target='_blank'><img src='../img/icon-pen.png' alt='edit'/></a></td>";
					echo "<td class='schedule-delete' poll-id='$id' poll-admid='$admid'></td>";
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
				$.post( "../delete-poll.php", { poll: $(this).attr("poll-id"), adm: $(this).attr("poll-admid") } ).done( function() {
					location.href = location.href;
				});
			}
		});

	});

</script>

<?php include "../footer.php" ?>
