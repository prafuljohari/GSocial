<?php
include("db_connect.php"); 
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");

$json = array();
$sql = "SELECT userid FROM profile where name LIKE '". $_POST['q'] ."%'";
$result = mysql_query($sql) or die('Error, query failed : '.mysql_error());

while($rows = mysql_fetch_array($result))
{
	array_push($json, $rows['userid']);
}
/*
array_push($json, "praful");
array_push($json, "shivangi@iitg.ernet.in");
array_push($json, "s.achal@iitg.ernet.in");
array_push($json, "anuj.gupta@iitg.ernet.in");*/
$jsonstring = json_encode($json);
echo $jsonstring;
die();
?>