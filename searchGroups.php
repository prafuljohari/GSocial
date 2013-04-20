<?php
include("db_connect.php"); 
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$json = array();
$sql = "SELECT groupid FROM groups where groupid LIKE '". $_POST['q'] ."%'";
$result = mysql_query($sql) or die('Error, query failed : '.mysql_error());

while($rows = mysql_fetch_array($result))
{
	array_push($json, $rows['groupid']);
}

$jsonstring = json_encode($json);
echo $jsonstring;
die();
?>