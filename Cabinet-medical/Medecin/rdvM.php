<?php
session_start(); // Start the session
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}

require '../Config/db.php'; // Include database connection

// Fonction pour vérifier et supprimer les rendez-vous expirés
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
            border: 2px solid #d14d30;
            border-radius: 5px;
        }
        body {
    font-family: Arial, sans-serif;
    background:rgb(228, 149, 148);
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
    background:rgb(192, 61, 32);
    color: white;
}

/* 🌿 Effet survol sur les lignes */
tr:hover {
    background-color:rgb(228, 149, 148);
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
    <div class="container">
        <input class= search type="text" id="searchInput" onkeyup="searchAppointments()" placeholder="🔍 Rechercher un patient...">
        <?php echo "<a href='dashboardM.php'> <button type='button' class='button3' >Back</button></a>
        <a href='select.php'> <button type='button' class='button4' >Ajouter</button></a>"; ?>
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
                $result = $conn->query("SELECT r.*, p.name, p.surname, a.numA FROM rendezvous r JOIN patient p ON r.IDP = p.ID JOIN année a ON r.IDA = a.IDA");
                if ($result->num_rows > 0) {
                    while ($row3 = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row3['name']) . " " . htmlspecialchars($row3['surname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row3['IDJ']) ."/".htmlspecialchars($row3['IDM'])."/".htmlspecialchars($row3['numA']) ."</td>";
                        echo "<td>" . htmlspecialchars($row3['numH']) . "</td>";
                        echo "<td><a href='supprdv.php?idp={$row3['IDP']}&idr={$row3['IDH']}'><button type='button' class='button4'>Supprimer</button></a> <a href='modif.php?idr={$row3['IDH']}'><button type='button' class='button4'>Modifier</button></a></td>";
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

<script>
function searchAppointments() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("appointmentsTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0]; // Search by patient name (first column)
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
</script>