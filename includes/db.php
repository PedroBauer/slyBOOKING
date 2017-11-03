<?php 

$databaseName ="ipa_complete";
$databaseUser ="ipa2016";
$databasePassword = "ipa2016";

$db = @mysqli_connect("127.0.0.1", $databaseUser, $databasePassword);
if (!@$db) die("Verbindung zur Datenbank konnte nicht hergestellt werden!");

mysqli_select_db($db, $databaseName);
if (mysqli_errno($db)) die("Verbindung zur Datenbank konnte nicht hergestellt werden!");

$sql = "SET NAMES 'utf8'";
$db->query($sql);

?>