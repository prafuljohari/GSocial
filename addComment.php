<?php 
include("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$currentUser = $_SESSION['username'];
$currentGroup = $_SESSION['currentGroup'];
?>

<?php
	
	//delete.php?id=IdOfPost
	if(isset($_POST['submit'])){
	
	echo $id = $_POST['id'];
	echo $content = $_POST['content'];
		
	//Delete the record of the post
	$insert = mysql_query("INSERT INTO comments (file_pointer, postid, sender_userid) VALUES ('$content', $id, '$currentUser')");
	$commentid=mysql_insert_id();
	
	//trigger like action
	$postid=$id;
	$table_notif="notification";
	$notif_type="0"; // type 0 is for posts/comments as opposed to messages
	$query_insert_notif="insert into $table_notif (type) values ('$notif_type')";
	mysql_query($query_insert_notif) or die (mysql_error());
	$notifid = mysql_insert_id();
	
	$post_type = 1; // post or comment's type for it to be post
	$table_post_notif= "post_notif";
	$query_insert_post_notif = "insert into $table_post_notif values ('$notifid','$commentid','$post_type')";
	mysql_query($query_insert_post_notif) or die (mysql_error());
	
	$table_is_in="is_in";
	$query_trigger_select="select *  from $table_is_in where groupid='$currentGroup'";
	$result = mysql_query($query_trigger_select) or die (mysql_error());;
	if($result)echo "selected.<br>";
	
	$unseen=0;// 0 is for unseen
	$table_user_notif="user_notif";
	 
	if ($result) 
	{
		while($row = mysql_fetch_array($result)) 
		{
			$userid=$row["userid"];
			//$groupid = $row["groupid"];
			echo $userid;
			$query_postcheck_select="select *  from post where postid='$postid' and sender_userid='$userid'";
			$check_post = mysql_query($query_postcheck_select) or die (mysql_error());
			$num_check_post = mysql_num_rows($check_post);
			
			$query_commentcheck_select="select *  from comments where postid='$postid' and sender_userid='$userid'";
			$check_comment = mysql_query($query_commentcheck_select) or die (mysql_error());
			$num_check_comment = mysql_num_rows($check_comment);
			
			if (($num_check_comment>0) or ($num_check_post>0))
			{
				if ( $userid != $currentUser)
				{
				$query_insert_userNotif="insert into $table_user_notif values ('$notifid', '$unseen', '$userid')";
				mysql_query($query_insert_userNotif) or die(mysql_error());
				}
			}
			else
			{
				echo "nothing here";
			}
			
		}

	}
	else
		echo "Not done man!";
		
	//end trigger
	
	//Redirect the user
	header("Location:commentForm.php");
	
	}

?>