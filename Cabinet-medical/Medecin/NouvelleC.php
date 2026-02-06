<?php
require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
$erreurs = []; 
if(isset ($_GET['id'])){ 
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM patient WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result1 = $stmt->get_result();
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
    } else {
        echo "Patient not found.";
    }
} else {
    echo "<h3>Error while searching the id <a href='Patient.php'>Back</a></h3>";
    die();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $dateObj = DateTime::createFromFormat('Y-m-d', $date);
    if (!$dateObj || $dateObj->format('Y-m-d') !== $date) {
        $erreurs['date'] = "La date n'est pas valide ou le format est incorrect (AAAA-MM-JJ).";
    } else {
        $aujourdhui = new DateTime(); 
        $aujourdhui->setTime(0, 0, 0); 
        if ($dateObj > $aujourdhui) {
            $erreurs['date'] = "La date de consultation ne peut pas être ultérieure à la date d'aujourd'hui.";
        }
    }
    $heure = $_POST['heureC'];
    if (!preg_match('/^(\d{2}):(\d{2})$/', $heure, $matches)) {
        $erreurs['heureC'] = "Le format de l'heure est incorrect (HH:MM).";
    } else {
        $heuresConsultation = intval($matches[1]);
        $minutesConsultation = intval($matches[2]);

        $maintenant = new DateTime();
        $heureActuelle = intval($maintenant->format('H'));
        $minuteActuelle = intval($maintenant->format('i'));
        if($aujourdhui==$date){
            if ($heuresConsultation > $heureActuelle || ($heuresConsultation == $heureActuelle && $minutesConsultation > $minuteActuelle)) {
            $erreurs['heureC'] = "L'heure de consultation ne peut pas être ultérieure à l'heure actuelle pour aujourd'hui.";
        }}
    }
    $qstnrC = $_POST['qstnrC'];
    if (strlen($qstnrC) > 255) { 
        $erreurs['qstnrC'] = "Le questionnaire est trop long (max 255 caractères).";
    }
    $diagnostic = $_POST['diagnosticC'];
    if (strlen($diagnostic) > 255) { 
        $erreurs['diagnosticC'] = "Le diagnostic est trop long (max 255 caractères).";
    }
    $traitement = $_POST['traitementC'];
    if (strlen($traitement) > 255) { 
        $erreurs['traitementC'] = "Le traitement est trop long (max 255 caractères).";
    }
    $honoraire = $_POST['honoraireC'];
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $honoraire)) {
        $erreurs['honoraireC'] = "L'honoraire doit être un nombre";
    }
    if (empty($erreurs)) {
        $sql = "INSERT INTO consultation (id,date, heureC, qstnrC, diagnosticC, honoraireC,  traitementC) VALUES (?,?, ?, ?, ?, ? ,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssss",$id, $date, $heure, $qstnrC, $diagnostic, $honoraire , $traitement);
        if ($stmt->execute()) {
            echo "Consultation ajoutée avec succès.<br>";
            if(isset($_GET['id'])){
                $idp = $_GET['id'];
                header("Refresh: 5; consultation.php?id=$id");
            }else{
                header("Refresh: 5; consultation.php");
            }
            echo "Vous serez redirigé dans 5 secondes...";
        } else {
            echo "Erreur lors de l'enregistrement de la consultation : " . $stmt->error;
        }
            $stmt->close();
        $conn->close();

    } else {
        echo "<strong>Erreurs de validation :</strong><br>";
        foreach ($erreurs as $champ => $message) {
            echo htmlspecialchars($message) . "<br>";
        }
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Nouvelle Consultation</title>
</head>
<body>
    <div class="container">
        <h1>Nouvelle Consultation</h1>
        <form method="post" action="NouvelleC.php?id=<?php echo $row1['ID']; ?>">
            <div>
                <label for="date">Date de Consultation :</label>
                <input type="date" id="date" name="date"  required>
            </div>
            <div>
                <label for="heureC">Heure de Consultation :</label>
                <input type="time" id="heureC" name="heureC" required>
            </div>
            <div>
                <label for="qstnrC">Questionnaire :</label>
                <input type="text" id="qstnrC" name="qstnrC" required>
            </div>
            <div>
                <label for="diagnosticC">Diagnostic :</label>
                <input type="text" id="diagnosticC" name="diagnosticC" required>
            </div>
            <div>
                <label for="honoraireC">Honoraire :</label>
                <input type="text" id="honoraireC" name="honoraireC" required>
            </div>
            <div>
                <label for="traitementC">traitement :</label>
                <input type="text" id="traitementC" name="traitementC" required>
            </div>
            <button type="submit">Enregistrer</button>
           <a href='consultation.php?id=<?php echo $id; ?>'><button type='button'>Back</button></a>
        </form>
    </div>
<style>
    
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background: rgb(228, 149, 148);
        text-align: center;
    }

    h1 {
        color: rgb(6, 16, 7);
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
        color: rgb(209, 48, 11);
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
        background-color: rgb(192, 61, 32);
    }

    .cancelbtn:hover {
        background-color: rgb(228, 149, 148);
    }

    a {
        text-decoration: none;
        color: white;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</body>
</html>