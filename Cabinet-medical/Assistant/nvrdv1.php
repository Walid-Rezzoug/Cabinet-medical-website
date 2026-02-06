<?php
require '../Config/db.php';
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
    if (!isset($_GET['idp'])){
        header("Location: rendez-vous.php");
        exit(); // Redirect to login page if not logged in
    } else {
        $idp = $_GET['idp'];
    }
?>
<html>
<body>
<h1>Prise de rendez-vous</h1>
<?php
require '../Config/db.php';
$anneeActuelle = date('Y');
$stmt = $conn->prepare("SELECT COUNT(*) FROM année WHERE numA = ?");
$stmt->bind_param('s', $anneeActuelle);
$stmt->execute();
$stmt->bind_result($nombreAnnees);
$stmt->fetch();
$stmt->close();
if ($nombreAnnees == 0) {
    $stmt = $conn->prepare("INSERT INTO année (numA) VALUES (?)");
    $stmt->bind_param('s', $anneeActuelle);
    $stmt->execute();
    $stmt->close();
}
function genererCalendrier($mois, $annee, $conn,$id,$idp) {
    $anneeh = isset($_GET['annee']) ? $_GET['annee'] : $annee;
    $moish = isset($_GET['mois']) ? $_GET['mois'] : $mois;
    $jourh = isset($_GET['jour']) ? $_GET['jour'] : 1;
    $aujourdhui = new DateTime();
    $premierJourDuMois = new DateTime("$annee-$mois-01");
    $dernierJourDuMois = new DateTime("$annee-$mois-" . $premierJourDuMois->format('t'));
    $jourSemainePremierJour = intval($premierJourDuMois->format('w'));
    $nombreJoursDansMois = intval($dernierJourDuMois->format('d'));
    $nomsJoursCourts = ['D', 'L', 'M', 'M', 'J', 'V', 'S'];
    echo "<div class='page-container-split'>";
    echo "<div class='heures-container-split'>";
    echo "<div class='heures-titre-split'></div>";
    echo "<div class='heures-grid-split'>";
    for ($heure = 8; $heure < 16; $heure++) {
        for ($minuteOffset = 0; $minuteOffset < 60; $minuteOffset += 30) {
            $heureFormattee = sprintf("%02d:%02d", $heure, $minuteOffset);
            $stmt = $conn->prepare("SELECT COUNT(*) FROM rendezvous WHERE IDA = (SELECT IDA FROM année WHERE numA = ?) AND IDM = ? AND IDJ = ? AND numH = ?");
            $stmt->bind_param('siis', $anneeh, $moish, $jourh, $heureFormattee);
            $stmt->execute();
            $count = 0;
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
            if ($count == 0) {
                
                echo "<a href='confirmrdv.php?annee=$anneeh&mois=$moish&jour=$jourh&heure=$heureFormattee&id=$id&idp=$idp' class='bouton-heure-split'>$heureFormattee</a>";
            }
        }
    }
    echo "</div>"; 
    echo "</div>"; 
    echo "<div class='container'>";
    echo "<div class='calendrier-split'>";
    echo "<div class='navigation-split'>";
    echo "<a href='?mois=" . ($mois == 1 ? 12 : $mois - 1) . "&annee=" . ($mois == 1 ? $annee - 1 : $annee) . "&id=$id&idp=$idp' class='fleche-split fleche-gauche-split'>&lt;</a>";
    echo "<div class='mois-annee-split'>" . date('M', strtotime("$annee-$mois-01")) . " " . $annee . "</div>";
    echo "<a href='?mois=" . ($mois == 12 ? 1 : $mois + 1) . "&annee=" . ($mois == 12 ? $annee + 1 : $annee) . "&id=$id&idp=$idp' class='fleche-split fleche-droite-split'>&gt;</a>";
    echo "</div>"; 
    echo "<div class='jours-semaine-split'>";
    foreach ($nomsJoursCourts as $nomJour) {
        echo "<div>$nomJour</div>";
    }
    echo "</div>"; 
    echo "<div class='jours-split'>";
    for ($i = 0; $i < $jourSemainePremierJour; $i++) {
        echo "<div class='case-vide-split'></div>";
    }
    for ($jour = 1; $jour <= $nombreJoursDansMois; $jour++) {
        $dateCourante = new DateTime("$annee-$mois-$jour");
        $estJourPasse = $dateCourante < $aujourdhui->setTime(0, 0, 0);
        $boutonContenu = $estJourPasse 
            ? "<div class='bouton-rond-split desactive-split'>$jour</div>" 
            : "<a href='nvrdv1.php?annee=$annee&mois=$mois&jour=$jour&id=$id&idp=$idp' class='bouton-rond-split'>$jour</a>";

        echo "<div class='case-jour-split'>";
        echo $boutonContenu;
        echo "</div>";
        
    }
    echo "</div>"; 
    echo "</div>"; 
    echo "<a href='rendez-vous.php?id=$id'> <button type='button' class='button3' >Back</button></a>";
    echo "</div>"; 
    echo "</div>"; 
    
}
$moisAffiche = isset($_GET['mois']) ? intval($_GET['mois']) : date('n');
$anneeAffiche = isset($_GET['annee']) ? intval($_GET['annee']) : date('Y');
$moisAffiche = max(1, min(12, $moisAffiche));
genererCalendrier($moisAffiche, $anneeAffiche, $conn,$id,$idp);
$conn->close();

?></div>

<style>
    .button3 {
    background-color:rgb(5, 165, 83);
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 50%;
}
    a{
        text-decoration: none;
    }
        body {
    font-family: Arial, sans-serif;
    background-color:rgb(153, 214, 158);
    margin: 0;
    padding: 0;
    text-align: center;
}
.container {
    width: 80%;
    width: 50vw;
    margin: 30px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    height:65vh; }
.page-container-split {
    display: flex;
    width: 100vw; 
    min-height: 100vh; 
    background-color:rgb(153, 214, 158);
}
.heures-container-split {
    width: 50%; 
    padding: 20px;
    background-color:rgb(153, 214, 158);
    display: flex;
    flex-direction: column;
}

.heures-titre-split {
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: center;
}

.heures-grid-split {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
    flex-grow: 1;
    overflow-y: auto;
}

.bouton-heure-split {
    padding: 10px 15px;
    border: none;
    border-radius: 8px;
    background-color: #e0e0e0;
    color: #333;
    cursor: pointer;
    font-size: 2em;
    transition: background-color 0.3s ease;
    text-align: center;
}

.bouton-heure-split:hover {
    background-color:rgb(5, 165, 83);
}
.calendrier-split {
    width: 90%; 
    border: 1px solid #ccc;
    border-radius: 8px;
    font-family: sans-serif;
    margin: 20px; 
    padding: 20px;
    box-shadow: 2px 2px 5px #ddd;
}

.navigation-split {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.fleche-split {
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

.fleche-split:hover {
    background-color:rgb(5, 165, 83);
}

.mois-annee-split {
    font-size: 1.4em;
    font-weight: bold;
    text-align: center;
    color:rgb(5, 165, 83);
}

.jours-semaine-split {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    margin-bottom: 8px;
    text-align: center;
    color: #555;
    font-size: 1em;
}

.jours-semaine-split div {
    padding: 8px;
}

.jours-split {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 8px;
}

.case-jour-split {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 8px;
}

.bouton-rond-split {
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

.bouton-rond-split:hover {
    background-color:rgb(5, 165, 83);
}

.bouton-rond-split.desactive-split {
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
    echo "<h3>Error while searching the id <a href='cnx.php'><button>Back</button></a></h3>";
}
?>




