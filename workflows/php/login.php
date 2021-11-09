<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/login.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
        	html{
        		padding-top: 10%;
        	}

        </style>
    </head>
    <body>
        <center>
        <?php
        	$uname = $_GET["uname"];
			$psw = $_GET["psw"];
			$servername = "utbweb.its.ltu.se";
			$username = "19980724";
			$password = "19980724";
			$dbName = "db19980724";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbName);
			// Check connection
			if ($conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}

			//Looks for usename in table
			$user_exist = "SELECT uUserName FROM users WHERE uUserName='$uname'";
			$user_exist_res = $conn->query($user_exist);

			//Checks if user exists
			if($user_exist_res->num_rows > 0){

				//GET PASSWORD FROM DATABASE TABLE

				if( [CHECK IF PASSWORD MATCH] ){
					echo "<h1 style='color:white'>Success!</h1>";
					//href to store page
				}
				else{
					echo "<h1 style='color:white'>Wrong password</h1>";
				}					

			}
			else{
				echo "<h1 style='color:white'>User not found</h1>";
			}


			$conn->close();
		?>
		
		<!--<a href="../html/index.html">
        	<button class="loginButton" type="submit">Login</button> 
        
        </a>-->
        </center>
    </body>
</html>