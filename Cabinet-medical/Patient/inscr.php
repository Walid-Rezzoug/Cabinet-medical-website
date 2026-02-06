<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription Patient</title>
    <style>
      h2{
            color: #007bff;
        }
        input[type="text"], input[type="password"],input[type="date"], input[type="tel"],input[type="email"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
      }
        label{
            color:#007bff;
        }
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
            background-color: rgb(255, 255, 255);
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
        input[type=text], input[type=password],input[type=date], input[type=tel],input[type=email] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;

}


button {
    background-color:rgb(55, 55, 55);
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}


button:hover {
  opacity: 0.8;
}


.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}


.container {
  padding: 100px;
  background-color:rgb(104, 104, 104);
}


@media screen and (max-width: 300px) {
  span.psw {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inscription Patient</h2>
        <form action="../php/processP.php" method="post">
        <label for="nom"><b>Nom :</b></label>
    <input type="text" placeholder="Entrer votre Nom" name="nom" required>

    <label for="prenom"><b>Prénom :</b></label>
    <input type="text" placeholder="Entrer votre Prénom" name="prenom" required>

    <label for="dateN"><b>Date de naissance :</b></label>
    <input type="date" placeholder="Entrer votre Date de naissance" name="dateN" required><br>

    <label for="Ntel"><b>N° de téléphone :</b></label>
    <input type="tel" placeholder="Entrer votre numéro de téléphone" name="Ntel" required><br>

    <label for="email"><b>Adresse e-mail :</b></label>
    <input type="email" placeholder="Entrer votre Adresse e-mail" name="email" required><br>

    <label for="adresse"><b>Adresse :</b></label>
    <input type="text" placeholder="Entrer votre Adresse" name="adresse" required><br>

    <label for="sexe"><b>Sexe :</b></label>
    <input type="radio" name="sexe" value="M" required>
    <label>Homme</label>
    <input type="radio" name="sexe" value="F" required>
    <label>Femme</label><br>

    <br><label for="psw"><b>Mot de passe :</b></label>
    <input type="password" placeholder="Entrer votre mot de passe" name="psw" required>
    
    <label for="psw2"></label>
    <input type="password" placeholder="comfirmer votre mot de passe" name="psw2" required>
   
    <button type="submit">S'inscrire</button>
    <a href="../index.html"><button class="button" type=button>Annuler</button></a>
        </form>
    </div>
</body>
</html>
