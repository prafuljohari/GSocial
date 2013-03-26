<?php 
$selected="groups";
$TITLE = "Groups";
include("header.php"); 
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
?>

List of Active Groups : <br>
<?php
$rel_name='is_in';
$tbl_name='groups';

$sql="SELECT B.groupid, B.description from $rel_name AS A JOIN $tbl_name AS B ON A.groupid = B.groupid WHERE A.userid = '$currentUser'";
$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());
echo '
<table id="groupsDescTable">
	<tr>
	<th>Group ID</th>
	<th>Description</th>
	</tr>';
	while($rows=mysql_fetch_array($result)){
echo '
	<tr>
	<td>'.$rows['groupid'].'</td>
	<td>'.$rows['description'].'</td>
	</tr>';
	}
echo '</table>';

?>