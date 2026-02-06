<?php
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
?>
<?php
// Récupérer les paramètres GET
$heure = isset($_GET['heure']) ? $_GET['heure'] : null;
$annee = isset($_GET['annee']) ? $_GET['annee'] : null;
$mois = isset($_GET['mois']) ? $_GET['mois'] : null;
$jour = isset($_GET['jour']) ? $_GET['jour'] : null;

if ($heure && $annee && $mois && $jour) {
    echo "<h1>Confirmation de votre rendez-vous</h1>";
    echo "<p>Vous souhaitez prendre rendez-vous le :</p>";
    echo "<ul>";
    echo "<li>Date : " . sprintf("%02d", $jour) . "/" . sprintf("%02d", $mois) . "/" . $annee . "</li>";
    echo "<li>Heure : " . $heure . "</li>";
    echo "</ul>";

    echo "<form method='post' action='updateBDD.php?id=$id'>";
    echo "<input type='hidden' name='heure' value='" . $heure . "'>";
    echo "<input type='hidden' name='annee' value='" . $annee . "'>";
    echo "<input type='hidden' name='mois' value='" . $mois . "'>";
    echo "<input type='hidden' name='jour' value='" . $jour . "'>";
    echo "<input type='submit' name='confirmer_rendezvous' value='Confirmer le rendez-vous'>";
    echo "<a href='CalendrierrdvH.php?id=$id' class='button'> Annuler</a>";
    echo "</form>";
} else {
    echo "<p>Erreur : Informations de rendez-vous manquantes.</p>";
    echo "<a href='Calendrierrdv.php?id=$id'>Retour au calendrier</a>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(111, 158, 225);
        color: white;
        text-align: center;
        padding: 50px;
    }
    
    h1 {
        margin-bottom: 20px;
    }
    
    ul {
        list-style-type: none;
        padding: 0;
    }
    
    li {
        margin: 10px 0;
    }
    
    form {
        margin-top: 20px;
    }
    
    input[type="submit"], button {
        background-color: #0056b3;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    
    input[type="submit"]:hover, button:hover {
        background-color: #004494;
    }
    </style>

<?php
}  else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}
?>