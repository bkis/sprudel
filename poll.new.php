<?php

    // FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);
    

    if (isset($_POST["title"]) && strlen($_POST["title"]) > 0
     && isset($_POST["dates"]) && sizeof($_POST["dates"]) > 0){

        require_once "db.php";
        $db = new DB();
        
        require_once "poll.model.php";
        $poll = new Poll(
            // id
            hash("crc32", time() . htmlspecialchars($_POST["title"])),
            // adminId
            isset($_POST["adminLink"]) && strcmp("true", $_POST["adminLink"]) == 0
                ? hash("crc32", time() . $title . "admin")
                : "NA",
            // title
            htmlspecialchars($_POST["title"]),
            // details
            preg_replace("/\s+/", " ", htmlspecialchars($_POST["details"])),
            // changed (null - will be set when written to db)
            null
        );

        // set poll dates
        $poll->setDates(
            $db->transformPollDates(
                $poll->getId(),
                array_values(
                    array_unique($_POST["dates"])
                )
            )
        );

        //write data to polls table
        $db->createPoll($poll);

        //redirect to poll
        $redir = "poll.php?poll=" . $poll->getId()
            . (strcmp($poll->getAdminId(), "NA") != 0
                ? ("&adm=" . $poll->getAdminId())
                : "");
        //if (strcmp($adminId, "NA") != 0) $redir .= "&adm=" . $adminId;
        header("Location: " . $redir);
        exit();
    }

?>