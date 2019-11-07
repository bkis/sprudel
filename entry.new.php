<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	
	$pollId = htmlspecialchars($_POST["pollId"]);
	$adminId = htmlspecialchars($_POST["pollAdminId"]);
	$name = htmlspecialchars($_POST["name"]);
	
	// try to pass anti-spam (if enabled)
	if (!$db->antiSpam($_SERVER['REMOTE_ADDR'])){
		//BLOCKED
		$redir = "poll.php?poll=" . $pollId
		. (strcmp($adminId, "NA") != 0
			? ("&adm=" . $adminId)
			: "") . "&blocked";
			header("Location: " . $redir);
		exit();
	}
	
	// save entry if input is valid
	$db->saveEntry(
		$pollId,
		$name,
		$_POST["dates"],
		$_POST["values"]
	);
	
	//redirect to poll
	$redir = "poll.php?poll=" . $pollId
	. (strcmp($adminId, "NA") != 0
		? ("&adm=" . $adminId)
		: "");
	
	header("Location: " . $redir);
	exit();

?>