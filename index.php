<?php 
		

require_once('/includes/db.php');

$query="SELECT * FROM settings";

$db_query=mysqli_query($db,$query);
if ( ! $db_query )
{
	die('Ungültige Abfrage: ' . mysqli_error());
}

/*$dateTime = mysqli_fetch_array($db_query, MYSQL_ASSOC);
$roomsAndBookings = array();
$roomSearch = array();*/

/*echo $_GET['date']."<br/>";
echo strtotime($_GET['date'])."<br/>";
echo time()."<br/>";*/


// Muss existieren da, array_push auf linie 32 $rooms einen Array verlangt
$rooms = array();

if(isset($_GET['submit'])) {

	$sql="SELECT * FROM room WHERE person_min <= ".$_GET['person']." AND person_max >= ".$_GET['person'];
	$res=mysqli_query($db,$sql);
	
	// Ohne While würde nur einen Raum ausgeben.
	while($arrayRes = mysqli_fetch_array($res, MYSQL_ASSOC)) {
		array_push($rooms, $arrayRes);
	}
	/*echo "<pre>";
	print_r($finalRes);
	echo "</pre>";*/

	

	foreach ($rooms as $room){
		
		$sql="SELECT COUNT(*) FROM booking WHERE room_id=".$room['ID']." AND date=".$_GET['date'];
		
		$res=mysqli_query($db,$sql);
		echo $res."<br/>";
		print_r($res);
		

	}
	

	/*if($_GET['person']>100){
		echo " fehler";
		echo $_GET['person'];
	}elseif(strtotime($_GET['date'])<time()){
		echo "Fehler Datum in der vergangheit";
	}else{*/
		
		/*$query2 = "SELECT * FROM booking JOIN room ON booking.room_id = room.ID";
		$query2 = "SELECT * FROM room JOIN booking ON room.ID = booking.room_id";
		$db_query2=mysqli_query($db,$query2);
		while($roomAndBookingQuery = mysqli_fetch_array($db_query2, MYSQL_ASSOC)) {
			array_push($roomsAndBookings, $roomAndBookingQuery);
		}
		
		// 	print_r($roomsAndBookings);
		foreach($roomsAndBookings as $roomAndBooking) {
			// Überprüfung ob die Zimmer in der Personen skala drinnen sind.
			if($_GET['person'] >= $roomAndBooking['person_min'] && $_GET['person'] <= $roomAndBooking['person_max']) {
				if(strtotime($roomAndBooking['date']) == strtotime($_GET['date']) && $roomAndBooking['time_of_day'] == 'wholeday') {
					echo "Its wholeday";
				} else {
					if(strtotime($roomAndBooking['date']) == strtotime($_GET['date']) && $roomAndBooking['time_of_day'] == 'morning' && $roomAndBooking['time_of_day'] == 'afternoon'){
						
					} else {
						if(strtotime($roomAndBooking['date']) == strtotime($_GET['date']) && $roomAndBooking['time_of_day'] == $_GET['timeOfDay']) {
							echo "Schon gebucht ".$roomAndBooking['ID']."<br/>";
						} else {
							echo "Noch frei ".$roomAndBooking['ID']."<br/>";
							array_push($roomSearch, $roomAndBooking);
					 	}
					}
				}
				
			}
			echo "<pre>";
			print_r($roomAndBooking);
			echo "</pre>";
		}
		$newArray = array();		
		for($i=0; $i<count($roomSearch); $i++){
			if($i == 0) {
				array_push($newArray, $roomSearch[$i]);
			} else {
				if($roomSearch[$i]['ID'] == $roomSearch[$i-1]['ID']) {
					echo "gleiche ID's";
				} else {
					array_push($newArray, $roomSearch[$i]);
				}
			}
		}
	}*/
}

//<input id="rangeInput" type="range" name="person" value="0" max="1000" onchange="updateTextInput(this.value);" />


?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<link href="css/reset.css" type="text/css" rel="stylesheet">
		<link href="css/body.css" type="text/css" rel="stylesheet">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
 		<script>
		  $(function() {
		    $( "#datepicker" ).datepicker({ dateFormat: 'dd.mm.yy' }).val();
		  });
		  function updateTextInput(val) {
		      document.getElementById('textInput').value=val; 
		   };
		  function updateRangeInput(val) {
			  document.getElementById('rangeInput').value=val; 
		   };
		</script>
	</head>
	<body>
		<div id="page">
			<div id="mainArea">
				<div class="centered">
					<form action="" method="GET">
						<fieldset id="customerInformation">
							<h3>Jetzt buchen!</h3>
							<div class="inputLabel">Datum: </div>
							<div class="inputText"><input type="text" id="datepicker" name="date" value="<?php if(@$_GET['date']){echo $_GET['date'];}else{echo date('d.m.Y');}?>" required /></div>
							
							<div id="times">
								<div class="dateTime">
									<input type="radio" id="morning" name="timeOfDay" value="morning" required />
									<label for="morning"> Am Vormittag von (<?php echo $dateTime['morningHours'];?>)</label>
								</div>
								<div class="dateTime">
									<input type="radio" id="afternoon" name="timeOfDay" value="afternoon" required />
									<label for="evening"> Am Nachtmittag von (<?php echo $dateTime['afternoonHours'];?>)</label>
								</div>
								<div class="dateTime">
									<input type="radio" id="wholeday" name="timeOfDay" value="wholeday" required<?php
									if ($_GET['timeOfDay'] == "wholeday") echo " checked";
									?> />
									<label for="Ganzertag">Ganzer Tag von (<?php echo $dateTime['wholedayHours'];?>)</label>
								</div>
							</div>
							
							<div class="inputLabel">Anzahl Seminarteilnehmer: </div>
							<div class="inputText"><input type="number" id="textInput" name="person" value="<?php if($_GET['person']){echo $_GET['person'];}else{echo 0;}?>" onchange="updateRangeInput(this.value);"></div>
							
							<div class="clear"></div>
							
							
							
							
							<div class="clear"></div>
							<div class="inputLabel"></div>
							<div class="inputText"><input type="submit" name="submit" value="Verf&uuml;gbarkeit &Uuml;berpr&uuml;fen"></div>
						</fieldset>
					</form>
					
						<?php
						$b=0;
						/*while($booking = mysqli_fetch_array($db_query, MYSQL_ASSOC)){*/
						foreach(@$newArray as $room){
							if($_GET['timeOfDay']=='morning'){
								$bookingPricing=$newArray[$b]['price_morning'];
							}
							if($_GET['timeOfDay']=='afternoon'){
								$bookingPricing=$newArray[$b]['price_afternoon'];
							}
							if($_GET['timeOfDay']=='wholeDay'){
								$bookingPricing=$newArray[$b]['price_wholeday'];
							}
							$res = mysqli_query($db, "SELECT image FROM room_image WHERE room_id = ".$room['ID']);
							if (mysqli_num_rows($res) > 0) {
								$imgObj = $res->fetch_object();
								echo '<img src="../images/'.$imgObj->image.'" width="200" />';
							}
							$b++;
							/*echo "<pre>";
							print_r($newArray);
							echo "</pre>";*/
						?>
						<div class="rooms" data-minPeople="<?php echo $room['person_min'];?>" data-maxPeople="<?php echo $room['person_max'];?>" >
							<a href="detailPage.php?roomid=<?php echo $room['ID'];?>&people=<?php echo $_GET['person'];?>&date=<?php echo $_GET['date'];?>&timeofday=<?php echo $_GET['timeOfDay'];?>">
								<fieldset id="roomInformation">
									<div id="room-<?php echo $room['ID'];?>" >
										<div id="room-image"><img src="images/<?php echo $imgObj->image;?>" width="300px"></div>
										<div id="room-name"><h3><?php echo $room['name'];?></h3></div>
										<div id="room-peopleCount"><p><?php echo $room['person_min'];?> - <?php echo $room['person_max'];?> Personen | <?php echo $bookingPricing;?> CHF.-</p></div>
									</div>
								</fieldset>
							</a>
						</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
