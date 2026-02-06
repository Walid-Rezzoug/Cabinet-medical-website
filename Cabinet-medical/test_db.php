<?php
require_once 'Config/db.php';

if ($conn->connect_error) {
    echo "Connection failed: " . $conn->connect_error;
} else {
    echo "Connected successfully to database: " . $dbname;
}
?>
