<?php 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	echo $id = $_POST['id'];
		
	//Delete the record of the post
	$delete = mysql_query("DELETE FROM comments WHERE `commentid` = '$id'");
		
	//Redirect the user
	header("Location:commentForm.php");
	
	}

?>