
<?php
include("db_connect.php"); 
session_start();
?>


<?php
/*
foreach($_POST as $key=>$value)
{
  echo "$key=$value\n";
}
if ($_FILES["myFile"]["error"] > 0)
  {
  echo "Error: " . $_FILES["myFile"]["error"] . "<br>";
  }
else
  {
  echo "Upload: " . $_FILES["myFile"]["name"] . "<br>";
  echo "Type: " . $_FILES["myFile"]["type"] . "<br>";
  echo "Size: " . ($_FILES["myFile"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["myFile"]["tmp_name"];
  }

*/
$name = $_POST["usrName"];
$hostel = $_POST["usrHostel"];
$dept = $_POST["usrDept"];
$desg = $_POST["usrDesg"];
$DOB = $_POST["date"];
$about_me = $_POST["usrAbout"];
$username = $_SESSION["username"];
$tbl_name="profile";

$uploads_dir = './images';
$tmp_name = $_FILES["myFile"]["tmp_name"];
$imgname = "img-".$_SESSION["username"];
$success = move_uploaded_file($tmp_name, "$uploads_dir/$imgname.jpg");
//echo $success;

$sql="UPDATE $tbl_name
SET name='$name', hostel='$hostel', department='$dept', designation='$desg', dob='$DOB', about_me = '$about_me'
WHERE userid= '$username'";

mysql_query($sql) or die (mysql_error());
header("location:profile.php");
?>