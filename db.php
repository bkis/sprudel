<?php

	require_once 'config.php';
	require_once 'medoo.php';

	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => P_DB_NAME,
		'server' => P_DB_SERVER,
		'username' => P_DB_USERNAME,
		'password' => P_DB_PASSWORD,
		'charset' => 'utf8'
	]);

?>