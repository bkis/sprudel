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
	define('SPR_ADMIN_INTERFACE', 1);

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

?>