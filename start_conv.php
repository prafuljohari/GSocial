<!DOCTYPE html>
 <head>
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <TITLE>Conversation</TITLE>
  <?php
  session_start();
  include ("header.html");
  include("db_connect.php");
  if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
  ?>
  <link href="css/bootstrap-tagmanager.css" rel="stylesheet">
  <script type="text/javascript" src="js/bootstrap-tagmanager.js"></script>
  <script type="text/javascript">
  $(function () {
    $(".tagManager").tagsManager({
     preventSubmitOnEnter: true,
     typeahead: true,
     typeaheadAjaxSource: null,
     typeaheadSource: function(query, process) 
		{
            $.post('searchusers.php', { q: query, limit: 8 }, function(data) 
			{
                process(JSON.parse(data));
            });
        },
     delimeters: [13, 44, 188, 9],
     backspace: [8],
     blinkBGColor_1: '#FFFF9C',
     blinkBGColor_2: '#CDE69C',
     hiddenTagListName: 'content'
  });
});
</script>
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
	</head>
  <body>
		<?php
			include ("navbar.html");
			
			$currentUser = $_SESSION['username'];
			if (isset($_GET['convid']))
			{
				$currentConv = $_GET['convid'];
				$_SESSION['currentConv'] = $currentConv;
				if (isset ($_GET["notif_id"]))
					{
						$currentNotif = $_GET["notif_id"];
						$_SESSION['currentNotif'] = $currentNotif;
						$sql = "UPDATE user_notif
								SET seen_unseen = 1
								WHERE userid='$currentUser' AND notif_id='$currentNotif'";
						mysql_query($sql) or die (mysql_error());
					}
			}
			else
			{
				if (isset($_POST['submit']))
				{
					if ($_POST['content'] == " " || $_POST['content'] == "")
						header("Location: conversations.php");
					$currentMembers = explode(",",$_POST['content']);
					$ins = mysql_query("INSERT INTO conversation (sender_userid) VALUES ('$currentUser')");
					$currentConv = mysql_insert_id();
					
					$_SESSION['currentConv'] = $currentConv;
					$ins = mysql_query("INSERT INTO members (convid, userid) VALUES ('$currentConv', '$currentUser')");
					
					for($i = 0; $i < count($currentMembers); $i++)
					{
						// echo $currentMembers[$i]."<br>";
						if ($currentMembers[$i] == $currentUser)
							continue;
						$ins = mysql_query("INSERT INTO members (convid, userid) VALUES ('$currentConv', '$currentMembers[$i]')");
						
					}
					// add trigger like action for $currentMembers for $currentConv...done
					// '... added you to a conversation' has to be added in notif.php
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
					
					for($i = 0; $i < count($currentMembers); $i++) 
					{
						$userid = $currentMembers[$i];
						if ($userid == $currentUser)
							continue;
						//$groupid = $row["groupid"];
						//echo $userid;
						
						$query_insert_userNotif="insert into $table_user_notif values ('$notifid', '$unseen', '$userid')";
						mysql_query($query_insert_userNotif) or die(mysql_error());
					}
					
					//end trigger
				}
				else
				{
					$currentConv = $_SESSION['currentConv'];	
				}
			}
			
		?>
		<div class = "container span4">
		<br>
				  <ul class="nav nav-list">
                  <center><li class="nav-header">Members:</li></center>
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
		<h2 class="text-center"><?php echo $currentConv; ?></h2></div><div class="well">
		<div id="comment"></div>
		
		
		</div>
		<form id="form" action="displayMessage.php" method="post">
						<textarea name="content" id="content" cols="30" rows="3" class="span12"></textarea> <br />
		<button class="submit" id="submit" name="submit" value="Send message">Send Message</button>
		</form>
		<br><br>
		
		<blockquote>To add members, start typing a name, select member and press comma key to tag the person</blockquote>
		<div>
			<form class="form-inline" id="form" action="add_to_conv.php" method="post">
			<input type="text" data-original-title="" id= "tagManager" class="input-medium tagManager" style="width:9em;" placeholder="Add member" name="tagsfun" data-provide="typeahead" data-items="6" autocomplete="off"><ul class="typeahead dropdown-menu" style="top: 1662px; left: 460.5px; display: none;"></ul><input type="hidden" value=" <?php echo $currentConv?>" name="conv">
			<button type="submit" name="submit" value="start_conv">Add members</button>
			</form>
		</div>
		</div>
	</body>

