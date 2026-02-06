<?php
require '../Config/db.php'; // Include database connection
    session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM staff WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?> 
<html>
    <body>
    <div class="container">
<legend><b>Assistant's information</b></legend>
<table>
    <tr>
        <th>Assistant ID: </th>
        <td><?php echo htmlspecialchars($row['ID']); ?></td>
    <tr>
        <th>Full name: </th>
        <td><?php echo htmlspecialchars($row['Name']); ?> <?php echo htmlspecialchars(string: $row['Surname']); ?> </td>
    </tr>
    <tr>
        <th>Date of birth: </th>
        <td><?php echo htmlspecialchars($row['dob']); ?></td>
    </tr>
    <tr>
        <th>Address: </th>
        <td><?php echo htmlspecialchars($row['Adresse']); ?></td>
    </tr>
    <tr>
        <th>Phone number: </th>
        <td><?php echo htmlspecialchars($row['tel']); ?></td>
    </tr>
    <tr>
        <th>Email: </th>
        <td><?php echo htmlspecialchars($row['email']); ?></td>
    </tr>
    <tr>
        <th>Sexe: </th>
        <td><?php echo htmlspecialchars($row['sexe']); ?></td>
    </tr>

</table>
<a href="Assistant.php"><button type="button" class="button2" >Back</button></a>
</div>  
    </body>
</html>
<?php
} else {
        echo "Assistant not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='Assistant.php'>Back</a></h3>";
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

        .container {
            background:rgb(209, 77, 48);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
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
            color:rgb(2, 16, 7);
        }
        .button2{
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
