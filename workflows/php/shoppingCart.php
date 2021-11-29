<!DOCTYPE html>
<html>

<head>
    <meta name="shoppingCart" content="e-commerce" />
    <meta charset="utf-8">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../css/shoppingCart.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/style.css">
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

        <h1> Lorem Ipsum </h1>

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
        <div class="gridContainer">
            <?php
            
            

            echo <<<HTML
            <div class="items">
                
            </div>

            <div class="checkout">
                
            </div>
            HTML;
            ?>
        </div>

    </div>

</body>

</html>