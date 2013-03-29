<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Welcome to GSocial+</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
			<br><br>
            <header>
                <h1>Welcome to <span>GSocial+</span></h1>
            </header>
			<br>
            <section>				
				<br>
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="login.php" autocomplete="on" method="post"> 
                                <h1>Log in</h1> 
								<?php
								session_start();
								if (isset($_SESSION['username']))
								{
									header( 'Location: profile.php' ) ;
								}
								if (isset($_SESSION['regError']))
								{
									if ($_SESSION['regError'] == 1)
									echo '<p style="text-align:center; color:red;">Form data mismatch</p>';
									elseif ($_SESSION['regError'] == 2)
									echo '<p style="text-align:center; color:red;">The login details entered are incorrect. Please enter them again:</p>';
								}
								?>
                                <p> 
                                    <label for="email" class="uname" data-icon="u" > Your userid or email </label>
                                    <input id="email" name="email" required="required" type="text" placeholder="userid or userid@iitg.ernet.in"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="Password" /> 
                                </p>
                                <!--<p class="keeplogin"> 
									<input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
									<label for="loginkeeping">Keep me logged in</label>
								</p>-->
                                <p class="login button"> 
                                    <input type="submit" value="Login" /> 
								</p>
                                <p class="change_link">
									Not a member yet ?
									<a href="#toregister" class="to_register">Join us</a>
								</p>
                            </form>
                        </div>

                        <div id="register" class="animate form">
                            <form  action="register.php" autocomplete="on" method="post"> 
                                <h1> Sign up </h1> 
								<?php
								if (isset($_SESSION['regError']))
								{
									if ($_SESSION['regError'] == 1)
									echo '<p style="text-align:center; color:red;">Form data mismatch</p>';
									elseif ($_SESSION['regError'] == 2)
									echo '<p style="text-align:center; color:red;">The login details entered are incorrect. Please enter them again:</p>';
								}
								?>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="email" required="required" type="email" placeholder="userid@iitg.ernet.in"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="password" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="password_confirm" required="required" type="password" placeholder="Password"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
<?php 
unset($_SESSION['regError']);
?>
</html>