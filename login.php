<?php
session_start();
		
include ("db_connect.php");
mysql_select_db("gsocial");
if (isset($_SESSION['regError']))
unset($_SESSION['regError']); 

$myemailid=$_POST['email'];
$mypassword=$_POST['password']; 

$tbl_name="login";

$sql="SELECT * FROM $tbl_name WHERE userid='$myemailid' and password='$mypassword'";
$result=mysql_query($sql) or die ("Error is :". mysql_error());

$count=mysql_num_rows($result);

if($count==1)
{
	$_SESSION["username"]=$myemailid;
	header("location:profile.php");
}
else 
{
		$_SESSION['regError'] = 2;
		header( 'Location: index.php' );
}
		
		
		
        ?>