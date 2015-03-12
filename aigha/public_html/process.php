<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
    
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/'; 
    // CONDITIONS NOM
    if ( (isset($_POST['nom'])) && (strlen(trim($_POST['nom'])) > 0) ){
        $nom = stripslashes(strip_tags($_POST['nom']));
    }
    else{
        echo "Merci d'écrire un nom <br />";
        $nom = '';
    }

    // CONDITIONS SUJET
    if ( (isset($_POST['sujet'])) && (strlen(trim($_POST['sujet'])) > 0) ){
        $sujet = stripslashes(strip_tags($_POST['sujet']));
    }
    else{
        echo "Merci d'écrire un sujet <br />";
        $sujet = '';
    }
 
    // CONDITIONS EMAIL
    if ( (isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0) && (preg_match($regex, $_POST['email'])) ){
        $email = stripslashes(strip_tags($_POST['email']));
    }
    elseif (empty($_POST['email'])){
        echo "Merci d'écrire une adresse email <br />";
        $email = '';
    }
    else{
        echo 'Email invalide :(<br />';
        $email = '';
    }
 
    // CONDITIONS MESSAGE
    if ( (isset($_POST['message'])) && (strlen(trim($_POST['message'])) > 0) ){
        $message = stripslashes(strip_tags($_POST['message']));
    }
    else{
        echo "Merci d'écrire un message<br />";
        $message = '';
    }
    
 
    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
   
    // PREPARATION DES DONNEES
    $destinataire = "frederic.teissier@live.fr";
    $objet        = "Aigha " . $sujet;
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
    $contenu     .= $message."\r\n\n";
 
    $headers  = "From: {$email}" . "\r\n"; // ici l'expediteur du mail
    $headers .= 'Content-Type: text/plain; charset="ISO-8859-1"; DelSp="Yes"; format=flowed \r\n';
    $headers .= 'Content-Disposition: inline \r\n';
    $headers .= 'Content-Transfer-Encoding: 7bit \r\n';
    $headers .= 'MIME-Version: 1.0';
        
    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($nom)) && (empty($sujet)) && (empty($email)) && (!preg_match($regex, $_POST['email'])) && (empty($message)) ){
        echo 'echec :( <br /><a href="contact.html">Retour au formulaire</a>';
    }
    // ENCAPSULATION DES DONNEES 
    else{
        mail($destinataire,$objet,utf8_decode($contenu),$headers);
        echo 'Formulaire envoyé';
    }

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>