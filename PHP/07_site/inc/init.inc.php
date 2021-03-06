<?php
/* 
Ce fichier sera inclus dans tous les scripts (hors inc eux mêmes) pour initialiser les éléments suivants :
- connexion à la BDD
- créer ou ouvrir une session
- définir le chemin absolu du site (comme dans wordpress)
-inclure le fichier fonctions.inc.php à la fin de ce fichier pour l'embarquer dans tous les scripts.
*/

// connexion à la BDD

$pdo = new PDO('mysql:host=localhost;dbname=site_commerce','root',
                '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') 
            );

// créer ou ouvrir une session
session_start();

// définir le chemin absolu du site (comme wordpress)
define('RACINE_SITE', '/php_repo/PHP/07_site/');  // cette constante servira à créer les chemins asolus utilisés dans haut.inc.php car ce fichier sera inclus dans des fichier scripts qui se situent dans des dossier différents du site. On ne peut donc pas faire de chemin relatif dans ce fichier.

// Variables d'affichage :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// inclusion du fichier fonctions.inc.php :
require_once ('fonctions.inc.php');
