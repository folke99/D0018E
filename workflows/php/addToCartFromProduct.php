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


    //Get stock of the product
    $get = mysqli_query($conn,"SELECT pStock FROM products WHERE pID='$pID'");

    if ($row = mysqli_fetch_array($get)) {
      $pStock = $row['pStock'];
    }




    //Check if product is already in users cart
    $sameFlag = false;
    $get = mysqli_query($conn,"SELECT cipID FROM cartItem WHERE ciID='$cID'");

    while($row = mysqli_fetch_array($get)) {
      $cipID = $row['cipID'];

      if ($cipID == $pID) {
        $sameFlag = true;


        //Get the quantity the user has of the product from before
        $get = mysqli_query($conn,"SELECT ciQuantity FROM cartItem WHERE ciID=$cID AND cipID=$pID");

        if ($row = mysqli_fetch_array($get)) {
          $ciQuantity = $row['ciQuantity'];
        }


         if (($amount + $ciQuantity) <= $pStock) {
        

            //Update to quantity
            $sql = "UPDATE cartItem SET ciQuantity=ciQuantity+$amount WHERE ciID=$cID AND cipID=$pID";

            if ($conn->query($sql) === TRUE) {
                //echo '<script>alert("Item Added!")</script>';
                echo '<script>';
                echo 'window.location = "product.php?pID='; echo $pID; echo '"';
                echo '</script>';

            } else {
                echo '<script>alert("Failed to add item to cart")</script>';
            }
        }
        else{
            echo '<script>alert("Not enough in stock")</script>';
            header("Location:  product.php?pID=$pID");
        }

      }
    }

    //If new item
    if (!$sameFlag) {

        if ($amount <= $pStock) {

            //Add item to shopping cart
            $add = "INSERT INTO cartItem (ciID, cipID, ciQuantity)
              VALUES ($cID, $pID, $amount)";

            if ($conn->query($add) === TRUE) {
                //echo '<script>alert("Item Added!")</script>';
                echo '<script>';
                echo 'window.location = "product.php?pID='; echo $pID; echo '"';
                echo '</script>';
            } 
            else {
                echo '<script>alert("Failed to add item to cart")</script>';
            }

        }
        else{
            echo '<script>alert("Not enough in stock")</script>';
            header("Location:  product.php?pID=$pID");
        }


      }


    ?>


</body>

</html>