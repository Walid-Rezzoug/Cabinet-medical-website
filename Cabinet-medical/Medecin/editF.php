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
    <title>Modifier une facture</title>
</head>
<body>
    <h1>Modifier une facture</h1>
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    ?>
        <h3>Modifier la facture ID: <?php echo $id; ?></h3>
        <form action="Facture.php" method="post">
            <fieldset>
                <legend>Informations de la facture</legend>
                <table>
                    <tr>
                        <th>Date de la facture: </th>
                        <td><input type="date" placeholder="Date de la facture" name="date" value="2025-05-22" required/></td>
                    </tr>
                    <tr>
                        <th>Prix: </th>
                        <td><input type="number" step="0.01" placeholder="Prix" name="price" value="5000" required/></td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>Actions</legend>
                <table>
                    <tr>
                        <td colspan="2"><input type="submit" value="Mettre à jour la facture">
                            <input type="reset" />
                            <a href="Facture.php"><button type="button">Retour</button></a>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    <?php
    } else {
        echo "<p>ID de facture non fourni.</p>";
    }
    ?>
</body>
</html>
