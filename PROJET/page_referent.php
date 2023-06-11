<?php
$emailReferent = $_GET['email_referent'] ?? '';
$nomReferent = $_GET['nom_referent'] ?? '';
$prenomReferent = $_GET['prenom_referent'] ?? '';
$dateNaissanceReferent = $_GET['date_naissance_referent'] ?? '';
$portableReferent = $_GET['portable_referent'] ?? '';
$reseauSocialReferent = $_GET['reseau_social_referent'] ?? '';
$descriptionEngagement = $_GET['description_engagement'] ?? '';
$milieuEngagement = $_GET['milieu_engagement'] ?? '';
$dureeEngagement = $_GET['duree_engagement'] ?? '';
$email = $_GET['email'] ?? '';
$prenom = $_GET['prenom'] ?? '';
$nom = $_GET['nom'] ?? '';
$dateNaissance = $_GET['date_naissance'] ?? '';
$reseau = $_GET['reseau'] ?? '';


if(isset($_POST['confirmerEngagement'])) {

    $CFemail = $_POST['email'] ?? '';
    $CFdescriptionEngagement = $_POST['description'] ?? '';
    $CFmilieuEngagement = $_POST['milieu'] ?? '';
    $CFdureeEngagement = $_POST['duree'] ?? '';

    $filename = $CFemail . '.txt';
    $fileExists = file_exists($filename);

    $file = fopen($filename, 'a');

    if($file) {
        fwrite($file, "engagement validé\n");
        fwrite($file, $CFdescriptionEngagement . "\n");
        fwrite($file, $CFmilieuEngagement . "\n");
        fwrite($file, $CFdureeEngagement . "\n" . "\n" . "\n");

        // Fermer le fichier
        fclose($file);

        echo '<script type="text/javascript">alert("Engagement confirmé avec succès !");</script>';
        exit();
    } else {
        echo '<script type="text/javascript">alert("error");</script>';
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles informations depuis le formulaire
    $newNom = $_POST['nom'] ?? '';
    $newPrenom = $_POST['prenom'] ?? '';
    $newDateNaissance = $_POST['dateNaissance'] ?? '';
    $newEmail = $_POST['email'] ?? '';
    $newReseau = $_POST['reseau'] ?? '';
    $newEmailReferent = $_POST['emailReferent'] ?? '';
    $newNomReferent = $_POST['nomReferent'] ?? '';
    $newPrenomReferent = $_POST['prenomReferent'] ?? '';
    $newDateNaissanceReferent = $_POST['dateNaissanceReferent'] ?? '';
    $newPortableReferent = $_POST['portableReferent'] ?? '';
    $newReseauSocialReferent = $_POST['reseauReferent'] ?? '';
    $newDescriptionEngagement = $_POST['description'] ?? '';
    $newMilieuEngagement = $_POST['milieu'] ?? '';
    $newDureeEngagement = $_POST['duree'] ?? '';


    // Reconstruction du lien
    $lien = "http://localhost:8000/page_referent.php?";
    $lien .= "email_referent=" . urlencode($newEmailReferent) . "&";
    $lien .= "nom_referent=" . urlencode($newNomReferent) . "&";
    $lien .= "prenom_referent=" . urlencode($newPrenomReferent) . "&";
    $lien .= "date_naissance_referent=" . urlencode($newDateNaissanceReferent) . "&";
    $lien .= "portable_referent=" . urlencode($newPortableReferent) . "&";
    $lien .= "reseau_social_referent=" . urlencode($newReseauSocialReferent) . "&";
    $lien .= "description_engagement=" . urlencode($newDescriptionEngagement) . "&";
    $lien .= "milieu_engagement=" . urlencode($newMilieuEngagement) . "&";
    $lien .= "duree_engagement=" . urlencode($newDureeEngagement) . "&";
    $lien .= "email=" . urlencode($newEmail) . "&";
    $lien .= "prenom=" . urlencode($newPrenom) . "&";
    $lien .= "nom=" . urlencode($newNom) . "&";
    $lien .= "date_naissance=" . urlencode($newDateNaissance) . "&";
    $lien .= "reseau=" . urlencode($newReseau);
    
    // Vérifier s'il y a des modifications
    if ($newEmailReferent !== $emailReferent || $newNomReferent !== $nomReferent || $newPrenomReferent !== $prenomReferent ||
        $newDateNaissanceReferent !== $dateNaissanceReferent || $newPortableReferent !== $portableReferent ||
        $newReseauSocialReferent !== $reseauSocialReferent) {
    
        $database = file_get_contents('data_engagement.txt');
        $userEntries = explode("\n", $database);
        $updatedUserEntries = '';
        foreach ($userEntries as $userEntry) {
            $userDataFields = explode(";", $userEntry);
            if ($userDataFields[0] === $nomReferent) {
                $userDataFields[0] = $newNomReferent;
                $userDataFields[1] = $newPrenomReferent;
                $userDataFields[2] = $newDateNaissanceReferent;
                $userDataFields[3] = $newPortableReferent;
                $userDataFields[4] = $newEmailReferent;
                $userDataFields[5] = $newReseauSocialReferent;
                $userDataFields[6] = $newDescriptionEngagement;
                $userDataFields[7] = $newMilieuEngagement;
                $userDataFields[8] = $newDureeEngagement;
            }
            $updatedUserEntries .= implode(";", $userDataFields) . "\n";
        }
        file_put_contents('data_engagement.txt', $updatedUserEntries);
    }

    // Rediriger vers le lien reconstruit
    header("Location: $lien");
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
    <link rel="stylesheet" href="page_referent.css">
    <style>
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="visiteur.php"><img src="LOGO_1.png"></a>
        </div>
        <div class="header-text">
            <h1>RÉFÉRENT</h1>
            <p>Je confirme la valeur de l'engagement</p>
        </div>

    </header>

    <nav>
        <ul>
            <li><a class="menu_jeune" href="page_jeune.php">JEUNE</a></li>
            <li><a class="menu_referent_actif" href="page_referent.php">RÉFÉRENT</a></li>
            <li><a class="menu_consultant" >CONSULTANT</a></li>
            <li><a class="menu_partenaires" href="page_partenaires.php">PARTENAIRES</a></li>
            <li><a class="menu_deconnexion" href="?logout=true">DECONNEXION</a></li>
        </ul>
    </nav>






    <form action="page_referent.php" method="POST">
        
        <div class="block_center">

            <div class="data">

                <h2>Informations du jeune</h2>

                <div class="container">
                    <label for="nom">Nom :</label>
                    <input class="custom_input" type="text" id="nom" name="nom" value="<?php echo $nom; ?>" readonly>
                </div>

                <div class="container">
                    <label for="prenom">Prénom :</label>
                    <input class="custom_input" type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" readonly>
                </div>

                <div class="container">
                    <label for="dateNaissance">Date de naissance :</label>
                    <input class="custom_input" type="date" id="dateNaissance" name="dateNaissance" value="<?php echo $dateNaissance; ?>" readonly>
                </div>

                <div class="container">
                    <label for="email">Email :</label>
                    <input class="custom_input" type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
                </div>

                <div class="container">
                    <label for="reseau">Réseau social :</label>
                    <input class="custom_input" type="text" id="reseau" name="reseau" value="<?php echo $reseau; ?>" readonly>
                </div>

                <div class="container">
                    <label for="reseau">Description :</label>
                    <input class="custom_input" type="text" id="description" name="description" value="<?php echo $descriptionEngagement; ?>" readonly>
                </div>

                <div class="container">
                    <label for="milieu">Milieu :</label>
                    <input class="custom_input" type="text" id="milieu" name="milieu" value="<?php echo $milieuEngagement; ?>" readonly>
                </div>

                <div class="container">
                    <label for="duree">Durée :</label>
                    <input class="custom_input" type="text" id="duree" name="duree" value="<?php echo $dureeEngagement; ?>" readonly>
                </div>
            </div>

        </div>

<!--------------------------------------------------------------------------->


        <div class="block_center_ref">

            <div class="data">

            <h2>Informations du Référent</h2>

                <div class="container_ref">
                    <label for="nomReferent">Nom :</label>
                    <input class="custom_input_ref" type="text" id="nomReferent" name="nomReferent" value="<?php echo $nomReferent; ?>">
                </div>

                <div class="container_ref">
                    <label for="prenomReferent">Prénom :</label>
                    <input class="custom_input_ref" type="text" id="prenomReferent" name="prenomReferent" value="<?php echo $prenomReferent; ?>">
                </div>

                <div class="container_ref">
                    <label for="dateNaissanceReferent">Date de naissance :</label>
                    <input class="custom_input_ref" type="date" id="dateNaissanceReferent" name="dateNaissanceReferent" value="<?php echo $dateNaissanceReferent; ?>">
                </div>

                <div class="container_ref">
                    <label for="emailReferent">Email :</label>
                    <input class="custom_input_ref" type="email" id="emailReferent" name="emailReferent" value="<?php echo $emailReferent; ?>">
                </div>

                <div class="container_ref">
                    <label for="portableReferent">Mot de passe :</label>
                    <input class="custom_input_ref" type="text" id="portableReferent" name="portableReferent" value="<?php echo $portableReferent; ?>">
                </div>

                <div class="container_ref">
                    <label for="reseauReferent">Réseau social :</label>
                    <input class="custom_input_ref" type="text" id="reseauReferent" name="reseauReferent" value="<?php echo $reseauSocialReferent; ?>">
                </div>

            </div>

            <div class="container_button">
                <button type="submit" class="button">Mettre à jour</button>
            </div>

        </div>

        <div class="confirmation">
            <button type="submit" class="button" name="confirmerEngagement">Confirmer l'engagement</button>
        </div>

    </form>



</html>

