<?php

	require_once 'res/medoo/Medoo.php';
	use Medoo\Medoo;

	require_once 'config/config.db.php';
	require_once 'config/config.features.php';
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
					"changed" => $this->getDate()
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
			$datesRaw = array_unique(array_values($datesRaw));
			$datesPrepared = array();
			for ($i = 0; $i < sizeof($datesRaw); $i++) { 
				array_push(
					$datesPrepared,
					array(
						"pollId" => $pollId,
						"date" => trim($datesRaw[$i]),
						"sort" => $i
					)
				);
			}
			return $datesPrepared;
		}

		function saveEntry($pollId, $name, $dates, $values){
			$name = trim($name);
			if (strlen($name) == 0) return;

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

			return $db->action(function($db) use ($pollId, $entries) {
				//write data to entries table
				$db->insert("entries", $entries);
				//update change date in polls table
				$db->update("polls", array("changed" => $this->getDate()), array("pollId" => $pollId));
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

		function deleteDate($pollId, $date){
			$db = $this->db;
			$db->action(function($db) use ($pollId, $date) {
				$db->delete("dates", [
					"AND" => [
						"pollId" => $pollId,
						"date" => $date
					]
				]);
				$db->delete("entries", [
					"AND" => [
						"pollId" => $pollId,
						"date" => $date
					]
				]);
			});
		}

		function saveComment($comment){
			$db = $this->db;
			$comment["date"] = $this->getDateTime();
			$db->action(function($db) use ($comment) {
				//write data to comments table
				$db->insert("comments", $comment);
				//update change date in polls table
				$db->update("polls", array("changed" => $this->getDate()), array("pollId" => $comment["pollId"]));
			});
		}

		function getDate(){
            return date("Y-m-d");
		}

		function getDateTime(){
            return date("Y-m-d H:i:s");
		}

		function getAdminId($pollId){
			return $this->db->get("polls", "pollAdminId", ["pollId" => $pollId]);
		}

		function antiSpam($ip){
			//is anti-spam enabled at all?
			if (!SPR_ANTISPAM) return true;

			$db = $this->db; // db object ref
			$pass = true; // action allowed
			$ipHash = hash('md4', $ip); // create ip hash
			$time = time(); // create timestamp
			$record; // ip hash record

			//// check if ip hash is known
			if ($db->has("antispam", ["ipHash" => $ipHash])){
				//// KNOWN
				$record = $db->get("antispam", "*", ["ipHash" => $ipHash]);

				// is ip already blocked?
				if ($record["blocked"]){
					// still within blocktime?
					if ($time - $record["blocktime"] < SPR_ANTISPAM_BLOCKTIME){
						//just keep blocking
						return false;
					} else {
						// enough blocking, RESET record
						$record["counter"] = 1;
						$record["time"] = $time;
						$record["blocked"] = false;
						$record["blocktime"] = 0;
					}
				} else if ($time - $record["time"] <= SPR_ANTISPAM_SECONDS){
					// last action was not long enough ago :(
					// within set seconds
					$record["counter"]++; // increment counter
					if ($record["counter"] > SPR_ANTISPAM_ACTIONS){
						$pass = false; // action not allowed, spam rules hit
						$record["blocked"] = true;
						$record["blocktime"] = $time;
					}
				} else {
					// longer ago, RESET record
					$record["counter"] = 1;
					$record["time"] = $time;
				}
				// update record in db
				$db->action(function($db) use ($record, $ipHash) {
					$db->update("antispam", $record, ["ipHash" => $ipHash]);
				});
			} else {
				//// UNKNOWN
				$record = [
					"ipHash" => $ipHash,
					"time" => $time,
					"counter" => 1,
					"blocked" => false,
					"blocktime" => 0
				];
				//write new record to db
				$db->action(function($db) use ($record) {
					$db->insert("antispam", $record);
				});
			}
			// let the user pass or don't.
			return $pass;
		}
		
		function install(){
			$db = $this->db;
			$success = true;

			// create table "polls"
			$query = "CREATE TABLE `polls` (
				`pollId` varchar(32) NOT NULL,
				`pollAdminId` varchar(32) NOT NULL,
				`title` varchar(256) NOT NULL,
				`details` varchar(512) NOT NULL,
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

			// create table "antispam"
			$query = "CREATE TABLE `antispam` (
				`ipHash` varchar(32) NOT NULL,
				`time` bigint NOT NULL,
				`counter` tinyint(4) NOT NULL,
				`blocked` boolean,
				`blocktime` bigint NOT NULL,
				KEY `ipHash` (`ipHash`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$success = $db->query($query) ? $success : false;

			// return true if everything went schmuhfli 
			return $success;
		}

		function getPollsInactiveSince($date){
			return $this->db->select("polls", "pollId", ["changed[<]" => $date]);
		}

	}

?>