<html>

<head>

<!-- Remove refresh form -->
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</head>

<body>
  
  
<?php 
session_start();
include('databaseConnection.php');
$uname = $_SESSION['username'];


?>


</body>
</html>