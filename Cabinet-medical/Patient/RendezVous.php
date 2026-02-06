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
    <title>Rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>


        <h1>Rendez-vous Patients</h1>

    <style>
      .search {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #0056b3;
            border-radius: 5px;
        }  
        body {
    font-family: Arial, sans-serif;
    background-color: rgb(111, 158, 225);
    text-align: center;
    margin: 0;
    padding: 0;
}

/* 🌿 En-tête */
h1 {
            color:rgb(6, 16, 7);
        }
/* 🌿 Conteneur principal */
.container {
    width: 80%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
}



/* 🌿 Tableau */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #0056b3;
    color: white;
}

/* 🌿 Effet survol sur les lignes */
td:hover {
    background-color:rgb(111, 158, 225);
}
.button3{
  width: auto;
  padding: 5px 10px;
  background-color:rgb(2, 2, 2);
  left:0;
  border-radius: 12px;
  color: white;
}
.button4{
  width: auto;
  padding: 5px 10px;
  background-color:rgb(0, 86, 179);
  left:0;
  border-radius: 12px;
  color: white;
}
    </style>
    <div class="container">
        <!-- Barre de recherche -->
        <input class= search type="text" id="searchInput" onkeyup="searchAppointments()" placeholder="🔍 Rechercher un patient...">
        <?php echo "<a href='dashboardP.php?id={$row['ID']}'> <button type='button' class='button3' >Back</button></a>
        <a href='prendrerdv.php?id={$row['ID']}'> <button type='button' class='button4' >Ajouter</button></a>"?>
        <!-- Tableau des rendez-vous -->
        <table class="table">
            <thead>
                <tr>
                    <th>Medecin</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fatima Zahra Othmani</td>
                    <td>30/11/1954</td>
                    <td>10:00</td>
                   
                </tr>
                <tr>
                    <td>Amina Al-Mansour</td>
                    <td>07/02/1945</td>
                    <td>11:30</td>
                    
                <tr>
                    <td>Layla Ben Ammar</td>
                    <td>11/06/1947</td>
                    <td>01:45</td>
                    
                </tr>
                <tr>
                    <td>Youssef El Khatib</td>
                    <td>04/02/1968</td>
                    <td>3:57</td>
                    
                </tr>
                <tr>
                    <td>Omar Al-Farouq</td>
                    <td>07/09/1973</td>
                    <td>10:00</td>
                    
                </tr>
                <tr>
                    <td>Karim Abdelwahab</td>
                    <td>19/07/1982</td>
                    <td>14:27</td>
                    
                </tr>
                <tr>
                    <td>Fatima Zahra Othmani</td>
                    <td>30/11/1954</td>
                    <td>10:00</td>
                   
                </tr>
                <tr>
                    <td>Amina Al-Mansour</td>
                    <td>07/02/1945</td>
                    <td>11:30</td>
                    
                <tr>
                    <td>Layla Ben Ammar</td>
                    <td>11/06/1947</td>
                    <td>01:45</td>
                    
                </tr>
                <tr>
                    <td>Youssef El Khatib</td>
                    <td>04/02/1968</td>
                    <td>3:57</td>
                    
                </tr>
                <tr>
                    <td>Omar Al-Farouq</td>
                    <td>07/09/1973</td>
                    <td>10:00</td>
                    
                </tr>
                <tr>
                    <td>Karim Abdelwahab</td>
                    <td>19/07/1982</td>
                    <td>14:27</td>
                    
                </tr>
            </tbody>
        </table>
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