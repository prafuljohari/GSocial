<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<?php 
$selected="groupPosts";
$TITLE = "Posts";
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
$currentGroup = $_SESSION['currentGroup'];
?>

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
	
	//Redirect the user back to the index page
	header("Location:commentForm.php");
	}
	/*Doesn't matter if the form has been posted or not, show the latest posts*/
	
	//Find all the notes in the database and order them in a descending order (latest post first).
	$rel_name = 'has_posts';
	$tbl_name = 'post';

	$sql = "SELECT B.postid AS postid, B.sender_userid AS sender_userid, B.file_pointer AS file_pointer 
	FROM $rel_name AS A JOIN $tbl_name AS B ON A.postid = B.postid 
	WHERE A.groupid = '$currentGroup' 
	ORDER BY postid DESC";
	
	$find = mysql_query($sql);
	
	//Setup the un-ordered list
	echo '<table class="table">';
	
	//Continue looping through all of them
	while($row = mysql_fetch_array($find)){
	
	//For each one, echo a list item giving a link to the delete page with it's id.
	echo '<tr><td valign="middle" width="90%">' . $row['file_pointer'] . ' </td>
		<td valign="middle" width="10%"><form id="form" action="delete.php?id=' . $row['postid'] . '" method="post">
		<input class="todo_id" name="todo_id" type="hidden" value="' . $row['postid'] . '" />
		<input class="todo_content" name="todo_content" type="hidden" value="'  . $row['file_pointer'] . '" />
		<input type="image" src="images/delete.png" class="delete" name="delete" style="width: 20px; height: 20px;"  />
		
		</form>
		</td></tr>';
	}
	
	//End the un-ordered list
	echo '</table>';
?>
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

</script>