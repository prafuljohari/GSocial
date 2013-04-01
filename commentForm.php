<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />	
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <TITLE> Comment Form with jQuery & PHP</TITLE>
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
  <body>
		<?php
			session_start();
			
			if (isset($_GET['groupName']))
			{
				$currentGroup = $_GET['groupName'];
				$_SESSION['currentGroup'] = $currentGroup;
			}
			else
			{
				$currentGroup = $_SESSION['currentGroup'];
			}
			
		?>
		<div class="container">
		<div class = "hero-unit">
		<h1><center><?php echo $currentGroup; ?></center></h1>
        <br>
		<div id="comment"></div>
		
		<!--
		<table border="0" width="600px" cellpadding="0" cellspacing="0" align="center" class="table">
			<tr>
				<th colspan="2">
					<h2><?php echo $currentGroup; ?></h2>
				</th>
			</tr>
			<tr valign="top">
				<td width="50%">
					<h2>Add New Post :</h2>
					<form id="form" action="displayPost.php" method="post">
						<textarea name="content" id="content" cols="30" rows="3"></textarea> <br />
						<input type="submit" id="submit" name="submit" value="Add Post" />
					</form>
					
					<div class="msg" id="msg"></div>
				</td>
				<td width="50%">
					<h2>Current Posts:</h2>
					<div id="comment"></div>
				</td>
			</tr>
		</table>-->	
		
		</div>
		<form id="form" action="displayPost.php" method="post">
						<textarea name="content" id="content" cols="30" rows="3" class="span12"></textarea> <br />
						<input type="submit" id="submit" name="submit" value="Add Post"/>
		</form>
		</div>
	</body>
 </HEAD>

 <BODY>
 <?php
	include ("navbar.html");
?>
 </BODY>
</HTML>