<?php
session_start(); // Start the session
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
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
        <h2>Voulez-vous vraiment vous déconnecter ?</h2>
        <a href="../php/confirmlogout.php"><button class="confirm" type=button>me déconnecter</button></a>
        <a href="profilM.php"><button class="cancel" type=button>Annuler</button></a>
    </div>
</body>
</html>