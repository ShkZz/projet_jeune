<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['email'])) {
  header('Location: page_jeune_index.php');
  exit();
}

$lien = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles informations depuis le formulaire

    $nomReferent = $_POST['nom_referent'] ?? '';
    $prenomReferent = $_POST['prenom_referent'] ?? '';
    $dateNaissanceReferent = $_POST['date_naissance_referent'] ?? '';
    $portableReferent = $_POST['portable_referent'] ?? '';
    $emailReferent = $_POST['email_referent'] ?? '';
    $reseauSocialReferent = $_POST['reseau_social_referent'] ?? '';
    $descriptionEngagement = $_POST['description_engagement'] ?? '';
    $milieuEngagement = $_POST['milieu_engagement'] ?? '';
    $dureeEngagement = $_POST['duree_engagement'] ?? '';
    $nom = $_SESSION['nom'] ?? '';
    $prenom = $_SESSION['prenom'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $dateNaissance = $_SESSION['date_naissance'] ?? '';
    $reseau = $_SESSION['reseau'] ?? '';
    
    $data = array(
        'email_referent' => $emailReferent,
        'nom_referent' => $nomReferent,
        'prenom_referent' => $prenomReferent,
        'date_naissance_referent' => $dateNaissanceReferent,
        'portable_referent' => $portableReferent,
        'reseau_social_referent' => $reseauSocialReferent,
        'description_engagement' => $descriptionEngagement,
        'milieu_engagement' => $milieuEngagement,
        'duree_engagement' => $dureeEngagement,
        'email' => $email,
        'prenom' => $prenom,
        'nom' => $nom,
        'date_naissance' => $dateNaissance,
        'reseau' => $reseau
    );
    
    $queryString = http_build_query($data);
    $lien = "http://localhost:8000/page_referent.php?$queryString";
    $lien_encode = urlencode($lien);


    // Sauvegarder les informations dans la base de données
    $database = file_get_contents('data_engagement.txt');
    $entry = $nomReferent . ';' . $prenomReferent . ';' . $dateNaissanceReferent . ';' . $portableReferent . ';' . $emailReferent . ';' . $reseauSocialReferent . ';' . $descriptionEngagement . ';' . $milieuEngagement . ';' . $dureeEngagement . "\n";
    file_put_contents('data_engagement.txt', $entry, FILE_APPEND);

    // Envoyer l'e-mail au référent
    /*
    $to = $emailReferent;
    $subject = 'Demande de référent';
    $message = "Cher référent,\n\nUne demande a été soumise avec les informations suivantes :\n\n$reseauSocialReferent\nDescription de l'engagement : $descriptionEngagement\nMilieu de l'engagement : $milieuEngagement\nDurée de l'engagement : $dureeEngagement\n";
    $headers = "Content-Type: text/plain; charset=utf-8\r\n";
    $headers = "adresse@gmail.com\r\n";

    // Utilisez la fonction mail() pour envoyer l'e-mail (assurez-vous que le serveur est configuré pour envoyer des e-mails)
    mail($to, $subject, $message, $headers);
    */
    // Rediriger vers une page de confirmation
    header("Location: page_engagement.php?lien=$lien_encode" . "$queryString");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>JEUNE - Demande de référent</title>
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
        <h2>Décrivez votre expérience et mettez en avant ce que vous en avez retiré.</h2>
    </div>


    <form action="page_jeune_demande.php" method="POST"> <!-- C'est la balise de formulaire qui envoie les données à la page "page_jeune_demande.php" en utilisant la méthode POST -->
        <div class="block_center">
            <div class="P2">
                <h2>Informations du référent :</h2>
            </div>
            <div class="data">
                <div class="container">
                    <label for="nom_referent">Nom :</label>
                    <input class="custom_input" type="text" id="nom_referent" name="nom_referent" required>
                </div>

                <div class="container">
                    <label for="prenom_referent">Prénom :</label>
                    <input class="custom_input" type="text" id="prenom_referent" name="prenom_referent" required>
                </div>

                <div class="container">
                    <label for="date_naissance_referent">Date de naissance :</label>
                    <input class="custom_input" type="date" id="date_naissance_referent" name="date_naissance_referent" required>
                </div>

                <div class="container">
                    <label for="portable_referent">Portable :</label>
                    <input class="custom_input" type="text" id="portable_referent" name="portable_referent" required>
                </div>

                <div class="container">
                    <label for="email_referent">Email :</label>
                    <input class="custom_input" type="email" id="email_referent" name="email_referent" required>
                </div>

                <div class="container">
                    <label for="reseau_social_referent">Réseau social :</label>
                    <input class="custom_input" type="text" id="reseau_social_referent" name="reseau_social_referent" required>
                </div>
            </div>
        </div>

        <div class="block_center">
            <div class="P2">
                <h2>Information sur l'engagement :</h2>
            </div>
            <div class="container">
                <label for="description_engagement">Description :</label>
                <textarea class="custom_input" id="description_engagement" name="description_engagement" required></textarea>
            </div>

            <div class="container">
                <label for="milieu_engagement">Milieu :</label>
                <input class="custom_input" type="text" id="milieu_engagement" name="milieu_engagement" required>
            </div>

            <div class="container">
                <label for="duree_engagement">Durée :</label>
                <input class="custom_input" type="text" id="duree_engagement" name="duree_engagement" required>
            </div>

        </div>

        <div class="block_options">
            <div class="choix1">
                <p class>MES SAVOIRS ETRE </p>
            </div>
            <div class="choix2">
                <p class>Je suis</p>
            </div>
            <div class="options">
                <label>
                    <input type="checkbox" id="option_autonome" name="options[]" value="Autonome" onclick="limitOptions()">
                    Autonome
                </label>

                <label>
                    <input type="checkbox" id="option_ecoute" name="options[]" value="A l'écoute" onclick="limitOptions()">
                    A l'écoute
                </label>

                <label>
                    <input type="checkbox" id="option_organise" name="options[]" value="Organisé" onclick="limitOptions()">
                    Organisé
                </label>

                <label>
                    <input type="checkbox" id="option_passionne" name="options[]" value="Passionné" onclick="limitOptions()">
                    Passionné
                </label>

                <label>
                    <input type="checkbox" id="option_fiable" name="options[]" value="Fiable" onclick="limitOptions()">
                    Fiable
                </label>

                <label>
                    <input type="checkbox" id="option_patient" name="options[]" value="Patient" onclick="limitOptions()">
                    Patient
                </label>

                <label>
                    <input type="checkbox" id="option_reflechi" name="options[]" value="Réfléchi" onclick="limitOptions()">
                    Réfléchi
                </label>

                <label>
                    <input type="checkbox" id="option_responsable" name="options[]" value="Responsable" onclick="limitOptions()">
                    Responsable
                </label>

                <label>
                    <input type="checkbox" id="option_sociable" name="options[]" value="Sociable" onclick="limitOptions()">
                    Sociable
                </label>

                <label>
                    <input type="checkbox" id="option_optimiste" name="options[]" value="Optimiste" onclick="limitOptions()">
                    Optimiste
                </label>
                
            </div>
            <div class="choix1">
                <input class="button" type="submit" value="Envoyer">
            </div>
        </div>

    </form>
    

</body>
</html>

<script>

/* fonction qui permet de cocher au maximum 4 cases pour les savoirs-etre du jeune */
function limitOptions() {
    // Sélectionne toutes les cases à cocher ayant le nom "options[]"
    var checkboxes = document.querySelectorAll('input[name="options[]"]');
    var checkedCount = 0;
    // Compte le nombre de cases à cocher sélectionnées
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkedCount++;
        }
    }
    // Si plus de 3 cases à cocher sont sélectionnées, désactive les cases supplémentaires 
    if (checkedCount > 3) {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].disabled = !checkboxes[i].checked;
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].disabled = false;
        }
    }
}
</script>