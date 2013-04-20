<!DOCTYPE html>
<html>
<head>
<!--<a href="#your-page-element">Jump to ID</a> <br>
-->
<?php
include("db_connect.php"); 
include("header.html");

session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
include ("navbar.html");
$_user = $_SESSION["username"];
?>
</head>
<body>
<div class="container">
<div class="hero-unit">
<legend>Notifications</legend>
</div>
<?php

$sql="SELECT * FROM user_notif WHERE userid='$_user' ORDER BY notif_id DESC";
//need to sort by timestamp
$result=mysql_query($sql) or die (mysql_error());
if ($result) 
	{
		echo '<ul class="unstyled">';
		while($row = mysql_fetch_array($result)) 
		{
			$notif_id= $row["notif_id"];
			$userid=  $row["userid"];
			//1 get the type i.e. message or post from notification table
			//2 get postid or commentid from post_notif (check type there comment or post). if comment get postid from comments using .
			//3 use has_posts to get groupid 
			
			$select_from_notif="select * from notification where notif_id='$notif_id'";
			$nest_query=mysql_query($select_from_notif) or die (mysql_error());
			$row_nest= mysql_fetch_array($nest_query);
			$msg_or_post=$row_nest["type"];
			
			if( $msg_or_post==0)//post/comment not msg
			{
				$select_from_post_notif="select * from post_notif where notif_id='$notif_id'";
				$nest_query2 = mysql_query($select_from_post_notif) or die (mysql_error());
				$row_nest2 = mysql_fetch_array($nest_query2);
				$comment_or_post =$row_nest2["type"]; 
				$comment_or_post_id = $row_nest2["post_or_comment_id"];
				
				if( $comment_or_post == 0)//post not comment
				{
					$postid=$comment_or_post_id;
				
				
				}
				else //comment
				{
					$select_from_comments="select * from comments where commentid='$comment_or_post_id'";
					$nest_query3 = mysql_query($select_from_comments) or die (mysql_error());
					$row_nest3 = mysql_fetch_array($nest_query3);
					$postid = $row_nest3["postid"];
					$commentid = $comment_or_post_id;
				}
				// get groupid
				$select_from_has_posts = "select * from has_posts where postid='$postid'";
				$nest_query4 = mysql_query($select_from_has_posts) or die (mysql_error());
				$row_nest4 = mysql_fetch_array($nest_query4);
				$groupid = $row_nest4["groupid"];
			
				//can have $sender_userid too from post or comments
			
					
			
				$url ="commentForm.php?groupName=".$groupid."&postid=".$postid."&notif_id=".$notif_id;
				
				echo '<li>';
				$_seen = $row["seen_unseen"]; // 0 is for unseen
				
				
				if (($_seen==0) && ($comment_or_post==0))
				{
					echo '<a href='.$url.' class="text-info" style="text-decoration:none;">A post was added in ' .$groupid.'  group </a>' ;
				}
				else if (($_seen==0) && ($comment_or_post==1))
				{
					echo '<a href='.$url.' class="text-info" style="text-decoration:none;">A comment was added on the post which you were following in ' .$groupid.'</a>' ;
				} 
				else if (($_seen==1) && ($comment_or_post==0))
				{
					echo '<a href='.$url.' class="muted" style="text-decoration:none;">A post was added in ' .$groupid.'</a>' ;
				} 
				else 
				{
					echo ' <a href='.$url.' class="muted" style="text-decoration:none;">A comment was added on the post which you were following in ' .$groupid.'</a>' ;
				} 
				echo '</li><br>';
			}
			else// for message/conv. $url="start_conv.php?convid=".$convid."&notif_id=".$notif_id; add notifid in start_conv for $seen
			{
			//1 get the type i.e. message or post from notification table done
			//2 get convid or msgid from msg_notif (check type there msg or conv). if msg get convid from has_msgs using .
			//3 use members to get convid 
			// but all i need is convid
			
			$select_from_conv_notif="select * from msg_notif where notif_id='$notif_id'";
			$nest_query2 = mysql_query($select_from_conv_notif) or die (mysql_error());
			$row_nest2 = mysql_fetch_array($nest_query2);
			$msg_or_conv =$row_nest2["notif_type"]; 
			$msg_or_conv_id = $row_nest2["messageid"];
			
			if( $msg_or_conv== 0)//conv not msg
			{
				$convid = $msg_or_conv_id;
			
			}
			else //msg
			{
				$select_from_has_msgs="select * from has_msgs where messageid='$msg_or_conv_id'";
				$nest_query3 = mysql_query($select_from_has_msgs) or die (mysql_error());
				$row_nest3 = mysql_fetch_array($nest_query3);
				$convid = $row_nest3["convid"];
				$msgid = $msg_or_conv_id;
			}
			
			//get sender
			$select_from_conv = "select * from conversation where convid='$convid'";
			$nest_query4 = mysql_query($select_from_conv) or die (mysql_error());
			$row_nest4 = mysql_fetch_array($nest_query4);
			$sender = $row_nest4["sender_userid"];
			
			$url="start_conv.php?convid=".$convid."&notif_id=".$notif_id;
				
			echo '<li>';
			$_seen = $row["seen_unseen"]; // 0 is for unseen
			
			if (($_seen==0) && ($msg_or_conv==0))
			{
				echo '<a href='.$url.' class="text-info" style="text-decoration:none;">You were added in a conversation by ' .$sender.'  </a>' ;
			}
			else if (($_seen==0) && ($msg_or_conv==1))
			{
				echo '<a href='.$url.' class="text-info" style="text-decoration:none;">A message was added in a conversation you were following. </a>' ;
			} 
			else if (($_seen==1) && ($msg_or_conv==0))
			{
				echo '<a href='.$url.' class="muted" style="text-decoration:none;">You were added in a conversation by ' .$sender.'</a>' ;
			} 
			else 
			{
				echo ' <a href='.$url.' class="muted" style="text-decoration:none;">A message was added in a conversation you were following. </a>' ;
			} 
			echo '</li><br>';
			
			}
		}
		echo '</ul>';
	}
?>
</div>
</body>
<!--	
<a href="#your-page-element">Jump to ID</a>

<div id="your-page-element">
    will jump here
</div> -->
