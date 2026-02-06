<?php
require '../Config/db.php'; // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];
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
    <title class=ajrdv>Ajouter un Rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
    .ajrdv{
        background-color: #0056b3;
}
/* 📌 Conteneur du formulaire */
.container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
    display:grid;
            place-items:center;
}

/* 📌 Titres */
h2 {
    color: #0056b3;
}

/* 📌 Champs du formulaire */
label {
    display: block;
    margin: 10px 0 5px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 8px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* 📌 Bouton */
button {
    background-color: #0056b3;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
}

button:hover {
    background:rgb(9, 0, 110);
}
</style>
    <div class="container">
        <h2>Ajouter un Rendez-vous</h2>
        <form action="RendezVous.php?id=<?php echo $row['ID'];?>" method="POST">
            <label for="nom">Nom du Patient :</label>
            <input type="text" id="nom" name="nom" required>

            <label for="date">Date de Consultation :</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Prendre Rdv</button>
        </form>
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