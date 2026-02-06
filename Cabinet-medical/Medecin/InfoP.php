<?php
require '../Config/db.php'; // Include database connection
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT ID, name, surname, dob, email, tel, adresse, sexe FROM patient WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
        
        $row = $result->fetch_assoc();
        

?> 
<html>
    <body>
    <div class="container">
<h1>Patient's information</h1>
        <p class=p><span class="info">Patient ID: 
        </span><?php echo htmlspecialchars($row['ID']); ?></p>
        <p class=p><span class="info">Full name: 
        </span><?php echo htmlspecialchars($row['name']); ?> <?php echo htmlspecialchars(string: $row['surname']); ?></p>
       <p class=p><span class="info">Date of birth: 
        </span><?php echo htmlspecialchars($row['dob']); ?></p>
       <p class=p><span class="info">Address: 
        </span><?php echo htmlspecialchars($row['adresse']); ?></p>
       <p class=p><span class="info">Phone number: 
        </span><?php echo htmlspecialchars($row['tel']); ?></p>
       <p class=p><span class="info">Email: 
        </span><?php echo htmlspecialchars($row['email']); ?></p>
       <p class=p><span class="info">Sexe: 
        </span><?php echo htmlspecialchars($row['sexe']); ?></p>
 


<a href="Patient.php"><button type="button" class="button3" >Back</button></a>
</div>  
    </body>
</html>
<?php
} else {
        echo "Patient not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='patients.php'>Back</a></h3>";
}

$conn->close();
?>
<html>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color:rgb(228, 149, 148);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        h1 {
            color: rgb(209, 48, 11);
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
    }

        .container{
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
            color:rgb(209, 48, 11);
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