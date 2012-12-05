<?php
session_start();
$ID=$_SESSION['id'];
$DBpass=$_SESSION['password'];
$Cpass=$_POST['Cpass'];
$Npass=$_POST['Npass'];
$ConfNpass=$_POST['ConfNpass'];

if($DBpass == $Cpass && $Npass == $ConfNpass)
{
    require_once('db_setup.php');

    $con = mysql_connect($db_server, $db_username, $db_password);

    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($db_username, $con);
    
    $query = sprintf("UPDATE User1 SET Password=SHA('%s') WHERE ID='%s'",
    mysql_escape_string($Npass),
    mysql_escape_string($ID));
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    
    ?>
<!DOCTYPE html>
            <html>
                <head>
                    <title>Change Result</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <style type ="text/css">
		html, body {
 					height: 100%;
  					margin: 0;
  					padding: 0;
				}
            
                h1 {text-align:center;
                	color:#FFFFFF;
                	background-color:#800000;
                	font-size:100%;
                	}
            
                body{
    					background-image: url('http://www.roanokechowan.edu/wp-content/uploads/2012/05/calendar.jpg');
    					background-repeat: no-repeat;
   						background-position: center;
						background-width:70%;
						background-height:70%;
    				}

					   h3 {text-align:center;
       				   		color:black;
						  }

    					h2
    					{
    					color:maroon;
    					text-align:center;
    					text-decoration:underline;
    					}

        </style>	 
                </head>
                <body>


                    <h1>Change Successful</h1>
                    <p>Your password has been changed.</p>
                    <p>Click <a href="welcome.php">here</a> to return to calendar.</p>

                </body>
            </html>
<?php 
	if($_COOKIE['password']!=NULL)
	{
		setcookie('password', $password, time()-31536000,'/~dcspg31/','pluto.cse.msstate.edu');
	}
}
else
{
    ?>
<!DOCTYPE html>
            <html>
                <head>
                    <title>Change Result</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <style type ="text/css">
		html, body {
 					height: 100%;
  					margin: 0;
  					padding: 0;
				}
            
                h1 {text-align:center;
                	color:#FFFFFF;
                	background-color:#800000;
                	font-size:100%;
                	}
            
                body{
    					background-image: url('http://www.roanokechowan.edu/wp-content/uploads/2012/05/calendar.jpg');
    					background-repeat: no-repeat;
   						background-position: center;
						background-width:70%;
						background-height:70%;
    				}

					   h3 {text-align:center;
       				   		color:black;
						  }

    					h2
    					{
    					color:maroon;
    					text-align:center;
    					text-decoration:underline;
    					}

        </style>	
                </head>
                <body>


                    <h1>Change Error</h1>
                    <p>Your current password or confirm new password was not correct.</p>
                    <p>Would you like to <a href="ChangePass.html">try again</a>?</p>

                </body>
            </html>
<?php } ?>