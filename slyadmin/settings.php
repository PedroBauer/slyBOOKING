<?php 
require_once('../includes/db.php');

$query = "SELECT * FROM settings";
$db_query=mysqli_query($db,$query);
if ( ! $db_query )
{
	die('Ungültige Abfrage: ' . mysqli_error());
}
$setting = mysqli_fetch_array($db_query, MYSQL_ASSOC);

if(isset($_POST['update'])){
	$email = $_POST['email'];
	$morningHours = $_POST['morningHours'];
	$afternoonHours = $_POST['afternoonHours'];
	$wholedayHours = $_POST['wholedayHours'];

	$query = "UPDATE settings SET email='$email', morningHours='$morningHours', afternoonHours='$afternoonHours', wholedayHours='$wholedayHours' WHERE ID=1";
	$db_query=mysqli_query($db,$query);
	if ( ! $db_query )
	{
		die('Ungültige Abfrage: ' . mysqli_error());
	}
	header('Location: settings.php');
	die();
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
				<a href="roomManage.php">R&auml;ume Verwalten</a>
				<span class="activeSidebar">Einstellungen</span>
			</div>
			<div id="mainArea">
			 	<form method="POST" style="padding:10px" action="<?php $_PHP_SELF ?>">
					<table class="settingsOverview">						
						<tr>
							<th>Admin E-Mail <span class="required">*</span></th>
							<td class="settingsEdit"><input name="email" type="text" style="width:170px;margin-top:5px;margin-bottom:5px"value="<?php if(!empty($setting['email'])){echo $setting['email'];}?>"></td>
						</tr>
						<tr>
							<th>Morgen <span class="required">*</span></th>
							<td class="settingsEdit"><input name="morningHours" type="text" style="width:80px" value="<?php if(!empty($setting['morningHours'])){echo $setting['morningHours'];}?>"></td>
						</tr>
						<tr>
							<th>Abend <span class="required">*</span></th>
							<td class="settingsEdit"><input name="afternoonHours" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($setting['afternoonHours'])){echo $setting['afternoonHours'];}?>"></td>
						</tr>
						<tr>
							<th>Ganzer Tag <span class="required">*</span></th>
							<td class="settingsEdit"><input name="wholedayHours" type="text" style="width:80px;margin-top:5px" value="<?php if(!empty($setting['wholedayHours'])){echo $setting['wholedayHours'];}?>"></td>
						</tr>
						<tr>
							<th></th>
							<td class="settingsEdit"><input type="submit" name="update" value="Aktualisieren"></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>