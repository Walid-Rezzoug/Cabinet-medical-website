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
    <title>Ajout de Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(228, 149, 148);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 350px;
            display:grid;
            place-items:center;
        }

        h2 {
            text-align: center;
            color:#d14d30
        }

        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .checkbox-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        button {
            width: 100%;
            padding: 10px;
            background:rgb(209, 77, 48);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background:rgb(120, 28, 7);
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Ajouter une Facture</h2>
        <form action="Facture.php" method="post">
            <!-- Sélection du patient -->
            <label for="patient">Nom du Patient :</label>
            <input type="text" id="patient" name="patient" required value="Idriss El Amrani">

            <!-- Date de consultation -->
            <label for="date">Date de consultation :</label>
            <input type="date" id="date" name="date" required>

            <!-- Montant -->
            <label for="montant">Montant (€) :</label>
            <input type="number" id="montant" name="montant" step="0.01" min="0" required>

            <!-- Case à cocher "Payé" -->
            <div class="checkbox-container">
                <input type="checkbox" id="paye" name="paye">
                <label for="paye">Payé</label>
            </div>

            <!-- Bouton Ajouter -->
            <button type="submit">Ajouter la Facture</button>
            <a href="Facture.php"> <button type="button" class="button" >Back</button></a>
        </form>
    </div>

</body>
</html>