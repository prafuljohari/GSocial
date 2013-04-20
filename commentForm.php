<!DOCTYPE html>
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />	
  <?php
  include("header.html");
  ?>
  <TITLE>Group</TITLE>
  <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			//When the button with an id of submit is clicked (the submit button)
			$("#submit").click(function(){
			
			//Retrieve the contents of the textarea (the content)
			var formvalue = $("#content").val();
			
			//Build the URL that we will send
			var url = 'submit=1&content=' + escape(formvalue);
			
			//Use jQuery's ajax function to send it
			 $.ajax({
			   type: "POST",
			   url: "displayPost.php",
			   data: url,
			   success: function(){
			
			//If successful , notify the user that it was added
			   $("#msg").html("<p class='add'><b>Just Added Comment : </b><i>" + formvalue + "</i></p>");
			   $("#content").val('');
			   comment();
			   }
			 });
			
			//We return false so when the button is clicked, it doesn't follow the action
			return false;
			
			});
			
			comment();
		});
		
		

		function comment(){
			$.ajax({
			  url: "displayPost.php",
			  cache: false,
			  success: function(html){
				$("#comment").html(html);
			  }
			});
		}

	</script>
</HEAD>
<BODY>
		<?php
			session_start();
			if (isset($_SESSION["username"]))
			$myusername = $_SESSION["username"];
			else
			header("Location: index.php");
			include("db_connect.php"); 
			include("navbar.html");
			$username = $_SESSION["username"];
			
			if (isset($_GET['groupName']))
			{
				$currentGroup = $_GET['groupName'];
				$_SESSION['currentGroup'] = $currentGroup;
				$sql_check = "SELECT * from is_in where userid = '$username' AND groupid = '$currentGroup'";
				$result_check = mysql_query($sql_check) or die(mysql_error());
				if (mysql_num_rows($result_check) == 0)
				{
					header("Location: groups.php");
				}
				if (isset ($_GET["postid"]))
				{
					$currentPost = $_GET['postid'];
					$_SESSION['currentPost'] = $currentPost;
					
					if (isset ($_GET["notif_id"]))
					{
						$currentNotif = $_GET["notif_id"];
						$_SESSION['currentNotif'] = $currentNotif;
						$sql = "UPDATE user_notif
								SET seen_unseen = 1
								WHERE userid='$username' AND notif_id='$currentNotif'";
						mysql_query($sql) or die (mysql_error());
					}
				}
			}
			else
			{
				$currentGroup = $_SESSION['currentGroup'];
				$currentPost = $_SESSION['currentPost'];
				$currentNotif = $_SESSION['currentNotif'];
			}
			
		?>
		<div class="container span4">
				<br>
				  <ul class="nav nav-list">
                  <center><li class="nav-header">Group Actions</li></center>
                  <br>
                  <li><a class= "text-center" href="view_group_mem.php?groupName=<?php echo $currentGroup?>">View Members</a></li>
				  <li><a class= "text-center" href="leave_group.php?groupName=<?php echo $currentGroup?>">Leave group</a></li>
                </ul>
  </div>
		<div class="container">
			<div class = "hero-unit">
				<legend><h2 class="text-center"><?php echo $currentGroup; ?></h2></legend>
			</div>
			<form id="form" action="displayPost.php" method="post" class="well">
				<textarea name="content" id="content" cols="30" rows="3" class="input-block-level" style="resize:none"></textarea>
				<input type="submit" id="submit" name="submit" value="Add Post"/>
			</form>
			<div id="comment"></div>
		</div>
</BODY>
<?php
	// include ("navbar.html");
?>
</HTML>