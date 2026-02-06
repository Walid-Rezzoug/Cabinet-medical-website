<?php
$servername = "127.0.0.1";
$username = "root"; 
$password = ""; 
$dbname = "cabinet_sbr";
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
} catch(Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start(); //IMPORTANT and MANDATORY
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $post_type = $_POST['account_type'];
    $stmt = $conn->prepare("SELECT ID, password FROM Patient WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            // Redirect based on profile type
             // Store email in session
            $UserType = $row['UserType'];
            $id = $row['id'];
            $_SESSION['profile_id'] = $row['ID'];
            header("Location:../Patient/dashboardP.php?id={$row['ID']}");
            $stmt->close();
            $conn->close();
            exit();
        } else {
            echo "Invalid email or password.";
        }
    } else {
        header("Location: ../page%20acceuil/page acceuilE.php");
    }
    header("Location: ../page%20acceuil/page acceuilE.php"); // Redirect after 5 seconds
    
} else {
    echo "Invalid request method.";
}