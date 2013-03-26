
<?php include("header.php");
include("db_connect.php"); 
session_start();
?>

<div class="swd-layout-wrapper clearfix">
                <div class="swd-content-layout">
                    <div class="swd-content-layout-row">
                        <div class="swd-layout-cell swd-content clearfix"><article class="swd-post swd-article">
                                
                                                
                <div class="swd-postcontent swd-postcontent-0 clearfix"><div class="swd-content-layout layout-item-0">
    <div class="swd-content-layout-row">
    <div class="swd-layout-cell layout-item-1" style="width: 100%" >
        <p style="text-align: center;"> </p>
<div id="phone" style="position: relative; display: inline-block; z-index: 0; margin: 7px;  border-width: 0px;  " class="swd-collage">
<div class="swd-slider swd-slidecontainerphone">
    <div class="swd-slider-inner">
<div class="swd-slide-item swd-slidephone0">

</div>
<div class="swd-slide-item swd-slidephone1">

</div>
<div class="swd-slide-item swd-slidephone2">

</div>

    </div>
</div>
<div class="swd-slidenavigator swd-slidenavigatorphone">
<a href="#" class="swd-slidenavigatoritem"></a><a href="#" class="swd-slidenavigatoritem"></a><a href="#" class="swd-slidenavigatoritem"></a>
</div>



    </div>

        <p style="text-align: center;">     </p>
    </div>
    </div>
</div>
<div class="swd-content-layout">
    <div class="swd-content-layout-row">
    <div class="swd-layout-cell layout-item-1" style="width: 33%" >
        <p><span style="font-size: 18px; color: rgb(255, 255, 255); font-weight: bold;">Welcome <? echo $_SESSION["username"] ?>! </span></p>
        <p> <? $myusername = $_SESSION["username"];
		  $sql="SELECT * FROM profile WHERE userid='$myusername' ";
          $result=mysql_query($sql) or die (mysql_error());
			while($row = mysql_fetch_array($result))
				{
				echo $row['name'];
				echo "<br />";
				echo "Department : ". $row['department'];
				echo "<br />";
				echo "Hostel : ".$row['hostel'];
				echo "<br />";
				}
		  ?>
       </p>
        <p>&nbsp;<a href="edit_profile.php" target="_self" class="swd-button">Edit Profile</a>&nbsp;<br></p>
        <p><span style="font-size: 18px; color: #E2341D;"><br></span></p>
    </div><div class="swd-layout-cell layout-item-1" style="width: 33%" >
        
    </div>
	<div class="swd-layout-cell layout-item-1" style="width: 34%" >
        <p><span style="font-size: 18px; color: rgb(255, 255, 255); font-weight: bold;">About:</span></p>
        <p>		  	<?$sql="SELECT * FROM profile WHERE userid='$myusername' ";
					$result=mysql_query($sql) or die (mysql_error());
					while($row = mysql_fetch_array($result))
					{
					echo $row['about_me'];
					echo "<br />";
					} ?>
		</p>
		<p>
		<? echo "<br br />"; 
		?>
		</p>
        <p>
		<form action="show_users.php" target="_blank" action="post">
		<input name="newThread" type="submit" value="View Users" />
		</form>
		</p>
    </div>
    </div>
</div>
</div>
</article></div>
                    </div>
                </div>
            </div><footer class="swd-footer clearfix">

</footer>

    </div>
    <p class="swd-page-footer">
        <span id="swd-footnote-links">Designed by <a href="http://stylishwebdesigner.com/" target="_blank">Stylish Web Designer</a>.</span>
    </p>
</div>


</body></html>