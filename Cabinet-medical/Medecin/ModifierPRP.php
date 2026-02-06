<?php
session_start();
require '../Config/db.php';
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $adresse = $_POST['addr'];
    $tel = $_POST['phone'];
    $stmt = $conn->prepare("UPDATE staff SET adresse = ?, tel = ? WHERE ID = 1");
    $stmt->bind_param("ss",  $adresse, $tel);
    if ($stmt->execute()) {
        echo "profile updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$stmt = $conn->prepare("SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM staff WHERE ID = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Profil Médecin</title>
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
        .container {
       background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 400px;
    text-align: center;
    display:grid;
    background:rgb(255, 255, 255);
    place-items:center;
}
label {
    color:rgb(209, 48, 11);
    font-weight: bold;
    display: block;
    margin: 10px 0 5px;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
    left:5px;
}

/* 🌿 Bouton */
.btn {
    background:rgb(189, 52, 22);
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
}
input [type="radio"] {
    display: flex;
    align-items: center;
}

.btn:hover {
    background:rgb(74, 16, 3);
}
        h2 {
            text-align: center;
            color:rgb(209, 48, 11);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #0056b3;
            border: none;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .mod{
            color:rgb(209, 48, 11);
        }
        button {
            background-color:rgb(26, 28, 32);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color:rgb(0, 2, 4);
        }
    </style>
</head>
<body>
<div class="container">
                    <h2 class=mod>Modifier le Profil</h2>

                    <form action="ModifierPRP.php" method="POST">

                        <label>Nom :</label>
                        <input type="text" value="<?php echo $row['name']; ?>" readonly>

                        <label>Prénom :</label>
                        <input type="text" value="<?php echo $row['surname']; ?>" readonly>

                        <label for="date">Date de naissance :</label>
                        <input type="date" value="<?php echo $row['dob']; ?>" readonly>

                        <label>N° de téléphone :</label>
                        <input type="tel" id="heure" name="phone" value="<?php echo $row['tel']; ?>" >

                        <label for="heure">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" readonly>

                        <label for="adresse">Adresse :</label>
                        <input type="text" id="adresse" name="addr" value="<?php echo $row['adresse']; ?>" >

                        <label>Sexe :</label>
                        <div class="radio-group">
                            <label class="sexe-label">Homme</label>
                            <input type="radio" name="sexe" value="Homme" <?php if ($row['sexe'] == 'M') echo 'checked'; ?> disabled><br>
                            <label class="sexe-label">Femme</label>
                            <input type="radio" name="sexe" value="Femme" <?php if ($row['sexe'] == 'F') echo 'checked'; ?> disabled>
                        </div>
                        <br><button type="submit" class="btn">Modifier le Profil</button>
                        <a href="profilM.php"><button type="button" class="cancelbtn">Annuler</button></a>
                    </form>
                </div>
</body>
</html>
        <?php
    }
?>