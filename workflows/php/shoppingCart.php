<!DOCTYPE html>
<html>

<head>
    <meta name="shoppingCart" content="e-commerce" />
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/shoppingCart.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/card.css">
</head>

<body>

    <?php
    session_start();
    include('databaseConnection.php');
    $uname = $_SESSION['username'];

    //Get user ID
    $uID_res = mysqli_query($conn, "SELECT * FROM users WHERE uUserName = '$uname'");
    while ($row0 = mysqli_fetch_array($uID_res)) {
        $uID = $row0['uID'];
        $uBalance = $row0['uBalance'];
    }
    echo $uBalance;
    echo $uID;
    ?>

    <header>

        <h1> Shopping Cart </h1>

    </header>

    <div id="menu">
        <ul>
            <li><a href="store.php">Home</a></li>
            <li><a href="../html/login.html" class="menuright">Logout</a></li>
            <li><a href="shoppingCart.php" class="img"><img src="../images/cart.png"></a></li>
            <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li>
        </ul>
        <p></p>
    </div>

    <div id="content">

        <?php
        error_reporting(error_reporting() & ~E_NOTICE);

        $nrOfItems =  mysqli_query($conn, "SELECT COUNT(*) FROM cartItem WHERE ciID=$uID");
        while ($row = mysqli_fetch_array($nrOfItems)) {
            $max = $row['COUNT(*)'];
        }

        $cart = mysqli_query($conn, "SELECT * FROM cartItem WHERE ciID=$uID");
        while ($row1 = mysqli_fetch_array($cart)) {
            //Product ID i
            $ciID = $row1['ciID'];
            $cipID = $row1['cipID'];
            $quantity = $row1['ciQuantity']; 

            $productInfo = mysqli_query($conn, "SELECT * FROM products WHERE pID=$cipID");
            while ($row2 = mysqli_fetch_array($productInfo)) {
                $pName = $row2['pName'];
                $pPrice = $row2['pPrice'] * $quantity;
                $totalPrice += $pPrice;
echo <<<HTML
        <div class="gridContainer">
            <div class="items">
                <div class="card">
                  <p class="price">      Price: $pPrice</p>
                  <p class="description">Name: $pName Quantity: $quantity</p>
                </div>
            </div>
        </div>
HTML;
            }
        }
echo <<<HTML
        <form method="POST">
            <div class="checkout">
                <p> Purchase </p>
                <p> Total Price: $totalPrice </p>
                <button type="submit" name="submit" value="submit"> Purchase </button>
            </div>
        </form>
HTML;
        include('purchase.php');
        ?>
    </div>
</body>

</html>