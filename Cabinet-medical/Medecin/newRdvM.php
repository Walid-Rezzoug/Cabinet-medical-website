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
    <title>Ajouter un Rendez-vous</title>
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

/* 📌 Conteneur du formulaire */
.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
    display:grid;
            place-items:center;
}

/* 📌 Titres */
h2 {
    color: #d14d30; /* Vert */
}

/* 📌 Champs du formulaire */
label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* 📌 Bouton */
button {
    background:rgb(209, 77, 48);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background:rgb(120, 28, 7);
}

</style>
    <div class="container">
        <h2>Ajouter un Rendez-vous</h2>
        <form action="rdvM.php" method="POST">
            <label for="nom">Nom du Patient :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="date">Date de Consultation :</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Ajouter Rdv</button><br>
            <a href="rdvM.php"> <button type="button" class="button" >Back</button></a>
        </form>
    </div>

</body>
</html>
