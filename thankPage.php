<?php
require_once('/includes/db.php');



$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$street = $_POST['street'];
$location = $_POST['location'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$roomid = $_POST['roomid'];
$people = $_POST['people'];
$date = $_POST['date'];
$timeofday = $_POST['timeofday'];


$query="SELECT * FROM room WHERE ID='$roomid'";
$db_query=mysqli_query($db,$query);
$room = mysqli_fetch_array($db_query, MYSQL_ASSOC);
if ( ! $db_query )
{
	die('Ungültige Abfrage: ' . mysqli_error());
}


if($timeofday=='morning'){
	$bookingPricing=$room['price_morning'];
}
if($timeofday=='afternoon'){
	$bookingPricing=$room['price_afternoon'];
}
if($timeofday=='wholeDay'){
	$bookingPricing=$room['price_wholeday'];
}

$query="INSERT INTO user (ID,first_name,last_name,street,city,zip,email,phone) VALUES ('','$firstname','$lastname','$street','$location','$zipcode','$email','$phone')";


 

if (mysqli_query($db, $query)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($db);
}

$userid = mysqli_insert_id($db);

/*echo $userid;*/


$date= date("Y-m-d", strtotime($date));

$query="INSERT INTO booking (ID,date,person_count,time_of_day,price,user_id,room_id) VALUES ('','$date','$people','$timeofday','$bookingPricing','$userid','$roomid')";




if (mysqli_query($db, $query)) {
	echo "New record created successfully";
} else {
	echo "Error: " . $query . "<br>" . mysqli_error($db);
}


mail('pgm.bauer@gmail.com','testmail','samplecontent','From: pgm.bauer@gmail.com');



?>
<html>
	<head>
		<link href="css/reset.css" type="text/css" rel="stylesheet">
		<link href="css/body.css" type="text/css" rel="stylesheet">
	</head>
	<body>
		<div class="centered">
			Vielen Dank Für Ihre Buchung
			Ihnen wurde eine E-Mail für die Bestätigung gesendet
		</div>
	</body>
</html>