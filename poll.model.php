<?php

    class Poll {

        private $id = '';
        private $adminId = '';
        private $title = '';
        private $details = '';
        private $changed = '';
        private $dates = array();
        private $entries = array();
        private $comments = array();


        function __construct($id, $adminId, $title, $details, $changed) {
			$this->id = $id ? $id : $this->id;
			$this->adminId = $adminId ? $adminId : $this->adminId;
			$this->title = $title ? $title : $this->title;
            $this->details = $details ? $details : $this->details;
            $this->changed = $changed ? $changed : $this->changed;
        }


        //// GETTERS ////

        function getId(){ return $this->id; }
        function getAdminId(){ return $this->adminId; }
        function getTitle(){ return $this->title; }
        function getDetails(){ return $this->details; }
        function getChanged(){ return $this->changed; }
        function getEntries(){ return $this->entries; }
        function getComments(){ return $this->comments; }
        function getDates(){ return $this->dates; }

        function getDatesForDisplay(){
            $preparedDates = array();
            //sort by "sort"
			usort($this->dates, function($a, $b) {
				return $a["sort"] - $b["sort"];
            });
            $count = 0;
            foreach ($this->dates as $date) {
				$preparedDates[$count++] = array(
                    "date" => $date["date"],
                    "yes" => 0,
                    "maybe" => 0,
                    "no" => 0,
                    "total" => 0
                );
			}
            return $preparedDates;
        }

        //// SETTERS ////

        function setTitle($title){
            $this->title = $title;
        }

        function setDetails($details){
            $this->details = $details;
        }

        function setChanged($changed){
            $this->changed = $changed;
        }

        function setDates($dates){
            $this->dates = $dates;
        }

        function setEntries($entries){
            $this->entries = array();

			foreach ($entries as $entry) {
				if (!isset($entry["name"])){
					$this->entries[$entry["name"]] = array();
				}
				$this->entries[$entry["name"]][$entry["date"]] = $entry["value"];
			}
        }
        
        function setComments($comments){
            $this->comments = $comments;
        }

    }

?>