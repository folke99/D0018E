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
    include('databaseConnection.php');
    $uname = $_SESSION['username'];
    error_reporting(error_reporting() & ~E_NOTICE);

    $array = array();

    if (isset($_POST['submit'])) {
        $sql = "START TRANSACTION";

        // Get all nessesary values
        $nrOfItems =  mysqli_query($conn, "SELECT COUNT(*) FROM cartItem WHERE ciID=$uID");
        while ($row = mysqli_fetch_array($nrOfItems)) {
            $max = $row['COUNT(*)'];
        }

        $cart = mysqli_query($conn, "SELECT * FROM cartItem WHERE ciID=$uID");
        while ($row1 = mysqli_fetch_array($cart)) {
            $ciID = $row1['ciID'];
            $cipID = $row1['cipID'];
            $quantity = $row1['ciQuantity'];
            array_push($array, $ciID);
            array_push($array, $cipID);

            $productInfo = mysqli_query($conn, "SELECT * FROM products WHERE pID=$cipID");
            while ($row2 = mysqli_fetch_array($productInfo)) {
                $pName = $row2['pName'];
                $pPrice = $row2['pPrice'] * $quantity;
                $totalPrice += $pPrice;
            }

            $sql = "UPDATE products 
                    SET stock -= $quantity
                    WHERE id = $cipID ";
        }

        //echo 'Storlek: '. sizeof($array);
        for ($i = 0; $i < sizeof($array); $i += 2) {
            echo ' i: ' . $array[$i] . $array[$i + 1];
            $temp1 = $array[$i];
            $temp2 = $array[$i + 1];
            $delete = mysqli_query($conn, "DELETE FROM cartItem WHERE ciID = '$temp1' and cipID = '$temp2'");
        }

        $sql = "UPDATE users
            SET balance -= $totalPrice
            WHERE uID = $uID ";

        if ($conn->query($delete) == TRUE) {
            echo '<script>alert("True")</script>';
        } else {
            echo '<script>alert("Not true")</script>';
            header("Location:  shoppingCart.php");
        }
    }

    ?>

</body>

</html>