<?php
require_once('core/classes/system.class.php');
system::init();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Codestats.io &ndash; Stats or it did not happen</title>
		<meta charset="utf-8" />
		<link type="text/css" rel="stylesheet" media="all" href="assets/css/style.css" />
		<script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="assets/js/functions.js"></script>
	</head>
	<body>
		<?php
		system::loadContent();
		?>
	</body>
</html>