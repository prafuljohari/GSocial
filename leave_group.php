<?php
include ("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");

$myusername = $_SESSION['username'];
$groupname = $_GET['groupName'];

$sql_check = "SELECT * from is_in where userid = '$myusername' AND groupid = '$groupname'";
$result_check = mysql_query($sql_check) or die(mysql_error());
if (mysql_num_rows($result_check) > 0)
{
	echo "Kya mazak hai?";
	$sql_del = "DELETE FROM is_in WHERE  userid='$myusername' AND groupid='$groupname'";
	$result_del = mysql_query($sql_del) or die(mysql_error());
}
header("Location: profile.php");
?>