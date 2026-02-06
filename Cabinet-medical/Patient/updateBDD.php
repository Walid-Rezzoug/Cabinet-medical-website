<?php
require '../Config/db.php';
session_start(); // Start the session
if (!isset($_SESSION['profile_id'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}

    $idp = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $heureSelectionnee = $_POST['heure'];
    $anneeSelectionnee = $_POST['annee'];
    $moisSelectionne = $_POST['mois'];
    $jourSelectionne = $_POST['jour'];
    $stmt2 = $conn->prepare("SELECT IDA FROM année WHERE numA = ?");
    $stmt2->bind_param("s", $anneeSelectionnee); 
    $stmt2->execute();
    $stmt2->bind_result($idannee);
    $stmt2->fetch();
    $stmt2->close();
    if (!$idannee) {
        $stmt = $conn->prepare("INSERT INTO année (numA) VALUES (?)");
        $stmt->bind_param('s', $anneeSelectionnee);
        $stmt->execute();
        $stmt->close();
        $stmt2 = $conn->prepare("SELECT IDA FROM année WHERE numA = ?");
        $stmt2->bind_param("s", $anneeSelectionnee); 
        $stmt2->execute();
        $stmt2->bind_result($idannee);
        $stmt2->fetch();
        $stmt2->close();
    }
    $stmt = $conn->prepare("INSERT INTO rendezvous (IDJ, IDM, IDA, numH,IDP) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siisi", $jourSelectionne, $moisSelectionne, $idannee, $heureSelectionnee, $idp); 
    if ($stmt->execute()) {
       echo"<div class='container'>";
        echo "<h1>Rendez-vous enregistré !</h1>";
        echo "<p>Le rendez-vous est pour le " . sprintf("%02d", $jourSelectionne) . "/" . sprintf("%02d", $moisSelectionne) . "/" . $anneeSelectionnee . " à " . $heureSelectionnee . " a été enregistré.</p>";
        echo "<a href='Calendrierrdv.php?id=$idp'><button>retour</button></a>";
        echo"</div>";
    
    } else {
        echo"<div class='container'>";
        echo "<h1>Erreur lors de l'enregistrement</h1>";
        echo "<p>Impossible d'enregistrer le rendez-vous.</p>";
        echo "<a href='RendezVous.php'>retour</a>";
        echo"</div>";
    }
    $stmt->close();
    $conn->close();
}
?>
<style>
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background: rgb(112, 152, 208);
        text-align: center;
    }
    p{
        color: rgb(0, 0, 0);
    }

    h1 {
        color: rgb(0, 0, 0);
    }

    
    .container {
        width: 80%;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        text-align: left;
    }

    label {
        display: block;
        margin: 10px 0 5px;
        font-weight: bold;
        color:  #0056b3;
    }

    input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="tel"], input[type="time"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .radio-group {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .radio-group label {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    input[type="radio"] {
        width: auto;
        margin-right: 5px;
    }

    button {
        padding: 10px 15px;
        background-color: rgb(4, 4, 4);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: rgb(6, 16, 7);
    }

    .cancelbtn {
        background-color:  #0056b3;
    }

    .cancelbtn:hover {
        background-color: rgb(112, 152, 208);
    }

    a {
        text-decoration: none;
        color: white;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
