<?php
$date=$_GET['date'];
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Add Event</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            h1 {text-align:center;}
            h1 {color:#FFFFFF;}
            h1 {background-color:#800000;}
            h1 {font-size:250%;}

			h2 {text-align:center;
       			color:maroon;
				font-weight: bold;
			   }

			#mysubmit { background-color: maroon; 
						color: white;
						}
        </style>
    </head>
    <body>
        <h1>e-Scheduler</h1>

		<div align="right">
		<A HREF = http://pluto.cse.msstate.edu/~dcspg31/welcome.php><FONT COLOR="#800000"><b>Back to Calendar </b></FONT></A>
		</div> 
		<br><br>
        <h2><u>Add an event to your calendar</u></h2>
        <h2><form action="addEvent.php" method="POST">
            <font size="4">Subject: <input type="text" name="subject"/></font><br><br/>
            <font size="4">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Date: <input type="text" name="date" value="<?php print($date)?>"/> (YYYY-MM-DD) </font><br><br/>
            <font size="4">Description:</font><br>
            <textarea name="description" cols="60" rows="6">
                     Describe the event...
            </textarea>
            <br/>
            <br/>
            <input type="submit" id="mysubmit" value="Submit"/>
            <input type="reset" id="mysubmit" value="Cancel"/>
			</h2>
        </form> 
    </body>
</html>
