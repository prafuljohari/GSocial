<?php 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
$currentConv = $_SESSION['currentConv'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	echo $id = $_POST['id'];
		
	//Delete the record of the message
	$delete = mysql_query("DELETE FROM has_msgs WHERE `messageid` = '$id' AND `convid` = '$currentConv'");
	$delete = mysql_query("DELETE FROM messages WHERE `messageid` = '$id'");
	
	//Redirect the user
	header("Location:start_conv.php");
	
	}

?>