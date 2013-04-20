<?php
include ("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");

$members = explode(',', $_POST['content']);
$currentConv = $_POST['conv'];

foreach($members as $item)
{
	if ($item != "" and $item != " "){
	$sql = "SELECT * from members WHERE userid = '$item' AND convid = '$currentConv'";
	$res = mysql_query($sql) or die(mysql_error());
	$result = mysql_num_rows($res);
	
	if ($result > 0)
	{
		echo "Skipped". $item . "\n";
		continue;
	}
	else
	{
			$sql = "INSERT INTO members (convid, userid) VALUES ('$currentConv', '$item')";
			$result = mysql_query($sql) or die(mysql_error());
			if ($result)
				echo $item." inserted!";
			// add same trigger like action as start_conv
			
			
			$table_notif="notification";
			$notif_type="1"; // type 0 is for posts/comments as opposed to messages
			$query_insert_notif="insert into $table_notif (type) values ('$notif_type')";
			mysql_query($query_insert_notif) or die (mysql_error());
			$notifid = mysql_insert_id();
			
			$conv_type = 0; // conv or msg type. 0 for it to be conv
			$table_conv_notif= "msg_notif";
			$query_insert_conv_notif = "insert into $table_conv_notif values ('$conv_type', '$currentConv', '$notifid')";
			mysql_query($query_insert_conv_notif) or die (mysql_error());
			
			$unseen=0;// 0 is for unseen
			$table_user_notif="user_notif";
			
			
			$userid = $item;
			//$groupid = $row["groupid"];
			echo $userid;
			
			$query_insert_userNotif="insert into $table_user_notif values ('$notifid', '$unseen', '$userid')";
			mysql_query($query_insert_userNotif) or die(mysql_error());
			
			
			//end trigger
			
			
			
	}
	echo " inserted!";
	}
}

header("Location: start_conv.php?convid=$currentConv");
?>