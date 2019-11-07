<?php

	// FOR DEVELOPMENT: UN-COMMENT TO PRINT ERRORS AND WARNINGS
	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);

	require_once 'config/config.all.php';
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo (isset($poll) ? $poll->getTitle() : SPR_HTML_PAGE_TITLE); ?></title>
	<meta name="robots" content="noindex,nofollow">
	<base href="<?php echo SPR_BASE_URL ?>">

	<!-- Mobile Specific Metas
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<!-- Favicon
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
	<link rel="manifest" href="img/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- CSS
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- JQUERY
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="res/jquery/jquery-3.4.1.min.js"></script>

	<!-- DATEPICKER
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="res/datepicker/datepicker.min.css">
	<script type="text/javascript" src="res/datepicker/datepicker.min.js"></script>

	<!-- CLIPBOARD
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script src="res/clipboard/clipboard.min.js"></script>

</head>
<body>

	<!-- JavaScript CHECK -->
	<noscript>
		<div id="noscript">
			<img src="img/logo.png" alt=""/>
			<span><?php echo SPR_NO_JS_MSG ?></span>
		</div>
	</noscript>

	<!-- ANTI-SPAM BLOCK-CHECK -->
	<?php if (SPR_ANTISPAM) { ?>
		<script>
			if (window.location.href.includes("&blocked")){
				alert("<?php echo SPR_ANTISPAM_BLOCKED_MSG ?>");
			}
		</script>
	<?php } ?>

	<!-- BEGIN PAGE HTML -->
	<div id="header" class="right-to-left">

		<div id="info">

			<!-- HEADER IS USED IN POLL VIEW -->
			<?php if (isset($poll)) { ?>

				<h1><?php echo $poll->getTitle(); ?></h1>
				<p class="details"><?php echo $poll->getDetails(); ?></p>

				<div class="poll-url-container">
					<span class="success"><em><?php echo SPR_PUBLIC_LINK ?></em></span>
					<input type="text" id="public-url-field" title="<?php echo SPR_PUBLIC_LINK_DESC ?>" readonly/>
					<button type="button" class="copy-trigger" data-clipboard-target="#public-url-field" title="<?php echo SPR_LINK_COPY_TITLE ?>"></button>
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
						<input type="text" id="admin-url-field" title="<?php echo SPR_ADMIN_LINK_DESC ?>" readonly/>
						<button type="button" class="copy-trigger" data-clipboard-target="#admin-url-field" title="<?php echo SPR_LINK_COPY_TITLE ?>"></button>
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
					<img src="img/logo.png" alt=""/>
				</a>
			</div>
		<?php } ?>

	</div>
