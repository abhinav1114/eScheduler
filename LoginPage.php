<?php
if($_COOKIE['username'] != NULL && $_COOKIE['password'] != NULL)
{
    $u = $_COOKIE['username'];
    $p = $_COOKIE['password'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <style type="text/css">
		html, body {
 					height: 100%;
  					margin: 0;
  					padding: 0;
				}
    
    body{
    background-image: url('http://www.roanokechowan.edu/wp-content/uploads/2012/05/calendar.jpg');
    background-repeat: no-repeat;
    background-position: left center;
    }

       
    div.ex
    {
        width: 280px;
        padding: 30px;
        border: 5px solid maroon;
        margin: 0px;
    }
    h1 {text-align:center;}
    h1 {color:#FFFFFF;}
    h1 {background-color:#800000;}
    h1 {font-size:250%;}
    
    div.rx
    {
        width: 350px;
        padding: 30px;
        border: 5px solid maroon;
        margin: 0px;
    }
    h1 {text-align:center;}
    h1 {color:#FFFFFF;}
    h1 {background-color:#800000;}
    h1 {font-size:250%;}
    
    h3 {text-decoration: underline;}

	#mysubmit { background-color: maroon; 
				color: white;
			}
     
    </style>
    </head>
    <body>
    <h1><font size="10">e-Scheduler</font></h1>
    
    
      <form action="Login.php" method="POST">
          
          <br><br><center><div class="ex"><font size="5">
          Username:<input type="text" name="username" value="<?php print($u)?>"><br><br>
          Password:<input type="password" name="password" value="<?php print($p)?>"><br><br></font>
          <input type="checkbox" name="remember" value="1">Remember me<p>&nbsp;</p>
          
		  <input type="submit" id="mysubmit" value="Submit">
          <input type="reset" id="mysubmit" value="Cancel">
      </form>

    <form>
        <br><br><center><a href="addUser.html"><h3>New to e-Scheduler?</h3><br>
          </a></center>
    </form>
    </body>
</html>