<?php
	
	//CLEANUP ROUTINE
	if (!(PHP_SAPI === 'cli')){
		echo "Error: The cleanup routine can only be run from the command line (i.e. via cronjojb).";
		exit();
	}
	chdir(__DIR__);
	require_once "config.php";
	require_once "db.php";

	$db = new DB;
	
	//minimum last changed date
	$minDate = date("Y-m-d H:i:s", strtotime("-" . SPR_DELETE_AFTER . " days", time()));
	
	echo PHP_EOL;
	echo "Sprudel cleanup routine" . PHP_EOL;
	echo "***********************" . PHP_EOL;
	echo PHP_EOL;
	echo "This will delete every poll that was inactive" . PHP_EOL . "since " . $minDate . " (for at least " . SPR_DELETE_AFTER . " days)." . PHP_EOL;
	echo "You may change this value in config.php" . PHP_EOL;
	echo PHP_EOL;

	//get IDs of polls to delete
	$trash = $db->getPollsInactiveSince($minDate);

	//remove old polls
	if (sizeof($trash) > 0){
		foreach ($trash as $pollId) {
			echo "Deleting poll: " . $pollId . " ..." . PHP_EOL;
			$db->deletePoll($pollId);
		}
	} else {
		echo "No polls inactive since " . $minDate . PHP_EOL;
	}

	echo PHP_EOL;
	echo "Deleted " . sizeof($trash) . " polls." . PHP_EOL;
	echo "Done." . PHP_EOL;

?>