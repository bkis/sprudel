<?php

	require_once 'db.php';

	$id = htmlspecialchars($_POST["poll"]);
	$name = htmlspecialchars($_POST["name"]);
	$text = preg_replace("/\s(?=\s)/", " ", htmlspecialchars($_POST["text"]));
	$date = date("Y-m-d H:i:s");


	//prapare comment data
	$comment = array(
		"poll" => $id,
		"name" => $name,
		"text" => $text,
		"date" => $date
	);

	$database->action(function($database) use ($comment) {
		//write data to comments table
		$database->insert("comments", $comment);

		//update change date in polls table
		$database->update("polls", array("changed" => $date), array("poll" => $id));
	});
	
	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>