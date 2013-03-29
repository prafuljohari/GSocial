
<?php
include("db_connect.php"); 
session_start();
?>


<?php
/*
foreach($_POST as $key=>$value)
{
  echo "$key=$value\n";
}*/
$name = $_POST["usrName"];
$hostel = $_POST["usrHostel"];
$dept = $_POST["usrDept"];
$desg = $_POST["usrDesg"];
$DOB = $_POST["date"];
$about_me = $_POST["usrAbout"];
$username = $_SESSION["username"];
$tbl_name="profile";

$sql="UPDATE $tbl_name
SET name='$name', hostel='$hostel', department='$dept', designation='$desg', dob='$DOB', about_me = '$about_me'
WHERE userid= '$username'";

mysql_query($sql) or die (mysql_error());
header("location:profile.php");



?>