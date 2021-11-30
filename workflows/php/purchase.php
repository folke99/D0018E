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

            $productInfo = mysqli_query($conn, "SELECT * FROM products WHERE pID=$cipID");
            while ($row2 = mysqli_fetch_array($productInfo)) {
                $pName = $row2['pName'];
                $pPrice = $row2['pPrice'] * $quantity;
                $totalPrice += $pPrice;

                $sql = "UPDATE products 
                    SET stock -= $quantity
                    WHERE id = $cipID ";

                $sql = "DELETE FROM cartItem WHERE ciID = $ciID and cipID = $cipID";
            }
        }
        $sql = "UPDATE users
            SET balance -= $totalPrice
            WHERE uID = $uID ";

        if ($conn->query($add) === TRUE) {
            echo '<script>alert("Items Purchased!")</script>';
        } else {
            echo '<script>alert("Failed to purchase item")</script>';
        }
    }

    ?>


</body>

</html>