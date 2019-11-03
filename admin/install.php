<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once '../db.php';
	$db = new DB();

	// init MySql DB
	$success = $db->install();

	include "../header.php";
?>

<div class="centerBox">
	<br>
	<?php if ($success){ ?>
		<h1 class='success'>Database initialized successfully.</h1>
		You should now try your new Sprudel installation!<br/>
		If everything works, <em>delete 'sprudel/admin/install.php'</em> from the server!<br/><br/>
		<a href='../index.php'>Click here to create the first Sprudel poll on this fresh instance!</a>
	<?php } else { ?>
		<h1 class='fail'>Database couldn't be initialized.</h1>
		Please check your setup in <em>config.php</em> and make sure you <em>create the database before you run install.php</em>!
	<?php }	?>
</div>

<?php include "../footer.php" ?>
