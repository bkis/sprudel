<?php

	require_once 'db.php';
	$db = new DB();

	$pollId = htmlspecialchars($_POST["pollId"]);
	$name = htmlspecialchars($_POST["name"]);
	$adminId = htmlspecialchars($_POST["adm"]);

	$dbAdminId = $db->getAdminId($pollId);

	//delete entry
	if (strcmp($adminId, $dbAdminId) == 0){
		$db->deleteEntry($pollId, $name);
	}

	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>
