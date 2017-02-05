<?php

	//// CONFIG
	//// Set these values to
	//// set up and customize Pudel
	//// (there are mandatory and optional settings)


	//// MANDATORY
	//// You'll HAVE TO set the
	//// following values to use Pudel	

	// database settings
	define('P_DB_NAME', 'your_db_name');		// database name
	define('P_DB_SERVER', 'your_server_name');		// database server ('localhost' in most cases)
	define('P_DB_USERNAME', 'your_db_user');			// username to access database
	define('P_DB_PASSWORD', 'your_db_password');	// password to access database


	//// OPTIONAL
	//// You can change these values if you want
	//// to customize Pudel or change the language

	// lifespan of inactive polls
	define('P_DELETE_AFTER', '180');	//delete inactive polls after x days (daily cronjob for cleanup.php needed!)

	// general strings / labels
	define('P_HTML_PAGE_TITLE', 'Pudel');			// title of html page
	define('P_INDEX_TITLE', 'Pudel');				// title shown in page header area
	define('P_INDEX_SUBTITLE', 'scheduling polls');	// subtitle shown in page header area
	define('P_ENTRY_SAVE', 'Save');	// new entry save button text
	define('P_RESULTS', 'Result');					// poll results row text
	define('P_REMOVE_CONFIRM', 'Do you really want to remove');	// confirmation text when removing an entry (followed by name)
	define('P_COMMENT_HEADING', 'Comments');		// comments section heading
	define('P_COMMENT_NONE', 'No comments, yet.');	// no comments message
	define('P_COMMENT_NAME', 'Name');				// comment name field label
	define('P_COMMENT_TEXT', 'Comment');			// comment text field label
	define('P_COMMENT_SUBMIT', 'Send');				// comment submit button text
	define('P_NO_JS_MSG', 'Please enable JavaScript in your browser and reload this page.');
	define('P_404', 'Something went wrong...');		// poll not found page text
	
	// new poll form strings / labels
	define('P_NEW_FORM_TITLE', 'Title');			
	define('P_NEW_FORM_DESCRIPTION', 'Description');
	define('P_NEW_FORM_DATES', 'Dates / Options');
	define('P_NEW_FORM_TITLE_PLACEHOLDER', 'What about a title for your poll?');
	define('P_NEW_FORM_DETAILS_PLACEHOLDER', 'Your participants may also like a short description of what this poll is all about, right?');
	define('P_NEW_FORM_DATES_PLACEHOLDER', 'Type what you want or pick a date with the calendar button!');
	define('P_NEW_FORM_SUBMIT', 'Create');
	define('P_DATEPICKER_LANG', 'en-US');			// datepicker language iso-code
	define('P_DATEPICKER_FORMAT', 'yyyy-mm-dd');	// datepicker date format (you can use and combine yyyy, yy, mm, m, dd, d)

	// poll view strings / labels
	define('P_POLL_NAME', 'Your name?');			// placeholder for name input field
	define('P_URL_COPY_ERROR', 'Error copying URL. Please copy it manually!');	// copy url error text

	//turn on/off footer text
	define('P_SHOW_FOOTER_LINK', '1');				// insert 0 if you want to remove the footer link, but it would be nice to leave it there


?>