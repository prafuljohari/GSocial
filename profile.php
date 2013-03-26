<!DOCTYPE html>
<html>
<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
session_start();
$myusername = $_SESSION["username"];
$sql="SELECT * FROM profile WHERE userid='$myusername' ";
$result=mysql_query($sql) or die (mysql_error());
while($row = mysql_fetch_array($result))
{
	//Check whether we need more entries or not, like DOB etc.
	$_SESSION['my_name'] = $row['name']; //Modify later: Only first name to be shown
	$_SESSION['my_desig'] = $row['designation'];
	$_SESSION['my_info'] = $row['about_me'];
	$_SESSION['my_dept'] = $row['department'];
	$_SESSION['my_hostel'] = $row['hostel'];
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
  <!--
  <div class="navbar navbar-inner navbar-fixed-top">
      <div class="navbar-inner">
      <form class="navbar-search pull-left">
       <input type="text" class="search-query" placeholder="Search">
        </form>
        <div class="container">
        
          <a class="brand" href="#">GSocial+</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li>
            </ul>
            <form class="navbar-form pull-right">
              <input class="span2" type="text" placeholder="Email">
              <input class="span2" type="password" placeholder="Password">
              <button type="submit" class="btn">Sign in</button>
            </form>
          </div>
        </div>
      </div>
    </div>-->
	<div class="navbar navbar-fixed-bottom">
		<div class="navbar-inner">
		    <div class="container"> 
				<ul class="nav">
                    <form class="navbar-search pull-left">
                    <input type="text" class="search-query" placeholder="Search">
                    </form>
		        	<a class="brand" href="#">GSocial+</a>
                    <li class="divider-vertical"></li>
                    <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Groups">G</a></li>
                    <li class="divider-vertical"></li>
                  <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Messages">M</a></li>
                  <li class="divider-vertical"></li>
                  <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Notifications">N</i></a></li>
                  <li class="divider-vertical"></li>
				</ul>
			</div>
		</div>
    </div>
  <div class="container">
   		<div class="row">    
            <div class="span6 hero-unit"> 
                <!--<br><br>-->
                <h1><center><?php echo $_SESSION['my_name']?></center></h1>
                <h4><center><?php echo $_SESSION['my_desig']?></center></h4>
                <h4><center>Dept. of <?php echo $_SESSION['my_dept']?></center></h4>
            </div>

            <div class="span4">
			<br><br>
			<div class="img-polaroid">
            <img src="images/fdp.jpg">
			</div>
            </div>
		</div>
	    <div class="row">
        <div class="span8">                    
         
	            <ul class="nav nav-list">
                  <center><li class="nav-header">Details</li></center>
                  <li class="progress-success">Hostel: <?php echo $_SESSION['my_hostel']?></li>
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
				  <li><a href="logout.php">Logout</a></li>
                </ul>
			</div>
    	</div>
     </div>
  </body>
</html>