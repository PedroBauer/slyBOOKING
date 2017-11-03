<?php 
require_once('/includes/db.php');
session_start();

if(isset($_POST['booking']) || $_SESSION['bookingFrontEnd']['room']){
	
	if(@$_POST['id']){
		$_SESSION['bookingFrontEnd']['room']['id'] = $_POST['id'];
		$_SESSION['bookingFrontEnd']['room']['bookingPrice'] = $_POST['bookingPrice'];
	}
	$id = $_SESSION['bookingFrontEnd']['room']['id'];
	$bookingPrice = $_SESSION['bookingFrontEnd']['room']['bookingPrice'];
	
	/*$_POST['id'];
	$bookingPrice = $_POST['bookingPrice'];*/
	$query = "SELECT * FROM room WHERE ID='$id'";
	$db_query=mysqli_query($db,$query);
	
	/*print_r($room);*/
	$room = mysqli_fetch_array($db_query, MYSQL_ASSOC);
	
	$_SESSION['bookingFrontEnd']['room']['name'] = $room['name'];
	$_SESSION['bookingFrontEnd']['room']['person_min'] = $room['person_min'];
	$_SESSION['bookingFrontEnd']['room']['person_max'] = $room['person_max'];
	$_SESSION['bookingFrontEnd']['room']['squaremeters'] = $room['squaremeters'];
	$_SESSION['bookingFrontEnd']['room']['description'] = $room['description'];
	
	
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	?>
	<html>
		<head>
			<link href="css/reset.css" type="text/css" rel="stylesheet">
			<link href="css/body.css" type="text/css" rel="stylesheet">
		</head>	
		<body>
			<div>
				<div class="centered">
					<form action="thankPage.php" method="POST">
						<div id="LeftContainer">
							<div><h1>Raum</h1></div>
							<div><?=$_SESSION['bookingFrontEnd']['room']['name']?></div>
							<div>Preis: <?=$_SESSION['bookingFrontEnd']['room']['bookingPrice']?></div>
							<div>Minimal Personen: <?=$_SESSION['bookingFrontEnd']['room']['person_min']?></div>
							<div>Maximal Personen: <?=$_SESSION['bookingFrontEnd']['room']['person_max']?></div>
							<div>Quadratmeter: <?=$_SESSION['bookingFrontEnd']['room']['squaremeters']?></div>
							<div>Description: <?=$_SESSION['bookingFrontEnd']['room']['description']?></div>
						</div>
						<div id="rightContainer">
							<div><h1>Kunde</h1></div>
							<div>Vorname: <?=$_SESSION['bookingFrontEnd']['user']['firstname']?></div>
							<div>Nachname: <?=$_SESSION['bookingFrontEnd']['user']['lastname']?></div>
							<div>Strasse: <?=$_SESSION['bookingFrontEnd']['user']['street']?></div>
							<div>PLZ / Ort: <?=$_SESSION['bookingFrontEnd']['user']['zipcode']?> / <?=$_SESSION['bookingFrontEnd']['user']['location']?></div>
							<div>Person: <?=$_SESSION['bookingFrontEnd']['user']['person']?></div>
							<div>Datum: <?=$_SESSION['bookingFrontEnd']['user']['date']?></div>
							<div>Tageszeit: <?=$_SESSION['bookingFrontEnd']['user']['timeOfDay']?></div>
							<div><input type="submit" name="submit" value="Bestätigung"/></div>
						</div>
					</form>
				</div>
			</div>
		</body>
	</html>
<?}?>

