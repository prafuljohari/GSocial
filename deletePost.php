<?php 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
$currentGroup = $_SESSION['currentGroup'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	echo $id = $_POST['id'];
		
	//Delete the record of the post
	$delete = mysql_query("DELETE FROM has_posts WHERE `postid` = '$id' AND `groupid` = '$currentGroup'");
	$delete = mysql_query("DELETE FROM post WHERE `postid` = '$id'");
	
	//Redirect the user
	header("Location:commentForm.php");
	
	}

?>