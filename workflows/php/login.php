<!DOCTYPE html>
<html>

<head>
	<link rel="icon" href="../images/fruitIcon.png">
	<link rel="stylesheet" href="../css/login.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		html {
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
		$uID = "";
			$user_exist_res[] = "";
			
			include('databaseConnection.php');
			$user_exist = $conn->prepare("SELECT uUserName FROM users WHERE uUserName=?");
			$user_exist->bind_param('s', $uname);
			$user_exist->execute();
			$user_exist->bind_result($unames);
			//echo $user_exist->fetch();
	        while ($user_exist->fetch()) {
	        	
	        	array_push($user_exist_res, $unames);

	        }

			if(count($user_exist_res)>1){
			//GET PASSWORD FROM DATABASE TABLE

			$result = mysqli_query($conn, "SELECT uPassword FROM users WHERE uUserName='$uname'");
			if ($row = $result->fetch_assoc()) {

				if ($row['uPassword'] == $psw) {

					$_SESSION['username'] = $uname;
					header("Location: store.php");
				} else {
					echo "<h1 style='color:white'>Wrong password</h1>";
					echo '<a href="../html/login.html">
        						<button class="loginButton" type="submit">Return</button> 
        					  </a>';
				}
			}
		} else {
			echo "<h1 style='color:white'>User not found</h1>";
		}


		$conn->close();
		?>


	</center>
</body>

</html>