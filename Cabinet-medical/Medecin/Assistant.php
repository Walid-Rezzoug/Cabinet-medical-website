
<?php
    require '../Config/db.php';
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $sql = "SELECT ID, UserType, name, surname, dob, email, tel, adresse, sexe FROM staff WHERE UserType = 2";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Assistants</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* 🌿 Styles généraux */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: rgb(228, 149, 148);
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
            color: rgb(192, 61, 32);
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
a {
        text-decoration: none;
        color: rgb(0, 0, 0);
    }

    </style>

</head>
<body>
        <h1>Liste des Assistants</h1>
        <div class="container">
        <input class="search" type="text" id="searchInput" onkeyup="searchAssistants()" placeholder="🔍 Rechercher un assistant par nom...">
        <script>
            function searchAssistants() {
                const input = document.getElementById("searchInput");
                const filter = input.value.toLowerCase();
                const table = document.querySelector("table");
                const rows = table.getElementsByTagName("tr");

                for (let i = 1; i < rows.length; i++) {
                    const nameCell = rows[i].getElementsByTagName("td")[1];
                    if (nameCell) {
                        const name = nameCell.textContent || nameCell.innerText;
                        rows[i].style.display = name.toLowerCase().includes(filter) ? "" : "none";
                    }
                }
            }
        </script>
        <a href="dashboardM.php"> <button type="button" class="button3" >Back</button></a>
        <a href="NouveauA.php"> <button type="button" class="button4" >Ajouter</button></a>
        <?php
        if ($result->num_rows > 0) {
            echo "<table border='1'  width='100%'>
               
                    <tr>
                        <th>Assistant ID</th>
                        <th>Full Name</th>
                        <th>Date of Birth</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Sexe</th>
                        <th>Actions</th>
                    </tr>";
            
            while ($row = $result->fetch_assoc()) {
                //$row = $result->fetch_assoc();
                /*print_r($row);
                echo "<br >";*/
                echo "<tr>
                        <td>{$row['ID']}</td>
                        <td><a href='infoA.php?id={$row['ID']}'>{$row['name']} {$row['surname']}</a></td>
                        <td>{$row['dob']}</td> 
                        <td>{$row['email']}</td>
                        <td>{$row['tel']}</td>
                        <td>{$row['adresse']}</td>
                        <td>{$row['sexe']}</td>
                        <td>
                            <a href='ModifierA.php?id={$row['ID']}'>Edit</a>
                            <a href='deleteA.php?id={$row['ID']}'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "No Assistant found.";
        }
        
        $conn->close();
        ?>
    </div>

</body>
</html>
