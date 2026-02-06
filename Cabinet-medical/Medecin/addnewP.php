
<?php
require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['patientN'];
    $surname = $_POST['patientS'];
    $dob = $_POST['dob'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
    $sexe = $_POST['sexe'];

    $stmt = $conn->prepare("INSERT INTO patient (name, surname, dob, email, password, tel, adresse, sexe) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $surname, $dob, $email, $password, $tel, $adresse, $sexe);
    
    if($stmt->execute()) {
        echo "Patient added successfully.<br >";
        header("Refresh: 5; URL=patient.php"); // Redirect after 5 seconds
        echo "You will be redirected in 5 seconds...";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Add-NewP</title>
<form method="POST" action="addnewP.php">
  <div class="container" style="background-color: rgb(255, 255, 255);">
    <label for="nom"><b>Nom :</b></label>
    <input type="text" name="patientN" placeholder="Entrer votre Nom"  required>

    <label for="prenom"><b>Prénom :</b></label>
    <input  type="text" name="patientS" placeholder="Entrer votre Prénom"  required>

    <label for="dateN"><b>Date de naissance :</b></label>
    <input type="date" name="dob" placeholder="Entrer votre Date de naissance"  required><br>

    <label for="Ntel"><b>N° de téléphone :</b></label>
    <input type="tel" name="tel" placeholder="Entrer votre numéro de téléphone"  required><br>

    <label for="email"><b>Adresse e-mail :</b></label>
    <input type="email" placeholder="Entrer votre Adresse e-mail" name="email" required><br>

    <label for="adresse"><b>Adresse :</b></label>
    <input type="text" placeholder="Entrer votre Adresse" name="adresse" required><br>

    <label for="sexe"><b>Sexe :</b></label>
    <input type="radio" name="sexe" value="M" required>
    <label>Homme</label>
    <input type="radio" name="sexe" value="F" required>
    <label>Femme</label><br>

    <br><label for="psw"><b>Mot de passe :</b></label>
    <input type="password" placeholder="Entrer votre mot de passe" name="psw" required>
    
    <label for="psw2"></label>
    <input type="password" placeholder="comfirmer votre mot de passe" name="psw2" required>
   
    <button type="submit">Add NewP</button>
  </div>

  <div class="container" style="background-color: rgb(255, 255, 255);">
    <a href="patient.php"><button  type=button class=cancelbtn>Cancel</button></a>
  </div>
</form>
<style>
    /* 🌿 Styles généraux */
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

    /* 🌿 Formulaire */
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

    input[type="text"], input[type="email"], input[type="password"], input[type="date"], input[type="tel"] {
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