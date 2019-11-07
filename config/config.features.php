<?php

    /////////////////////////////////////////////
	////                                     ////
	////    FUNCTIONAL CONFIGURATION         ////
	////    (switch stuff on and off)        ////
	////                                     ////
	/////////////////////////////////////////////

	// Turn on(1)/off(0) admin interface
	// (Read README.md for further instructions!
	// You will have to secure the 'admin' directory!)
	define('SPR_ADMIN_INTERFACE', 0);

	// Turn on(1)/off(0) admin link functionality (recommended)
	define('SPR_ADMIN_LINKS', 1);

	
	// Header Logo
	// (set to 1 if you want to show header logo, 0 otherwise)
	define('SPR_SHOW_HEADER_LOGO', 1); 
	
	// Footer Text and Link
	// (Insert 0 if you want to remove the GitHub footer link.
	// Hot tipp of the week: Consider being nice and leaving it there!)
	define('SPR_SHOW_FOOTER_LINK', 1);
	
	// Lifespan (in days) of inactive polls
	// (read README.md for further instructions!)
	define('SPR_DELETE_AFTER', 30);

	// Maximum number of options / dates per poll
	define('SPR_MAX_POLL_DATES', 32);
	

	// ANTI-SPAM-MECHANICS
	// ON (1) or OFF (0)
	define('SPR_ANTISPAM', 1);
	// Minimum time between actions
	// (create poll/entry/comment) in seconds
	// (default is 60 = 1 minute)
	define('SPR_ANTISPAM_SECONDS', 60);
	// How many actions (create poll/entry/comment)
	// in a row is one user allowed to take with less
	// than n seconds (specified above) in between?
	// (default is 5)
	define('SPR_ANTISPAM_ACTIONS', 5);
	// If a user violates the above rules, for how long
	// should their actions be blocked (in seconds)?
	// (default is 3600 = 1 hour)
	define('SPR_ANTISPAM_BLOCKTIME', 3600);

?>