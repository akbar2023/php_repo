<?php
// -------------------------------
// La superglobale $_COOKIE
// -------------------------------
/* 
Un cookie est un petit fichier (4ko max) déposé par le serveur du site sur le poste de l'internaute et qui peut contenir des informations. Les cookies sont automatiquement renvoyés au serveur web par le navigateur lorsque l'internaute navigue dans les pages concernées par les cookies. PHP permet de récupérer très facilement les données contenues dans un cookie : ses informations sont stoxkées dans la superglobale $_COOKIE.

Précaution à prendre avec les cookies :
Un cookie étant sauvegarder sur le post de l'internet, il peut potentiellement être volé ou détourné. On y met donc que des informations d'importance mineure : préférences, traces e visites...

*/

// Application pratique : nous allons stocker dans un cookie la langue choisie par l'internaute.

// Affectation de la variable $langue :
 if (isset($_GET['langue']) ) {  // si une langue est passée dans l'url c'est que nous avons cliqué sur un lien
    $langue = $_GET['langue'];
 } elseif (isset($_COOKIE['langue'])) {  // si on a reçu sur le serveur un cookie appelé "langue" de la part du navigateur de l'internaute

    $langue = $_COOKIE['langue'];

 } else {
     $langue = 'fr';  // par défaut on choisit le français si l'internaute n'a pas choisi de langue (= condition if) ou qu'il n'a pa de cookie (= condition esleif)
 }

//  ---------
// Envoyer un cookie :
echo time();  // la fonction prédéfinie time() retourne le timestamp de maintenant = nombre de secondes écoulées depuis le 01/01/1970 à 00:00:00

$un_an = 365 * 24 * 60 * 60;  // 1an exprimé en secondes

$date_validite = time() + $un_an;  // on calcule la date de validité du cookie à un an à partir de maintenant

setcookie('langue', $langue, $date_validite);  // on envoie un cookie sur le post de l'internaute : setcookie('nom', 'valeur', 'date d'expiration en timestamp').

// Il n'existe pas de foction prédéfinie permettant de SUPPRIMER un cookie. On peut cependant le rendre invalide en lui mettant une date d'expiration à 0 ou dépassée, ou encore mettre le nom de cookie dans setcookie(). 



// ------
// Affichage de la langue du site :
echo "<h2>Langue du site : $langue </h2>";






?>

<h1>Votre langue</h1>
<ul>
    <li><a href="?langue=fr">Français</a></li>

    <li><a href="?langue=en">Anglais</a></li>

    <li><a href="?langue=es">Espagnol</a></li>

    <li><a href="?langue=it">Italien</a></li>
</ul>









