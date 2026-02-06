<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL server.\n";

// Create database if not exists
$dbname = "cabinet_sbr";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' verified (created if it didn't exist).\n";
} else {
    echo "Error creating database: " . $conn->error . "\n";
}

$conn->select_db($dbname);

// Check if tables exist
$result = $conn->query("SHOW TABLES LIKE 'staff'");
if ($result->num_rows == 0) {
    echo "Base tables (e.g. 'staff') not found. Please import 'cabinet.sql'.\n";
    // Hint: we could try to read and execute the SQL file, but big dumps can be tricky in PHP without a parser.
    // Given the complexity of splitting SQL commands, it is safer to ask the user to import it via phpMyAdmin or command line.
    echo "You can import the database by running: mysql -u root $dbname < cabinet.sql\n";
} else {
    echo "Database seems to be populated (table 'staff' exists).\n";
}

$conn->close();
?>
