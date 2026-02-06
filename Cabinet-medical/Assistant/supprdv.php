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
    if (isset ($_GET['idp'])) {
        $idp = $_GET['idp'];
    } else {
        header("Location: rendez-vous.php?id=$id");
        exit(); // Redirect to login page if not logged in
    }
    if (isset($_GET['idr'])) {
        $idr = $_GET['idr'];
    } else {
        header("Location: rendez-vous.php?id=$id");
        exit(); // Redirect to login page if not logged in
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM staff WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
            $stmt = $conn->prepare("DELETE FROM rendezvous WHERE IDP = ? AND IDH = ?");
            $stmt->bind_param("ii", $idp, $idr);
            if ($stmt->execute()) {
                $message = "Appointment deleted successfully.";
            } else {
                $message = "Error: " . $stmt->error;
            }
            $stmt->close();
            header("Location: rendez-vous.php?id=$id"); // Redirect to the appointment page after deletion
        }
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Déconnexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color:rgb(169, 231, 174);
        }

        h2{
            color: rgb(19, 162, 88);
        }
        .container {
            background:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }
        button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
        
        .confirm {
            background: red;
            color: white;
        }
        .cancel {
            background-color:rgb(26, 28, 32);
            color: white;
            margin: 10px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
     <form method="post">
            <h2>Are you sure you want to delete appointement?</h2>
            <button type="submit" class="confirm" name="confirm">Delete</button>
            <?php echo "<a href='rendez-vous.php?id={$row['ID']}'><button class='cancel' type=button>Annuler</button></a>"?>
     </form>
    </div>
</body>
</html>
<?php
} else {
        echo "Assitant not found.";
    }
} else {
    echo "<h3>Error while searching the id <a href='../cnxstaff/index.html'>Back</a></h3>";
}

$conn->close();
?>