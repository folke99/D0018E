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
        	session_start();

        	$uname = $_POST["uname"];
			$psw = $_POST["psw"];
			$servername = "utbweb.its.ltu.se";
			$username = "19980724";
			$password = "";
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

				$result = mysqli_query($conn, "SELECT uPassword FROM users WHERE uUserName='$uname'");
                if ($row = $result->fetch_assoc()) {

                    if( $row['uPassword'] == $psw ){

                    	$_SESSION['username'] = $uname;
						header("Location: store.php");
					}
					else{
						echo "<h1 style='color:white'>Wrong password</h1>";
						echo '<a href="../html/login.html">
        						<button class="loginButton" type="submit">Return</button> 
        					  </a>';
					}

                }

			}
			else{
				echo "<h1 style='color:white'>User not found</h1>";
			}


			$conn->close();
		?>
		
		
        </center>
    </body>
</html>