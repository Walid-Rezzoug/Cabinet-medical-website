<?php
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
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM patient WHERE id= ?");
    $stmt->bind_param("i", $id);
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
    <title>Confirmation de Déconnexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color:rgb(112, 152, 208);
        }
        h2{
            color: rgb(20, 97, 213);
        }
        .container {
            background:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        .confirm {
            background: red;
            color: white;
        }
        .cancel {
            background-color:rgb(26, 28, 32);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Voulez-vous vraiment vous déconnecter ?</h2>
        <a href="../php/confirmlogoutP.php"><button class="confirm" type=button>me déconnecter</button></a>
        <?php echo " <a href='profilP.php?id={$row['ID']}'><button class='cancel' type=button>Annuler</button></a> "?>
    </div>
</body>
</html>
<?php
} else {
        echo "Patient not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='cnx.php?id={$row['ID']}'>Back</a></h3>";
}

$conn->close();
?>
