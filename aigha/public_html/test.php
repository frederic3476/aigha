<?php
 
// Mettez ici votre adresse valide
$to = "fredjacou@gmail.com";
 
// Sujet du message 
$subject = "Test fonction mail() de PHP";
 
// Corps du message, écrit en texte et encodage iso-8859-1
$message = "Bonjour,\nl'envoi du mail via PHP a réussi. Le webmaster\n";
 
// Entêtes du message
$headers = ""; // on vide la variable
$headers = "From: Webmaster Site <webmaster@domaine.ext>\n"; // ajout du champ From
// $headers = $headers."MIME-Version: 1.0\n"; // ajout du champ de version MIME
$headers = $headers."Content-type: text/plain; charset=iso-8859-1\n"; // ajout du type d'encodage du corps
 
// Appel à la fonction mail
if ( mail($to, $subject, $message, $headers) == TRUE )
{
   echo "Envoi du mail reussi.";
}
else
{
   echo "Erreur : l'envoi du mail a échoué.";
}
 
?>