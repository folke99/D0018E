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

    $apples = mysqli_query($conn, "SELECT pPrice FROM products WHERE pName='Apple'");

    $row = mysqli_fetch_array($apples);

    if ($row = $apples->fetch_assoc()) {
      if ($row['pName'] == "Apples") {
        $apples = $row['pPrice'];
      }
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
          <img src="../images/products/apple.png" alt="apples">
          <h1>Apples</h1>
          <p class="price"> 
            <?php  
                echo $row['pPrice'];
            ?> 
          </p>
          <p class="description">Some text about apples..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

      <div class="middle">
        <div class="card">
          <img src="../images/products/banana.png" alt="bananas">
          <h1>Bananas</h1>
          <p class="price">$19.99</p>
          <p class="description">Some text about the bananas..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>  

      <div class="right">
        <div class="card">
          <img src="../images/products/orange.png" alt="oranges">
          <h1>Oranges</h1>
          <p class="price">$19.99</p>
          <p class="description">Some text about the oranges..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

    </div> <!-- gridContainer -->


    <div class="gridContainer">
      
      <div class="left">
        <div class="card">
          <img src="../images/products/pear.png" alt="pear">
          <h1>Pear</h1>
          <p class="price">$1</p>
          <p class="description">Some text about Pear..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

      <div class="middle">
        <div class="card">
          <img src="../images/products/mango.png" alt="mango">
          <h1>Mango</h1>
          <p class="price">$19.99</p>
          <p class="description">Some text about the mangos..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>  

      <div class="right">
        <div class="card">
          <img src="../images/products/kiwi.png" alt="kiwis">
          <h1>Kiwi</h1>
          <p class="price">$19.99</p>
          <p class="description">Some text about the kiwis..</p>
          <p><button>Add to Cart</button></p>
        </div>
      </div>

    </div> <!-- gridContainer -->


  </div> <!-- Content -->


  <footer>
    

  </footer>

</body>
</html>