<?php
session_start();

// Récupération des données soumises
$email = $_POST['login-email'];
$password = $_POST['login-password'];

// Vérification de l'authentification
$userData = file_get_contents('database.txt');
$userDataArray = explode("\n", $userData);
$loginSuccessful = false;

// Parcourt des données du fichier data base pour vérifier les identifiants
foreach ($userDataArray as $userDataEntry) {
  $userDataEntry = trim($userDataEntry);
  if (!empty($userDataEntry)) {
    $userDataFields = explode(";", $userDataEntry);
    $storedEmail = $userDataFields[0];
    $storedPassword = $userDataFields[1];

// Vérification de l'adresse e-mail et du mot de passe
    if ($storedEmail === $email && $storedPassword === $password) {
      $loginSuccessful = true;
      break;
    }
  }
}

// Si l'authentification est réussie, enregistre les informations de l'utilisateur en session et redirige vers la page_jeune.php
if ($loginSuccessful) {
    $_SESSION['nom'] = $userDataFields[2];
    $_SESSION['prenom'] = $userDataFields[3];
    $_SESSION['date_naissance'] = $userDataFields[4];
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['reseau'] = $userDataFields[5];
    header('Location: page_jeune.php');
} else {
  // Si l'authentification échoue, redirige vers la page page_jeune_login_failed.php
    header('Location: page_jeune_login_failed.php');
}
?>



