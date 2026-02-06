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
    <title>Factures des Rendez-vous</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
 <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #0056b3;
    margin: 0;
    padding: 0;
    text-align: center;
}
tr:hover {
    background-color:rgb(112, 152, 208);
}
.container {
    width: 80%;
    margin: 20px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

/* 🌿 Champ de recherche */
#searchInput {
    width: 55%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border: 2px solid #0056b3;
            border-radius: 5px;
    font-size: 16px;
}

/* 🌿 Tableau */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}
h1 {
            color:rgb(6, 16, 7);
        }

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #0056b3;
    color: white;
}

/* 🌿 Statut payé / non payé */
.paid {
    color: green;
    font-weight: bold;
}

.unpaid {
    color: red;
    font-weight: bold;
}
.button3{
  width: auto;
  padding: 5px 10px;
  background-color:rgb(3, 3, 3);
  left:0;
  border-radius: 12px;
  color: white;
}
.button4{
  width: auto;
  padding: 5px 10px;
  background:rgb(20, 97, 213);
  left:0;
  border-radius: 12px;
  color: white;
}
 </style>
        <h1>Factures des Rendez-vous</h1>

    <div class="container">
        <input type="text" id="searchInput" placeholder="🔍Rechercher un patient..." onkeyup="searchPatient()">
        <?php echo "<a href='dashboardP.php?id={$row['ID']}'> <button type='button' class='button3' >Back</button></a>"?>
        <table>
            <thead>
                <tr>
                    <th>Médecin</th>
                    <th>Date du Rendez-vous</th>
                    <th>Statut de Consultation</th>
                    
                </tr>
            </thead>
            <tbody id="patientTable">
                <tr>
                    <td>Ali Ben Salem</td>
                    <td>2025-03-10</td>
                    <td class="paid">Payée</td>
                    
                </tr>
                <tr>
                    <td>Fatima Zahra</td>
                    <td>2025-03-12</td>
                    <td class="unpaid">Non Payée</td>
                    
                </tr>
                <tr>
                    <td>Youssef El Amrani</td>
                    <td>2025-03-15</td>
                    <td class="paid">Payée</td>
                    
                </tr>
                <tr>
                    <td>Sarah Bouchra</td>
                    <td>2025-03-18</td>
                    <td class="unpaid">Non Payée</td>
                   
                </tr>
                <tr>
                    <td>Ali Ben Salem</td>
                    <td>2025-03-10</td>
                    <td class="paid">Payée</td>
                   
                </tr>
                <tr>
                    <td>Fatima Zahra</td>
                    <td>2025-03-12</td>
                    <td class="unpaid">Non Payée</td>
                    
                </tr>
                <tr>
                    <td>Youssef El Amrani</td>
                    <td>2025-03-15</td>
                    <td class="paid">Payée</td>
                  
                </tr>
                <tr>
                    <td>Sarah Bouchra</td>
                    <td>2025-03-18</td>
                    <td class="unpaid">Non Payée</td>
                   
                </tr>
                <tr>
                    <td>Ali Ben Salem</td>
                    <td>2025-03-10</td>
                    <td class="paid">Payée</td>
                  
                </tr>
                <tr>
                    <td>Fatima Zahra</td>
                    <td>2025-03-12</td>
                    <td class="unpaid">Non Payée</td>
                    
                </tr>
                <tr>
                    <td>Youssef El Amrani</td>
                    <td>2025-03-15</td>
                    <td class="paid">Payée</td>
                    
                </tr>
                <tr>
                    <td>Sarah Bouchra</td>
                    <td>2025-03-18</td>
                    <td class="unpaid">Non Payée</td>
                 
                </tr>
                <tr>
                    <td>Ali Ben Salem</td>
                    <td>2025-03-10</td>
                    <td class="paid">Payée</td>
                   
                </tr>
                <tr>
                    <td>Fatima Zahra</td>
                    <td>2025-03-12</td>
                    <td class="unpaid">Non Payée</td>
                   
                </tr>
                <tr>
                    <td>Youssef El Amrani</td>
                    <td>2025-03-15</td>
                    <td class="paid">Payée</td>
                    
                </tr>
                <tr>
                    <td>Sarah Bouchra</td>
                    <td>2025-03-18</td>
                    <td class="unpaid">Non Payée</td>
                    
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