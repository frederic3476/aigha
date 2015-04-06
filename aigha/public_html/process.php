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
   
    // PREPARATION DES DONNEES
    /*
    $destinataire = "frederic.teissier@live.fr";
    $objet        = "Site Aigha :" . $sujet;
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
    $contenu      = "Email de l'expéditeur : " . $email . "\r\n";
    $contenu     .= $message."\r\n\n";
 
    $headers  = "From: Webmaster Site <webmaster@domaine.ext>\n"; // ici l'expediteur du mail
    $headers .= 'Content-Type: text/plain; charset="ISO-8859-1";\n';
        
    // SI LES CHAMPS SONT MAL REMPLIS
    if ( (empty($nom)) && (empty($sujet)) && (empty($email)) && (!preg_match($regex, $_POST['email'])) && (empty($message)) ){
        echo 'Echec formulaire';
    }
    // ENCAPSULATION DES DONNEES 
    else{
        mail($destinataire,$objet,$contenu,$headers);
        echo 'Formulaire envoyé';
    }
     */
    
    // Mettez ici votre adresse valide
    $to = "fredjacou@gmail.com";

    // Sujet du message 
    $subject = "Site Aigha : ".$sujet;

    // Corps du message, écrit en texte et encodage iso-8859-1
    $contenu      = "Nom de l'expéditeur : " . $nom . "\r\n";
    $contenu      = "Email de l'expéditeur : " . $email . "\r\n";
    $contenu     .= $message."\r\n\n";

    // Entêtes du message
    $headers = ""; // on vide la variable
    $headers = "From: Webmaster Site <webmaster@domaine.ext>\n"; // ajout du champ From
    // $headers = $headers."MIME-Version: 1.0\n"; // ajout du champ de version MIME
    $headers = $headers."Content-type: text/plain; charset=iso-8859-1\n"; // ajout du type d'encodage du corps

    // Appel à la fonction mail
    if ( mail($to, $subject, $contenu, $headers) == TRUE )
    {
       echo "Envoi du message reussi.";
    }
    else
    {
       echo "Erreur : l'envoi du message a échoué.";
    }
     

    // Les messages d'erreurs ci-dessus s'afficheront si Javascript est désactivé
?>