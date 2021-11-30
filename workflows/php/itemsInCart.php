<html>

<head>

</head>

<body>
  
  
<?php 

  include('databaseConnection.php');

  //Get uID
  $uname = $_SESSION['username'];
  $get = mysqli_query($conn,"SELECT uID FROM users WHERE uUserName='$uname'");

  if ($row = mysqli_fetch_array($get)) {
    $uID = $row['uID'];
  }

  //Count
  $count = 0;
  $get = mysqli_query($conn,"SELECT COUNT() FROM cartItem WHERE ciID='$uID'");

  if ($row = mysqli_fetch_array($get)) {
    $pID = $row['pID'];
  }


?>


</body>
</html>