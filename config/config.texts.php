<?php

	////////////////////////////////////////////////
	////                                        ////
	////    USER INTERFACE TEXTS AND STRINGS    ////
	////    (go wild, change everything!)       ////
	////                                        ////
	////////////////////////////////////////////////
	
	//// GENERAL ////
	
	// Title of the HTML page
	define('SPR_HTML_PAGE_TITLE', 'Sprudel'); 
	// Title shown in index header area
	define('SPR_INDEX_TITLE', 'Sprudel'); 
	// Subtitle shown in index header area
	define('SPR_INDEX_SUBTITLE', 'scheduling polls'); 
	// Warning message to show if JavaScript is disabled
	define('SPR_NO_JS_MSG', 'Please enable JavaScript in your browser and reload this page.');
	
	//// CREATE NEW POLL / LANDING PAGE ////

	// Heading for index / new poll page
	define('SPR_NEW_FORM_HEADING', 'Create a new poll ...'); 
	// Label for poll title field
	define('SPR_NEW_FORM_TITLE', 'Title'); 
	// Placeholder for poll title field
	define('SPR_NEW_FORM_TITLE_PLACEHOLDER', 'What about a title for your poll?'); 
	// Label for poll description / details field
	define('SPR_NEW_FORM_DETAILS', 'Description'); 
	// Placeholder for poll details field
	define('SPR_NEW_FORM_DETAILS_PLACEHOLDER', 'Your participants may also like a short description of what this poll is all about, right?'); 
	// Label for poll answer options
	define('SPR_NEW_FORM_OPTIONS', 'Options'); 
	// Placeholder for poll first poll answer / option
	define('SPR_NEW_FORM_OPTIONS_PLACEHOLDER', 'Type whatever you want or pick a date!');
	// Label for poll admin links
	define('SPR_NEW_FORM_ADMIN', 'Admin Link');
	// Label for poll admin links checkbox
	define('SPR_NEW_FORM_ADMIN_CHECKBOX', 'Deleting poll/entries only with admin link');
	// Text for poll submit button
	define('SPR_NEW_FORM_SUBMIT', 'Create poll!');
	
	//// POLL VIEW ////
	
	// Placeholder for poll entry name input field
	define('SPR_POLL_NAME', 'Your name?');
	// Save poll entry button text
	define('SPR_ENTRY_SAVE', 'Save');
	// Confirmation text when removing an entry (automatically followed by name)
	define('SPR_REMOVE_CONFIRM', 'Do you really want to remove');
	// Confirmation text when deleting a poll
	define('SPR_DELETE_POLL_CONFIRM', 'Do you really want to delete this poll?');
	// Label for public link in header
	define('SPR_PUBLIC_LINK', 'Public link:');
	// Description for public link in header
	define('SPR_PUBLIC_LINK_DESC', 'Give this public link to the participants of your poll!');
	// Label for admin link in header
	define('SPR_ADMIN_LINK', 'Admin link:');
	// Description for admin link in header
	define('SPR_ADMIN_LINK_DESC', 'Save this admin link, you need it to manage your poll!');
	// Copy link button tooltip
	define('SPR_LINK_COPY_TITLE', 'Copy link to clipboard!');
	// Copy url error text
	define('SPR_URL_COPY_ERROR', 'Error copying URL. Please copy it manually!');
	// Control button text: Trigger mini view
	define('SPR_POLL_CONTROL_MINI_VIEW', 'Mini View');
	// Control button text: Trigger normal view
	define('SPR_POLL_CONTROL_NORMAL_VIEW', 'Normal View');
	// Control button text: Delete poll
	define('SPR_POLL_CONTROL_DELETE', 'Delete Poll');
	// Poll results legend: yes
	define('SPR_POLL_RESULTS_YES', 'Yes:');
	// Poll results legend: maybe
	define('SPR_POLL_RESULTS_MAYBE', 'Maybe:');
	// Poll results legend: no
	define('SPR_POLL_RESULTS_NO', 'No:');
	// Comments section heading
	define('SPR_COMMENT_HEADING', 'Comments');
	// No comments message
	define('SPR_COMMENT_NONE', 'No comments, yet.');
	// Comment name field label
	define('SPR_COMMENT_NAME', 'Your name');
	// Comment text field label
	define('SPR_COMMENT_TEXT', 'Your comment');
	// Comment submit button text
	define('SPR_COMMENT_SUBMIT', 'Save');
	// Poll not found / invalid URL text
	define('SPR_404', 'Whoops... did you use a wrong link?');
	// Info about how long inactive polls are stored
	// (leave "n" as a placeholder for the number of days - it will be replaced automatically!)
	define('SPR_LIFESPAN', 'Attention! Inactive polls will be deleted automatically after n days!');							

	//// DATEPICKER STRINGS ////

	// Datepicker translation for monday
	define('SPR_DATEPICKER_MONDAY', 'Monday'); 
	// Datepicker translation for Tuesday
	define('SPR_DATEPICKER_TUESDAY', 'Tuesday'); 
	// Datepicker translation for Wednesday
	define('SPR_DATEPICKER_WEDNESDAY', 'Wednesday'); 
	// Datepicker translation for Thursday
	define('SPR_DATEPICKER_THURSDAY', 'Thursday'); 
	// Datepicker translation for Friday
	define('SPR_DATEPICKER_FRIDAY', 'Friday');
	// Datepicker translation for Saturday
	define('SPR_DATEPICKER_SATURDAY', 'Saturday');
	// Datepicker translation for Sunday
	define('SPR_DATEPICKER_SUNDAY', 'Sunday');
	// Datepicker locale ISO-code
	// (change to de-DE for German, fr-FR for French, etc.)
	define('SPR_DATEPICKER_LANG', 'en-US');
	// Datepicker date format
	// (you can use and combine yyyy, yy, mm, m, dd, d)
	define('SPR_DATEPICKER_FORMAT', 'yyyy-mm-dd');