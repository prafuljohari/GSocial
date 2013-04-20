<!DOCTYPE html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
include ("header.html");
?>
</head>
<body>
<?php
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$selected="conversation";
$TITLE = "Conversation";
include("db_connect.php");
$currentUser = $_SESSION['username'];
$currentConv = $_SESSION['currentConv'];

/*
foreach($_POST as $key=>$value)
{
  fwrite($file, $value, strlen($value));
}
fclose($file);*/
//Was the form submitted?
if(isset($_POST['submit']))
{
	//Map the content that was sent by the form a variable. Not necessary but it keeps things tidy.
	$content = $_POST['content'];
	
	//Insert the content into database
	// Note that the postid field is auto-increment
	$ins = mysql_query("INSERT INTO messages (sender_userid, file_pointer) VALUES ('$currentUser', '$content')") or die(mysql_error());
	$msgid = mysql_insert_id();
	$ins = mysql_query("INSERT INTO has_msgs (messageid, convid) VALUES ('$msgid', '$currentConv')") or die(mysql_error());
	
	
	
	
	
	//trigger like action
	
	$table_notif="notification";
	$notif_type="1"; // type 0 is for posts/comments as opposed to messages
	$query_insert_notif="insert into $table_notif (type) values ('$notif_type')";
	mysql_query($query_insert_notif) or die (mysql_error());
	$notifid = mysql_insert_id();
	
	$conv_type = 1; // conv or msg type. 0 for it to be conv
	$table_conv_notif= "msg_notif";
	$query_insert_conv_notif = "insert into $table_conv_notif values ('$conv_type', '$msgid', '$notifid')";
	mysql_query($query_insert_conv_notif) or die (mysql_error());
	
	$table_members="members";
	$query_trigger_select="select *  from $table_members where convid='$currentConv'";
	$result = mysql_query($query_trigger_select) or die (mysql_error());;
	if($result)echo "selected.<br>";
	
	$unseen=0;// 0 is for unseen
	$table_user_notif="user_notif";
	
	if ($result) 
	{
		while($row = mysql_fetch_array($result)) 
		{
			$userid=$row["userid"];
			if ( $userid != $currentUser)
				{
					$query_insert_userNotif="insert into $table_user_notif values ('$notifid', '$unseen', '$userid')";
					mysql_query($query_insert_userNotif) or die(mysql_error());
				}	
				
		}
	}
		
	//end trigger
	
	
	
	
	
	//Redirect the user back to the index page
	//header("Location:start_conv.php");
}
	/*Doesn't matter if the form has been posted or not, show the latest posts*/

	//Find all the notes in the database and order them in a descending order (latest post first).
	$rel_name = 'has_msgs';
	$tbl_name = 'messages';

	$sql = "SELECT B.messageid AS messageid, B.sender_userid AS sender_userid, B.file_pointer AS file_pointer 
	FROM $rel_name AS A JOIN $tbl_name AS B ON A.messageid = B.messageid 
	WHERE A.convid = '$currentConv'";
	
	$find = mysql_query($sql);
	
	//Setup the un-ordered list
	echo '<table border="0" cellpadding="5" cellspacing="0" class="table" width="100%"><tbody>';
	if ($find != false)
	//Continue looping through all of them
	while($row = mysql_fetch_array($find))
	{
	$temp = $row['sender_userid'];
	$new_sq = "SELECT name from profile where userid = '$temp'";
	$name_result = mysql_query($new_sq) or die(mysql_error());
	$name_result = mysql_result($name_result,0);
	
	//For each one, echo a list item giving a link to the delete page with it.
	echo '<tr><td valign="middle" width="90%"><a class = "text-info" href="view_users.php?user=' . $row['sender_userid'] .'">' . $name_result. '</a>: ' . $row['file_pointer'] . ' </td>
		<td valign="middle" width="10%"><form id="form" action="delete.php?id=' . $row['messageid'] . '" method="post">
		<input class="todo_id" name="todo_id" type="hidden" value="' . $row['messageid'] . '" />
		<input class="todo_content" name="todo_content" type="hidden" value="'  . $row['file_pointer'] . '" />
		<button class="delete close" name="delete" style="width: 20px; height: 20px; float:right">&times</button>
		
		</form>
		</td></tr>';
	}
	
	//End the un-ordered list
	echo '</tbody></table>';
?>
</body>
<script type="text/javascript">
	$(".delete").click(function(){
	
		//Retrieve the contents of the textarea (the content)
		var todo_id = $(this).parent().find(".todo_id").val();
		var todo_content = $(this).parent().find(".todo_content").val();
		
		//Build the URL that we will send
		var url = 'submit=1&id=' + todo_id;
		
		//Use jQuery's ajax function to send it
		 $.ajax({
		   type: "POST",
		   url: "deleteMessage.php",
		   data: url,
		   success: function(){
		
		//If successful , notify the user that it was added
		   $("#msg").html("<p class='remove'><b>Deleted Message :</b><i>" + todo_content + "</i></p>");
		   $("#content").val('');
		   comment();
		   }
		 });
		
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
	
	});

</script>