
<?php
include("db_connect.php"); 
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
?>


<?php
/*
foreach($_POST as $key=>$value)
{
  echo "$key=$value\n";
}
*/
/*
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

$result = mysql_query("SELECT groupid FROM is_in WHERE userid='$username'") or die(mysql_error());
if (mysql_num_rows($result) > 0)
$currentGroups = mysql_fetch_array($result);
else
$currentGroups = array();

$result = mysql_query("SELECT A.groupid FROM request_rel AS A JOIN request B ON A.requestid = B.requestid AND B.status = 0 
WHERE A.userid='$username'") or die(mysql_error());
$pendingRequests = mysql_fetch_array($result);
$groupsRequested = explode(",", $_POST["content"]);

foreach($groupsRequested AS $newRequestGroup)
{
	if ((!in_array($newRequestGroup, $currentGroups)) && ((sizeof($pendingRequests) == 1) || (!in_array($newRequestGroup, $pendingRequests))))
	{
		$insert = mysql_query("INSERT INTO request() VALUES()");
		$requestid = mysql_insert_id();
		
		$insert = mysql_query("INSERT INTO request_rel(requestid, userid, groupid) VALUES($requestid,'$username','$newRequestGroup')");
	}
}

/*
$groupsRequested = explode(",", $_POST["content"]);

foreach($groupsRequested AS $newRequestGroup)
{
	if (!in_array($newRequestGroup, $currentGroups))
	{
		if ($newRequestGroup == "" or $newRequestGroup == " ")
			continue;
		$insert = mysql_query("INSERT INTO request() VALUES()") or die(mysql_error());
		$requestid = mysql_insert_id();
		
		$insert = mysql_query("INSERT INTO request_rel(requestid, userid, groupid) VALUES($requestid,'$username','$newRequestGroup')") or die(mysql_error());
	}
}*/

header("location:profile.php");
?>