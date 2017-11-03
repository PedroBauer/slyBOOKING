<?php


require_once('../includes/db.php');




if(isset($_GET['roomid'])) {
	$roomId = $_GET['roomid'];
	$query="DELETE room, booking FROM room JOIN booking ON room.ID = booking.room_id WHERE room.ID = '$roomId'";
	mysqli_query($db,$query);
	
	$query="SELECT *,room.id as roomid  FROM room";
}else{
	$query="SELECT *,room.id as roomid  FROM room";
}

$db_query=mysqli_query($db,$query);
if ( ! $db_query ){
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
				<a href="index.php">Buchungen</a>
				<span class="activeSidebar">R&auml;ume Verwalten</span>
				<a href="settings.php">Einstellungen</a>
			</div>
			<div id="mainArea">
			 	<form action="" method="GET">
					<table class="order">
						<tr class="topRail">
							<th align="left">Nr.</th>
							<th align="left">Raumname</th>
							<th align="left">Vormittag</th>
							<th align="left">Nachmittag</th>
							<th align="left">Ganzer Tag</th>
							<th align="left">Pers. Minimal</th>
							<th align="left">Pers. Maximal</th>
							<th align="left">Quadratmeter</th>
							<th></th>
							<th><a class="addRoom" href="roomEdit.php">+</a></th>
						</tr>
						<?php while($room = mysqli_fetch_array($db_query, MYSQL_ASSOC)){?>
						<tr>
							<td class="roomInfo"><?php echo $room['ID'];?></td>
							<td class="roomInfo"><?php echo $room['name'];?></td>
							<td class="roomInfo"><?php echo $room['price_morning'];?> CHF</td>
							<td class="roomInfo"><?php echo $room['price_afternoon'];?> CHF</td>
							<td class="roomInfo"><?php echo $room['price_wholeday'];?> CHF</td>
							<td class="roomInfo"><?php echo $room['person_min'];?></td>
							<td class="roomInfo"><?php echo $room['person_max'];?></td>
							<td class="roomInfo"><?php echo $room['squaremeters'];?></td>
							<td class="roomInfoEdit"><a href="roomEdit.php?roomid=<?php echo $room['roomid'];?>"><div id="edit">Edit</div></a></td>
							<td class="roomInfoDelete"><a href="roomManage.php?roomid=<?php echo $room['roomid'];?>"><div id="delete">Delete</div></a></td>
						</tr>
						<?php } ?>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>