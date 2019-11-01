<?php

	require_once 'db.php';
	$db = new DB();

	$id = htmlspecialchars($_POST["pollId"]);
	$name = htmlspecialchars($_POST["name"]);
	$text = preg_replace("/\s(?=\s)/", " ", htmlspecialchars($_POST["text"]));

	// prapare comment data
	$comment = array(
		"pollId" => $id,
		"name" => $name,
		"text" => $text
	);

	// save comment to DB
	$db->saveComment($comment);
	
	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>