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
$month = $_SESSION['month'] + 1;
if($month > 12)
{
    $month = 1;
    $_SESSION['year'] = $_SESSION['year'] + 1;
}
$_SESSION['month'] = $month;
header("Location: welcome.php");
}
?>
