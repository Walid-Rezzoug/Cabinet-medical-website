<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
    if (isset ($_GET['idr'])) {
        $idr = $_GET['idr'];
    } else {
        header("Location: rendez-vous.php?id=$id");
        exit(); // Redirect to login page if not logged in
    }
?>
<?php
// Récupérer les paramètres GET
$heure = isset($_GET['heure']) ? $_GET['heure'] : null;
$annee = isset($_GET['annee']) ? $_GET['annee'] : null;
$mois = isset($_GET['mois']) ? $_GET['mois'] : null;
$jour = isset($_GET['jour']) ? $_GET['jour'] : null;

if ($heure && $annee && $mois && $jour) {
    echo "<h1>Confirmation de modification rendez-vous</h1>";
    echo "<ul>";
    echo "<li>Date : " . sprintf("%02d", $jour) . "/" . sprintf("%02d", $mois) . "/" . $annee . "</li>";
    echo "<li>Heure : " . $heure . "</li>";
    echo "</ul>";

    echo "<form method='post' action='updaterdv1.php?idr=$idr'>";
    echo "<input type='hidden' name='heure' value='" . $heure . "'>";
    echo "<input type='hidden' name='annee' value='" . $annee . "'>";
    echo "<input type='hidden' name='mois' value='" . $mois . "'>";
    echo "<input type='hidden' name='jour' value='" . $jour . "'>";
    echo "<input type='submit' name='confirmer_rendezvous' value='Confirmer le rendez-vous'>";
    echo "</form>";
    echo "<a href='modif1.php?idr=$idr'><button>Annuler</button></a>";
} else {
    echo "<p>Erreur : Informations de rendez-vous manquantes.</p>";
    echo "<a href='rdvM.php'><button>Retour</button></a>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(228, 149, 148);
        color: white;
        text-align: center;
        padding: 50px;
    }
    
    h1 {
        margin-bottom: 20px;
        color:rgb(0, 0, 0);
    }
    
    ul {
        list-style-type: none;
        padding: 0;
    }
    p{
        color:rgb(0, 0, 0);
    }
    
    li {
        margin: 10px 0;
        color:rgb(0, 0, 0);
    }
    
    form {
        margin-top: 20px;
    }
    
    input[type="submit"], button {
        background-color:rgb(192, 61, 32);
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>