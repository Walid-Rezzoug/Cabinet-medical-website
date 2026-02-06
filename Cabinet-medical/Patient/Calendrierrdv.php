<html><body><h1>Prise de rendez-vous</h1></body>
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
function genererCalendrier($mois, $annee,$id) {
    $aujourdhui = new DateTime();
    $premierJourDuMois = new DateTime("$annee-$mois-01");
    $dernierJourDuMois = new DateTime("$annee-$mois-" . $premierJourDuMois->format('t'));
    $jourSemainePremierJour = intval($premierJourDuMois->format('w'));
    $nombreJoursDansMois = intval($dernierJourDuMois->format('d'));
    $moisNom = date('F', strtotime("$annee-$mois-01"));
    $nomsJoursCourts = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];?>
    <div class="container"><?php echo "<div class='calendrier-moitie'>";
    echo "<div class='navigation-moitie'>";
    echo "<a href='?mois=" . ($mois == 1 ? 12 : $mois - 1) . "&annee=" . ($mois == 1 ? $annee - 1 : $annee) . "&id=$id' class='fleche-moitie fleche-gauche-moitie'>&lt;</a>";
    echo "<div class='mois-annee-moitie'>" . date('M', strtotime("$annee-$mois-01")) . " " . $annee . "</div>";
    echo "<a href='?mois=" . ($mois == 12 ? 1 : $mois + 1) . "&annee=" . ($mois == 12 ? $annee + 1 : $annee) . "&id=$id' class='fleche-moitie fleche-droite-moitie'>&gt;</a>";
    echo "</div>";
    echo "<div class='jours-semaine-moitie'>";
    foreach ($nomsJoursCourts as $nomJour) {
        echo "<div>$nomJour</div>";
    }
    echo "</div>";
    echo "<div class='jours-moitie'>";

    for ($i = 0; $i < $jourSemainePremierJour; $i++) {
        echo "<div class='case-vide-moitie'></div>";
    }

    for ($jour = 1; $jour <= $nombreJoursDansMois; $jour++) {
        $dateCourante = new DateTime("$annee-$mois-$jour");
        $estJourPasse = $dateCourante < $aujourdhui->setTime(0, 0, 0);
        $boutonContenu = $estJourPasse ? "<div class='bouton-rond-moitie desactive-moitie'>$jour</div>" : "<a href='CalendrierrdvH.php?annee=$annee&mois=$mois&jour=$jour&id=$id' class='bouton-rond-moitie' onclick='afficherDate(this, $jour, $mois, $annee)'>$jour</a>";

        echo "<div class='case-jour-moitie'>";
        echo $boutonContenu;
        echo "</div>";
    }

    echo "</div>";
    echo "</div>";
    echo "<a href='dashboardP.php?id=$id'> <button type='button' class='button3' >Back</button></a>";
}
$moisAffiche = isset($_GET['mois']) ? intval($_GET['mois']) : date('n'); 
$anneeAffiche = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y'); 
$moisAffiche = max(1, min(12, $moisAffiche));
genererCalendrier($moisAffiche, $anneeAffiche,$id);

?></div>
    

<style>
    body {
    font-family: Arial, sans-serif;
    background-color:rgb(111, 158, 225);
    margin: 0;
    padding: 0;
    text-align: center;
}
.container {
    width: 55%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
.calendrier-moitie {
    width: 50vw; 
    border: 1px solid #ccc;
    border-radius: 8px;
    font-family: sans-serif;
    margin: 20px auto; 
    padding: 20px;
    box-shadow: 2px 2px 5px #ddd;
}
h1 {
            color:rgb(6, 16, 7);
            font-family: Arial, sans-serif;
        }

.navigation-moitie {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.fleche-moitie {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #f0f0f0;
    color: #555;
    text-decoration: none;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.fleche-moitie:hover {
    background-color: #007bff;
}

.mois-annee-moitie {
    font-size: 1.4em;
    font-weight: bold;
    text-align: center;
    color: #007bff;
}

.jours-semaine-moitie {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    margin-bottom: 8px;
    text-align: center;
    color: #555;
    font-size: 1em;
}

.jours-semaine-moitie div {
    padding: 8px;
}

.jours-moitie {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

.case-jour-moitie {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px;
}
.button3 {
    background-color: #007bff;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 50%;
}

.bouton-rond-moitie {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    background-color: #eee;
    color: #333;
    font-size: 1em;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.bouton-rond-moitie:hover {
    background-color: #007bff;
}

.bouton-rond-moitie.desactive-moitie {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #f9f9f9;
    color: #aaa;
    cursor: default;
    text-decoration: none;
    font-size: 1em;
}
</style>
</html>
<?php
}  else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}
?>
