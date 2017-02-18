<?php

	require_once 'db.php';

	if (isset($_POST["poll"])){
		$id = htmlspecialchars($_POST["poll"]);

		//delete entries
		$database->action(function($database) use ($id) {
			//delete from polls table
			$database->delete("polls", ["poll" => $id]);

			//delete from entries table
			$database->delete("entries", ["poll" => $id]);

			//delete from dates table
			$database->delete("dates", ["poll" => $id]);

			//delete from comments table
			$database->delete("comments", ["poll" => $id]);

			//removed poll?
			if ($database->has("polls", ["poll" => $id])){
				echo "ERROR: Something went wrong..." . PHP_EOL;
				return false;
			}
		});
	}

	//redirect to poll
	header("Location: index.php");
	exit();

?>