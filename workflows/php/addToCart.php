<html>

<head>

<!-- Remove refresh form -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</head>

<body>
  
  
<?php 

  include('databaseConnection.php');

  //Break flag
  $break = false;

  //Check what button has been clicked

  for ($i=0; $i < $max; $i++) { 
    
    $result =  mysqli_query($conn,"SELECT pName FROM products");

    if ($break == true) {
      break;
    }

    while($row = mysqli_fetch_array($result)){

      if(isset($_POST[$row['pName']."Button"])){

        $pName = $row['pName'];

        //echo $pName;

        //Get pID
        $get = mysqli_query($conn,"SELECT pID FROM products WHERE pName='$pName'");

        if ($row = mysqli_fetch_array($get)) {
          $pID = $row['pID'];
        }

        //echo $pID;


        //Get uID
        $uname = $_SESSION['username'];
        $get = mysqli_query($conn,"SELECT uID FROM users WHERE uUserName='$uname'");

        if ($row = mysqli_fetch_array($get)) {
          $uID = $row['uID'];
        }

        //echo $uID;

        //Get cID (The cart connected to the user)
        $get = mysqli_query($conn,"SELECT cID FROM cart WHERE cuID='$uID'");

        if ($row = mysqli_fetch_array($get)) {
          $cID = $row['cID'];
        }

        //echo $cID;
        


        //Add item to shopping cart
        $add = "INSERT INTO cartItem (ciID, cipID, ciQuantity)
          VALUES ($uID, $pID, 1)";

        if ($conn->query($add) === TRUE) {
            echo '<script>alert("Item Added!")</script>';
        } else {
            echo '<script>alert("Failed to add item to cart")</script>';
        }


        $break = true;
        break;
      }

    }

  }



?>


</body>
</html>