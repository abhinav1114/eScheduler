<?php
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    
    require_once('db_setup.php');

    $con = mysql_connect($db_server, $db_username, $db_password);

    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }

    mysql_select_db($db_username, $con);
    
    $query = sprintf("SELECT * FROM User1 WHERE UserName='%s' OR Email = '%s'",
    mysql_escape_string($username),
    mysql_escape_string($email));
    $result = mysql_query($query);
    $row = mysql_fetch_row($result);
    
    if($row != FALSE)
        {
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Creation Result</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                </head>
                <body>


                    <h1>Creation Error</h1>
                    <p>Your username or email is already in out database.</p>
                    <p>Would you like to <a href="addUser.html">try again</a>?</p>

                </body>
            </html>
            <?php
        }
        elseif($password != $cpassword)
        {
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Creation Result</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                </head>
                <body>


                    <h1>Creation Error</h1>
                    <p>Your passwords did not match</p>
                    <p>Would you like to <a href="addUser.html">try again</a>?</p>

                </body>
            </html>
            <?php
        }
        else
        {
            $query2 = sprintf("INSERT INTO User1 (Username,Password,First_Name,Last_Name,Email) VALUES ('%s', SHA1('%s'),'%s','%s','%s')",
            mysql_escape_string($username),
            mysql_escape_string($password),
            mysql_escape_string($firstname),
            mysql_escape_string($lastname),
            mysql_escape_string($email));
            $result = mysql_query($query2);
            ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <title>Creation Result</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                
					<style>
				
						 h2 {text-align:center;}
            			 h2 {color:#FFFFFF;}
            			 h2 {background-color:#800000;}
            			 h2 {font-size:250%;}
						
						h3
    					{
    					color:maroon;
    					text-align:center;
    					text-decoration:underline;
    					}
					</style>
				</head>
                
				<body>	

				<h2>Registered!</h2><br>
				<h3>Thank you <b><? echo $First_Name; ?></b>, your information has been added to the database, you may now <a href="LoginPage.php" title="Login">log in</a>.</h3>
                
				</body>
            </html>
    <?php
        }

        mysql_close($con);
        ?>
    </body>
</html>
