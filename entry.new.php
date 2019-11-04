<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	$pollId = htmlspecialchars($_POST["pollId"]);
	$name = htmlspecialchars($_POST["name"]);
	
	// save entry if input is valid
	$db->saveEntry(
		$pollId,
		$name,
		$_POST["dates"],
		$_POST["values"]
	);
	
	//redirect to poll
	header("Location: poll.php?poll=" . $pollId);
	exit();

?>