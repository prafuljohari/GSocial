<head>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
</head>
<body>
<?php 
$selected="groups";
$TITLE = "Groups";
include("db_connect.php");
session_start();
$currentUser = $_SESSION['username'];
?>

<div class="hero-unit">
<div class="container">
<legend>List of active groups</legend> <br><br>
<?php
$rel_name='is_in';
$tbl_name='groups';

$sql="SELECT B.groupid, B.description from $rel_name AS A JOIN $tbl_name AS B ON A.groupid = B.groupid WHERE A.userid = '$currentUser'";
$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());
echo '
<table id="groupsDescTable" class = "table">
	<tr>
		<br>
		
			<th>Group ID</th>
		
		
			<th>Description</th>
		
		</tr>';
	while($rows=mysql_fetch_array($result)){
echo '
	<tr>
	<td><a href = "commentForm.php?groupName='.$rows['groupid'].'">'.$rows['groupid'].'</a></td>
	<td>'.$rows['description'].'</td>
	</tr>';
	}
echo '</table>';
include ("navbar.html");

?>
</div>
</div>
</body>