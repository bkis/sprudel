<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once 'db.php';
	$db = new DB();

	$pollId = htmlspecialchars($_POST["pollId"]);
	$name = trim(htmlspecialchars($_POST["name"]));
	$text = trim(preg_replace("/\s+/", " ", htmlspecialchars($_POST["text"])));

	// save comment to DB if content is valid
	if (strlen($name) > 0 && strlen($text) > 0){
		$db->saveComment([
			"pollId" => $pollId,
			"name" => $name,
			"text" => $text
		]);
	}
	
	//redirect to poll
	echo $pollId;
	header("Location: poll.php?poll=" . $pollId . "#comments");
	exit();

?>