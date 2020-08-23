<?php

    // FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    
    require_once "config/config.features.php";

    if (isset($_POST["title"])
        && isset($_POST["dates"])
        && is_array($_POST["dates"])
        && sizeof($_POST["dates"]) > 0
        && sizeof($_POST["dates"]) <= SPR_MAX_POLL_DATES){

        require_once "db.php";
        $db = new DB();

        // try to pass anti-spam (if enabled)
        if (!$db->antiSpam($_SERVER['REMOTE_ADDR'])){
            //BLOCKED
            header("Location: index.php?blocked");
            exit();
        }

        //prep data
        $title = trim(htmlspecialchars($_POST["title"]));
        $details = trim(preg_replace("/\s+/", " ", htmlspecialchars($_POST["details"])));
        
        require_once "poll.model.php";
        $poll = new Poll(
            // id
            hash("crc32", time() . htmlspecialchars($_POST["title"])),
            // adminId
            isset($_POST["adminLink"]) && strcmp("true", $_POST["adminLink"]) == 0
                ? hash("crc32", time() . $title . "admin")
                : "NA",
            // title
            strlen($title) > 0 ? $title : "Sprudel",
            // details
            $details,
            // changed (null - will be set when written to db)
            null
        );

        // set poll dates
        $poll->setDates(
            $db->transformPollDates(
                $poll->getId(),
                $_POST["dates"]
            )
        );

        //write data to polls table
        $db->createPoll($poll);

        //redirect to poll
        $redir = "poll.php?poll=" . $poll->getId()
            . (strcmp($poll->getAdminId(), "NA") != 0
                ? ("&adm=" . $poll->getAdminId())
                : "");
        
        header("Location: " . $redir);
        exit();
    }

?>