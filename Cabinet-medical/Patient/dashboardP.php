<?php
require '../Config/db.php'; // Include database connection
session_start(); // Start the session
if (!isset($_SESSION['profile_id'])) {
    header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
    exit();
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id != $_SESSION['profile_id']) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
    $stmt = $conn->prepare("SELECT ID, Name, Surname, dob, email, tel, Adresse, sexe FROM patient WHERE id= ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        function getTodaysAppointments($conn) {
            $today = new DateTime();
            $todayString = $today->format('Y-m-d');
            $result = $conn->query("SELECT r.*, p.name, p.surname, a.numA FROM rendezvous r JOIN année a ON r.IDA = a.IDA JOIN patient p ON r.IDP = p.ID");
            if ($result->num_rows > 0) {
                $todaysAppointments = array();
                while ($row = $result->fetch_assoc()) {
                    $appointmentDateString = sprintf("%04d-%02d-%02d", $row['numA'], $row['IDM'], $row['IDJ']);
                    $appointmentDateTime = DateTime::createFromFormat('Y-m-d', $appointmentDateString);
        
                    if ($appointmentDateTime !== false && $appointmentDateTime->format('Y-m-d') === $todayString) {
                        $todaysAppointments[] = $row;
                    }
                }
                return $todaysAppointments;
            } else {
                return array();
            }
        }
        
        $todaysAppointments = getTodaysAppointments($conn);
?> 
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}
th {
    background:rgb(20, 97, 213);
    color: white;
}

/* 🌿 Effet survol sur les lignes */
td:hover {
    background-color:rgb(111, 158, 225);
}
        body {
            display: flex ;
            height: 100vh;
        }
        .tbl{
            color:rgb(0, 3, 7);
        }
        .sidebar {
            width: 200px;
            background:rgb(0, 76, 157);
            color: white;
            padding: 20px;
            height: 100vh;
            left: 0;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background:rgb(111, 158, 225);
            height: 100vh;
            left:20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .rdv{
            color:rgb(0, 3, 7);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Patient</h2>
        <ul class="nav flex-column">
            
            <li class="nav-item"><?php echo "<a href='ProfilP.php?id={$row['ID']}' class='nav-link text-white'>Mon Profil</a>"?></li> 
            <li class="nav-item"><?php echo "<a href='Calendrierrdv.php?id={$row['ID']}' class='nav-link text-white'>Rendez-vous</a>"?></li>
            <li class="nav-item"><?php echo "<a href='consultation.php?id={$row['ID']}' class='nav-link text-white'>Consultations</a>"?></li>
        </ul>
    </div>
    <div class="content">
        <h1 class=tbl>Tableau de bord</h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rendez-vous du jour</h5>
                        <?php
                        $todayJ = date("d");
                        $todayM = date("m");
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total_rdv FROM rendezvous WHERE IDJ = ? AND IDM = ? AND IDP = ?");
                        $stmt->bind_param("iii", $todayJ, $todayM,$id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalRdv = $row['total_rdv'];
                        } else {
                            $totalRdv = 0;
                        }
                        ?>
                        <p class="card-text"><?php echo $totalRdv; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <tbody>
        <h1>Rendez-vous du jour</h1>
        <table class="table">
        <thead>
                <tr class="tablep">
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
                <?php
                if (count($todaysAppointments) > 0) {
                    foreach ($todaysAppointments as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['name']) . " " . htmlspecialchars($row['surname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['IDJ']) . "/" . htmlspecialchars($row['IDM']) . "/" . htmlspecialchars($row['numA']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['numH']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Aucun rendez-vous trouvé pour aujourd'hui.</td></tr>";
                }
                ?>
                </table>
        </tbody>
       
</body>
</html>
<?php
} else {
        echo "Patient not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='cnx.php'>Back</a></h3>";
}

$conn->close();
?>
