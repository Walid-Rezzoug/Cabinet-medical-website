<?php

use Dom\HTMLElement;

require '../Config/db.php'; // Include database connection
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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adresse = $_POST['addr'];
        $tel = $_POST['phone'];


        $stmt = $conn->prepare("UPDATE staff SET adresse = ?, tel = ? WHERE ID = ?");
        $stmt->bind_param("ssi",  $adresse, $tel, $id);

        if ($stmt->execute()) {
            echo "profile updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>
        <html>
            <head>
                <title>Edit Profile</title>
            </head>
            <body>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: rgb(111, 158, 225);
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
                        display: grid;
                        background: rgb(255, 255, 255);
                        place-items: center;
                    }

                    label {
                        font-weight: bold;
                        display: block;
                        margin: 10px 0 5px;
                        color:#007bff;
                    }

                    input {
                        width: 100%;
                        padding: 8px;
                        margin-bottom: 15px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                        text-align: center;
                        left: 5px;
                    }

                    /* 🌿 Bouton */
                    .btn {
                        background:  #007bff;
                        color: white;
                        padding: 10px 15px;
                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        font-weight: bold;
                    }

                    input[type="radio"] {
                        display: flex;
                        align-items: center;
                    }

                    .btn:hover {
                        background-color: rgb(4, 57, 1);
                    }

                    h2 {
                        text-align: center;
                        color: #007bff;
                    }

                    .form-group {
                        margin-bottom: 15px;
                    }

                    .form-group label {
                        display: block;
                        margin-bottom: 5px;
                        color: #333;
                    }

                    .form-group input,
                    .form-group textarea {
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
                        background:  #007bff;
                        border: none;
                        color: #fff;
                        font-size: 16px;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    .form-group button:hover {
                        background:  #007bff;
                    }

                    .mod {
                        color: #007bff;
                    }

                    button {
                        background-color: rgb(26, 28, 32);
                        color: white;
                        border: none;
                        padding: 10px 15px;
                        border-radius: 5px;
                        cursor: pointer;
                    }

                    button:hover {
                        background-color: rgb(0, 2, 4);
                    }
                </style>
                <div class="container">
                    <h2 class=mod>Modifier le Profil</h2>

                    <form action="ModifierPRP.php?id=<?php echo $id; ?>" method="POST">

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
                        <a href="profilP.php?id=<?php echo $id; ?>"><button type="button" class="cancelbtn">Annuler</button></a>
                    </form>
                </div>
            </body>
        </html>
        <?php
    }
}
?>

