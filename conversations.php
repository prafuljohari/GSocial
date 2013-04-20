<!DOCTYPE html>
<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<?php
session_start();
include ("header.html");
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
?>
<link href="css/bootstrap-tagmanager.css" rel="stylesheet">
<script type="text/javascript" src="js/bootstrap-tagmanager.js"></script>
</head>
<body>
<?php 
$selected="conversation";
$TITLE = "conversation";
include("db_connect.php");
$currentUser = $_SESSION['username'];
include ("navbar.html");
?>
<div class="container">
<div class="hero-unit">

<legend>Conversations</legend>
<?php
$rel_name='members';
$tbl_name='conversation';

$sql="SELECT B.convid, B.sender_userid from $rel_name AS A JOIN $tbl_name AS B ON A.convid = B.convid WHERE A.userid = '$currentUser' ORDER BY B.convid DESC";
$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());
echo '</div><div class="well">
<table id="groupsDescTable" class = "table table-hover">
	<thead>
		<tr>
			<br>
			<th>Conversation (last message sent)</th>
			<th>Started by</th>
		</tr>
	</thead>
	<tbody>	';
	while($rows=mysql_fetch_array($result)){
	$id = $rows['convid'];
	$que = "SELECT C.messageid from has_msgs C where C.convid = '$id'";
	$resul = mysql_query($que) or die(mysql_error());
	if (mysql_num_rows($resul) > 0){
	$query1 = "SELECT MAX(C.messageid) from has_msgs C where C.convid = '$id' ";
	$res= mysql_query($query1) or die('Error, query failed : '.mysql_error());
	$last_msgid = mysql_result($res , 0);
	$query2 = "SELECT file_pointer from messages where messageid = '$last_msgid' ";
	$res1 =  mysql_query($query2) or die('Error, query failed : '.mysql_error());
	$last_msgfull = mysql_result( $res1, 0);	
	$last_msg = substr ($last_msgfull, 0 , 20);
	if( strlen($last_msgfull) > 20)
		$dot = ".....";
	else
		$dot = " ";
	
	$query3 = "SELECT sender_userid from messages where messageid = '$last_msgid' ";
	$res2 =  mysql_query($query3) or die('Error, query failed : '.mysql_error());
	$last_sender = mysql_result( $res2, 0);
	
	$sender = $rows['sender_userid'];
	$query4 = "SELECT name from profile where userid = '$sender'";
	$res3 =  mysql_query($query4) or die('Error, query failed : '.mysql_error());
	$fname = mysql_result($res3,0);
	$fname = explode(" ", $fname);
	$fname = $fname[0];
	
	$query_name_lsender = "SELECT name from profile where userid = '$sender'";
	$result_name_lsender = mysql_query($query_name_lsender) or die('Error, query failed : '.mysql_error());
	$fname_lsender = mysql_result($result_name_lsender,0);
	$fname_lsender = explode(" ", $fname_lsender);
	$fname_lsender = $fname_lsender[0];
	
echo '
	<tr>
	<td><a href = "start_conv.php?convid='.$rows['convid'].'">'.$fname_lsender.": ".$last_msg.$dot."    ".'</a></td>
	<td><a href = "view_users.php?user='.$rows['sender_userid'].'">'. $fname. '</td>
	</tr>';
	}
	}
echo '</tbody></table>';?>
</div>


<div>
	<form class="form-inline" id="form" action="start_conv.php" method="post">
		<input type="text" data-original-title="" id= "tagManager" class="tagManager" placeholder="Start conversing with.." name="tagsfun" data-provide="typeahead" data-items="6" autocomplete="off"><ul class="typeahead dropdown-menu" style="top: 1662px; left: 460.5px; display: none;"></ul><input type="hidden" value="" name="hidden-tagsfun">
		<button type="submit" name="submit" value="start_conv">Start conversation</button>
		<!--<textarea name="content" id="content" cols="30" rows="3" class="span12"></textarea> <br />
		<input type="submit" id="submit" name="submit" value="Start Conversation"/>-->
	</form>
</div>
</div>

<?php

?>
</body>
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
     delimeters: [44, 188, 13],
     backspace: [8],
     blinkBGColor_1: '#FFFF9C',
     blinkBGColor_2: '#CDE69C',
     hiddenTagListName: 'content'
  });
});
</script>