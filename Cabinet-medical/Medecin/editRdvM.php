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
    <title>Modification de Rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

/* 🌿 Conteneur du formulaire */
.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

/* 🌿 Titres */
h2 {
    color:#d14d30
}

/* 🌿 Champs du formulaire */
label {
    font-weight: bold;
    display: block;
    margin: 10px 0 5px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* 🌿 Bouton */
.btn {
    background:rgb(209, 77, 48);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}

.btn:hover {
    background:rgb(120, 28, 7);
}
  </style>

    <div class="container">
        <h2>Modifier le Rendez-vous</h2>
        
        <form action="rdvM.php" method="POST">
            <!-- Nom du patient (Affiché mais non modifiable) -->
            <label>Nom du Patient :</label>
            <input type="text" value="Idriss El Amrani" readonly>

            <!-- Sélection de la nouvelle date -->
            <label for="date">Nouvelle Date :</label>
            <input type="date" id="date" name="date" required>

            <!-- Sélection de la nouvelle heure -->
            <label for="heure">Nouvelle Heure :</label>
            <input type="time" id="heure" name="heure" required>

            <!-- Bouton de validation -->
            <button type="submit" class="btn">Modifier le Rendez-vous</button>
            <a href="rdvM.php"> <button type="button" class="btn" >Back</button></a>
        </form>
    </div>

</body>
</html>