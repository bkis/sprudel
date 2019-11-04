<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	require_once 'config/config.all.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo SPR_HTML_PAGE_TITLE ?></title>
	<meta name="robots" content="noindex,nofollow">

	<!-- Mobile Specific Metas
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Favicon
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo SPR_BASE_URL ?>img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo SPR_BASE_URL ?>img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo SPR_BASE_URL ?>img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo SPR_BASE_URL ?>img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo SPR_BASE_URL ?>img/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo SPR_BASE_URL ?>img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?php echo SPR_BASE_URL ?>img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- CSS
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="<?php echo SPR_BASE_URL ?>css/reset.css">
	<link rel="stylesheet" href="<?php echo SPR_BASE_URL ?>css/style.css">

	<!-- JQUERY
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="<?php echo SPR_BASE_URL ?>res/jquery/jquery-3.4.1.min.js"></script>

	<!-- DATEPICKER
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="<?php echo SPR_BASE_URL ?>res/datepicker/datepicker.min.css">
	<script type="text/javascript" src="<?php echo SPR_BASE_URL ?>res/datepicker/datepicker.min.js"></script>

	<!-- CLIPBOARD
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script src="<?php echo SPR_BASE_URL ?>res/clipboard/clipboard.min.js"></script>

</head>
<body>

	<noscript>
		<div class="noscript" style="display: table; overflow: hidden;">
			<div style="display: table-cell; vertical-align: middle;">
				<div>
				 	<?php echo SPR_NO_JS_MSG ?>
				</div>
			</div>
		</div>
	</noscript>

	<div id="header" class="right-to-left">

		<div id="info">

			<!-- HEADER IS USED IN POLL VIEW -->
			<?php if (isset($poll)) { ?>

				<h1><?php echo $poll->getTitle(); ?></h1>
				<p class="details"><?php echo $poll->getDetails(); ?></p>
				<br/>
				<div class="poll-url-container">
					<span class="success"><em><?php echo SPR_PUBLIC_LINK ?></em></span>
					<input type="text" id="urlInfo" title="<?php echo SPR_PUBLIC_LINK_DESC ?>" readonly/>
					<button type="button" class="copy-trigger" data-clipboard-target="#urlInfo" title="<?php echo SPR_LINK_COPY_TITLE ?>"></button>
					<span class="pale">&nbsp;&larr; <?php echo SPR_PUBLIC_LINK_DESC ?></span>
				</div>
				<!--
					If admin links are enabled and the correct admin
					id came with the request, show admin link
				-->
				<?php
					if (strcmp($poll->getAdminId(), "NA") != 0
					 && strcmp($poll->getAdminId(), $adminId) == 0) {
				?>
					<div class="poll-url-container">
						<span class="fail"><em><?php echo SPR_ADMIN_LINK ?></em></span>
						<input type="text" id="admUrl" title="<?php echo SPR_ADMIN_LINK_DESC ?>" readonly/>
						<button type="button" class="copy-trigger" data-clipboard-target="#admUrl" title="<?php echo SPR_LINK_COPY_TITLE ?>"></button>
						<span class="pale">&nbsp;&larr; <?php echo SPR_ADMIN_LINK_DESC ?></span>
					</div>
				<?php
					}
				?>

			<!-- HEADER IS USED IN OTHER VIEW -->
			<?php } else { ?>
				<h1><?php echo SPR_INDEX_TITLE ?></h1>
				<p class="details"><?php echo SPR_INDEX_SUBTITLE ?></p>
			<?php } ?>

		</div>

		<?php if (SPR_SHOW_HEADER_LOGO == 1) { ?>
			<div id="logo">
				<a href="index.php" title="<?php echo SPR_NEW_FORM_HEADING ?>">
					<img src="<?php echo SPR_BASE_URL ?>img/logo.png" alt=""/>
				</a>
			</div>
		<?php } ?>

	</div>
