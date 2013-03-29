<head>
	<title>Edit Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
	<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
session_start();
$myusername = $_SESSION["username"];
$sql="SELECT * FROM profile WHERE userid='$myusername' ";
$result=mysql_query($sql) or die (mysql_error());
while($row = mysql_fetch_array($result))
{
	//Check whether we need more entries or not, like DOB etc.
	$_SESSION['my_name'] = $row['name']; //Modify later: Only first name to be shown
	$_SESSION['my_desig'] = $row['designation'];
	$_SESSION['my_info'] = $row['about_me'];
	$_SESSION['my_dept'] = $row['department'];
	$_SESSION['my_hostel'] = $row['hostel'];
	$_SESSION['img-user'] = 1;				//Set to 1 if profile pic set. Check in database basically.
}
?>
</head>

<body>
<div class="container">
<div class="hero-unit">
<form class="form-horizontal" method="post" action="process_edit_profile.php">
  <fieldset>
    <legend>Edit profile</legend>
  		<div class="row">
  			<div class="span6">
  				<div class="control-group">
    				<label class="control-label" for="usrName">Name</label>
   					<div class="controls">
				      <input type="text" name="usrName" placeholder="Your Name" value="<?php echo $_SESSION['my_name'];?>">
				    </div>
				</div>
				<div class="control-group">
				    <label class="control-label" for="usrDesg">Designation</label>
			    	<div class="controls">
			    		<select name="usrDesg">
			      			<option <?php if ($_SESSION['my_desig'] == "Student") echo "selected"?>>Student</option>
			      			<option <?php if ($_SESSION['my_desig'] == "Faculty") echo "selected"?>>Faculty</option>
			    	  		<option <?php if ($_SESSION['my_desig'] == "Director!") echo "selected"?>>Director!</option>
				   		</select>
			    	</div>
  				</div>

   	<div class="control-group">
	<label class="control-label" for="usrDept">Department</label>
	 	<div class="controls">
          <select name="usrDept">
          <option <?php if ($_SESSION['my_dept'] == "CSE") echo "selected"?>>CSE</option>
          <option <?php if ($_SESSION['my_dept'] == "EC/EE") echo "selected"?>>EC/EE</option>
          <option <?php if ($_SESSION['my_dept'] == "ME") echo "selected"?>>ME</option>
          <option <?php if ($_SESSION['my_dept'] == "CE") echo "selected"?>>CE</option>
          <option <?php if ($_SESSION['my_dept'] == "EP") echo "selected"?>>EP</option>
          </select>
		</div>
	</div>
   	<div class="control-group">
	<label class="control-label" for="usrHostel">Hostel</label>
         <div class="controls">
              <select name="usrHostel">
              <option>Kameng</option>
              <option>Barak</option>
              <option>Umiam</option>
              <option>Manas</option>
              <option>Dihing</option>
              <option>Kapili</option>
              <option>Subhansiri</option>
              <option>Brahmaputra</option>
              <option>Married Scholars</option>
              <option>None</option>                            
              </select>
        </div>
	</div>
	<div class="control-group">
    	<label class="control-label" for="usrHostel">Date of Birth</label>
    	<div class="controls">
			  <div class="input-append date" id="dp3" data-date="2013-03-28" data-date-format="yyyy-mm-dd">
				<input name="date" type="text" value="2013-03-28" readonly="">
				<span class="add-on"><i class="icon-calendar"></i></span>
			  </div>
        </div>
	</div>
    <div class="control-group">
    	<label class="control-label" for="usrAbout">About me</label>
    	<div class="controls">
        	<textarea name= "usrAbout" rows="3" ><?php echo $_SESSION['my_info']?></textarea>
        </div>
    </div>
  </div>
  <div class="span3">
	<div class="control-group">
    	<label for="usrImage">Display image</label>         
		<div class="img-polaroid">
           	<img src="images/img-null.jpg">
		</div>
        <input type="file">
	</div>
  </div>

</div>

<center><button type="submit" class="btn">Update info</button>

<script>
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp3').datepicker();
			var startDate = new Date(2013,1,20);
			var endDate = new Date(2018,1,25);
			$('#dp3').datepicker().on('changeDate', function(ev){
					if (ev.date.valueOf() > endDate.valueOf()){
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#dp4').data('date'));
					}
					$('#dp3').datepicker('hide');
				});
			$('#dp5').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() < startDate.valueOf()){
						$('#alert').show().find('strong').text('The end date can not be less then the start date');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#dp5').data('date'));
					}
					$('#dp5').datepicker('hide');
				});

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>

</form>
</div>
<form action="profile.php">
<button type="submit" class="btn">Back to profile</button>
</form>
</div>
<div class="navbar navbar-inverse navbar-fixed-bottom">
		<div class="navbar-inner">
		    <div class="container"> 
                <div class="row">
				<ul class="nav">
                    <form class="span5 navbar-search pull-left offset1">
                    <input type="text" class="search-query" placeholder="Search">
                    </form>
		        	<a class="span3 brand" href="#">GSocial+</a>
                    <li class="divider-vertical"></li>
                    <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Groups">G</a></li>
                    <li class="divider-vertical"></li>
                  <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Messages">M</a></li>
                  <li class="divider-vertical"></li>
                  <li><a rel="tooltip" target="_blank" href="#" title="" data-original-title="Notifications">N</i></a></li>
                  <li class="divider-vertical"></li>
				</ul>
                                    </div>
			</div>
		</div>
    </div>
</body>