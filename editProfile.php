<!DOCTYPE html>
<head>
	<title>Edit Profile</title>
	<?php
//Do the PHP processing of variables here only.
include("db_connect.php"); 
include ("header.html");
session_start();
if (isset($_SESSION["username"]))
$myusername = $_SESSION["username"];
else
header("Location: index.php");
$myusername = $_SESSION["username"];
$sql="SELECT * FROM profile WHERE userid='$myusername' ";
$result=mysql_query($sql) or die (mysql_error());
while($row = mysql_fetch_array($result))
{
	//Check whether we need more entries or not, like DOB etc.
	$_SESSION['my_name'] = $row['name']; //Modify later: Only first name to be shown
	$name = explode(" ",$_SESSION['my_name']);
	if ($_SESSION['my_name'] == "")
	$_SESSION['my_fname'] = $_SESSION["username"];
	else
	$_SESSION['my_fname'] = $name[0];
	$_SESSION['my_desig'] = $row['designation'];
	$_SESSION['my_info'] = $row['about_me'];
	$_SESSION['my_dept'] = $row['department'];
	$_SESSION['my_hostel'] = $row['hostel'];
	$_SESSION['img-user'] = 1;				//Set to 1 if profile pic set. Check in database basically.
}
?>
<link href="css/bootstrap-tagmanager.css" rel="stylesheet">
<script type="text/javascript" src="js/bootstrap-tagmanager.js"></script>
<script src="js/jasny/jasny-bootstrap.js"></script>
<script src="js/bootstrap.js"></script>
</head>

<body>
<?php
include("navbar.html");
?>
<div class="container">
<div class="hero-unit">
<form class="form-horizontal" method="post" enctype="multipart/form-data" action="process_edit_profile.php">
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
              <option <?php if ($_SESSION['my_hostel'] == "Kameng") echo "selected"?>>Kameng</option>
              <option <?php if ($_SESSION['my_hostel'] == "Barak") echo "selected"?>>Barak</option>
              <option <?php if ($_SESSION['my_hostel'] == "Umiam") echo "selected"?>>Umiam</option>
              <option <?php if ($_SESSION['my_hostel'] == "Manas") echo "selected"?>>Manas</option>
              <option <?php if ($_SESSION['my_hostel'] == "Dihing") echo "selected"?>>Dihing</option>
              <option <?php if ($_SESSION['my_hostel'] == "Kapili") echo "selected"?>>Kapili</option>
              <option <?php if ($_SESSION['my_hostel'] == "Subansiri") echo "selected"?>>Subansiri</option>
              <option <?php if ($_SESSION['my_hostel'] == "Brahmaputra") echo "selected"?>>Brahmaputra</option>
              <option <?php if ($_SESSION['my_hostel'] == "Married Scholars") echo "selected"?>>Married Scholars</option>
              <option <?php if ($_SESSION['my_hostel'] == "None") echo "selected"?>>None</option>                            
              </select>
        </div>
	</div>
	<div class="control-group">
    	<label class="control-label" for="usrHostel">Date of Birth</label>
    	<div class="controls">
			  <div class="input-append date" id="dp3" data-date="2013-03-28" data-date-format="yyyy-mm-dd">
				<input name="date" type="text" value="2013-03-28" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			  </div>
        </div>
	</div>
    <div class="control-group">
    	<label class="control-label" for="usrAbout">About me</label>
    	<div class="controls">
        	<textarea name= "usrAbout" rows="3" style="resize:none"><?php echo $_SESSION['my_info']?></textarea>
    </div>
	</div>
	<div class="control-group">
		<label class="control-label" for="usrGroups">Subscribe to Groups</label>
		<div class="controls">
			<input type="text" data-original-title="" id= "tagManager" class="tagManager" placeholder="For eg. Kameng, IITG-2014" name="groupsList" data-provide="typeahead" data-items="6" autocomplete="off"><ul class="typeahead dropdown-menu" style="top: 1662px; left: 460.5px; display: none;"></ul><input type="hidden" value="" name="hidden-tagsfun">
		</div>
	</div>
  </div>
  <div class="span3">
	<div class="control-group">
    	<!--<label for="usrImage">Display image</label>         
		<div class="img-polaroid">
           	<img src="images/img-null.jpg">
		</div>
        <input type="file">-->
        <div class="fileupload fileupload-new" data-provides="fileupload">
		<div class="fileupload-new thumbnail img-polaroid" style="width: 200px; height: 150px; text-align:center;"><img src="images/img-<?php echo $_SESSION["username"]?>.jpg" /></div>
  			<div class="fileupload-preview fileupload-exists thumbnail img-polaroid" style="width: 200px; height: 150px; text-align:center;"></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span>
    	<input name="myFile" type="file" />
      	</span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Revert to original</a>
  </div>
</div>
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
	<script type="text/javascript">
  $(function () {
    $(".tagManager").tagsManager({
     preventSubmitOnEnter: true,
     typeahead: true,
     typeaheadAjaxSource: null,
     typeaheadSource: function(query, process) 
		{
            $.post('searchGroups.php', { q: query, limit: 8 }, function(data) 
			{
                process(JSON.parse(data));
            });
        },
     delimeters: [44, 188, 13],
     backspace: [8],
     blinkBGColor_1: '#FFFF9C',
     blinkBGColor_2: '#CDE69C',
     hiddenTagListName: 'content'
  });
});
</script>

</form>
</div>
<form action="profile.php">
<button type="submit" class="btn">Back to profile</button>
</form>
</div>

</body>