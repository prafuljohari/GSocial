
<?php
			session_start();
			include("db_connect.php");

			$currentUser = $_SESSION['username'];
			$currentConv = $_SESSION['currentConv'];

if (isset($_POST['submit']))
				{
					$currentMembers = explode(",",$_POST['content']);					
					for($i = 0; $i < count($currentMembers); $i++)
					{
						// echo $currentMembers[$i]."<br>";
						$ins = mysql_query("INSERT INTO members (convid, userid) VALUES ('$currentConv', '$currentMembers[$i]')");
						
					}
				}
				
?>

	