<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../css/createAccount.css">
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
			$uname 	  = $_GET["uname"];
			$psw 	  = $_GET["psw"];
			$admin 	  = $_GET["admin"];
			$uBalance = $_GET["uBalance"];
			
			include('databaseConnection.php');

			//Looks for usename in table
			$user_exist = $conn->prepare("SELECT uUserName FROM users WHERE uUserName=?");
			$user_exist->bind_param('s', $uname);
			$user_exist->execute();

			if ($row = mysqli_fetch_array($user_exist)){
			          $user_exist_res = $row['uUserName'];
			}

			if (!$user_exist) {
			    printf("Error: %s\n", mysqli_error($conn));
			    exit();
			}
			//$user_exist_res = mysqli_fetch_array($user_exist);

			//Checks if username is already in use
			if($user_exist_res->num_rows == 0){

				$sql = $conn->prepare("INSERT INTO users (uUserName, uPassword, uIsAdmin, uBalance)
				VALUES (?, ?, ?, ?)");
				$sql->bind_param('ssii', $uname, $psw ,$admin ,$uBalance);
				$sql->execute();

				if ($sql == TRUE) {
					//Create a shopping cart for the user
					$get = $conn->prepare("SELECT uID FROM users WHERE uUserName=?");
					$get->bind_param('s', $uname);
					$get->execute();

			        if ($row = mysqli_fetch_array($get)) {
			          $uID = $row['uID'];
			        }

			        $add = "INSERT INTO cart (cuID)
			          VALUES ($uID)";

			         if ($conn->query($add) === TRUE) {
			        } else {
			        }

					header("Location:  ../html/login.html");
				} else {
				  	echo "<h1 style='color:white>Failed to create account</h1>";
				}

			}
			else{
				echo "<h1 style='color:white'>Username already in use</h1>";
			}
			

			$conn->close();
		?>
        </center>
    </body>
</html>