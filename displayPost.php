<head>
<?php 
$selected="groupPosts";
$TITLE = "Posts";
include("header.html");
include("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$currentUser = $_SESSION['username'];
$currentGroup = $_SESSION['currentGroup'];
?>
</head>
<?php	
	//Was the form submitted?
	if(isset($_POST['submit'])){
	//Map the content that was sent by the form a variable. Not necessary but it keeps things tidy.
	$content = $_POST['content'];
	
	//Insert the content into database
	
	// Note that the postid field is auto-increment
	$ins = mysql_query("INSERT INTO post (sender_userid, file_pointer) VALUES ('$currentUser', '$content')");
	$postid = mysql_insert_id();
	
	$ins = mysql_query("INSERT INTO has_posts VALUES ('$postid', '$currentGroup')");
	
		//trigger like action
	$table_notif="notification";
	$notif_type="0"; // type 0 is for posts/comments as opposed to messages
	$query_insert_notif="insert into $table_notif (type) values ('$notif_type')";
	mysql_query($query_insert_notif) or die (mysql_error());
	$notifid = mysql_insert_id();
	
	$post_type = 0; // post or comment's type for it to be post
	$table_post_notif= post_notif;
	$query_insert_post_notif = "insert into $table_post_notif values ('$notifid','$postid','$post_type')";
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
			//echo $userid;
			if ($currentUser!=$userid)
			{
			$query_insert_userNotif="insert into $table_user_notif values ('$notifid', '$unseen', '$userid')";
			mysql_query($query_insert_userNotif) or die(mysql_error());
			}
		}

	}
	else
		echo "Not done man!";
	
	//end trigger
	
	//Redirect the user back to the index page
	header("Location:commentForm.php");
	}
	/*Doesn't matter if the form has been posted or not, show the latest posts*/
	
	//Find all the notes in the database and order them in a descending order (latest post first).
	$rel_name = 'has_posts';
	$tbl_name = 'post';

	$sql = "SELECT B.postid AS postid, B.sender_userid AS sender_userid, B.file_pointer AS file_pointer, C.name AS username 
	FROM $rel_name AS A JOIN $tbl_name AS B ON A.postid = B.postid JOIN profile AS C ON B.sender_userid = C.userid
	WHERE A.groupid = '$currentGroup' 
	ORDER BY postid DESC";
	
	$find = mysql_query($sql);
	
	// Displaying the posts
	
	//Setup the un-ordered list
	echo '<table class="table">';
	
	//Continue looping through all of them
	while($row = mysql_fetch_array($find))
	{
		echo '<div class="displayForm well" name="displayForm" id="displayForm">';
		echo '<form class="form" type="hidden" id="form" action="delete.php?id=' . $row['postid'] . '" method="post">';
		//For each one, echo a list item giving a link to the delete page with it's id.
		echo '<blockquote class="postBlock">';
		echo '<a href="view_users.php?user=' . $row['sender_userid'] . '">' . $row['username'] . '</a> ';
		echo $row['file_pointer'];
		echo '<input class="todo_id" name="todo_id" type="hidden" value="' . $row['postid'] . '" />
			<input class="todo_content" name="todo_content" type="hidden" value="'  . $row['file_pointer'] . '" />';
			echo '<button class="toggleComments close" name="toggleComments" style="width: 20px; height: 20px; float:right"><i class="icon-chevron-down"></i></button>';
			
			if ($currentUser == $row['sender_userid'])
			{
				echo '<button class="delete close" name="delete" style="width: 20px; height: 20px; float:right">&times</button>';
			}
			
			echo '</blockquote>';
			
		echo '</form>';
		
		echo '<div class="displayComments" name="displayComments">';
			$currPostId = $row['postid'];
			$findComments = mysql_query("SELECT A.commentid AS commentid, A.file_pointer as file_pointer, A.comment_time AS comment_time, A.sender_userid AS sender_userid, B.name AS sender_username 
			FROM comments A JOIN profile AS B ON A.sender_userid = B.userid
			WHERE postid = '$currPostId'");
			
			echo '<ul class="offset1">';
				while ($commentRow = mysql_fetch_array($findComments))
				{
					echo '<li>';
					echo '<a href="view_users.php?user=' . $commentRow['sender_userid'] . '">' . $commentRow['sender_username'] . '</a> ';
					echo $commentRow['file_pointer'];
					if ($currentUser == $commentRow['sender_userid'])
					{
						echo '<button class="deleteComment close" name="deleteComment" style="width: 20px; height: 20px; float:right">&times</button>
						<input class="comment_id" type="hidden" value="' . $commentRow['commentid'] . '" />';
					}
					echo '</li>';
				}
				
				// Display the box to add a comment
				?>
				<form type="hidden" id="addCommentForm" action="addComment.php" method="post">
					<div name="addCommentDiv">
						<textarea name="commentCont" id="commentCont" cols="30" rows="2" class="input-block-level" style="resize:none"></textarea>
						<button class="addComment" id="addComment" name="addComment" value="Add Comment">Add comment </button>	
						<input class="currPost" name="currPost" type="hidden" value="<?php echo $row['postid']; ?>" />					
					</div>
				</form>
				
			<?php
			echo '</ul>';
		echo '</div>';
		echo '</div>'; // Closing div displayForm
	}
	
	//End the un-ordered list
	echo '</table>';
?>
<script type="text/javascript">
$(function(){
	$(".delete").click(function(){
		
		// alert("Delete clicked!");
		
		//Retrieve the contents of the textarea (the content)
		var todo_id = $(this).parent().find(".todo_id").val();
		var todo_content = $(this).parent().find(".todo_content").val();
		
		//Build the URL that we will send
		var url = 'submit=1&id=' + todo_id;
		
		//Use jQuery's ajax function to send it
		 $.ajax({
		   type: "POST",
		   url: "deletePost.php",
		   data: url,
		   success: function(){
		
		//If successful , notify the user that it was added
		   $("#msg").html("<p class='remove'><b>Deleted Post :</b><i>" + todo_content + "</i></p>");
		   $("#content").val('');
		   comment();
		   }
		 });
		
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
	
	});
	
	$(".deleteComment").click(function(){
		
		// alert("Delete clicked!");
		
		//Retrieve the comment id
		var todo_id = $(this).parent().find(".comment_id").attr('value');
		// alert(todo_id);

		//Build the URL that we will send
		var url = 'submit=1&id=' + todo_id;
		
		
		//Use jQuery's ajax function to send it
		 $.ajax({
		   type: "POST",
		   url: "deleteComment.php",
		   data: url,
		   success: function(){
		
		//If successful , notify the user that it was added
		   $("#content").val('');
		   comment();
		   }
		 });
		
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
	
	});
	
	//When the button with an id of submit is clicked (the submit button)
	$(".addComment").click(function(){
		// alert("Adding comment!");
		// Retrieve the contents of the textarea (the content)
		// var formvalue = $("#commentCont").val();
		
		var formvalue = $(this).parent().parent().find("#commentCont").val();
		var idvalue = $(this).parent().find(".currPost").attr('value');
		
		// alert(idvalue);
		// alert(formvalue);
		
		//Build the URL that we will send
		// var url = 'addComment=1&commentCont=' + escape(formvalue);
		var url = 'submit=1&content=' + escape(formvalue) + '&id=' + escape(idvalue);
		// alert(url);
		
		//Use jQuery's ajax function to send it
		 $.ajax({
		   type: "POST",
		   url: "addComment.php",
		   data: url,
		   success: function(){
		
		//If successful , notify the user that it was added
		   $("#commentCont").val('');
		   comment();
		   }
		 });
		
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
		
	});
	
	$(".toggleComments").click(function() { 
		// var idvalue = $(this).parent().find(".todo_id").attr('value');
		// alert(idvalue);
		
		// var divid = $(this).parent().parent().find(".displayComments").attr('class');
		// alert(divid);
		
		$(this).parent().parent().find(".displayComments").toggle("fast","linear");
	});
});

</script>