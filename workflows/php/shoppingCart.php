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
    $uID_res = mysqli_query($conn, "SELECT uID FROM users WHERE uUserName = '$uname'");
    while ($row0 = mysqli_fetch_array($uID_res)) {
        $uID = $row0['uID'];
    }
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
                $nrOfItems =  mysqli_query($conn,"SELECT COUNT(*) FROM cartitem WHERE ciID=$uID");

                while($row = mysqli_fetch_array($nrOfItems)){
                    $max = $row['COUNT(*)'];
                }
                $i=1;
                $ciID = 0;
                $cipID = 0;
                $cart = mysqli_query($conn, "SELECT * FROM cartitem WHERE ciID=$uID");

                while($row1 = mysqli_fetch_array($cart))
                {
                    //Product ID i
                    $ciID = $row1['ciID'];
                    $cipID = $row1['cipID'];
                    // QUANT $p1_price = $row1['pPrice']; 
echo <<<HTML
        <div class="gridContainer">
            <div class="items">
                <div class="card">
                  <p class="price">      ciID: $ciID</p>
                  <p class="description">cipID: $cipID</p>
                </div>
            </div>
            <div class="checkout">
                <p>aolsfiukhalsfijasöodm </p>
            </div>
        </div>
HTML;
                
                } 
            ?>

    </div>
</body>
</html>