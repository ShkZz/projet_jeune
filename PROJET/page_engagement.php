<?php
// Récupérer les paramètres de l'URL
$queryString = $_SERVER['QUERY_STRING'];

// Extraire les paramètres et les stocker dans un tableau associatif
parse_str($queryString, $params);

// Récupérer les informations spécifiques de $data
$nomReferent = $_GET['nom_referent'];
$prenomReferent = $_GET['prenom_referent'];
$descriptionEngagement = $_GET['description_engagement'];
$milieuEngagement = $_GET['milieu_engagement'];
$dureeEngagement = $_GET['duree_engagement'];
$emailJeune = $_GET['email'];
$prenomJeune = $_GET['prenom'];
$nomJeune = $_GET['nom'];
$dateNaissanceJeune = $_GET['date_naissance'];
$reseauJeune = $_GET['reseau'];
$lien = $_GET['lien'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Validation de l'engagement</title>
</head>
<body>
    <h2>Validation de l'engagement</h2>
    <p>Bonjour <?php echo $nomReferent; ?> <?php echo $prenomReferent; ?>,</p>
    
    <p>Un jeune a soumis une demande d'engagement et vous a désigné comme référent. Veuillez cliquer sur le lien ci-dessous pour valider son engagement :</p>
    
    <a href="<?php echo $lien; ?>"><?php echo $lien; ?></a>
    
    <p>Voici les informations de l'engagement :</p>
    
    <ul>
        <li>Description de l'engagement : <?php echo $descriptionEngagement; ?></li>
        <li>Milieu de l'engagement : <?php echo $milieuEngagement; ?></li>
        <li>Durée de l'engagement : <?php echo $dureeEngagement; ?></li>
    </ul>
    
    <p>Informations sur le jeune :</p>
    
    <ul>
        <li>Prénom : <?php echo $prenomJeune; ?></li>
        <li>Nom : <?php echo $nomJeune; ?></li>
        <li>Email : <?php echo $emailJeune; ?></li>
        <li>Date de naissance : <?php echo $dateNaissanceJeune; ?></li>
        <li>Réseau : <?php echo $reseauJeune; ?></li>
    </ul>
    
    <p>Merci de votre collaboration.</p>
    

</body>
</html>
