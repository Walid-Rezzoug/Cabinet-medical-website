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
<body>
    <div class="profile-card">
        <h1>Mon Profil Assistant :</h1>
        <p class=p><span class="info">Nom :</span><?php echo htmlspecialchars($row['Name']); ?></p>
        <p class=p><span class="info">prénom :</span><?php echo htmlspecialchars($row['Surname']); ?></p>
        <p class=p><span class="info">Date de naissance :</span><?php echo htmlspecialchars($row['dob']); ?></p>
        <p class=p><span class="info">Email :</span><?php echo htmlspecialchars($row['email']); ?></p>
        <p class=p><span class="info">Téléphone :</span> <?php echo htmlspecialchars($row['tel']); ?></p>
        <p class=p><span class="info">Adresse :</span><?php echo htmlspecialchars($row['Adresse']); ?></p>
        <p class=p><span class="info">sexe :</span><?php echo htmlspecialchars($row['sexe']); ?></p>
        <?php echo "<a href='dashboardA.php?id={$row['ID']}'><button type='button' class='button3'>Back</button></a>"; ?>
<?php echo "<a href='Modifierprof.php?id={$row['ID']}'><button type='button' class='button1'>Edit</button></a>"; ?>
<?php echo "<a href='logout.php?id={$row['ID']}'><button type='button' class='button2'>Log-out</button></a>"; ?>
    </div>

</body>
</html>
<?php
} else {
        echo "Assistant not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='dashboardM.php'>Back</a></h3>";
}

$conn->close();
?>
<html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(153, 214, 158);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            color: rgb(6, 145, 73);
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
    }

        .profile-card {
            background:rgb(255, 255, 255);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 500px;
            text-align: center;
            height:300px;
        }

        h2 {
            margin: 10px 0;
            color: #333;
        }

        p {
            color: #555;
            margin: 5px 0;
        }

        .info {
            font-weight: bold;
            color:rgb(6, 145, 73);
        }
        .button2{
  width: auto;
  padding: 5px 10px;
  background-color: #f44336;
  left:0;
  border-radius: 12px;
  color: white;
}
.button1{
  width: auto;
  padding: 5px 10px;
  background-color:rgb(241, 135, 14);
  left:0;
  border-radius: 12px;
  color: white;
}
.button3{
  width: auto;
  padding: 5px 10px;
  background-color:rgb(5, 5, 5);
  left:0;
  border-radius: 12px;
  color: white;
}
 .p{
    color:rgb(6, 16, 7);
 }
      </style>
</html> 