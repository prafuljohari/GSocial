
<?php include("header.php");
include("db_connect.php"); 
session_start();
?>


<?php


$name = $_POST["name"];
$hostel = $_POST["hostel"];
$dept = $_POST["dept"];
$about_me = $_POST["about_me"];
$username = $_SESSION["username"];
$tbl_name="profile";

$sql="UPDATE $tbl_name
SET name='$name', hostel='$hostel', department='$dept', about_me = '$about_me'
WHERE userid= '$username'";

mysql_query($sql) or die (mysql_error());
header("location:profile.php");



?>