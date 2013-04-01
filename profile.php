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
    <!--
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
  </script>-->
  </head>
  <body>
  <div class="container">   
            <div class="span6 hero-unit"> 
                <h1><center><?php echo $_SESSION['my_name']?></center></h1>
                <h4><center><?php echo $_SESSION['my_desig']?></center></h4>
                <h4><center>Dept. of <?php echo $_SESSION['my_dept']?></center></h4>
            </div>

            <div class="span4">
				<br><br>
				<div class="img-polaroid" style="width: 300px; height: 200px;">
					<img src="images/img-<?php if (isset($_SESSION['img-user'])) echo $myusername; else echo "null"; ?>.jpg">
				</div>
            </div>
        <br>
        <div class="span6 offset1">                    
                  <center><li class="nav-header">User Details</li></center>
                  <br>
                  <table class="table table-bordered">
              		<tbody>
                		<tr>
		                  <td><center>Hostel</center></td>
        		          <td><center><?php echo $_SESSION['my_hostel']?></center></td>
		                </tr>
        		        <tr>
		                  <td><center>Batch</center></td>
        		          <td><center>2014</center></td>
		                </tr>
        		        <tr>
		                  <td><center>Webmail id</center></td>
        		          <td><center>stud</center></td>
                		</tr>
	              </tbody>
    	        </table>
            </div>
        	<div class="span3 offset1">
                <ul class="nav nav-list">
                  <center><li class="nav-header">User Actions</li></center>
                  <br>
                  <!--<li><a href="#">Message</a></li>
                  <li><a href="#">Poke</a></li>
                  <li><a href="#">Kill</a></li>-->
				  <li><a href="editProfile.php">Edit Profile</a></li>
				  <li><a href="logout.php">Logout</a></li>
                </ul>
			</div>
     </div>
     <?php
	 include ("navbar-profile.html");
	 ?>
  </body>
</html>