<?php
include("db_connect.php"); 
session_start();

$json = array();
foreach($_POST as $key=>$value)
{
  array_push($json, $value);
}
$jsonstring = json_encode($json);
echo $jsonstring;
die();
?>