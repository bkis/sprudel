<?php
    
    /////////////////////////////////
	////                         ////
	////   SOME INTERNAL STUFF   ////
	////   (Don't touch this!)   ////
	////                         ////
	/////////////////////////////////
	
	// figure out the base URL
	if (!(PHP_SAPI === 'cli')){
		$doc_root = preg_replace("!${_SERVER['SCRIPT_NAME']}$!", '', $_SERVER['SCRIPT_FILENAME']);
		$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
		$domain = $_SERVER['HTTP_HOST'];
		$base_url = preg_replace("!^${doc_root}!", '', dirname(__DIR__));
		define('SPR_BASE_URL', "${protocol}://${domain}${base_url}/");
	}

    
?>