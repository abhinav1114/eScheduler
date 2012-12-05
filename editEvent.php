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

require_once('db_setup.php');

   		$con = mysql_connect($db_server, $db_username, $db_password);

   		 if (!$con) {
       		 die('Could not connect: ' . mysql_error());
    			}

    	mysql_select_db($db_username, $con);
		$id=$_SESSION['id'];
		$subject=$_GET['subject'];
		$query2 = "SELECT * FROM Events WHERE User_ID = '$id' and eName='$subject'";
		
		$result = mysql_query($query2);
		$db_field = mysql_fetch_assoc($result);
		
		$subject = $db_field['eName'];
		$description = $db_field['eDescription'];
		$date = $db_field['eDate'];
		?>

<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <title>Modify Event</title>
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
        <h2><u>Edit or Delete the Event</u></h2>
        <h2><form action="editEvent2.php?oldSubject=<?php print($subject); ?>" method="POST">
            <font size="4">Subject: <input type="text" name="subject" value='<?php print($subject); ?>'/></font><br><br/>
            <font size="4">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Date: <input type="text" name="date" value="<?php print($date); ?>"/> (YYYY-MM-DD) </font><br><br/>
            <font size="4">Description:</font><br>
            <textarea name="description" cols="60" rows="6"><?php print($description); ?></textarea>
            <br/>
            <br/>
            <input name="choice" type="submit" id="mysubmit" value="Update"/>
			<input name="choice" type="submit" id="mysubmit" value="Delete"/>
            <input type="reset"  id="mysubmit" value="Cancel"/>
			</h2>
        </form> 
    </body>
</html>

    <?php
        mysql_close($con);
}
  ?>

