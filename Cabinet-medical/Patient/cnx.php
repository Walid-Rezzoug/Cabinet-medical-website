<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(177, 202, 238);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: rgb(112, 152, 208);
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 25%;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Connexion Patient</h2>
        <form action="../php/processP.php" method="post">
            <input type="email" placeholder="email" name="email" required>
            <input type="password" placeholder="Mot de passe" name="pwd" required>
            <input type="hidden" name="account_type" value="assistant" />
            <button type="submit">Se connecter</button></a>
        </form>
    </div>
</body>
</html>