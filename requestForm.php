<!DOCTYPE html>
<HTML>
 <HEAD>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />	
  <?php
include("db_connect.php"); 
include("header.html");
session_start();
$_user = $_SESSION["username"];
include ("navbar.html");
  ?>
  <TITLE>Requests</TITLE>
  <script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			displayRequests();
		});
		
		

		function displayRequests(){
			$.ajax({
			  url: "requests.php",
			  cache: false,
			  success: function(html){
				$("#allRequests").html(html);
			  }
			});
		}

	</script>
</HEAD>
<BODY>
		<div class="container">
			<div class="hero-unit">
				<legend>Requests</legend>
			</div>
			
			<div id="allRequests"></div>
		</div>
</BODY>
</HTML>