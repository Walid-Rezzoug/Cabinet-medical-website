<?php
session_start(); // Start the session
use Dom\HTMLElement;
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
require '../Config/db.php'; // Include database connection
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $questionnaire = $_POST['qstnrC'];
        $diagnostic = $_POST['diagnosticC'];
        $honoraire = $_POST['honoraireC'];
        $traitement = $_POST['traitementC'];
        $stmt = $conn->prepare("UPDATE consultation SET qstnrC = ?, diagnosticC = ?, honoraireC = ?, traitementC = ? WHERE IDC = ?");
        $stmt->bind_param("ssssi", $questionnaire, $diagnostic, $honoraire, $traitement, $id);
        if ($stmt->execute()) {
            echo "Consultation updated successfully.";

        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $stmt = $conn->prepare("SELECT IDC, ID , date, heureC, qstnrC, diagnosticC, honoraireC, traitementC  FROM consultation where IDC = ?" );
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
<html>
    <head>
        <title>Edit Consultation</title>
    </head>
    <body>  
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: rgb(228, 149, 148);
                display: flex;
                flex-direction: column;
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

            h1{
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

            h3{
                color: #d14d30;
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

            input[type="text"],
            input[type="time"],
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
        <div class="container">
            <form method="post">
                    <h1>Edit Consultation:</h1>
                            <h3>Date of consultation:</h3> 
                            <input disabled type="text" name="DateC" value="<?php echo htmlspecialchars($row['date']); ?>"  />
                            <h3>Hour of consultation:</h3>
                            <input disabled type="time" name="HourC" value="<?php echo date('H:i', strtotime($row['heureC'])); ?>" />
                            <h3>Questionnaire:</h3> 
                            <input type="text" placeholder="Questionnaire" name="qstnrC" value="<?php echo htmlspecialchars($row['qstnrC']); ?>"required  /> 
                            <h3>Diagnostique:</h3> 
                            <input type="text" placeholder="Diagnostic" name="diagnosticC" value="<?php echo htmlspecialchars($row['diagnosticC']); ?>" required />
                            <h3>Honoraire:</h3> 
                            <input type="tel" placeholder="Honoraire" name="honoraireC" value="<?php echo htmlspecialchars($row['honoraireC']); ?>" required />
                            <h3>traitement:</h3> 
                            <input  type="text" placeholder="Traitement" name="traitementC" value="<?php echo htmlspecialchars($row['traitementC']); ?>"required  /><br>
                            <td colspan="2">
                                <input type="submit" value="Update consultation"/>
                                <input type="reset" />
                            </td>
            </form>
            <?php
            if(isset($_GET['idp'])){
                $idp = $_GET['idp'];
                echo "<a href='Consultation.php?id=$idp'><button>Back</button></a>";
            } else {
                echo "<a href='Consultation.php'><button>Back</button></a>";
            }
            ?>            
        </div>
<?php
    } else {
        echo "<h3>No Consultation found with the given ID. <a href='Consultation.php'>Back</a></h3>";
    }

    $stmt->close();
} else {
    echo "<h3>Error: No ID provided. <a href='Consultation.php'>Back</a></h3>";
}
?>
    </body>
</html>