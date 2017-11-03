<?php 
require_once('../includes/db.php');

if(isset($_GET['bookingid'])) {
	$bookingId = $_GET['bookingid'];
}

$query="SELECT *,booking.id as bookingid  FROM booking JOIN room ON booking.room_id=room.ID JOIN user ON booking.user_id=user.ID WHERE booking.id='$bookingId'";
$db_query=mysqli_query($db,$query);
if ( ! $db_query )
{
	die('Ungültige Abfrage: ' . mysqli_error());
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
			 	<form action="" style="padding:10px" method="post">
					<table class="order">
						<?php while($booking = mysqli_fetch_array($db_query, MYSQL_ASSOC)){
							if($booking['time_of_day']=='morning'){
								//$bookingPricing=$booking['price_morning'];
								$bookingDaytime="Vormittag";
							}
							if($booking['time_of_day']=='afternoon'){
								//$bookingPricing=$booking['price_afternoon'];
								$bookingDaytime="Abend";
							}
							if($booking['time_of_day']=='wholeDay'){
								//$bookingPricing=$booking['price_wholeday'];
								$bookingDaytime="Ganzer Tag";
							}
						?>
						<tr>
							<th>Nr.</th>
							<td class="overviewInfo" ><?php echo $booking['bookingid'];?></td>
						</tr>
						<tr>
							<th>Vorname</th>
							<td class="overviewInfo" style="padding-top:5px"><?php echo $booking['first_name'];?></td>
						</tr>
						<tr>
							<th>Nachname</th>
							<td class="overviewInfo" style="padding-top:5px"><?php echo $booking['last_name'];?></td>
						</tr>
						
						<tr>
							<th>Datum</th>
							<td class="overviewInfo" style="padding-top:5px"><?php echo date('d.m.Y',strtotime($booking['date']));?></td>
						</tr>
						<tr>
							<th>Tageszeit</th>	
							<td class="overviewInfo" style="padding-top:5px"><?php echo $bookingDaytime;?></td>
						</tr>
						<tr>
							<th>Preis</th>
							<td class="overviewInfo" style="padding-top:5px"><?php echo $booking['price'];?> CHF</td>
						</tr>
						<?php } ?>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
