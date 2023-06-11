<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
  header('Location: page_jeune_index.php');
  exit();
}

$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$date_naissance = $_SESSION['date_naissance'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$reseau = $_SESSION['reseau'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles informations depuis le formulaire
    $newNom = $_POST['nom'];
    $newPrenom = $_POST['prenom'];
    $newDate_naissance = $_POST['date_naissance'];
    $newPassword = $_POST['password'];
    $newEmail = $_POST['email'];
    $newReseau = $_POST['reseau'];
  
    // Vérifier s'il y a des modifications
    if ($newNom !== $nom || $newPrenom !== $prenom || $newDate_naissance !== $date_naissance ||
        $newPassword !== $password || $newEmail !== $email || $newReseau !== $reseau) {
      
        // Mettre à jour les informations de l'utilisateur dans la session
        $_SESSION['nom'] = $newNom;
        $_SESSION['prenom'] = $newPrenom;
        $_SESSION['date_naissance'] = $newDate_naissance;
        $_SESSION['email'] = $newEmail;
        $_SESSION['password'] = $newPassword;
        $_SESSION['reseau'] = $newReseau;
      
        // Mettre à jour les informations de l'utilisateur dans la base de données
        $database = file_get_contents('database.txt');
        $userEntries = explode("\n", $database);
        $updatedUserEntries = '';
        foreach ($userEntries as $userEntry) {
            $userDataFields = explode(";", $userEntry);
            if ($userDataFields[0] === $email) {
                $userDataFields[0] = $newEmail;
                $userDataFields[1] = $newPassword;
                $userDataFields[2] = $newNom;
                $userDataFields[3] = $newPrenom;
                $userDataFields[4] = $newDate_naissance;
                $userDataFields[5] = $newReseau;
            }
            $updatedUserEntries .= implode(";", $userDataFields) . "\n";
        }
        file_put_contents('database.txt', $updatedUserEntries);
    }

    // Rediriger vers la page de bienvenue avec les informations mises à jour
    header('Location: page_jeune.php');
    exit();
}

// Gérer la déconnexion
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: page_jeune_index.php');
    exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
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
            <li><a class="menu_jeune_actif" href="page_jeune.php">JEUNE</a></li>
            <li><a class="menu_referent" >RÉFÉRENT</a></li>
            <li><a class="menu_consultant" >CONSULTANT</a></li>
            <li><a class="menu_partenaires" href="page_partenaires.php">PARTENAIRES</a></li>
            <li><a class="menu_deconnexion" href="?logout=true">DECONNEXION</a></li>
        </ul>
    </nav>

    <div class="text_before">
        <h2>Mes informations</h2>
    </div>

    <div class="block_center">

        <form action="page_jeune.php" method="POST">

            <div class="data">
                <div class="container">
                    <label for="nom">Nom :</label>
                    <input class="custom_input" type="text" id="nom" name="nom" value="<?php echo $nom; ?>">
                </div>

                <div class="container">
                    <label for="prenom">Prénom :</label>
                    <input class="custom_input" type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>">
                </div>

                <div class="container">
                    <label for="date_naissance">Date de naissance :</label>
                    <input class="custom_input" type="date" id="date_naissance" name="date_naissance" value="<?php echo $date_naissance; ?>">
                </div>

                <div class="container">
                    <label for="email">Email :</label>
                    <input class="custom_input" type="email" id="email" name="email" value="<?php echo $email; ?>">
                </div>

                <div class="container">
                    <label for="password">Mot de passe :</label>
                    <input class="custom_input" type="password" id="password" name="password" value="<?php echo $password; ?>">
                </div>

                <div class="container">
                    <label for="reseau">Réseau social :</label>
                    <input class="custom_input" type="text" id="reseau" name="reseau" value="<?php echo $reseau; ?>">
                </div>

            </div>

            <div class="container_button">
                <button type="submit" class="button">Mettre à jour</button>
                <a href="page_jeune_demande.php" class="button">Demande de référence</a>
            </div>

        </form>
    </div>


</body>

</html>
