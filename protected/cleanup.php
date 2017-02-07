<?php

	//CLEANUP ROUTINE
	chdir(__DIR__);
	require_once '../config.php';
	require_once '../medoo.php';

	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => SPR_DB_NAME,
		'server' => SPR_DB_SERVER,
		'username' => SPR_DB_USERNAME,
		'password' => SPR_DB_PASSWORD,
		'charset' => 'utf8'
	]);

	echo PHP_EOL;
	echo "Sprudel cleanup routine" . PHP_EOL;
	echo "*********************" . PHP_EOL;
	echo PHP_EOL;
	echo "Removing every poll that was inactive for at least " . SPR_DELETE_AFTER . " days." . PHP_EOL;
	echo "(you may change this value in config.php)" . PHP_EOL;
	echo PHP_EOL;

	//minimum last changed date
	$minDate = date("Y-m-d H:i:s", strtotime('-' . SPR_DELETE_AFTER . ' days', time()));

	//get IDs of polls to delete
	$trash = $database->select("polls", "poll", ["changed[<]" => $minDate]);

	//remove old polls
	foreach ($trash as $id) {
		echo "Deleting poll: " . $id . " ..." . PHP_EOL;

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

	echo PHP_EOL;
	echo "Deleted " . sizeof($trash) . " polls." . PHP_EOL;
	echo "Done." . PHP_EOL;

?>