<!DOCTYPE html>
<HTML>
<HEAD>
<?php 
session_start();
include("header.html"); 
include("db_connect.php");
include ("navbar.html");
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");

$currentUser = $_SESSION['username'];
$currentGroup = $_GET['groupName'];
?>
</HEAD>
<BODY>
<?php
$rel_name = 'is_in';
$count_users = mysql_query("SELECT COUNT(*) from is_in A where groupid = '$currentGroup'") or die(mysql_error());
$memberRow = mysql_fetch_array($count_users)

?>
	<div class="container">
	<div class = "hero-unit text-center">
		<h1>Group Members</h1>
	</div>
		<!--<div class="pagination text-center">
			<ul>
				<li><a href="#"><<</a></li>
				<li><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">>></a></li>
			</ul>
		</div>-->
		<ul class="unstyled">
<?php
$rel_name = 'is_in';
$see_users = mysql_query("SELECT A.userid, B.name from is_in A, profile B where groupid = '$currentGroup' AND B.userid = A.userid ");

while ($memberRow = mysql_fetch_array($see_users))
				{
					echo '<li>';
					echo '<a href="view_users.php?user=' . $memberRow['userid'] . '">' . $memberRow['name'] . '</a></li><br> ';
				}
?>
</ul>
</div>
</BODY>