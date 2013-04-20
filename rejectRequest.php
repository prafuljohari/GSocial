<?php 
include("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$currentUser = $_SESSION['username'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	$id = $_POST['id'];
		
	//Delete the record of the message
	$update = mysql_query("UPDATE request SET `status` = 2 WHERE `requestid` = $id");
		
	//Redirect the user
	header("Location:requestForm.php");
	
	}

?>