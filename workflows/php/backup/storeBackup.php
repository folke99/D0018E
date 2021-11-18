<!DOCTYPE html>
<html>

<head>
  <meta name="Store" content="e-commerce" />
  <meta charset="utf-8">
  <title>Store</title>
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/menu.css">
  <link rel="stylesheet" href="../css/grid.css">
  <link rel="stylesheet" href="../css/card.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">

</head>

<body>
  
  <?php
    session_start();

    $servername = "utbweb.its.ltu.se";
    $username = "19980724";
    $password = "19980724";
    $dbName = "db19980724";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $p1 = mysqli_query($conn, "SELECT * FROM products WHERE pID='1'");
    $p2 = mysqli_query($conn, "SELECT * FROM products WHERE pID='2'");
    $p3 = mysqli_query($conn, "SELECT * FROM products WHERE pID='3'");
    $p4 = mysqli_query($conn, "SELECT * FROM products WHERE pID='4'");
    $p5 = mysqli_query($conn, "SELECT * FROM products WHERE pID='5'");
    $p6 = mysqli_query($conn, "SELECT * FROM products WHERE pID='6'");

    while($row1 = mysqli_fetch_array($p1) and
          $row2 = mysqli_fetch_array($p2) and
          $row3 = mysqli_fetch_array($p3) and
          $row4 = mysqli_fetch_array($p4) and
          $row5 = mysqli_fetch_array($p5) and
          $row6 = mysqli_fetch_array($p6)
    ){

      //Product ID 1
      $p1_name = $row1['pName'];
      $p1_price = $row1['pPrice'];
      $p1_description = $row1['pDescription'];
      $p1_img = $row1['pImg'];

      //Product ID 2
      $p2_name = $row2['pName'];
      $p2_price = $row2['pPrice'];
      $p2_description = $row2['pDescription'];
      $p2_img = $row2['pImg'];

      //Product ID 3
      $p3_name = $row3['pName'];
      $p3_price = $row3['pPrice'];
      $p3_description = $row3['pDescription'];
      $p3_img = $row3['pImg'];

      //Product ID 4
      $p4_name = $row4['pName'];
      $p4_price = $row4['pPrice'];
      $p4_description = $row4['pDescription'];
      $p4_img = $row4['pImg'];

      //Product ID 5
      $p5_name = $row5['pName'];
      $p5_price = $row5['pPrice'];
      $p5_description = $row5['pDescription'];
      $p5_img = $row5['pImg'];

      //Product ID 6
      $p6_name = $row6['pName'];
      $p6_price = $row6['pPrice'];
      $p6_description = $row6['pDescription'];
      $p6_img = $row6['pImg'];

    }

    $conn->close();
  ?>

  <header>
    
    <h1> Lorem Ipsum </h1>

  </header>

  <div id="menu">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="../html/login.html" class="menuright">Logout</a></li>
      <li><a href="#" class="img"><img src="../images/cart.png"></a></li>
      <li id="user"> <span></span> User: <?php echo $_SESSION['username'] ?> </li> 
   </ul>
    <p></p> 
  </div>
    

  <div id="content">
    
    <h1 class="space"></h1>

    <div class="gridContainer">
      
      <div class="left">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p1_img ?>" alt="<?php echo $p1_name ?>"></a>
          <h1>
            <?php
              echo $p1_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p1_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p1_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

      <div class="middle">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p2_img ?>" alt="<?php echo $p2_name ?>"></a>
          <h1>
            <?php
              echo $p2_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p2_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p2_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>  

      <div class="right">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p3_img ?>" alt="<?php echo $p3_name ?>"></a>
          <h1>
            <?php
              echo $p3_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p3_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p3_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

    </div> <!-- gridContainer -->


    <div class="gridContainer">
      
      <div class="left">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p4_img ?>" alt="<?php echo $p4_name ?>"></a>
          <h1>
            <?php
              echo $p4_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p4_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p4_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

      <div class="middle">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p5_img ?>" alt="<?php echo $p5_name ?>"></a>
          <h1>
            <?php
              echo $p5_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p5_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p5_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>  

      <div class="right">
        <div class="card">
          <a href="product.php" class="reviewPage"><img src="<?php echo $p6_img ?>" alt="<?php echo $p6_name ?>"></a>
          <h1>
            <?php
              echo $p6_name;
            ?>
          </h1>
          <p class="price">$ 
            <?php  
                echo $p6_price;
            ?> 
          </p>
          <p class="description">
            <?php  
                echo $p6_description;
            ?> 
          </p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

    </div> <!-- gridContainer -->

  </div> <!-- Content -->


  <footer>
    

  </footer>

</body>
</html>