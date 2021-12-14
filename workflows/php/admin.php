<!DOCTYPE html>
<html>

<head>
  <meta name="Store" content="e-commerce" />
  <meta charset="utf-8">
  <link rel="icon" href="../images/fruitIcon.png">
  <title>Admin</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/menu.css">
  <link rel="stylesheet" href="../css/grid.css">
  <link rel="stylesheet" href="../css/card.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">

  <style type="text/css">
    form{
      padding-left: 30pt;
      padding-bottom: 30pt;
    }
    #addNewProduct{
      background-color: grey;
      width: 40%;
      float: left; 
    }
    #removeProductDiv{
      width: 28%;
      background-color: grey;
      margin-left: 10pt;
      float: left;
    }
    h3, h4{
      text-align: center;
      margin-top: 15pt;
    }

    #removeProductDiv ul{
      background-color: grey;
    }

    #removeProductDiv ul li{
      display: block;
      clear: both;


  </style>

</head>

<body>
  
  <?php
    include('databaseConnection.php');
    session_start();
    $uname = $_SESSION['username'];
    $admin = mysqli_query($conn, "SELECT uIsAdmin FROM users WHERE uUserName='$uname'");
    while($adminRow = mysqli_fetch_array($admin))
    {
      $adminCheck = $adminRow['uIsAdmin'];
    }
    include('adminAndBalanceCheck.php');
  ?>

  <header>
    
    <h1> Admin </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="store.php">Home</a></li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
      <?php 
      if ($adminCheck == 1) {
        echo "<li><a href='../php/admin.php' class='menuright'>ADMIN</a></li>";
      }
      ?> 
      <li><a href="shoppingCart.php" class="img"><img src="../images/cart.png"></a></li>
      <li> Items in cart: <?php include('itemsInCart.php'); ?> </li>
      <li> <span></span> Balance: $<?php echo $balanceCheck; ?> </li>
      <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li>
   </ul>
    <p></p> 
  </div>

  <div id="content">
    <div id="addNewProduct">
      <h3> Add Product </h3>
      <form action="addProduct.php" method="POST" enctype="multipart/form-data">
        <div class="pName">
          <label for="pName"><h2>Product Name</h2></label>
          <input type="text" placeholder="Enter product name" name="pName" required>
        </div>
        <div class="pPrice">
          <label for="pPrice"><h2>Price</h2></label>
          <input type="text" placeholder="Enter product price" name="pPrice" required>
        </div>
        <div class="pStock">
          <label for="pStock"><h2>Stock</h2></label>
          <input type="number" placeholder="Enter product stock" name="pStock" required>
        </div>
        <div class="pDescription">
          <label for="pDescription"><h2>Description</h2></label>
          <input type="textarea" placeholder="Enter product description" name="pDescription">
        </div>
        <br>
        
        <div>
          <label for="img">Select image:</label>
          <input type="file" name="img" value=""/>
        </div>

        <br>
        <div class="createProduct">
          <button class="createProduct" type="submit" name="upload">Add product</button>
        </div>
      </form>
    </div>

    <div id="removeProductDiv">
      <h3> Remove Product </h3>
      <form action="removeProduct.php">
        <div class="pID">
            <label for="pID"><h2>Product ID</h2></label>
            <input type="text" placeholder="Enter product ID" name="pID" required>
        </div>
        <br>
        <button class="removeProductButton" type="submit">Remove product</button>
      </form>
      <h4> List of avalible products </h4>
      <?php include('listProducts.php'); ?>
      <span></span>
    </div>

    <div id="removeProductDiv">
      <h3> Remove user </h3>
      <form action="removeAccount.php">
        <div class="uID">
            <label for="uID"><h2>User ID</h2></label>
            <input type="text" placeholder="Enter user ID" name="uID" required>
        </div>
        <br>
        <button class="removeUserButton" type="submit">Remove user</button>
      </form>
    </div>
    <div id="removeProductDiv">
      <h3> Change stock </h3>
      <form action="addStock.php">
        <div class="pID">
            <label for="pID"><h2>Product ID</h2></label>
            <input type="text" placeholder="Enter product ID" name="pID" required>
            <label for="pStock"><h2>New stock value</h2></label>
            <input type="text" placeholder="Enter user ID" name="pNewStock" required>
        </div>
        <br>
        <button class="removeUserButton" type="submit">Add stock</button>
      </form>
    </div>

  </div>

  <footer>
    

  </footer>

</body>
</html>