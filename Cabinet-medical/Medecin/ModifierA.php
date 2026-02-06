<?php

use Dom\HTMLElement;
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
require '../Config/db.php'; // Include database connection

$message = ""; // Initialize message variable

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $adresse = $_POST['addr'];
        $tel = $_POST['phone'];

        $stmt = $conn->prepare("UPDATE staff SET adresse = ?, tel = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $adresse, $tel, $id);

        if ($stmt->execute()) {
            $message = "Assistant updated successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT ID, UserType, name, surname, dob, email, tel, adresse, sexe FROM staff WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<html>
    <head>
        <title>Edit Assistant</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: rgb(228, 149, 148);
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
                width: 500px;
                text-align: center;
            }

            h3 {
                color: #d14d30;
                margin-bottom: 20px;
            }

            .message {
                color: green;
                font-weight: bold;
                margin-bottom: 15px;
            }

            fieldset {
                border: 1px solid #ccc;
                border-radius: 5px;
                padding: 15px;
                margin-bottom: 20px;
            }

            legend {
                font-weight: bold;
                color: #d14d30;
            }

            table {
                width: 100%;
                margin: 10px 0;
            }

            th {
                text-align: left;
                padding: 5px;
                color: #333;
            }

            td {
                padding: 5px;
            }

            input[type="text"],
            input[type="email"],
            input[type="tel"],
            input[type="date"] {
                width: 100%;
                padding: 8px;
                margin: 5px 0;
                border: 1px solid #ccc;
                border-radius: 5px;
            }

            input[type="submit"],
            input[type="reset"],
            a {
                background: rgb(209, 77, 48);
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-weight: bold;
                margin: 5px;
            }

            input[type="submit"]:hover,
            input[type="reset"]:hover,
            a:hover {
                background: rgb(120, 28, 7);
            }

            .sexe-field {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .back-button {
                margin-top: 15px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
            
        
        <div class="container">
            <form method="post">
                
                    <h1>Edit Assistant:</h1>
                    
                        
                            <h3>Name:</h3> 
                            <input disabled type="text" placeholder="Assistant name" name="patientN" value="<?php echo htmlspecialchars($row['name']); ?>"  />
                        
                        
                            <h3>Surname:</h3>
                            <input disabled type="text" placeholder="Assistant surname" name="patientS" value="<?php echo htmlspecialchars($row['surname']); ?>" />
                        
                        
                            <h3>Date of Birth:</h3> 
                            <input disabled type="date" name="dob" value="<?php echo htmlspecialchars($row['dob']); ?>"  />
                        
                        
                            <h3>Address:</h3> 
                            <input type="text" placeholder="Address" name="addr" value="<?php echo htmlspecialchars($row['adresse']); ?>" required />
                        
                        
                            <h3>Phone Number:</h3> 
                            <input type="tel" placeholder="Phone number" name="phone" value="<?php echo htmlspecialchars($row['tel']); ?>" required />

                            <h3>e-mail:</h3> 
                            <input  type="text" placeholder="Assistant email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>"  />
                        
                        
                            <h3>Sexe:</h3> 
                            <td class="sexe-field">
                                <label>
                                    <input disabled type="radio" name="sexe" value="Homme" <?php echo ($row['sexe'] === 'M') ? 'checked' : ''; ?> required /> Homme
                                </label>
                                <label>
                                    <input disabled type="radio" name="sexe" value="Femme" <?php echo ($row['sexe'] === 'F') ? 'checked' : ''; ?> required /> Femme
                                </label>
                            </td><br>
                            <td colspan="2">
                                <input type="submit" value="Update Assistant"/>
                                <input type="reset" />
                            </td>
                            
                        
            </form>
            <a href="Assistant.php" ><button>Back</button></a>
                            
<?php
    } else {
        echo "<h3>No Assistant found with the given ID. <a href='Assistant.html'>Back</a></h3>";
    }

    $stmt->close();
} else {
    echo "<h3>Error: No ID provided. <a href='Assistant.html'>Back</a></h3>";
}
?>
    </body>
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

/* 🌿 Conteneur du formulaire */
.container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 400px;
    text-align: center;
    display:grid;
    place-items:center;
}
a {
                background: rgb(209, 77, 48);
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-weight: bold;
                margin: 5px;
            }
/* 🌿 Titres */
h2 {
    color:#d14d30
}

/* 🌿 Champs du formulaire */
label {
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

button{ 
                background: rgb(209, 77, 48);
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                text-decoration: none;
                font-weight: bold;
            }
input [type="radio"] {
    display: flex;
    align-items: center;
}

.btn:hover {
    background:rgb(120, 28, 7);
}
  </style>
</html>
<!--
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de l Assistant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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

/* 🌿 Conteneur du formulaire */
.container {
    background: white;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 400px;
    text-align: center;
    display:grid;
    place-items:center;
}

/* 🌿 Titres */
h2 {
    color:#d14d30
}

/* 🌿 Champs du formulaire */
label {
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
    background:rgb(209, 77, 48);
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
    background:rgb(120, 28, 7);
}
  </style>

    <div class="container">
        <h2>Modifier l'Assistant</h2>
        
        <form action="Assistant.php" method="POST">
            
            
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

            <br><button type="submit" class="btn">Modifier l'Assistant</button>
        </form>
    </div>

</body>
</html>
-->