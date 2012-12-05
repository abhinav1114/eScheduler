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
    ?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>List Events</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--              JQUERY LIBS 
================================================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>

<!--             CSS STYLING 
================================================-->
<link rel="stylesheet" href="http://pluto.cse.msstate.edu/~dcspg31/css/smoothness/jquery-ui-1.9.2.custom.css">
        <style type="text/css">
					html, body {
 								height: 100%;
  								margin: 0;
  								padding: 0;
								}
                    body{
    					background-image: url('http://www.roanokechowan.edu/wp-content/uploads/2012/05/calendar.jpg');
    					background-repeat: no-repeat;
   						background-position: center bottom;
						background-width:70%;
						background-height:70%;
    				}

			h1 {
				text-align:center;
           		color:#FFFFFF;
            	background-color:#800000;
            	font-size:250%;
				}

			h2 {
				text-align:center;
       			color:maroon;
				font-weight: bold;
			   }
			   
			.message{
				background: green;
				color: white;
				width: 25%;
				font-size: 30px;
				margin: auto;
				margin-bottom: 10px;
				text-align: center;
			}

			.error_message{
				background: red;
				color: white;
				width: 25%;
				font-size: 30px;
				margin: auto;
				margin-bottom: 10px;
				text-align: center;
			}
            
        </style>
    </head>    
    <body>
        <h1>Today's Events</h1>

		<div align="right">
		<A HREF = http://pluto.cse.msstate.edu/~dcspg31/welcome.php><FONT COLOR="#800000"><b>Back to Calendar </b></FONT></A>
		</div>
        <?php 
		session_start();
		$ID = $_SESSION['id'];
		
		if($message = $_SESSION["db_message"]){
			print("<div class='message' style='display: none'>$message</div>"); 
			unset($_SESSION["db_message"]);
		}
		
		if($message = $_SESSION["db_error"]){
			print("<div class='error_message' style='display: none'>$message</div>"); 
			unset($_SESSION["db_error"]);
		}
		require_once('db_setup.php');
   					$con = mysql_connect($db_server, $db_username, $db_password);

   		 			if (!$con) {
						print("Error");
       		 			die('Could not connect: ' . mysql_error());
    				}
					
    					mysql_select_db($db_username, $con);
					$cDate = new DateTime('today',new DateTimeZone('America/Chicago'));
					$dDate = $cDate->format('Y-m-d');
					$query = "SELECT ID,eName FROM Events WHERE User_ID='$ID' AND eDate='$dDate'";
					$test = mysql_query($query);
					$events = array();
					$num = mysql_num_rows($test);
					$i=0;
					while ($eventrow = mysql_fetch_assoc($test)) {
							$events[]=$eventrow;
					}
					print("<ul style='list-style-type:none;'>");
					for($i=0; $i<=$num;$i++){
					$sub=$events[$i]['eName'];
					$event_id=$events[$i]['ID'];
					print(" <li style='width: 100%; font-size: 20px; text-align: center;'><a href='editEvent.php?subject=$sub' class='event' id='$event_id' style='text-decoration: none;'><b>$sub</b></a></li><br />");
					
				}
		?>
        </ul>

		<div align="center">		
			<a class="event_date" href="addEvent.html" day="<?php print($dDate) ?>"><b>Add an event</b></a><br />
		</div>
		
        <div id="eventInfo"></div>
    </body>

	  <!-- jQuery Code -->
	  <script>
		$(document).ready(function(){
			$('.message').delay(500).fadeIn(1500).delay(3000).fadeOut("slow");
			$('.error_message').delay(1500).fadeIn(1500);
			
			<!-- Displays Event Info -->
			$(".event").click(function(event){
			
				event.preventDefault(); //prevents click from going to href
				var eventID = this.id;  //grabs event ID
				
				/* Grab events info from getEventInfo.php and 
				   display in dialog box */
				$.post(
					'getEventInfo.php?location=listEvents.php',	//URL of file to get info from
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
					'addEvent_popUp.php?location=listEvents.php',	//URL of file to get info from
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