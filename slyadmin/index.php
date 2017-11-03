<?php 
require_once('../includes/db.php');
require_once('../includes/functions.php');

if(isset($_GET['bookingid'])) {
	$bookingId = $_GET['bookingid'];
	$query="DELETE FROM booking WHERE ID = '$bookingId'";
	mysqli_query($db,$query);
}

?>
<!DOCTYPE html>
<html>
	<head>
	<meta charset="utf-8">
	<link href="../css/reset.css" type="text/css" rel="stylesheet">
	<link href="../css/slyadmin.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div id="page">
			<div id="topArea">
				<div id="logo"></div>
				<div id="login"></div>
			</div>
			<div id="sideBar">
				<span class="activeSidebar">Buchungen</span>
				<a href="roomManage.php">R&auml;ume Verwalten</a>
				<a href="settings.php">Einstellungen</a>
			</div>
			<div id="mainArea">
			 	<form action="" method="GET">
					<?=print_booking_table("FUTURE")?>
				</form>
			</div>
		</div>
	</body>
</html>
