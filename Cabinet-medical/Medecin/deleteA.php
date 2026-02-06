<?php
require '../Config/db.php'; // Include database connection
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
$message = ""; // Initialize message variable

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
        $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            $message = "Assistant deleted successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
        header("Refresh: 5; URL=Assistant.php"); // Redirect after 5 seconds
        $message .= " You will be redirected in 5 seconds...";
    }
} else {
    $message = "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de supression Assistant</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color:rgb(228, 149, 148);
        }
        .container {
            background:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .confirm {
            background: red;
            color: white;
        }
        h2{
            color:rgb(209, 48, 11);
        }
        .delete {
            background-color:rgb(209, 48, 11);
            color: white;
        }
        .cancel {
            background-color:rgb(26, 28, 32);
            color: white;
        }
    </style>
</head>
<body>
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <div class="container">
        <form method="post">
            <h2>Are you sure you want to delete this Assistant?</h2>
            <button type="submit" name="confirm" class="delete">Delete</button>
            
        </form>
        <a href="Assistant.php"><button class="cancel">Cancel</button></a>
    </div>
</body>
</html>