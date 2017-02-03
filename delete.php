<?php

	require_once 'db.php';

	$id = htmlspecialchars($_POST["poll"]);
	$name = htmlspecialchars($_POST["name"]);

	//delete entries
	$database->action(function($database) use ($id, $name) {
		$database->delete("entries", [
			"AND" => [
				"poll" => $id,
				"name" => $name
			]
		]);
	});

	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>