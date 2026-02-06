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
        $stmt = $conn->prepare("DELETE FROM Consultation WHERE IDC = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Consultation deleted successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }
        $stmt->close();
        if(isset($_GET['idp'])){
            $idp = $_GET['idp'];
            header("Refresh: 5; Consultation.php?id={$idp}"); // Redirect to Consultation page with idp
        } else {
            header("Refresh: 5; Consultation.php"); // Redirect to Consultation page without idp
        }
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
    <title>Confirmation de supression Consultation</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: rgb(228, 149, 148);
        }
        .container {
            background: rgb(209, 77, 48);
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
            background: red;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: rgb(26, 28, 32);
            color: white;
            display: inline-block;
        }
        .message {
            margin-bottom: 20px;
            font-size: 18px;
            color: green;
        }
    </style>
    <?php if (!empty($message)): ?>
        <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <div class="container">
        <form method="post">
            <p>Are you sure you want to delete this Consultation?</p>
            <button type="submit" name="confirm">Yes, Delete</button>
            <?php if(isset($_GET['idp'])){
                $idp = $_GET['idp'];
                echo "<a href='Consultation.php?id={$idp}'>Cancel</a>";
            } else {
                echo "<a href='Consultation.php'>Cancel</a>";
            } ?>
        </form>
    </div>
</body>
</html>