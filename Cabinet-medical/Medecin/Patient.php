<?php
    require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $sql = "SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Patients</title>
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
        background:rgb(228, 149, 148);
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
        background: rgb(192, 61, 32);
        color: white;
    }

    td:hover {
        background-color: rgb(228, 149, 148);
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
            border: 2px solid #d14d30;
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
  background:rgb(195, 62, 32);
  left:0;
  border-radius: 12px;
  color: white;
}
</style>
<h1>Liste des Patients</h1>
<div class="container">
<?php
if ($result->num_rows > 0) {
    ?>   <input class="search" type="text" id="searchInput" onkeyup="searchPatients()" placeholder="🔍 Rechercher un patient...">
    <script>
        function searchPatients() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table');
            const rows = table.getElementsByTagName('tr');
            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        const textValue = cells[j].textContent || cells[j].innerText;
                        if (textValue.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                rows[i].style.display = match ? '' : 'none';
            }
        }
    </script>
    <a href="dashboardM.php"> <button type="button" class="button3" >Back</button></a>
    <a href="addnewP.php"> <button type="button" class="button4" >Ajouter</button></a><?php
    echo "<table border='1' width='100%'>
            <tr>
                <th>Patient ID</th>
                <th>Full Name</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Sexe</th>
                <th>consultation</th>
                <th>Actions</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['ID']}</td>
                <td><a href='infoP.php?id={$row['ID']}'>{$row['name']} {$row['surname']}</a></td>
                <td>{$row['dob']}</td>
                <td>{$row['email']}</td>
                <td>{$row['tel']}</td>
                <td>{$row['adresse']}</td>
                <td>{$row['sexe']}</td>
                <td><a href='Consultation.php?id={$row['ID']}'>consultation</a></td>
                <td>
                    <a href='editP.php?id={$row['ID']}'>Edit</a>
                    <a href='deleteP.php?id={$row['ID']}'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
    ?></a><?php
} else {
    echo "No patients found.";
}

$conn->close();
?>
</div>
</html>