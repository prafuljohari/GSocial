<?php

        // dbConfig.php is a file that contains your
        // database connection information. This
        // tutorial assumes a connection is made from
        // this existing file.
    include ("db_connect.php");

	session_start();

//Input vaildation and the dbase code
	if ( $_GET["op"] != "thanks" )
	  {
	  $bInputFlag = false;
	  foreach ( $_POST as $field )
		{
			if ($field == "")
			{
				$bInputFlag = false;
			}
			else
			{
				$bInputFlag = true;
			}
		}
	  // If we had problems with the input, exit with error
			if ($bInputFlag == false)
			{
			
			$_SESSION['regError'] = 1;
			header( 'Location: index.php' );
		
			}

	  // Fields are clear, add user to database
	  //  Setup query
	  $q = "INSERT INTO `dbUsers` (`email`,`password`,`email`) "
			."VALUES ('".$_POST["email"]."', "
			."PASSWORD('".$_POST["password"]."'))";
			
	  //  Run query
	  $r = mysql_query($q);
	  
	  // Make sure query inserted user successfully
	  if ( !mysql_insert_id() )
			{
			$_SESSION['regError'] = 1;
			header( 'Location: index.php' );
			}
	  else
			{
			// Redirect to thank you page.
			Header("Location: register.php?op=thanks");
			}
	  } // end if


//The thank you page
  elseif ( $_GET["op"] == "thanks" )
  {
	header( 'Location: home.php' ) ;
  }
  
//The web form for input ability

	header( 'Location: index.php' ) ;
?>