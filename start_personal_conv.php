<!DOCTYPE html>
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />	
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <TITLE> Conversation</TITLE>
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
				   url: "displayMessage.php",
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
				  url: "displayMessage.php",
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
			include("db_connect.php");
			include ("navbar.html");
			
			$currentUser = $_SESSION['username'];
			$viewuser = $_SESSION['viewuser'];
			if (isset($_GET['convid']))
			{
				$currentConv = $_GET['convid'];
				$_SESSION['currentConv'] = $currentConv;
			}
			else
			{
					$ins = mysql_query("INSERT INTO conversation (sender_userid) VALUES ('$currentUser')");
					$currentConv = mysql_insert_id();
					
					$_SESSION['currentConv'] = $currentConv;
					$ins = mysql_query("INSERT INTO members (convid, userid) VALUES ('$currentConv', '$currentUser')");
					
					
						$ins = mysql_query("INSERT INTO members (convid, userid) VALUES ('$currentConv', '$viewuser')");
						
				
					//$currentConv = $_SESSION['currentConv'];	
			
			}
			
		?>
		<div class = "container span4">
		<br>
				  <ul class="nav nav-list">
                  <center><li class="nav-header">Conversation Members:</li></center>
                  <br>
                  <?php
				  	$rel_name='members';
					$tbl_name='groups';

					$sql="SELECT A.userid, B.name from $rel_name AS A, profile as B WHERE A.convid = '$currentConv' AND A.userid = B.userid LIMIT 10";
					$result=mysql_query($sql) or die('Error-> query failed : '.mysql_error());
					while($rows=mysql_fetch_array($result))
					{
					echo '
						<li>
						<a target="_blank" class="text-center" href = "view_users.php?user='.$rows['userid'].'">'.$rows['name'].'</a></li>';
					}
				  ?>
                </ul>
		</div>
		<div class="container">
		<div class = "hero-unit">
		<h1><center><?php echo $currentConv; ?></center></h1>
		<div id="comment"></div>
		
		
		</div>
		<form id="form" action="displayMessage.php" method="post">
						<textarea name="content" id="content" cols="30" rows="3" class="span12"></textarea> <br />
		<button class="submit" id="submit" name="submit" value="Send message">Send Message</button>
		</form>
		</div>
	</body>
 </HEAD>

 <BODY>

 </BODY>
</HTML>