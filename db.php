<?php

	require_once 'Medoo.php';
	use Medoo\Medoo;

	require_once 'config.php';
	require_once 'poll.model.php';

	class DB {

		private $db = null;

		function __construct() {
			try {
				$this->db = new medoo([
					'database_type' => 'mysql',
					'database_name' => SPR_DB_NAME,
					'server' => SPR_DB_SERVER,
					'username' => SPR_DB_USERNAME,
					'password' => SPR_DB_PASSWORD,
					'charset' => 'utf8'
				]);
			} catch (Exception $ex) { die($ex->getMessage()); }
		}
	  
		function __destruct() {
			if ( $this->db !== null ) { $this->db = null; }
		}

		function getPoll($id){
			$db = $this->db;
			//get poll data from db
			$pollData = $db->get("polls", "*", ["pollId" => $id]);
			//return false if poll with $id not found
			if (!$pollData) return false;
			//create poll model instance
			$poll = new Poll(
				$pollData["pollId"],
				$pollData["pollAdminId"],
				$pollData["title"],
				$pollData["details"],
				$pollData["changed"]
			);
			//populate entries, dates and comments
			$poll->setEntries($db->select("entries", "*", ["pollId" => $id]));
			$poll->setComments($db->select("comments", "*", ["pollId" => $id]));
			$poll->setDates($db->select("dates", "*", ["pollId" => $id]));
			return $poll;
		}

		function getPollsOverviewData(){
			return $this->db->select("polls", ["pollId", "pollAdminId", "title"]);
		}

		function createPoll($poll){
			$db = $this->db;
			//// save poll data to polls table
			$db->action(function($db) use ($poll) {
				$db->insert("polls", [
					"pollId" => $poll->getId(),
					"pollAdminId" => $poll->getAdminId(),
					"title" => $poll->getTitle(),
					"details" => $poll->getDetails(),
					"changed" => $this->getTime()
				]);
			});

			//// save dates data to dates table
			$db->action(function($db) use ($poll) {
				$db->insert("dates", $poll->getDates());
			});
		}

		function deletePoll($pollId){
			$db = $this->db;
			$db->action(function($db) use ($pollId) {
				//delete from polls table
				$db->delete("polls", ["pollId" => $pollId]);
				//delete from entries table
				$db->delete("entries", ["pollId" => $pollId]);
				//delete from dates table
				$db->delete("dates", ["pollId" => $pollId]);
				//delete from comments table
				$db->delete("comments", ["pollId" => $pollId]);
			});
			//removed poll?
			if ($db->has("polls", ["pollId" => $pollId])){
				echo "ERROR: Something went wrong..." . PHP_EOL;
				return false;
			} else {
				return true;
			}
		}

		function transformPollDates($pollId, $datesRaw){
			$datesPrepared = array();
			for ($i = 0; $i < sizeof($datesRaw); $i++) { 
				array_push($datesPrepared, array("pollId" => $pollId, "date" => $datesRaw[$i], "sort" => $i));
			}
			return $datesPrepared;
		}

		function saveEntry($pollId, $name, $dates, $values){
			$db = $this->db;

			//prepare distinct entries
			$entries = array();
			for ($i = 0; $i < sizeof($dates); $i++) { 
				array_push($entries, array("pollId" => $pollId, "date" => $dates[$i], "name" => $name, "value"=> $values[$i]));
			}

			//if no dates are checked, insert dummy data
			if (sizeof($entries) == 0){
				$dummy = substr(hash("md4",time()), 0, 16);
				array_push($entries, array("pollId" => $pollId, "date" => $dummy, "name" => $name));
			}

			$db->action(function($db) use ($pollId, $entries) {
				//write data to entries table
				$db->insert("entries", $entries);
				//update change date in polls table
				$db->update("polls", array("changed" => $this->getTime()), array("pollId" => $pollId));
			});
		}

		function deleteEntry($pollId, $name){
			$db = $this->db;
			$db->action(function($db) use ($pollId, $name) {
				$db->delete("entries", [
					"AND" => [
						"pollId" => $pollId,
						"name" => $name
					]
				]);
			});
		}

		function saveComment($comment){
			$db = $this->db;
			$comment["date"] = $this->getTime();
			$db->action(function($db) use ($comment) {
				//write data to comments table
				$db->insert("comments", $comment);
				//update change date in polls table
				$db->update("polls", array("changed" => $this->getTime()), array("pollId" => $comment["pollId"]));
			});
		}

		function getTime(){
            return date("Y-m-d H:i:s");
		}

		function getAdminId($pollId){
			return $this->db->get("polls", "pollAdminId", ["pollId" => $pollId]);
		}
		
		function install(){
			$db = $this->db;
			$success = true;

			// create table "polls"
			$query = "CREATE TABLE `polls` (
				`pollId` varchar(32) NOT NULL,
				`pollAdminId` varchar(32) NOT NULL,
				`title` text NOT NULL,
				`details` text NOT NULL,
				`changed` date NOT NULL,
				PRIMARY KEY (`pollId`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$success = $db->query($query) ? $success : false;

			// create table "entries"
			$query = "CREATE TABLE `entries` (
					`pollId` varchar(32) NOT NULL,
					`date` varchar(32) NOT NULL,
					`name` varchar(32) NOT NULL,
					`value` tinyint(4) NOT NULL,
					KEY `pollId` (`pollId`,`name`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$success = $db->query($query) ? $success : false;

			// create table "dates"
			$query = "CREATE TABLE `dates` (
					`pollId` varchar(32) NOT NULL,
					`date` varchar(32) NOT NULL,
					`sort` tinyint(4) NOT NULL,
					KEY `pollId` (`pollId`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$success = $db->query($query) ? $success : false;

			// create table "comments"
			$query = "CREATE TABLE `comments` (
					`pollId` varchar(32) NOT NULL,
					`text` varchar(512) NOT NULL,
					`name` varchar(32) NOT NULL,
					`date` varchar(32) NOT NULL,
					KEY `pollId` (`pollId`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$success = $db->query($query) ? $success : false;

			// return true if everything went schmuhfli 
			return $success;
		}

	}

?>