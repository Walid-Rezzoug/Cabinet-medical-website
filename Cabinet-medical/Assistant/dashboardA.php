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
    <title>Dashboard - Assistant</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        th, td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: left;
}

/* 🌿 Effet survol sur les lignes */
td:hover {
    background-color:rgb(169, 231, 174);
}
        body {
            display: flex ;
            height: 100vh;
            background-color:rgb(153, 214, 158);
        }
        .sidebar {
            width: 200px;
            background:rgb(6, 145, 73);
            color: white;
            padding: 20px;
            height: 150vh;
            left: 0;
        }
        th {
    color: white;
    padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
}


        .content {
            flex-grow: 1;
            padding: 20px;
            background:rgb(147, 214, 153);
            height: 150vh;
            left:20px;
        }
        .card {
            margin-bottom: 20px;
        }
        
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .tablep {
            color: rgb(5, 165, 83);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Assistant Médical</h2>
        <ul class="nav flex-column">
            
            <li class="nav-item"><?php echo "<a href='profilA.php?id={$row['ID']}' class='nav-link text-white'>Mon Profil</a>"; ?></li>
            <li class="nav-item"><?php echo "<a href='patient.php?id={$row['ID']}' class='nav-link text-white'>Patients</a>"; ?></li>
            <li class="nav-item"><?php echo "<a href='rendez-vous.php?id={$row['ID']}' class='nav-link text-white'>Rendez-vous</a>"; ?></li>
        </ul>
    </div>
    <div class="content">
        <h1>Tableau de bord</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Patients</h5>
                        <?php
                        $result = $conn->query("SELECT COUNT(*) AS total_patients FROM patient");
                        if ($result && $row = $result->fetch_assoc()) {
                            $totalPatients = $row['total_patients'];
                        } else {
                            $totalPatients = 0;
                        }
                        ?>
                        <p class="card-text"><?php echo $totalPatients; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Rendez-vous du jour</h5>
                                                <?php
                        $todayJ = date("d");
                        $todayM = date("m");
                        $stmt = $conn->prepare("SELECT COUNT(*) AS total_rdv FROM rendezvous WHERE IDJ = ? AND IDM = ?");
                        $stmt->bind_param("ii", $todayJ, $todayM);
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
    </div>
</body>
</html>
<?php
} else {
        echo "Rendez-vous not found.";
    }
    
    $stmt->close();
} else {
    echo "<h3>Error while searching the id <a href='../cnxstaff/index.html'>Back</a></h3>";
}

$conn->close();
?>
