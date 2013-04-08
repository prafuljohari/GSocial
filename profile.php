<!DOCTYPE html>
<html>
<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
session_start();
$myusername = $_SESSION["username"];
$sql="SELECT * FROM profile WHERE userid='$myusername' ";
$result=mysql_query($sql) or die (mysql_error());
$_SESSION['view'] = 0;
include ("navbar.html");	
while($row = mysql_fetch_array($result))
{
	//Check whether we need more entries or not, like DOB etc.
	$_SESSION['my_name'] = $row['name']; //Modify later: Only first name to be shown
	$first_name = explode(" ", $_SESSION['my_name']);
	$_SESSION['my_fname'] = $first_name[0];
	$_SESSION['my_desig'] = $row['designation'];
	$_SESSION['my_info'] = $row['about_me'];
	$_SESSION['my_dept'] = $row['department'];
	$_SESSION['my_hostel'] = $row['hostel'];
	$_SESSION['img-user'] = 1;				//Set to 1 if profile pic set. Check in database basically.
}
?>
  <head>
    <title>GSocial+</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
	include ("header.html");
	?>
  </head>
  <body>
  <br><br>
  <div class="container span5">
				<br>
				  <ul class="nav nav-list">
                  <center><li class="nav-header">User Groups</li></center>
                  <br>
                  <?php
				  	$rel_name='is_in';
					$tbl_name='groups';

					$sql="SELECT B.groupid, B.description from $rel_name AS A JOIN $tbl_name AS B ON A.groupid = B.groupid WHERE A.userid = '$myusername' LIMIT 10";
					$result=mysql_query($sql) or die('Error, query failed : '.mysql_error());
					while($rows=mysql_fetch_array($result)){
					echo '
						<li>
						<a target="_blank" class="text-center" href = "commentForm.php?groupName='.$rows['groupid'].'">'.$rows['groupid'].'</a></li>';
						}
				  ?>
                </ul>
  </div>
  <div class="offset1">
  <div class="container span10">
		<div class="row">
			<div class="span5 hero-unit"> 
				<h1 class="text-right"><?php echo $_SESSION['my_name']?></center></h1>
				<h4 class="text-right"><?php echo $_SESSION['my_desig']?></h4>
				<h4 class="text-right">Dept. of <?php echo $_SESSION['my_dept']?></h4>
			</div>

			<div class="span2">
				<br>
				<div class="img-polaroid" style="width: 300px; height: 200px;">
					<img src="images/img-<?php if (isset($_SESSION['img-user'])) echo $myusername; else echo "null"; ?>.jpg">
				</div>
			</div>
		</div>
		<br>
		<div class="span5 offset1">                    
			  <li class="nav-header text-center">User Details</li>
			  <br>
				<dl class="dl-horizontal">
				<dt>Hostel</dt>
				<dd class="text-center"><?php echo $_SESSION['my_hostel']?></dd>
				<dt>Batch</dt>
				<dd class="text-center">2014</dd>
				<dt>Webmail id</dt>
				<dd class="text-center">stud</dd>
				</dl>
		   <!--   <table class="table table-bordered table-striped">
				<tbody>
					<tr>
					  <td class="text-info"><center>Hostel</center></td>
					  <td><b><center><?php echo $_SESSION['my_hostel']?></center></b></td>
					</tr>
					<tr>
					  <td class="text-info"><center>Batch</center></td>
					  <td><b><center>2014</center></b></td>
					</tr>
					<tr>
					  <td class="text-info"><center>Webmail id</center></td>
					  <td><b><center>stud</center></b></td>
					</tr>
			  </tbody>
			</table>-->
		</div>
		<div class="span2 offset1">
			<ul class="nav nav-list">
			  <center><li class="nav-header">User Actions</li></center>
			  <br>
			  <!--<li><a href="#">Message</a></li>
			  <li><a href="#">Poke</a></li>
			  <li><a href="#">Kill</a></li>-->
			  <li><a class="text-center" href="editProfile.php">Edit Profile</a></li>
			  <li><a class="text-center" href="logout.php">Logout</a></li>
			</ul>
		</div>
    </div>
	</div>
  </body>
</html>
<script type="text/javascript">
$(document).ready(function() 
{
    $("#searchfield").typeahead(
	{
        source: function(query, process) 
		{
            $.post('searchusers.php', { q: query, limit: 8 }, function(data) 
			{
                process(JSON.parse(data));
            });
        }
    });
});
</script>