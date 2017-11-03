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

$room = mysqli_fetch_array($db_query, MYSQL_ASSOC);

if ( ! $db_query )
{
	die('Ungültige Abfrage: ' . mysqli_error());
}

if($_GET['timeofday']=='morning'){
	$bookingPricing=$room['price_morning'];
}
if($_GET['timeofday']=='afternoon'){
	$bookingPricing=$room['price_afternoon'];
}
if($_GET['timeofday']=='wholeDay'){
	$bookingPricing=$room['price_wholeday'];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<? include("")?>
		<meta charset="utf-8">
		<link href="css/reset.css" type="text/css" rel="stylesheet">
		<link href="css/body.css" type="text/css" rel="stylesheet">	
	</head>
	<body>
		<div class="centered">
			<h1>Ihre Buchung</h1>
			<form class="customer-form" method="POST" action="thankPage.php" onsubmit="return confirm('Sind sicher das die Angaben richtig sind?');">
				<div class="inputLabel">Vorname: </div>
				<div class="inputText"><input type="text" name="firstname" required /></div>
				<div class="clear"></div>
							
				<div class="inputLabel">Nachname: </div>
				<div class="inputText"><input type="text" name="lastname" required /></div>
				<div class="clear"></div>
							
				<div class="inputLabel">Strasse: </div>
				<div class="inputText"><input type="text" name="street" required /></div>
				<div class="clear"></div>
							
				<div class="inputLabel">Ort / PLZ: </div>
				<div class="inputText"><input type="text" name="location" style="width:65px" required /></div>
				<div class="inputText"><input type="text" name="zipcode" style="width:65px" required /></div>
				<div class="clear"></div>

				<div class="inputLabel">Email: </div>
				<div class="inputText"><input type="text" name="email" required /></div>
				<div class="clear"></div>
					
				<div class="inputLabel">Telefon: </div>
				<div class="inputText"><input type="text" name="phone" required /></div>
				<div class="clear"></div>
				
				<input type="hidden" name="roomid" value="<?php echo $roomId;?>" />
				<input type="hidden" name="people" value="<?php echo $people;?>" />
				<input type="hidden" name="date" value="<?php echo $date;?>" />
				<input type="hidden" name="timeofday" value="<?php echo $timeofday;?>" />
				
				<input class="confirm" type="submit" value="Best&auml;tigen"/>
			</form>
			<div class="room-overview">
				<fieldset id="roomInformation">
					<div>
						<div id="room-image"><img src="images/demo-zimmer.jpg" width="300px"></div>
						<div id="room-name"><h3><?php echo $room['name'];?></h3></div>
						<div id="room-peopleCount"><p><?php echo $room['person_min'];?> - <?php echo $room['person_max'];?> Personen | <?=$bookingPricing?> CHF.-</p></div>
					</div>
				</fieldset>
			</div>
		</div>
	</body>
</html>