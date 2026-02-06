<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['profile_id'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($id != $_SESSION['profile_id']) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM Patient WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
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
            background-color:rgb(188, 236, 211);
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
            color:#05a553
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
            background-color: #05a553;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #2a7d2e;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Ajouter une Facture</h2>
        <form action="Factures.php" method="post">
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
           
            <button type="submit">Ajouter la Facture</button><br>
            <a href="Factures.php"> <button type="button" class="button3" >Cancel</button></a>
        </form>
    </div>

</body>
</html>
<?php
} else {
        echo "Patient not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}

$conn->close();
?>