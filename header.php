<?php require_once 'config.php' ?>


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
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- CSS
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/form.min.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- JQUERY
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script type="text/javascript" src="res/jquery/jquery-1.12.3.min.js"></script>

	<!-- DATEPICKER
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<link rel="stylesheet" href="res/datepicker/datepicker.min.css">
	<script type="text/javascript" src="res/datepicker/datepicker.min.js"></script>

	<!-- CLIPBOARD
	–––––––––––––––––––––––––––––––––––––––––––––––––– -->
	<script src="res/clipboard/clipboard.min.js"></script>


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

	<div id="header">
		<div id="logo">
			<a href="index.php">
				<img src="img/logo.png" alt=""/>
			</a>
		</div>
		<div id="info">
			<h1><?php echo (isset($poll) ? $poll["title"] : SPR_INDEX_TITLE); ?></h1>
			<p class="details"><?php echo (isset($poll) ? $poll["details"] : SPR_INDEX_SUBTITLE); ?></p>
			<?php
				if (isset($poll)){
					echo "<br/><img src='img/icon-copy.png' id='btnCopy' data-clipboard-target='#urlInfo' /><span id='urlInfo'></span>";

					if (strcmp($poll["polladm"], "NA") != 0 && strcmp($poll["polladm"], $adminId) == 0) {
						echo "<br/><br/><div id='admin-url'>ADMIN-LINK:<br/><br/><span id='admUrl'></span>&adm=" . $adminId . "</div>";
					}
				}
			?>
		</div>
	</div>
