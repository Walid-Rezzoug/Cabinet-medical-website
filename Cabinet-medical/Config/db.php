<?php 
// Local setup
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "cabinet_sbr";

// Remote setup (commented out)
// $servername = "sql303.infinityfree.com";
// $username = "if0_38944637"; 
// $password = "0BKF13rGPdutTr"; 
// $dbname = "if0_38944637_XXX";

// Create connection
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
}catch(Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>