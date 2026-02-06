<?php
require '../Config/db.php';
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
    color:rgb(192, 61, 32); /* Vert */
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
    background-color:rgb(192, 61, 32);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}
 .button2 {
    background-color:rgb(192, 61, 32);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}
select {
  appearance: none; /* Supprime l'apparence par défaut du navigateur */
  padding: 10px 30px 10px 15px; /* Ajoute un peu d'espace autour du texte */
  border: 1px solid #ccc; /* Ajoute une bordure subtile */
  border-radius: 5px; /* Arrondit légèrement les coins */
  background-color: #f9f9f9; /* Une couleur de fond claire */
  font-size: 16px; /* Taille de la police */
  color: #333; /* Couleur du texte */
  /* Style pour la flèche du menu déroulant (la personnalisation peut varier selon le navigateur) */
  background-image: url('data:image/svg+xml;utf8,<svg fill="#333" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/><path d="M0 0h24v24H0z" fill="none"/></svg>');
  background-repeat: no-repeat;
  background-position: right 10px center;
  cursor: pointer; /* Indique que l'élément est interactif */
}

/* Style lorsque le select est au focus */
select:focus {
  border-color:rgb(192, 61, 32); /* Change la couleur de la bordure au focus */
  outline: none; /* Supprime l'outline par défaut du navigateur */
  box-shadow: 0 0 5px rgb(168, 53, 27); /* Ajoute une ombre légère au focus */
}

/* Style pour les options (peut être limité selon le navigateur) */
select option {
  padding: 8px 15px;
  background-color: #fff;
  color: #333;
}

select option:hover {
  background-color: #eee;
}


</style>
    <div class="container">
        <h2>Selectionner le Patient</h2>
        <form action="nvrdv.php" method="POST">
            <label for="nom">Nom des Patient :</label>
            <select id="nom" name="nom" required>
                <?php
                $patientQuery = $conn->query("SELECT ID, Name,surname FROM patient");
                while ($patient = $patientQuery->fetch_assoc()) {
                    echo "<option value='" . $patient['ID'] . "'>" . htmlspecialchars($patient['Name']).htmlspecialchars($patient['surname']) . "</option>";
                }
                ?>
            </select>
            <button type="submit">confirmer</button><br>
        </form>
        <a href="rdvM.php" type="button"><button class="button2">Retour</button></a>
    </div>

</body>
</html>