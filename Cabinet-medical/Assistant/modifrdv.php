<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['mimi'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id != $_SESSION['mimi']) {
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
    echo "<h1>Confirmation de modification de rendez-vous</h1>";
    echo "<ul>";
    echo "<li>Date : " . sprintf("%02d", $jour) . "/" . sprintf("%02d", $mois) . "/" . $annee . "</li>";
    echo "<li>Heure : " . $heure . "</li>";
    echo "</ul>";

    echo "<form method='post' action='updaterdv1.php?id=$id&idr=$idr'>";
    echo "<input type='hidden' name='heure' value='" . $heure . "'>";
    echo "<input type='hidden' name='annee' value='" . $annee . "'>";
    echo "<input type='hidden' name='mois' value='" . $mois . "'>";
    echo "<input type='hidden' name='jour' value='" . $jour . "'>";
    echo "<input type='submit' name='confirmer_rendezvous' value='Confirmer le rendez-vous'>";
    
    echo "</form>";
    echo "<a href='modif1.php?id=$id&idr=$idr' ><button> Annuler</button class='retour'></a>";
} else {
    echo "<p>Erreur : Informations de rendez-vous manquantes.</p>";
    echo "<a href='rendez-vouz.php?id=$id'><button class='retour'>Retour</button></a>";
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(169, 231, 174);
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
        .retour[type="submit"], button {
        background-color:rgb(0, 0, 0);
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    
    input[type="submit"],button {
        background-color:rgb(6, 145, 73);
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
    }
    
    input[type="submit"]:hover, button:hover {
        background-color:rgb(10, 93, 50);
    }
    </style>

<?php
}  else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}
?>