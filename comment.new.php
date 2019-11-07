<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	
	$pollId = htmlspecialchars($_POST["pollId"]);
	$adminId = htmlspecialchars($_POST["pollAdminId"]);
	$name = trim(htmlspecialchars($_POST["name"]));
	$text = trim(preg_replace("/\s+/", " ", htmlspecialchars($_POST["text"])));
	
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

	// save comment to DB if content is valid
	if (strlen($name) > 0 && strlen($text) > 0){
		$db->saveComment([
			"pollId" => $pollId,
			"name" => $name,
			"text" => $text
		]);
	}
	
	//redirect to poll
	$redir = "poll.php?poll=" . $pollId
	. (strcmp($adminId, "NA") != 0
		? ("&adm=" . $adminId)
		: "") . "#comments";
	
	header("Location: " . $redir);
	exit();

?>