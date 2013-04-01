<?php 
$selected="groupPosts";
$TITLE = "Posts";
include("header.php"); 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
$currentGroup = $_GET['groupName'];
?>

<?php
echo 'Current Group : '.$currentGroup.'<br>';
$rel_name = 'has_posts';
$tbl_name = 'post';

$sql="SELECT B.sender_userid, B.file_pointer from $rel_name AS A JOIN $tbl_name AS B ON A.postid = B.postid WHERE A.groupid = '$currentGroup'";
$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());

	while($rows=mysql_fetch_array($result)){
echo '
	Sender : '.$rows['sender_userid'];
echo '
	Post : '.$rows['file_pointer'];
	}
echo '</table>';

?>