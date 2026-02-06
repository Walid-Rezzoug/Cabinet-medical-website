<?php
    require '../Config/db.php';
    session_start(); // Start the session
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        if (!isset($_SESSION['profile_id'])) {
            header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
            exit();
        }
        if ($id != $_SESSION['profile_id']) {
            header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
            exit();
        }
        $stmt = $conn->prepare("SELECT IDC, ID , date, heureC, qstnrC, diagnosticC, honoraireC, traitementC  FROM consultation WHERE ID= ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Consultations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<style>
    /* 🌿 Styles généraux */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
        background:rgb(111, 158, 225);
        text-align: center;
    }

    h1 {
        color: rgb(6, 16, 7);
    }

    /* 🌿 Tableau des assistants */
    .container {
        width: 80%;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    table {
        width: 100%;
        margin: auto;
        border-collapse: collapse;
        background: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background:  #007bff;
        color: white;
    }

    td:hover {
        background-color: rgb(111, 158, 225);
    }

    a {
        text-decoration: none;
        color: rgb(0, 0, 0);
    }

    a:hover {
        text-decoration: underline;
    }

    input[type="button"] {
        padding: 10px 15px;
        background-color: rgb(4, 4, 4);
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="button"]:hover {
        background-color: rgb(6, 16, 7);
    }
    .search {
            width: 50%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #007bff;
            border-radius: 5px;
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
  background: #007bff;
  left:0;
  border-radius: 12px;
  color: white;
}
</style>
<h1>Liste des Consultations</h1>
<div class="container">
    
<?php
    echo "<a href='dashboardP.php?id=$id'> <button type='button' class='button3' >Back</button></a>";
    if ($result->num_rows > 0) {
        ?>   <input class= search type="text" id="searchInput" onkeyup="searchAppointments()" placeholder="🔍 Rechercher un patient...">
<?php
        echo "<table border='1' width='100%'>
        <tr>
            <th>Date of consultation</th>
            <th>heure de consultation</th>
            <th>questionnaire</th>
            <th>diasgnostic</th>
            <th>honoraire</th>
            <th>traitement</th>
        </tr>";
while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['date']}</td>
            <td>{$row['heureC']}</td>
            <td>{$row['qstnrC']}</td>
            <td>{$row['diagnosticC']}</td>
            <td>{$row['honoraireC']}</td>
            <td>{$row['traitementC']}</td>
          </tr>";
}
echo "</table>";
?></a><?php
} else {
echo "No consultations found.";
}
} else {
    echo "<h3>Error: No ID provided. <a href='cnx.php'>Back</a></h3>";
}

$conn->close();
?>
</div>
</html>