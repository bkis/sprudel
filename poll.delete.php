<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	if (isset($_POST["pollId"])
	 && !empty($_POST["pollId"])
	 && isset($_POST["adm"])
	 && !empty($_POST["adm"])){

		$pollId = htmlspecialchars($_POST["pollId"]);
		$adminId = htmlspecialchars($_POST["adm"]);
		$dbAdminId = $db->getAdminId($pollId);

		if (strcmp($dbAdminId, $adminId) == 0)
			$db->deletePoll($pollId);
	}

?>
