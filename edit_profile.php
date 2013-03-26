
<?php include("header.php");
include("db_connect.php"); 
session_start();
?>
<!DOCTYPE html>
<html>
<head>

<title>
Edit Profile
</title>

<!-- Meta Tags -->
<meta charset="utf-8">
<meta name="generator" content="Wufoo">
<meta name="robots" content="index, follow">

<!-- CSS -->
<link href="css/structure.css" rel="stylesheet">
<link href="css/form.css" rel="stylesheet">

<!-- JavaScript -->
<script src="scripts/wufoo.js"></script>

<!--[if lt IE 10]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body id="public">
<div id="container" class="ltr">

<h1 id="logo">
<a href="edit_profile.php" >Edit Profile</a>
</h1>

<form id="form69" name="form69" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate
action="process_edit_profile.php">

<ul>

<li id="foli0" class="notranslate      ">
<label class="desc" id="title0" for="Field0">
Name
</label>
<span>
<input id="name" name="name" type="text" class="field text fn" value="" size="8" tabindex="1" />
<?        $myusername = $_SESSION["username"];
		  mysql_query("INSERT INTO profile (name) VALUE ('name') where userid = '$myusername' ") ?>
<label for="Field0"></label>
</span>
</li>

<li id="foli1" class="notranslate      ">
<label class="desc" id="title1" for="Field1">
Hostel

<span class="hostel">
<select id="Field1" name="hostel" class="field select addr" tabindex="1" >
<option value="" selected="selected"></option>
<option value="Kameng" >Kameng</option>
<option value="Umiam" >Umiam</option>
<option value="Dihing" >Dihing</option>
<option value="Kapili" >Kapili</option>
<option value="Subansiri" >Subansiri</option>
</select>
</span>
</div>
</li>


<li id="foli2" class="notranslate      ">
<label class="desc" id="title2" for="Field2">
Department
</label>
<span>
<input id="dept" name="dept" type="text" class="field text fn" value="" size="8" tabindex="1" />

<label for="Field2"></label>
</span>
</li>

<!--dob -->

<li id="foli2" class="notranslate      ">
<label class="desc" id="title2" for="Field4">
About me
</label>
<span>
<input id="about_me" name="about_me" type="text" class="field text fn" value="" size="8" tabindex="1" />

<label for="Field4"></label>
</span>
</li>
<input type="submit" value="Submit">
</form>
</body>
</html>

