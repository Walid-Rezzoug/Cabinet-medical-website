<?php
require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserType = 2; 

    $name = $_POST['AssistantN'];
    $surname = $_POST['AssistantS'];
    $dob = $_POST['dob'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = password_hash($_POST['psw'], PASSWORD_DEFAULT);
    $sexe = $_POST['sexe'];

    $stmt = $conn->prepare("INSERT INTO staff (UserType, Name, Surname, dob, email, password, tel, adresse, sexe) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $UserType, $name, $surname, $dob, $email, $password, $tel, $adresse, $sexe);
    
    if($stmt->execute()) {
        echo "Assitant added successfully.<br >";
        header("Refresh: 5; URL=Assistant.php"); // Redirect after 5 seconds
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
  <title>Add-NewA</title>
<form method="POST" action="NouveauA.php">
  <div class="container" >
    <label for="nom"><b>Nom :</b></label>
    <input type="text" name="AssistantN" placeholder="Entrer votre Nom"  required>

    <label for="prenom"><b>Prénom :</b></label>
    <input  type="text" name="AssistantS" placeholder="Entrer votre Prénom"  required>

    <label for="dateN"><b>Date de naissance :</b></label>
    <input type="date" name="dob" placeholder="Entrer votre Date de naissance"  required><br>

    <label for="Ntel"><b>N° de téléphone :</b></label>
    <input type="tel" name="tel" placeholder="Entrer votre numéro de téléphone"  required><br>

    <label for="email"><b>Adresse e-mail :</b></label>
    <input type="email" placeholder="Entrer votre Adresse e-mail" name="email" required><br>

    <label for="adresse"><b>Adresse :</b></label>
    <input type="text" placeholder="Entrer votre Adresse" name="adresse" required><br>

    <label for="sexe"><b>Sexe :</b></label>
    <div class="radio-group">
        <label><input type="radio" name="sexe" value="M" required> Homme</label>
        <label><input type="radio" name="sexe" value="F" required> Femme</label>
    </div><br>

    <br><label for="psw"><b>Mot de passe :</b></label>
    <input type="password" placeholder="Entrer le mot de passe" name="psw" required>
    
    <label for="psw2"><b>Confirmer mot de passe :</b></label>
    <input type="password" placeholder="Confirmer le mot de passe" name="psw2" required>
   
    <button type="submit">Add</button>
  </div>

  <div class="container">
    <a href="Assistant.php"><button type="button" class="cancelbtn">Cancel</button></a>
  </div>
</form>
<style>


    /* 🌿 Corps de la page */
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
<!-- <html>
    <head>
        <meta charset="UTF-8">
        <title>New assistant</title>
    </head>
    <body>
        <h3>New assistant</h3>
        <form action="Assistant.php" method="post">
            <fieldset>
                <legend>Personnal information</legend>
                <table>
                    <tr>
                        <th>Fullname: </th>
                        <td><input type="text" placeholder="Assistant name" name="assistantN" required /></td>
                    </tr>
                    <tr>
                        <th>Date of birth: </th>
                        <td><input type="date" placeholder="Date of birth" name="dob" required /></td>
                    </tr>
                    <tr>
                        <th>Address: </th>
                        <td><input type="text" placeholder="Address" name="addr" required /></td>
                    </tr>
                    <tr>
                        <th>Phone number: </th>
                        <td><input type="number" placeholder="Phone number" name="phone" required /></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Login information</legend>
                <table>
                    <tr>
                        <th>Email address: </th>
                        <td><input type="email" placeholder="Email address" name="email" required></td>
                    </tr>
                    <tr>
                        <th>Password: </th>
                        <td><input type="password" placeholder="Password" name="pass" required></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Add assistant">
                            <input type="reset" />
                            <a href="Assistant.php"><button type="button">Back</button></a>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </body>
</html>
-->