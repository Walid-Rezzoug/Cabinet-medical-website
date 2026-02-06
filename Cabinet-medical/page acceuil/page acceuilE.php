<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 50px;
            position: relative;
        }
        img {
            width: 30%;
            border-radius: 10px;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
        }
        .signup {
            background-color: #28a745;
            color: white;
        }
        .login {
            background-color: #007bff;
            color: white;
        }
        .staff-login {
            background-color: #ffc107;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            position: absolute;
            top: 10px;
            left: 10px;
        }
        h3 {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="../cnxstaff/index.html" class="staff-login">Login Staff</a>
        <h1>Bienvenue au Cabinet Médical</h1>
        <p>Votre santé, notre priorité. Nous offrons des services médicaux de qualité avec une équipe expérimentée.</p>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQD3f7CU2ZFozaIfHD6GZIcPdxQ1AC3qKHAIA&s" alt="Laboratoire Médical">
        <p>Prenez rendez-vous dès maintenant pour une consultation.</p>
        <p>Si vous êtes déjà inscrit, connectez-vous pour accéder à votre profil.</p>
        <p>Si vous n'êtes pas encore inscrit, veuillez vous inscrire pour bénéficier de nos services.</p>
        <p>Nous beneficions des meilleurs médecins de la villes et offerons un service haut de gamme pour touts nos clients</p>
        <p>Notre équipe est à votre disposition pour répondre à toutes vos questions.</p>
        <div class="buttons">
            <a href="../Patient/inscr.php"><button class="signup">S'inscrire</button></a>
            <a href="../Patient/cnx.php"><button class="login">Se connecter</button></a>
        </div>
        <h3>invalid email or password</h3>
    </div>
</body>
</html>