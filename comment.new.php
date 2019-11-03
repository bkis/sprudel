<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	$pollId = htmlspecialchars($_POST["pollId"]);
	$name = htmlspecialchars($_POST["name"]);
	$text = preg_replace("/\s+/", " ", htmlspecialchars($_POST["text"]));

	// prapare comment data
	$comment = array(
		"pollId" => $pollId,
		"name" => $name,
		"text" => $text
	);

	// save comment to DB
	$db->saveComment($comment);
	
	//redirect to poll
	echo $pollId;
	header("Location: poll.php?poll=" . $pollId . "#comments");
	exit();

?>