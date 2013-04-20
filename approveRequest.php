<?php 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	$id = $_POST['id'];
	$approvedUser = $_POST['user'];
	$group = $_POST['groupid'];
		
	//Delete the record of the message
	$update = mysql_query("UPDATE request SET `status` = 1 WHERE `requestid` = $id");
	$insert = mysql_query("INSERT INTO is_in (userid,groupid) VALUES ('$approvedUser','$group')");
	
	//Redirect the user
	header("Location:requestForm.php");
	
	}

?>