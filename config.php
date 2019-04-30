<?php
$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);

$SETTINGS["hostname"] = 'localhost';
$SETTINGS["mysql_user"] = 'root';
$SETTINGS["mysql_pass"] = '';
$SETTINGS["mysql_database"] = 'green_house';
$SETTINGS["USERS"] = 'php_users_login'; // this is the default table name that we used
$SETTINGS["ip"] = $array["ip"];

/* Connect to MySQL */
$connection = mysqli_connect($SETTINGS["hostname"], $SETTINGS["mysql_user"], $SETTINGS["mysql_pass"], $SETTINGS["mysql_database"]) or die ('Unable to connect to MySQL server.<br ><br >Please make sure your MySQL login details are correct.');

$db = mysqli_select_db($connection, $SETTINGS["mysql_database"]) or die ('request "Unable to select database."');
?>