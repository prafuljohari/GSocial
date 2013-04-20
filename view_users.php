<!DOCTYPE html>
<html>
<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$viewuser = $_GET['user'];
$_SESSION['viewuser']=$viewuser;
if ($viewuser == $_SESSION['username'])
	header("Location: profile.php");
	
$sql="SELECT * FROM profile WHERE userid='$viewuser' ";

$result=mysql_query($sql) or die (mysql_error());
$_SESSION['view'] = 1;
while($row = mysql_fetch_array($result))
{
	//Check whether we need more entries or not, like DOB etc.
	$_SESSION['view_name'] = $row['name']; //Modify later: Only first name to be shown
	$first_name = explode(" ", $_SESSION['view_name']);
	$_SESSION['view_fname'] = $first_name[0];
	$_SESSION['view_desig'] = $row['designation'];
	$_SESSION['view_info'] = $row['about_me'];
	$_SESSION['view_dept'] = $row['department'];
	$_SESSION['view_hostel'] = $row['hostel'];
}
?>
  <head>
    <title>GSocial+</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <?php
	 include ("header.html");
	?>
  </head>
  <body>
  <?php
  	 include ("navbar.html");
  ?>
  <br>
  <div class="container">
   		<div class="row">    
            <div class="span5 hero-unit"> 
                <!--<br><br>-->
                <h1 class="text-right"><?php echo $_SESSION['view_name']?></center></h1>
                <h4 class="text-right"><?php echo $_SESSION['view_desig']?></center></h4>
                <h4 class="text-right">Dept. of <?php echo $_SESSION['view_dept']?></center></h4>
            </div>

            <div class="span2">
				<br>
				<div class="img-polaroid" style="width: 300px; height: 200px; text-align: center">
					<img style="max-width: 300px; max-height: 200px; text-align:center;" src="images/img-<?php if (file_exists("images/img-".$viewuser.".jpg")) echo $viewuser; else echo "null"; ?>.jpg">
				</div>
			</div>
		</div>
	    <div class="row">
        <div class="span5 offset1">                    
         
	            <ul class="nav nav-list">
                  <center><li class="nav-header">Details</li></center>
					<br>
					<dl class="dl-horizontal">
					<dt>Hostel</dt>
					<dd class="text-center"><?php echo $_SESSION['view_hostel']?></dd>
					<dt>Webmail id</dt>
					<dd class="text-center"><?php echo $_SESSION['viewuser']?></dd>
					</dl>
                </ul>
            </div>
        	<div class="span2 offset1">
                <ul class="nav nav-list">
                  <center><li class="nav-header">User Actions</li></center>
				  <br>
                  <li><a class ="text-center" href="start_personal_conv.php">Message</a></li>
                  <!--<li><a class ="text-center" href="#">Poke</a></li>
                  <li><a class ="text-center" href="#">Kill</a></li>-->
                </ul>
			</div>
    	</div>
     </div>
	 <?php
	 ?>
  </body>
</html>