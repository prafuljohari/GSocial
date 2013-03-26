<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Custom Login Form Styling</title>
        <meta name="description" content="Custom Login Form Styling with CSS3" />
        <meta name="keywords" content="css3, login, form, custom, input, submit, button, html5, placeholder" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">
			
			<header>
			<br>
			<br>
				<h1>Welcome to GSocial</h1>
				<!-- <h2>Creative and modern form design with CSS magic</h2>
				
				<nav class="codrops-demos">
					<a class="current-demo" href="index.html">Demo 1</a>
					<a href="index2.html">Demo 2</a>
					<a href="index3.html">Demo 3</a>
					<a href="index4.html">Demo 4</a>
					<a href="index5.html">Demo 5</a>
				</nav>
				-->
				
				<div class="support-note">
					<span class="note-ie">Sorry, only modern browsers.</span>
				</div>
				
			</header>
			<?php
			session_start();
			if (isset($_SESSION['regError']))
			{
			if ($_SESSION['regError'] == 1)
				echo "Form entry mismatch";
			elseif ($_SESSION['regError'] == 2)
				echo "Wrong info";
			unset($_SESSION['regError']);
			}
				?>
			<section class="main">
				<form class="form-1" action="login.php" method="post">
					<p class="field">
						<input type="text" name="email" placeholder="IITG Email address">
						<i class="icon-user icon-large"></i>
					</p>
					<p class="field">
						<input type="password" name="password" placeholder="Password">
						<i class="icon-lock icon-large"></i>
					</p>
					<p class="submit">
						<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
					</p>
				</form>
				<a href = "register.php"> Register </a>
				<!--<form class="form-2" action="register.php" method="post">
					<p class="register">
						<button type="submit" name="Register" value="Register" id="Reg">
					</p>
				</form> -->
			</section>
        </div>
    </body>
</html>