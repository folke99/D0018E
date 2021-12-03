<html>

<head>

    <!-- Remove refresh form -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

</head>

<body>


    <?php
    session_start();
    include('databaseConnection.php');

    $uname = $_SESSION['username'];
    $pID = $_GET["pID"];

    $amount = $_POST["amount"];

    // Get uID
    $uID_res = mysqli_query($conn, "SELECT * FROM users WHERE uUserName = '$uname'");
    while ($row0 = mysqli_fetch_array($uID_res)) {
        $uID = $row0['uID'];
    }

    // Get cID
    $cID_res = mysqli_query($conn, "SELECT cID FROM cart WHERE cuID='$uID'");
    if ($row = mysqli_fetch_array($cID_res)) {
        $cID = $row['cID'];
    }

    //Check if product is already in users cart
    $sameFlag = false;
    $get = mysqli_query($conn,"SELECT cipID FROM cartItem WHERE ciID='$cID'");

    while($row = mysqli_fetch_array($get)) {
      $cipID = $row['cipID'];

      if ($cipID == $pID) {
        $sameFlag = true;
        
        //Update to quantity
        $sql = "UPDATE cartItem SET ciQuantity=ciQuantity+$amount WHERE ciID=$cID AND cipID=$pID";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Item Added!")</script>';
            header("Location:  product.php?pID=$pID");
        } else {
            echo '<script>alert("Failed to add item to cart")</script>';
        }
      }
    }

    //If new item
    if (!$sameFlag) {

        //Add item to shopping cart
        $add = "INSERT INTO cartItem (ciID, cipID, ciQuantity)
          VALUES ($cID, $pID, $amount)";

        if ($conn->query($add) === TRUE) {
            echo '<script>alert("Item Added!")</script>';
            header("Location:  product.php?pID=$pID");
        } else {
            echo '<script>alert("Failed to add item to cart")</script>';
        }
      }


    ?>


</body>

</html>