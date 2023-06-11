<?php
session_start();


// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['email'])) {
  header('Location: page_jeune.php');
  exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['register-nom'];
    $prenom = $_POST['register-prenom'];
    $date_naissance = $_POST['register-date-naissance'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $reseau = $_POST['register-reseau'];


  // Lire le contenu de la base de données
  $database = file_get_contents('database.txt');

  // Vérifier si l'utilisateur existe déjà
  $userExists = false;
  $userEntries = explode("\n", $database);
  foreach ($userEntries as $userEntry) {
    $userDataFields = explode(";", $userEntry);
    if ($userDataFields[0] === $email) {
      $userExists = true;
      break;
    }
  }

  if ($userExists) {
    header('Location: page_jeune_registration_fail.php');
    exit();
  } else {
    // Ajouter l'utilisateur à la base de données
    $newUserEntry = $email . ';' . $password . ';' . $nom . ';' . $prenom . ';' . $date_naissance . ';' . $reseau . "\n";
    file_put_contents('database.txt', $newUserEntry, FILE_APPEND);
    header('Location: page_jeune_registration_succes.php');
    exit();
  }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset = "utf-8">
    <title>Inscription</title>
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
            <li><a class="menu_consultant">CONSULTANT</a></li>
            <li><a class="menu_partenaires" href="page_partenaires.php">PARTENAIRES</a></li>
        </ul>
    </nav>

    <div class="text_before">
        <h2>Inscrivez-vous</h2>
    </div>

    <div class="block_center">

        <form action="page_jeune_register.php" method="POST">

            <div class="data">

                <div class="container">
                    <label for="register-nom">Nom :</label>
                    <input class="custom_input" type="text" id="register-nom" name="register-nom" required>
                </div>

                <div class="container">
                    <label for="register-prenom">Prénom :</label>
                    <input class="custom_input" type="text" id="register-prenom" name="register-prenom" required>
                </div>
                        
                <div class="container">
                    <label for="register-date_naissance">Date de naissance :</label>
                    <input class="custom_input" type="date" id="register-date-naissance" name="register-date-naissance" required>
                </div>

                <div class="container">
                    <label for="register-email">Email :</label>
                    <input class="custom_input" type="email" id="register-email" name="register-email" required>
                </div>            

                <div class="container">
                    <label for="register-password">Mot de passe :</label>
                    <input class="custom_input" type="password" id="register-password" name="register-password" required>
                </div>

                <div class="container">
                    <label for="register-reseau">Réseau social :</label>
                    <input class="custom_input" type="text" id="register-reseau" name="register-reseau" required>
                </div>
            
            </div>

                <div class="container_button">
                    <button type="submit" class="button">S'inscrire</button>
                </div>
        </form>

    </div>
</body>


</html>