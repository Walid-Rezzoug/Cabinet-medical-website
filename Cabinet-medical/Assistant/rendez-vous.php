<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['mimi'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id != $_SESSION['mimi']) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM staff WHERE id= ?");
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
            border: 2px solid rgb(60, 160, 60);
            border-radius: 5px;
        }  
        body {
    font-family: Arial, sans-serif;
    background:rgb(153, 214, 158);
    text-align: center;
    margin: 0;
    padding: 0;
}

/* 🌿 En-tête */
h1 {
            color:rgb(2, 59, 34);
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



/*  Tableau */
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
    background:rgb(5, 165, 83);
    color: white;
}

/* 🌿 Effet survol sur les lignes */
tr:hover {
    background-color:rgb(148, 228, 155);
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
  background-color:rgb(44, 167, 72);
  left:0;
  border-radius: 12px;
  color: white;
}
    </style>
    <div class="container">
        <!-- Barre de recherche -->
        <input class= search type="text" id="searchInput" onkeyup="searchAppointments()" placeholder="🔍 Rechercher un patient...">
        <?php echo "<a href='dashboardA.php?id={$row['ID']}'> <button type='button' class='button3' >Back</button></a>
        <a href='select.php?id={$row['ID']}'> <button type='button' class='button4' >Ajouter</button></a>"; ?>
        <!-- Tableau des rendez-vous -->
        <table>
            <thead>
                <tr>
                    <th>Nom du Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="appointmentsTable">
                <?php
                $result = $conn->query("SELECT * FROM rendezvous ");
                if ($result->num_rows > 0) {
                    while ($row3 = $result->fetch_assoc()) {
                        echo "<tr>";
                        $idp=$row3['IDP'];
                        $stmt1 = $conn->prepare("SELECT name, surname FROM patient WHERE ID= ?");
                        $stmt1->bind_param("i", $idp);
                        $stmt1->execute();
                        $result1 = $stmt1->get_result();
                        $row1 = $result1->fetch_assoc();
                        echo "<td>" . htmlspecialchars($row1['name']) . " " . htmlspecialchars($row1['surname']) . "</td>";
                        $IDA=$row3['IDA'];
                        $stmt2 = $conn->prepare("SELECT numA FROM année WHERE IDA= ?");
                        $stmt2->bind_param("i", $IDA);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
                        echo "<td>" . htmlspecialchars($row3['IDJ']) ."/".htmlspecialchars($row3['IDM'])."/".htmlspecialchars($row2['numA']) ."</td>";
                        echo "<td>" . htmlspecialchars($row3['numH']) . "</td>";
                        echo "<td><a href='supprdv.php?id=$id&idp=$idp&idr={$row3['IDH']}'><button type='button' class='button4'>Supprimer</button></a> <a href='modif.php?id=$id&idr={$row3['IDH']}'><button type='button' class='button4'>Modifier</button></a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucun rendez-vous trouvé.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php
} else {
        echo "Assitant not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='../cnxstaff/index.html'>Back</a></h3>";
}

$conn->close();
?>