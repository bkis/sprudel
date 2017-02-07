<?php

	require_once 'config.php';
	require_once 'medoo.php';

	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => SPR_DB_NAME,
		'server' => SPR_DB_SERVER,
		'username' => SPR_DB_USERNAME,
		'password' => SPR_DB_PASSWORD,
		'charset' => 'utf8'
	]);

?>