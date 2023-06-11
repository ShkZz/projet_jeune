<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
  header('Location: page_jeune.php');
  exit();
}


// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupérer les données soumises
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Lire le contenu de la base de données
  $database = file_get_contents('database.txt');
  $userExists = false;

  // Parcourir les lignes de la base de données
  $userEntries = explode("\n", $database);
  foreach ($userEntries as $userEntry) {
    $userDataFields = explode(";", $userEntry);

    // Vérifier si le nom d'utilisateur et le mot de passe correspondent
    if ($userDataFields[0] === $email && $userDataFields[1] === $password) {
      $userExists = true;
      break;
    }
  }

  if ($userExists) {
    $_SESSION['nom'] = $userDataFields[2];
    $_SESSION['prenom'] = $userDataFields[3];
    $_SESSION['date_naissance'] = $userDataFields[4];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['reseau'] = $userDataFields[5];
    header('Location: page_jeune.php');
    exit();
  } else {
    header('Location: page_jeune_login_failed.php');
    exit();
  }
}

?>




<!DOCTYPE html>
<html>

<head>
    <meta charset = "utf-8">
    <title>JEUNE</title>
    <link rel="icon" href="LOGO_1.png">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="page_jeune.css">
    <style>
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="visiteur.php"><img src="LOGO_1.png"></a>
        </div>
        <div class="header-text">
            <h1>JEUNE</h1>
            <p>Je donne de la valeur à mon engagement</p>
        </div>
        
    </header>

    <nav>
        <ul>
            <li><a class="menu_jeune_actif" href="page_jeune_index.php">JEUNE</a></li>
            <li><a class="menu_referent" >RÉFÉRENT</a></li>
            <li><a class="menu_consultant" >CONSULTANT</a></li>
            <li><a class="menu_partenaires" href="page_partenaires.php">PARTENAIRES</a></li>
        </ul>
    </nav>

    <div class="text_before">
        <h2>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h2>
    </div>

    <div class="block_center">

        <form action="page_jeune_index.php" method="POST">

            <div class="data">
                
                <div class="container">
                    <label for="email">Email :</label>
                    <input class="custom_input" type="email" id="email" name="email" required>
                </div>            

                <div class="container">
                    <label for="password">Mot de passe :</label>
                    <input class="custom_input" type="password" id="password" name="password" required>
                </div>

            </div>

            <div class="container_button">
                    <button type="submit" class="button">Connexion</button>
            </div>

        </form>
        <form action="page_jeune_register.php" method="POST">

            <div class="P1">
                <p>Vous ne possédez pas de compte ?<p>
            </div>
            
            <div class="container_button">
                <a class="button" href="page_jeune_register.php">S'inscrire</a>
            </div>
            
        </form>

    </div>

</body>


</html>