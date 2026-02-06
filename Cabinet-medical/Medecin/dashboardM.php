<?php
session_start();
if (!isset($_SESSION['mama'])) {
    header("Location: ../page%20acceuil/");
    exit();
}
require '../Config/db.php';

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
        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        td:hover {
            background-color: rgb(228, 149, 148);
        }

        .tablep {
            background: rgb(209, 77, 48);
            color: white;
        }

        body {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 200px;
            ;
            background: rgb(192, 61, 32);
            color: white;
            padding: 20px;
            height: 150vh;
            left: 0;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
            background: rgb(228, 149, 148);
            height: 150vh;
            left: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Médecin</h2>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="profilM.php" class="nav-link text-white">Mon Profil</a></li>
            <li class="nav-item"><a href="Patient.php" class="nav-link text-white">Patients</a></li>
            <li class="nav-item"><a href="rdvM.php" class="nav-link text-white">Rendez-vous</a></li>
            <li class="nav-item"><a href="Assistant.php" class="nav-link text-white">Assistants</a></li>
            <li class="nav-item"><a href="Consultation.php" class="nav-link text-white">Consultation</a></li>
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
        <h2>Rendez-vous a venir</h2>
        <table class="table">
            <thead>
                <tr class="tablep">
                    <th>Patient</th>
                    <th>Date</th>
                    <th>Heure</th>
                </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
</body>
</html>
