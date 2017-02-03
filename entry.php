<?php

	require_once 'db.php';

	$id = htmlspecialchars($_POST["poll"]);
	$name = htmlspecialchars($_POST["name"]);
	$dates = $_POST["dates"];
	$values = $_POST["values"];

	//prepare entries
	$entries = array();
	for ($i=0; $i < sizeof($dates); $i++) { 
		array_push($entries, array("poll" => $id, "date" => $dates[$i], "name" => $name, "value"=> $values[$i]));
	}

	//if no dates are checked, insert dummy data
	if (sizeof($entries) == 0){
		$dummy = substr(hash("md4",time()), 0, 16);
		array_push($entries, array("poll" => $id, "date" => $dummy, "name" => $name));
	}

	$database->action(function($database) use ($id, $entries) {
		//write data to entries table
		$database->insert("entries", $entries);

		//update change date in polls table
		$database->update("polls", array("changed" => date("Y-m-d H:i:s")), array("poll" => $id));
	});
	
	//redirect to poll
	header("Location: poll.php?poll=" . $id);
	exit();

?>