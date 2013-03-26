<?php
$host = "127.0.0.1";
$user = "root";
  $pass = "";
  $db = "gsocial";

$con = mysql_connect($host, $user, $pass);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

//echo "connection made";
mysql_select_db("$db")or die("Cannot select DB");
?>