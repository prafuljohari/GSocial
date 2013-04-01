<!DOCTYPE html>
<html>
<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
session_start();
$viewuser = $_GET['user'];
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
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type='text/javascript'>
     $(document).ready(function () {
     if ($("[rel=tooltip]").length) {
     $("[rel=tooltip]").tooltip();
     }
   });
  </script>
  </head>
  <body>
  <div class="container">
   		<div class="row">    
            <div class="span6 hero-unit"> 
                <!--<br><br>-->
                <h1><center><?php echo $_SESSION['view_name']?></center></h1>
                <h4><center><?php echo $_SESSION['view_desig']?></center></h4>
                <h4><center>Dept. of <?php echo $_SESSION['view_dept']?></center></h4>
            </div>

            <div class="span4">
			<br><br>
			<div class="img-polaroid">
            <img src="images/img-<?php if (isset($_SESSION['img-user'])) echo $viewuser; else echo "null"; ?>.jpg">
			</div>
            </div>
		</div>
	    <div class="row">
        <div class="span8">                    
         
	            <ul class="nav nav-list">
                  <center><li class="nav-header">Details</li></center>
                  <li class="progress-success">Hostel: <?php echo $_SESSION['view_hostel']?></li>
                  <li><br></li>
                  <li>Batch: 2014</li>
                  <li>Webmail id: stud</li>
                </ul>
            </div>
        	<div class="span4">
                <ul class="nav nav-list">
                  <center><li class="nav-header">User Actions</li></center>
                  <li><a href="#">Message</a></li>
                  <li><a href="#">Poke</a></li>
                  <li><a href="#">Kill</a></li>
                </ul>
			</div>
    	</div>
     </div>
	 <?php
	 include ("navbar-profile.html");
	 ?>
  </body>
</html>