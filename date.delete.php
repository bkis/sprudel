<?php

	require_once 'db.php';
	$db = new DB();

	$pollId = htmlspecialchars($_POST["pollId"]);
	$date = htmlspecialchars($_POST["date"]);
	$adminId = htmlspecialchars($_POST["adm"]);

	$dbAdminId = $db->getAdminId($pollId);

	//delete entry
	if (strcmp($adminId, $dbAdminId) == 0){
		$db->deleteDate($pollId, $date);
	}

	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>
