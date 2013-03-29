<?php

    include ("db_connect.php");
	session_start();
	unset($_SESSION['regError']);
//Input vaildation and the dbase code

	  $bInputFlag = false;
	  
	  $email=$_POST['email'];
	  $passw=$_POST['password']; 
	  $passw_cnf=$_POST['password_confirm']; 
	  
	  $userid = $email;
	  if ($passw != $passw_cnf)
	  {
			die("Error is : " . $passw . " " . $passw_cnf);
			$_SESSION['regError'] = 1;
			header( 'Location: index.php#toregister' ) ;
	  }
	  else
	  {
	  $q = "INSERT INTO `profile` (`userid`) "
			."VALUES ('$userid')";
	  $r = mysql_query($q);
	  if ( !$r )
		{
			die("Error is : 2" . mysql_error());
			$_SESSION['regError'] = 1;
			header( 'Location: index.php' );
		}
	  else
			{
				$mysqltime = date ("Y-m-d H:i:s", $phptime);
				$q = "INSERT INTO `login`"
					."VALUES ('$userid', '$passw', '$mysqltime')";
				
				$r = mysql_query($q);
				  if ( !$r )
						{
							die("Error is : 3" . mysql_error());
							$_SESSION['regError'] = 1;
							header( 'Location: index.php' );
						}
			}
	}
	$_SESSION['username'] = $userid;	
	header( 'Location: profile.php' ) ;
?>