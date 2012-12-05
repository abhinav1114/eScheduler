<?php
$username = $_POST['username'];
$password = $_POST['password'];
if($username == NULL && $password == NULL)
{
    if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
    {
        $username = $_COOKIE['username'];
        $password = $_COOKIE['password'];
    }
}
require_once('db_setup.php');

$con = mysql_connect($db_server, $db_username, $db_password);
if (!$con) {
    die('Could not connect: ' . mysql_error());
}

mysql_select_db($db_username, $con);

$query = sprintf("SELECT * FROM User1 WHERE Username='%s' AND Password=SHA1('%s')",
mysql_escape_string($username),
mysql_escape_string($password));
$result = mysql_query($query);
$row = mysql_fetch_row($result);

$query2 = sprintf("SELECT * FROM User1 WHERE Username='%s'",
mysql_escape_string($username));
$result2 = mysql_query($query2);
$ID = mysql_fetch_array($result2);

session_start();
$_SESSION['id']=$ID['ID'];
$_SESSION['first_name']=$ID['First_Name'];
$_SESSION['last_name']=$ID['Last_Name'];

if($row == FALSE)
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
            Please input a valid username and password.
            Click <a href="LoginPage.php">here</a> to try again.
        </body>
    </html>
    <?php
}
else
{
    if (isset($_POST['remember'])) 
        {
            /* Set cookie to last 1 year */
            setcookie('username', $username, time()+31536000,'/~dcspg31/','pluto.cse.msstate.edu');
            setcookie('password', $password, time()+31536000,'/~dcspg31/','pluto.cse.msstate.edu');
        }
	$_SESSION['password']=$password;
    header("Location: initialize.php");
}

mysql_close($con);
?>
</body>
</html>
