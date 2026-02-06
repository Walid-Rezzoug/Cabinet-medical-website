<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (!isset($_SESSION['profile_id'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    if ($id != $_SESSION['profile_id']) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM Patient WHERE id= ?");
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
    <title>Dossier Médical</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background-color:rgb(112, 152, 208);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h2{
            color: rgb(0, 76, 157);
        }
        
.profile-card {
    background-color:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 500px;
            text-align: center;
            height:300px;
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
        .info{
            color:rgb(0, 76, 157);
        }
    </style>
</head>
<body>
    <div class="profile-card">
        <h2>Dossier Médical du Patient</h2>
        <p><strong class=info>Nom :</strong> Dupont</p>
        <p><strong class=info>Prénom :</strong> Jean</p>
        <p><strong class=info>Âge :</strong> 45 ans</p>
        <p><strong class=info>Groupe sanguin :</strong> O+</p>
        <p><strong class=info>Antécédents médicaux :</strong> Hypertension, Allergies aux pénicillines</p>
        <?php echo "<a href='dashboardP.php?id={$row["ID"]}'> <button type='button' class='button3' >Back</button></a>"?>
    </div>
</body>
</html>
<?php
} else {
        echo "Patient not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}

$conn->close();
?>
