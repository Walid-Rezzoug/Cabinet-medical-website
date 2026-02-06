<?php
session_start(); // Start the session
    if (!isset($_SESSION['mama'])) {
        header("Location: ../page%20acceuil/"); // Redirect to login page if not logged in
        exit();
    }
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dossier Patient</title>
</head>
<body>
    <div class="patient-file">
        <h1>Patient File</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Date</th>
                <th>Description</th>
            </tr>
            <tr>
                <td>2025-03-01</td>
                <td>Patient complained of severe headache. Prescribed painkillers and advised rest.</td>
            </tr>
            <tr>
                <td>2025-02-15</td>
                <td>Routine check-up. Blood pressure and cholesterol levels are normal.</td>
            </tr>
            <tr>
                <td>2025-01-20</td>
                <td>Patient reported mild chest pain. ECG performed, results were normal.</td>
            </tr>
        </table>
        <a href="patient.php" class="back-button">
            <button type="button">Retour</button>
        </a>
    </div>
</body>
</html>