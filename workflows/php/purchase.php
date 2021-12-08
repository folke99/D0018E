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
    //error_reporting(error_reporting() & ~E_NOTICE);

    $array = array();

    if (isset($_POST['submit'])) {

        $conn->begin_transaction();

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
            if ($row2 = mysqli_fetch_array($productInfo)) {
                $pName = $row2['pName'];
                $pPrice = $row2['pPrice'] * $quantity;
                $pStock = $row2['pStock'];
                $totalPrice += $pPrice;
            }

            $newQuantity = $pStock - $quantity;
            $updateStock = mysqli_query($conn, "UPDATE products 
                SET pStock = '$newQuantity'
                WHERE pID = '$cipID' ");
        }

        for ($i = 0; $i < sizeof($array); $i += 2) {
            $temp1 = $array[$i];
            $temp2 = $array[$i + 1];
            $delete = mysqli_query($conn, "DELETE FROM cartItem WHERE ciID = '$temp1' and cipID = '$temp2'");
        }

        $newBalance = $uBalance - $totalPrice / 2;

        try {
            if($uBalance < ($totalPrice / 2)) {
                throw new Exception;
            }
            $updateBalance = mysqli_query($conn, "UPDATE users
            SET uBalance = '$newBalance'
            WHERE uID = '$uID' ");
        } catch (Exception $e){
            echo 'Not enough money';
            $conn->rollback();
        }

        if ($conn->query($delete) == TRUE) {
            $conn->rollback();
            echo '<script>alert("Error")</script>';
        } else {
            $conn->commit();
            echo '<script>';
            echo 'window.location = "shoppingCart.php"';
            echo '</script>';
        }
    }

    ?>

</body>

</html>