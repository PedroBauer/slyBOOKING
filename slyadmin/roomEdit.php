<?php 
require_once('../includes/db.php');
$uploadedFile = false;

//Upload file if available
function doUploadFile($roomid) {
	global $db;
	if(@$_FILES['fileToUpload'] && $roomid){
		$uploadfile = preg_replace("/\\\\slyadmin$/", "", getcwd())."/images/". $_FILES['fileToUpload']['name'];
		if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
			$uploadedFile = $_FILES['fileToUpload']['name'];
			$query = "DELETE FROM room_image WHERE room_id = ".$roomid;
			mysqli_query($db,$query);
			$query = "INSERT INTO room_image (image, room_id) VALUES ('".$uploadedFile."', ".$roomid.")";
			mysqli_query($db,$query);
			return true;
		}
	}
	return false;
}

if(isset($_GET['roomid'])) {
	$roomid = $_GET['roomid'];
	$query="SELECT * FROM room WHERE ID='$roomid'";
	$db_query=mysqli_query($db,$query);
	if ( ! $db_query )
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	$room = mysqli_fetch_array($db_query, MYSQL_ASSOC);
}

if(isset($_POST['update'])){
	$name = $_POST['name'];
	$price_morning = $_POST['price_morning'];
	$price_afternoon = $_POST['price_afternoon'];
	$price_wholeday = $_POST['price_wholeday'];
	$person_min = $_POST['person_min'];
	$person_max = $_POST['person_max'];
	$squaremeters = $_POST['squaremeters'];
	$description = $_POST['description'];
	
	$query = "UPDATE room SET name='$name', price_morning='$price_morning', price_afternoon='$price_afternoon', price_wholeday='$price_wholeday', person_min='$person_min', person_max='$person_max', squaremeters='$squaremeters', description='$description' WHERE ID='$roomid'";
	$db_query=mysqli_query($db,$query);
	if ( ! $db_query )
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	doUploadFile($_GET['roomid']);
	header('Location: roomManage.php');
}

if(isset($_POST['submit'])){
	
	$name = $_POST['name'];
	$price_morning = $_POST['price_morning'];
	$price_afternoon = $_POST['price_afternoon'];
	$price_wholeday = $_POST['price_wholeday'];
	$person_min = $_POST['person_min'];
	$person_max = $_POST['person_max'];
	$squaremeters = $_POST['squaremeters'];
	$description = $_POST['description'];

	if(!is_numeric($price_morning)){
		echo "Das Feld Morgen ist keine Zahl!";
	}elseif(!is_numeric($price_afternoon)){
		echo "Das Feld Abend ist keine Zahl!";
	}elseif(!is_numeric($price_wholeday)){
		echo "Das Feld Ganzer Tag ist keine Zahl!";
	}elseif(!is_numeric($person_min)){
		echo "Das Feld Personen Minimal ist keine Zahl!";
	}elseif(!is_numeric($person_max)){
		echo "Das Feld Personen Maximal ist keine Zahl!";
	}elseif(!@$_FILES['fileToUpload'] || !@$roomid){
		$error = "!";
	}else{
		
	
		$query = "INSERT INTO room (name, price_morning, price_afternoon, price_wholeday, person_min, person_max, squaremeters, description) VALUES('$name', '$price_morning', '$price_afternoon', '$price_wholeday', '$person_min', '$person_max', '$squaremeters', '$description')";
		$db_query=mysqli_query($db,$query);
		if ( ! $db_query )
		{
			die('Ungültige Abfrage: ' . mysqli_error());
		}
		$query = "SELECT LAST_INSERT_ID()";
		$db_query=mysqli_query($db, $query);
		$roomid = $db_query->fetch_array()[0];
		
		header('Location:  roomManage.php');
	}
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
			</div>
			<div id="sideBar">
				<a href="index.php">Buchungen</a>
				<span class="activeSidebar">R&auml;ume Verwalten</span>
				<a href="settings.php">Einstellungen</a>
			</div>
			<div id="mainArea">
			 	<form enctype="multipart/form-data" method="POST" accept="image/*" style="padding:10px" action="<?php $_PHP_SELF ?>">
					<table class="roomOverview">						
						<?php if(!empty($room['ID'])){?>
						<tr>
							<th>Nr.</th>
							<td class="roomEdit"><span><?php if(!empty($room['ID'])){echo $room['ID'];}?></span></td>
						</tr>
						<?php }?>
						<tr>
							<th>Name <span class="required">*</span></th>
							<td class="roomEdit"><input name="name" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['name'])){echo $room['name'];}?>" required /></td>
						</tr>
						<tr>
							<th>Vormittag <span class="required">*</span></th>
							<td class="roomEdit"><input name="price_morning" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['price_morning'])){echo $room['price_morning'];}?>" required /> CHF</td>
						</tr>
						<tr>
							<th>Abend <span class="required">*</span></th>
							<td class="roomEdit"><input name="price_afternoon" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['price_afternoon'])){echo $room['price_afternoon'];}?>" required /> CHF</td>
						</tr>
						<tr>
							<th>Ganzer Tag <span class="required">*</span></th>
							<td class="roomEdit"><input name="price_wholeday" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['price_wholeday'])){echo $room['price_wholeday'];}?>" required /> CHF</td>
						</tr>
						<tr>
							<th>Personen Minimal <span class="required">*</span></th>
							<td class="roomEdit"><input name="person_min" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['person_min'])){echo $room['person_min'];}?>" required /></td>
						</tr>
						<tr>
							<th>Personen Maximal <span class="required">*</span></th>
							<td class="roomEdit"><input name="person_max" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['person_max'])){echo $room['person_max'];}?>" required /></td>
						</tr>
						<tr>
							<th>Quadratmeter</th>
							<td class="roomEdit"><input name="squaremeters" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($room['squaremeters'])){echo $room['squaremeters'];}?>" /></td>
						</tr>
						<tr>
							<th>Beschreibung</th>
							<td class="roomEdit"><textarea name="description" rows="4" cols="50" style="margin-top:5px;vertical-align: top"><?php if(!empty($room['description'])){echo $room['description'];}?></textarea></td>
						</tr>
						<tr>
							<th>Bild</th>
							<td class="roomEdit">
							 <input name="fileToUpload" type="file"  id="fileToUpload">
							 <?
							 if(isset($_GET['roomid'])) {
							 	$res = mysqli_query($db, "SELECT image FROM room_image WHERE room_id = ".$roomid);
							 	if (mysqli_num_rows($res) > 0) {
									$imgObj = $res->fetch_object();
									echo '<img src="../images/'.$imgObj->image.'" width="200" />';
								}
							 }
							 ?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td class="roomEdit"><?php if(isset($_GET['roomid'])){?><input type="submit" name="update" value="Update"><?php }else{?><input type="submit" name="submit" value="Submit"><?php }?></td>
							<td class="roomEdit"><?php if(isset($_GET['roomid'])){?><input type="submit" name="update" value="Update"><?}else{?><input type="submit" name="submit" value="Speichern"><?}?></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>