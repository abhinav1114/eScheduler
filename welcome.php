<?php
session_start();
if($_SESSION['loggedin']!=True)
{
    if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
    {
        header('Location: Login.php');
    }
    else 
    {
        ?>

    <!--
    To change this template, choose Tools | Templates
    and open the template in the editor.
    -->
    <!DOCTYPE html>
    <html>
        <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <style type="text/css">
			html, body {
 					height: 100%;
  					margin: 0;
  					padding: 0;
				}
                
			body
                {
                    background-image: url('http://www.roanokechowan.edu/wp-content/uploads/2012/05/calendar.jpg');
                    background-repeat: no-repeat;
                    background-position: center right;
                }   

                h1 {text-align:center;}
                h1 {color:#FFFFFF;}
                h1 {background-color:#800000;}
                h1 {font-size:250%;}

                h2 {color: red}
            </style>
        </head>
        <body>
            <h1>e-Scheduler</h1>
            <h2>Error!!!</h2>
            You must log in before doing this.
            Click <a href="LoginPage.php">here</a> to try again.
        </body>
    </html>
    <?php
    }
}
else
{
$cDate = new DateTime();
$today = new DateTime('today',new DateTimeZone('America/Chicago'));
$Wmonth = date("F");
$NumOfDays;
$FirstDay;

$CurrentMonth = $_SESSION['month'];
$CurrentYear = $_SESSION['year'];

$ID = $_SESSION['id'];
$First_Name = $_SESSION['first_name'];
$Last_Name = $_SESSION['last_name'];

$query = sprintf("SELECT * FROM Events WHERE User_ID='%s'",
mysql_escape_string($ID));
$result = mysql_query($query);
$array = mysql_fetch_array($result);

$date = $array['eDate'];
$subject = $array['eName'];

if($CurrentMonth == 1)
{
    $Wmonth = "January";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 2)
{
    $Wmonth = "February";
    if(($year % 4) == 0)
    {
        $NumOfDays = 29;
    }
    else
    {
        $NumOfDays = 28;
    }
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 3)
{
    $Wmonth = "March";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 4)
{
    $Wmonth = "April";
    $NumOfDays = 30;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 5)
{
    $Wmonth = "May";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 6)
{
    $Wmonth = "June";
    $NumOfDays = 30;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 7)
{
    $Wmonth = "July";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 8)
{
    $Wmonth = "August";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 9)
{
    $Wmonth = "September";
    $NumOfDays = 30;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 10)
{
    $Wmonth = "October";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
elseif($CurrentMonth == 11)
{
    $Wmonth = "November";
    $NumOfDays = 30;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
else
{
    $Wmonth = "December";
    $NumOfDays = 31;
    $FirstDay = date("w", mktime(0,0,0,$CurrentMonth,1,$CurrentYear));
}
?>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>
<html>
<head>
<title>Calendar</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="date.created" content="2012-11-15">
<meta name="generator" content="HTML Calendar Maker 2.0">
<meta name="licensekey" content="">

<!--              JQUERY LIBS 
================================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

<!--             CSS STYLING 
================================================-->
<link rel="stylesheet" href="http://pluto.cse.msstate.edu/~dcspg31/css/smoothness/jquery-ui-1.9.2.custom.css">

<style type="text/css">

/* Styling for the title (Month and Year) of the calendar */
div.title {
    font: x-large Verdana, Arial, Helvetica, sans-serif;
    text-align: center;
    height: 20px;
    color: black;
	margin-bottom:15px;
    }
/* Styling for the footer */
div.footer {
    font: small Verdana, Arial, Helvetica, sans-serif;
    text-align: center;
    }
/* Styling for the overall table */
table {
    font: 100% Verdana, Arial, Helvetica, sans-serif;
    table-layout: fixed;
    border-collapse: collapse;
    width: 100%;
    }
/* Styling for the column headers (days of the week) */
th {
    padding: 0 0.5em;
    text-align: center;
    background-color:maroon;
    color:white;
    }

/* Styling for the individual cells (days) */
td  {     
    font-size: medium;
    padding: 0.25em 0.25em;   
    width: 14%;
	color:maroon;
    text-align: left;
    vertical-align: top;
    }

/* Styling for the date numbers */
.date  {     
    font-size:medium;
    padding: 0.25em 0.25em;   
    text-align: left;
    vertical-align: top;
    }

/* Class for individual days (coming in future release) */
.sun {
     color:white;
     }

/* Hide the month element (coming in future release) */
th.month {
    visibility: hidden;
    display:none;
    }
ul
{
	list-style-type: none;
	margin:0;
	padding:0;
	overflow:hidden;
}

#mysubmit { background-color: maroon; 
			color: white;
		  }

li
{
	float:left;
	width:20%;
}

	#nav{
	list-style:none;
	font-weight:bold;
	margin-bottom:10px;
	/* Clear floats */
	float:left;
	width:100%;
	/* Bring the nav above everything else--uncomment if needed.
	position:relative;
	z-index:5;
	*/
}

.norm a:link,a:visited
{
	display:block;
	width:100%;
	color:maroon;
	background-color:#E8E8E8 ;
	font-weight:bold;
	text-align:center;
	padding:2px;
	text-decoration:none;
	text-transform:uppercase;
}

.norm a:hover,a:active
{
	background-color:#ACA7A7;
}

</style>

<script language="JavaScript">
<!--

var backColor = new Array(); // don't change this

backColor[0] = '#F0E68C';
backColor[1] = '#98FB98';
backColor[2] = '#F08080';
backColor[3] = '#FFFFFF';

function changeBG(whichColor){
document.bgColor = backColor[whichColor];
}

//-->
</script>

<script language="JavaScript">
<!--

var backImage = new Array(); // don't change this

backImage[1] = "nao.jpg";
backImage[2] = "msstate_logo.jpg";
backImage[3] = "logo.jpg";
backImage[4] = "";

function changeBGImage(whichImage){
	if (document.body){
	document.body.background = backImage[whichImage];
	}
}

//-->
</script>
</head>

<body>
	<span class="norm hover"> 
    <ul>
    <li><a href="WelcomePage.html">Home</a></li>
    <li><a href="listEvents.php">To-Do</a></li>
	<li><a href="feature.html">Extras</a></li>
    <li><a href="contact.html">Contact</a></li>
    <li><a href="about.html">About</a></li>	
    </ul>
	</span>	
<br />

<style type="text/CSS" >
#clockFace
{
color:maroon;
font-family:"Verdana";
text-align:center;
font-weight:bold;
}

.message{
	background: green;
	color: white;
	width: 25%;
	font-size: 30px;
	margin: 10px auto;
	text-align: center;
	border-radius: 5px;
	box-shadow: 1px 1px 15px black;
}

.error_message{
	background: red;
	color: white;
	width: 50%;
	font-size: 30px;
	margin: 10px auto;
	text-align: center;
	border-radius: 5px;
	box-shadow: 1px 1px 15px black;
}
#password{ 
	float: left;
	margin-left: 15px;
	font-weight: bold;
	color: #a52a2a;
	text-decoration: none;
}
#logout{
	float: right;
	margin-right: 15px;
	font-weight: bold;
	color: #a52a2a;
	text-decoration: none;
}
#welcome{
	clear: both;
	text-align: center;
	color: maroon;
}
#today{
	color: maroon;
	text-align: center;
}
#calendar{
	border: 3px solid white;
	border-radius: 5px;
	padding: 2px;
	box-shadow: 1px 1px 19px #6B1414;
	margin: 5px 10px;
}
#calendar td{background: white;}
</style>

<script>
function showTime () {
	var time = new Date()
	var hour = time.getHours()
	var minute = time.getMinutes()
	var sMin = (minute<10) ? "0" + minute : minute
	var second = time.getSeconds()
	var sSecs = (second<10) ? "0" + second : second
	var dd = "AM"
	if (hour >= 12) {
        hour = hour-12;
        dd = "PM";
    }
    if (hour == 0) {
        hour = 12;
    }
	var strTime = hour + ":" + sMin + ":" + sSecs + " " + dd
	document.getElementById("clockFace").innerHTML = strTime;
}//showTime
</script>
</head>
<br />

<body onload="setInterval(showTime, 5)">

<p>
	<a id="password" href="ChangePass.html">Change Password</a>
	<a id="logout" href = "logout.php">Logout</a>
</p>

<?php
	print("<h1 id='welcome'>Welcome $First_Name $Last_Name </h1>");
?>


<p id='today'><?php echo "Today is ".$today->format("l F d, Y"); ?></p>
<a href="toCurrMonth.php"><p id='today'>Go to Current Month</p></a>

<div id="clockFace"></div>

<div align="right">

</div> 

<?php 
	if($message = $_SESSION["db_message"]){
		print("<div class='message' style='display: none'>$message</div>"); 
		unset($_SESSION["db_message"]);
	}
	
	if($message = $_SESSION["db_error"]){
		print("<div class='error_message' style='display: none'>$message</div>"); 
		unset($_SESSION["db_error"]);
	}
?>
<table class=m style="width:20;">

<td id="calendar_nav" style="text-align:right;"><a style="color:maroon; text-decoration:none;" href='decreaseDate.php' rel="nofollow"><b><</b></a></td>
<td>
<div class="title">
    <?php 
    print("$Wmonth ");
    print("$CurrentYear"); 
    ?>
</div></td>

<td><a style="color:maroon;text-decoration:none;" href='increaseDate.php' rel="nofollow"><b>></b></a></td>
</table>

<div id="calendar">
<table border="1">   
<tr><th>Sunday</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th></tr><tr>
       
	<?php
       while($FirstDay > 0)
       {
           print("<td><span class=\"date\">&nbsp;</span></td>");
           $FirstDay--;
       }
           $Count = 1;
                while($Count <= $NumOfDays)
                {
					$cDate->setDate($CurrentYear,$CurrentMonth,$Count);
					if($cDate->format('Y-m-d') == $today->format('Y-m-d'))
						echo "<td width='14%' height='80px' style='overflow:auto; background: SpringGreen'>";
					else
						echo "<td width='14%' height='80px' style='overflow:auto; background: white''>";
						
                    print("
					<span class=\"date hover\">
					<a href='addEvent.html' style='text-decoration: none' class='event_date' day='".$cDate->format("Y-m-d")."'>$Count<br /><br /></a>");
   		
					require_once('db_setup.php');
   					$con = mysql_connect($db_server, $db_username, $db_password);

   		 			if (!$con) {
       		 			die('Could not connect: ' . mysql_error());
    				}
    					mysql_select_db($db_username, $con);
		
					$query2 = "SELECT ID,eName FROM Events WHERE User_ID='$ID' AND eDate='$CurrentYear-$CurrentMonth-$Count'";
					$test = mysql_query($query);
					$events = array();
					$num = mysql_num_rows($test);
					$i=0;
					while ($eventrow = mysql_fetch_assoc($test)) {
							$events[]=$eventrow;
					}
					print("<ul>");
					for($i=0; $i<=$num;$i++){
					if($events[$i]['eDate']==$cDate->format('Y-m-d')){
					$sub=$events[$i]['eName'];
					$event_id=$events[$i]['ID'];
					print(" <li style='width: 100%; font-size: 13px; '><a href='editEvent.php?subject=$sub' class='event' id='$event_id' style='text-decoration: none;'><b>$sub</b></a></li><br />");
					}
					else{
							$sub="";
					}
				}
			print("</ul>
			</span>
			</td>");
                
    
					$CurrentDay = date("w", mktime(0,0,0,$CurrentMonth,$Count,$CurrentYear));
                    if($CurrentDay == 6)
                    {
                        print("</tr><tr>");
                    }
                    $Count++;
                }
                $LastDay = date("w", mktime(0,0,0,$CurrentMonth,$NumOfDays,$CurrentYear));
                while($LastDay < 6)
                {
                    print("<td><span class=\"date\">&nbsp;</span></td>");
                    $LastDay++;
                }
         ?>
      </table>
</div>
	</br>

		<span style="float:left;">
		<b> Background Color:</b>&nbsp;
		<form name="jump1">
		<select name="myjumpbox"
		OnChange="location.href=jump1.myjumpbox.options[selectedIndex].value">
		<option selected>
		<option value="javascript:changeBG(0)">Khaki
		<option value="javascript:changeBG(1)">Pale Green
		<option value="javascript:changeBG(2)">Light Coral
		<option value="javascript:changeBG(3)">White
		</select>
		</form>
		</span>

		<span style="float:right;">
		<b> Background Image:</b> &nbsp;
		<form name="jump2">
		<select name="myjumpbox"
		OnChange="location.href=jump2.myjumpbox.options[selectedIndex].value">
		<option selected>
		<option value="javascript:changeBGImage(1)">Nao
		<option value="javascript:changeBGImage(2)">Msstate
		<option value="javascript:changeBGImage(3)">Logo
		<option value="javascript:changeBGImage(4)">Blank
		</select>
		</form>		
		</span>
		
		 <span style="float:center;">
        <form action="goToDate.php" method="POST">
            <br><center><div class="ex"><font size="3">
                      Month (1-12) &nbsp; &nbsp; &nbsp; Year (YYYY)<br>
                      <input type="text" name="month">&nbsp;
                      <input type="text" name="year"><br><br></font>
                      
                      <input type="submit" id="mysubmit" value="Submit">
                      <input type="reset" id="mysubmit" value ="Cancel">
          </form>
		</span>
		
		<!-- This div is hidden from view -->
		<div id="eventInfo"></div>
      </body>
	  
	  
	  <!-- jQuery Code -->
	  <script>
		$(document).ready(function(){
			$('.message').delay(500).fadeIn(1500).delay(3000).fadeOut("slow");
			$('.error_message').delay(1000).fadeIn(1500);
			<!-- Displays Event Info -->
			$(".event").click(function(event){
			
				event.preventDefault(); //prevents click from going to href
				var eventID = this.id;  //grabs event ID
				
				/* Grab events info from getEventInfo.php and 
				   display in dialog box */
				$.post(
					'getEventInfo.php?location=welcome.php',	//URL of file to get info from
					{'id':eventID},									//Parameters passed to file
					
					function(data){	
						$("#eventInfo").html(data);					//Store the returned info in 'eventInfo' div
						$("#eventInfo").dialog({ 
							title: "Edit OR Delete This Event",
							modal: true,
							width: 400
						});	//Display the hidden 'eventInfo' div in jQuery dialogue box
					}
				);
			});
			
			$(".event_date").click(function(event){
			
				event.preventDefault(); //prevents click from going to href
				var day = $(this).attr("day");  //grabs event ID
				
				/* Grab events info from getEventInfo.php and 
				   display in dialog box */
				$.post(
					'addEvent_popUp.php?location=welcome.php',	//URL of file to get info from
					{'date':day},									//Parameters passed to file
					
					function(data){	
						$("#eventInfo").html(data);					//Store the returned info in 'eventInfo' div
						$("#eventInfo").dialog({ 
							title: "Add Event",
							modal: true,
							width: 400
						});	//Display the hidden 'eventInfo' div in jQuery dialogue box
					}
				);
			});
		});
	  </script>
</html>
<?php
}
?>