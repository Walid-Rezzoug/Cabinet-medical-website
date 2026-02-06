<?php
    require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $sql = "SELECT IDC, ID , date, heureC, qstnrC, diagnosticC, honoraireC, traitementC  FROM consultation";
    $result = $conn->query($sql);
    $sql2 = "SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient";
    $result2 = $conn->query($sql2);
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
<h1>Liste des Consultations</h1>
<div class="container">
<?php
if (isset($_GET['id'])){
    $id=$_GET['id'];
    ?><a href="Patient.php"> <button type="button" class="button3" >Back</button></a>
    <a href="NouvelleC.php?id=<?php echo $id?>"> <button type="button" class="button4" >Ajouter</button></a> <br/><?php
    if ($result->num_rows > 0) {
        ?>   <input class="search" type="text" id="searchInput" onkeyup="searchConsultations()" placeholder="🔍 Rechercher une consultation par date...">
        <script>
            function searchConsultations() {
                let input = document.getElementById("searchInput").value.toLowerCase();
                let table = document.querySelector("table");
                let rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    let dateCell = rows[i].getElementsByTagName("td")[0];
                    if (dateCell) {
                        let dateText = dateCell.textContent || dateCell.innerText;
                        rows[i].style.display = dateText.toLowerCase().includes(input) ? "" : "none";
                    }
                }
            }
        </script>
<?php
        echo "<table border='1' width='100%'>
                <tr>
                    <th>Date of consultation</th>
                    <th>heure de consultation</th>
                    <th>questionnaire</th>
                    <th>diasgnostic</th>
                    <th>honoraire</th>
                    <th>traitement</th>
                    <th>Action</th>
                </tr>";
        
     
        while ($row = $result->fetch_assoc()) {
            if($id == $row['ID']){
                $heure = date("H:i", strtotime($row['heureC'])); // Convert text to hour format
                echo "<tr>
                    <td>{$row['date']}</td>
                    <td>{$heure}</td>
                    <td>{$row['qstnrC']}</td>
                    <td>{$row['diagnosticC']}</td>
                    <td>{$row['honoraireC']}</td>
                    <td>{$row['traitementC']}</td>
                    <td>
                    "?> <a href='ModifierC.php?id=<?php echo $row['IDC']; ?>&idp=<?php echo $id; ?>'>Modifier</a> <?php echo "
                  </tr>";
            }
     }
        echo "</table>";
        ?></a><?php
    } else {
        echo "No consultations found.";
    }
}else{
    echo "<a href='dashboardM.php'> <button type='button' class='button3' >Back</button></a>";
    if ($result->num_rows > 0 && $result2->num_rows > 0) {
        ?>   <input class= search type="text" id="searchInput" onkeyup="searchAppointments()" placeholder="🔍 Rechercher un patient...">
    <script>
        function searchAppointments() {
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
<?php
        echo "<table border='1' width='100%'>
        <tr>
            <th>Patient</th>
            <th>Date of consultation</th>
            <th>heure de consultation</th>
            <th>questionnaire</th>
            <th>diasgnostic</th>
            <th>honoraire</th>
            <th>traitement</th>
            <th>Action</th>
        </tr>";


while ($row = $result->fetch_assoc()) {
    $sql2 = "SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient where ID = ?";
    $idp = $row['ID'];
    $stmt = $conn->prepare($sql2);
    $stmt->bind_param("i", $idp);
    $stmt->execute();
    $result2 = $stmt->get_result();
    $row2 = $result2->fetch_assoc();
    $name = $row2['name']." ".$row2['surname'];
    $stmt->close();
    $heure = date("H:i", strtotime($row['heureC']));
        echo "<tr>
            <td>{$name}</td>
            <td>{$row['date']}</td>
            <td>{$heure}</td>
            <td>{$row['qstnrC']}</td>
            <td>{$row['diagnosticC']}</td>
            <td>{$row['honoraireC']}</td>
            <td>{$row['traitementC']}</td>
            <td>
                <a href='ModifierC.php?id={$row['IDC']}'>Modifier</button></a>
            </td>
          </tr>";
}
echo "</table>";
?></a><?php
} else {
echo "No consultations found.";
}
}

$conn->close();
?>
</div>
</html>