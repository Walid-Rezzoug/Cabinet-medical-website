<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if (isset ($_GET['idp'])) {
    $idp = $_GET['idp'];
} else {
    header("Location: rendez-vous.php?id=$id");
    exit(); // Redirect to login page if not logged in
}
if (isset($_GET['idr'])) {
    $idr = $_GET['idr'];
} else {
    header("Location: rendez-vous.php?id=$id");
    exit(); // Redirect to login page if not logged in
 }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
            $stmt = $conn->prepare("DELETE FROM rendezvous WHERE IDP = ? AND IDH = ?");
            $stmt->bind_param("ii", $idp, $idr);
            if ($stmt->execute()) {
                $message = "Appointment deleted successfully.";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $stmt->close();
            header("Location: rdvM.php"); // Redirect to the appointment page after deletion
        }
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Déconnexion</title>
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
        .cancel {
            background-color:rgb(26, 28, 32);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
     <form method="post">
            <h2>Are you sure you want to delete appointement?</h2>
            <button type="submit" class="confirm" name="confirm">Delete</button>
     </form>
     <?php echo "<a  href='rdvM.php'><button class='cancel'>Cancel</button></a>"; ?>
    </div>
</body>
</html>