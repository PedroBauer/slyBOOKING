<?php
require_once('/includes/db.php');


if(isset($_GET['roomid'])) {
	$roomId = $_GET['roomid'];
	$people = $_GET['people'];
	$date = $_GET['date'];
	$timeofday = $_GET['timeofday'];
	$query="SELECT * FROM room WHERE ID='$roomId'";
	$db_query=mysqli_query($db,$query);
}

$detailRoom = mysqli_fetch_array($db_query, MYSQL_ASSOC);

if ( ! $db_query ){
	die('Ungültige Abfrage: ' . mysqli_error());
}

if($_GET['timeofday']=='morning'){
	$bookingPricing=$detailRoom['price_morning'];
}
if($_GET['timeofday']=='afternoon'){
	$bookingPricing=$detailRoom['price_afternoon'];
}
if($_GET['timeofday']=='wholeDay'){
	$bookingPricing=$detailRoom['price_wholeday'];
}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link href="css/reset.css" type="text/css" rel="stylesheet">
		<link href="css/body.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="centered">
			<form method="GET">
				<h1><?php echo $detailRoom['name'];?></h1>
				<img src="images/demo-zimmer.jpg" >
				<?php echo $detailRoom['description'];?>
				<p>Personen Minimal: <?php echo $detailRoom['person_min'];?></p>
				<p>Personen Maximal: <?php echo $detailRoom['person_max'];?></p>
				<p>Preis: <?php echo $bookingPricing;?> CHF.-</p>
				<p>Quadratmeter: <?php echo $detailRoom['squaremeters'];?></p>
				<div id="buchenButton"><a href="bookingCustomer.php?roomid=<?php echo $roomId;?>&people=<?php echo $_GET['people'];?>&date=<?php echo $_GET['date'];?>&timeofday=<?php echo $timeofday;?>">Buchen</a></div>
				<div id="backButton"><a href="index.php">Zur&uuml;ck</a></div>
			</form>
		</div>
	</body>
</html>