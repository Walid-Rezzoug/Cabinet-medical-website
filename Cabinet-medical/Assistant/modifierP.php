
<?php

use Dom\HTMLElement;

require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['mimi'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if(isset($_GET['id'])){ 
    $id = $_GET['id'];
    if ($id != $_SESSION['mimi']) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM staff WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result1 = $stmt->get_result();
    
    if ($result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
    if (isset($_GET['idp'])) {
    $idp = $_GET['idp'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adresse = $_POST['addr'];
        $tel = $_POST['phone'];
        

        $stmt = $conn->prepare("UPDATE patient SET adresse = ?, tel = ? WHERE ID = ?");
        $stmt->bind_param("ssi",  $adresse, $tel, $idp);

        if ($stmt->execute()) {
            echo "Patient updated successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient WHERE ID = ?");
    $stmt->bind_param("i", $idp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<html>
    <head>
        <title>Edit Patient</title>
    </head>
    <body>  
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: rgb(153, 214, 158);
        display: flex;
        flex-direction: column;
        align-items: center;
        height: 100vh;
        margin: 0;
        }

        /* 🌿 Form Container */
        fieldset {
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        width: 400px;
        text-align: center;
        margin-bottom: 20px;
        }

        /* 🌿 Titles */
        h3 {
        color: #05a553;
        margin-top: 20px;
        }

        /* 🌿 Form Fields */
        label, th {
        font-weight: bold;
        display: block;
        margin: 10px 0 5px;
        }

        input, select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-align: center;
        }

        /* 🌿 Sexe Field */
        td.sexe-field {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 10px;
        flex-wrap: nowrap;
        }

        label.sexe-label {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 5px;
        }

        td.sexe-field label {
        display: inline-flex;
        align-items: center;
        margin-right: 10px;
        }

        /* 🌿 Buttons */
        input[type="submit"], input[type="reset"], a {
        background: rgb(5, 165, 83);
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
        display: inline-block;
        margin: 5px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover, a:hover {
        background-color: #2a7d2e;
        }

        table {
        width: 100%;
        }

        td, th {
        padding: 5px;
        text-align: left;
        }
        h3{
        color:rgb(0, 0, 0);
        }

        input[type="radio"] {
        margin-right: 5px;
        }
        </style>
        <h3>Edit Patient: <?php echo htmlspecialchars($row['name']) . "  " . htmlspecialchars($row['surname']); ?></h3>
        <form method="post">
            <fieldset>
                <table>
                    <tr>
                        <th>Name: </th>
                        <td><input disabled type="text" placeholder="Patient name" name="patientN" value="<?php echo htmlspecialchars($row['name']); ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Surname: </th>
                        <td><input disabled type="text" placeholder="Patient surname" name="patientS" value="<?php echo htmlspecialchars($row['surname']); ?>" /></td>
                    </tr>
                    <tr>
                        <th>Date of Birth: </th>
                        <td><input disabled type="date" name="dob" value="<?php echo htmlspecialchars($row['dob']); ?>"  /></td>
                    </tr>
                    <tr>
                        <th>Address: </th>
                        <td><input type="text" placeholder="Address" name="addr" value="<?php echo htmlspecialchars($row['adresse']); ?>" required /></td>
                    </tr>
                    <tr>
                        <th>Phone Number: </th>
                        <td><input type="tel" placeholder="Phone number" name="phone" value="<?php echo htmlspecialchars($row['tel']); ?>" required /></td>
                    </tr>
                    <tr>
                        <th>Sexe: </th>
                        <td class="sexe-field">
                            <label>
                                <input disabled type="radio" name="sexe" value="Homme" <?php echo ($row['sexe'] === 'M') ? 'checked' : ''; ?> required /> Homme
                            </label>
                            <label>
                                <input disabled type="radio" name="sexe" value="Femme" <?php echo ($row['sexe'] === 'F') ? 'checked' : ''; ?> required /> Femme
                            </label>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <table>
                    <tr>
                        <th>Email Address: </th>
                        <td><input type="email" value="<?php echo htmlspecialchars($row['email']); ?>" placeholder="Email address" name="email" disabled></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Update Patient">
                            <input type="reset" />
                            <?php echo " <a href='patient.php?id={$row1['ID']}'>Back</a> "?>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
<?php
    } else {
        echo "<h3>No patient found with the given ID. <a href='patient.html'>Back</a></h3>";
    }

    
} else {
    echo "<h3>Error: No ID provided. <a href='patient.html'>Back</a></h3>";
}
} else {
    echo "Assitant not found.";
}

$stmt->close();
} else {
echo "<h3>Error while searching the id <a href='../cnxstaff/index.html'>Back</a></h3>";
}

$conn->close();
?>
    </body>
</html>
<!--- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du Patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


    <div class="container">
        <h2>Modifier le Patient</h2>
        
        <form action="patient.php" method="POST">
    
             Nom du patient (Affiché mais non modifiable) 
            <label>Nom :</label>
            <input type="text" value="Idriss El Amrani" readonly>

            <label>Prénom :</label>
            <input type="text" value="Idriss El Amrani" readonly>

            
            <label for="date">Date de naissance :</label>
            <input type="date" value="04/02/2006" readonly>

            
            <label >N° de téléphone :</label>
            <input type="tel" id="heure" name="heure" >

            <label for="heure">Adresse e-mail :</label>
            <input type="email" id="heure" name="heure" >

            <label for="heure">Adresse :</label>
            <input type="text" id="heure" name="heure" >

            <label>Sexe :</label>
            <label>Homme</label>
            <input type="radio" checked disabled><br>
            <label>Femme</label>
            <input type="radio" disabled>

            
            <br><button type="submit" class="btn">Modifier le Patient</button>
        </form>
    </div>

</body>
</html> 
-->