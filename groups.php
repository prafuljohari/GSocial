<!DOCTYPE html>
<head>
<?php
include("header.html");
?>
</head>
<body>
<?php 
$selected="groups";
$TITLE = "Groups";
include("db_connect.php");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$currentUser = $_SESSION['username'];
include ("navbar.html");
?>


<div class="container">
<div class="hero-unit">
<legend>List of groups for current user</legend></div>
<?php
$rel_name='is_in';
$tbl_name='groups';

$sql="SELECT B.groupid, B.description from $rel_name AS A JOIN $tbl_name AS B ON A.groupid = B.groupid WHERE A.userid = '$currentUser'";
$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());
echo '<div class="well">
<table id="groupsDescTable" class = "table table-hover">
	<thead>
	<tr>
		<br>
		
			<th><center>Group ID</center></th>
		
		
			<th><center>Description</center></th>
		
		</tr></thead><tbody>';
	while($rows=mysql_fetch_array($result)){
echo '
	<tr>
	<td><a href = "commentForm.php?groupName='.$rows['groupid'].'"><center>'.$rows['groupid'].'</center></a></td>
	<td><center>'.$rows['description'].'<center></td>
	</tr>';
	}
echo '</tbody></table></div>';
?>
</div>
</body>