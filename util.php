<?php

	function transformPollEntries($entries){
		$data = array();

		foreach ($entries as $entry) {

			if (!isset($data[$entry["name"]])){
				$data[$entry["name"]] = array();
			}

			$data[$entry["name"]][$entry["date"]] = $entry["value"];
		}

		return $data;
	}

	function transformPollDates($dates){
		$data = array();

		foreach ($dates as $date) {
			$data[$date["sort"]] = array("date" => $date["date"], "count" => 0);
		}

		return $data;
	}

?>