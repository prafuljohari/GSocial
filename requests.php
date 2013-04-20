<!DOCTYPE html>
<html>
<head>
<!--<a href="#your-page-element">Jump to ID</a> <br>
-->
<?php
include("db_connect.php"); 
include("header.html");
session_start();
$_user = $_SESSION["username"];
?>

</head>

<?php

$sql="SELECT A.requestid AS requestid, A.groupid AS groupid, A.userid AS userid, C.name AS username, B.status AS status FROM request_rel A
JOIN request B ON A.requestid = B.requestid AND B.status = 0
JOIN profile C ON A.userid = C.userid
JOIN groups D ON A.groupid = D.groupid
JOIN admin E ON A.groupid = E.groupid AND E.userid = '$_user'";

echo '<div id="rejectMessage" style="display: none; background: red; text-align: center; height: 20px;">';
echo 'The request has been rejected.';
echo '</div>';

echo '<div id="approveMessage" style="display: none; background: green; text-align: center; height: 20px;">';
echo 'The request has been approved.';
echo '</div>';

echo '<p>';
$result=mysql_query($sql) or die (mysql_error());
if ($result) 
{
	echo '<ul class="unstyled">';
	while($row = mysql_fetch_array($result)) 
	{
					
		$groupid = $row['groupid'];
		$username = $row['username'];
		$requestid = $row['requestid'];
		echo '<li>';
		$status = $row['status'];
		if ($status==0)
		{
			echo '<a href="view_users.php?user=' . $row['userid'] . '">' . $username . '</a> has requested to join group ' . $groupid;
			echo '<button class="rejectRequest close" name="rejectRequest" style="width: 20px; height: 20px; float:right">&times</button>';
			echo '<button class="approveRequest close" name="approveRequest" style="width: 20px; height: 20px; float:right"><i class="icon-ok"></i></button>';
			echo '<input class="request_id" name="request_id" type="hidden" value="' . $requestid . '" />';
			echo '<input class="request_userid" name="request_userid" type="hidden" value="' . $row['userid'] . '" />';
			echo '<input class="request_groupid" name="request_groupid" type="hidden" value="' . $groupid . '" />';
		}
		else 
		{
			echo $username . ' has been added to group ' . $groupid;
		} 
		echo '</li><br>';
	}
	echo '</ul>';
}
?>

<script type="text/javascript">
$(function(){
	$(".rejectRequest").click(function(){
		
		// alert("Request rejected!");
		
		//Retrieve the contents of the textarea (the content)
		var request_id = $(this).parent().find(".request_id").attr('value');
		// var request_userid = $(this).parent().find(".request_userid").attr('value');
		// var request_groupid = $(this).parent().find(".request_groupid").attr('value');
		
		// alert(request_id);
		// alert(request_userid);
		// alert(request_groupid);
		
		//Build the URL that we will send
		var url = 'submit=1&id=' + request_id;
		// alert(url);
		
		// $('#rejectMessage').fadeIn().delay(250).fadeOut();		
		
		//Use jQuery's ajax function to send it 
		$.ajax({
		type: "POST",
		url: "rejectRequest.php",
		data: url,
		success: function(){

		//If successful , notify the user that it was added
		displayRequests();
		}
		});
		 
		 
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
	
	});
	
	$(".approveRequest").click(function(){
		
		// alert("Request approved!");
		
		//Retrieve the contents of the textarea (the content)
		var request_id = $(this).parent().find(".request_id").attr('value');
		var request_userid = $(this).parent().find(".request_userid").attr('value');
		var request_groupid = $(this).parent().find(".request_groupid").attr('value');
		
		// alert(request_id);
		// alert(request_userid);
		// alert(request_groupid);
		
		//Build the URL that we will send
		var url = 'submit=1&id=' + request_id + '&user=' + request_userid + '&groupid=' + request_groupid;
		
		// $('#approveMessage').fadeIn().delay(1000).fadeOut();
		
		//Use jQuery's ajax function to send it
		$.ajax({
			type: "POST",
			url: "approveRequest.php",
			data: url,
			success: function(){

			//If successful , notify the user that it was added
			displayRequests();
			}
		});
		
		//We return false so when the button is clicked, it doesn't follow the action
		return false;
	
	});

});

</script>
