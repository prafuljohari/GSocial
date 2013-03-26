<?php include("db_connect.php"); ?>

<?php
  
$myusername=$_POST['email'];
//$myusername="praful@iitg.ernet.in";
$mypassword=$_POST['password']; 

$tbl_name="login";

$sql="SELECT * FROM $tbl_name WHERE userid='$myusername' and password='$mypassword'";
$result=mysql_query($sql) or die (mysql_error());

$count=mysql_num_rows($result);

if($count==1){
session_start();

$_SESSION["username"]=$myusername;
//echo $_SESSION["username"];
header("location:profile.php");
}
else {
        // Login not successful
			die("Password is : ".$_POST["password"]." and username is : ".$_POST["email"]);
			/*$_SESSION['regError'] = 2;
			header( 'Location: index.php' ) ;*/
        }
		
		
		
?>