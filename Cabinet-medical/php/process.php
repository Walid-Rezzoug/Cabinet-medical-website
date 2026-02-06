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
    session_start();
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $post_type = $_POST['account_type'];
    $stmt = $conn->prepare("SELECT ID, password, UserType FROM staff WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if(password_verify($password, $row['password'])) {
            // Redirect based on profile type
            $UserType = $row['UserType'];
            $id = $row['id'];
            switch ($UserType) {
                case 2: //for doctor
                    $_SESSION['mama'] = $row['ID'];
                    header("Location:../Medecin/dashboardM.php?id={$row['ID']}");
                    break;
                case 1: //for assistant
                    $_SESSION['mimi'] = $row['ID'];
                    header("Location:../Assistant/dashboardA.php?id={$row['ID']}");
                    break;
            }
            $stmt->close();
            $conn->close();
            exit();
        } else {
            header("Location:../page acceuil/page acceuilE.php");
        }
    } else {
        header("Location:../page acceuil/page acceuilE.php");
    }

} else {
    echo "Invalid request method.";
}