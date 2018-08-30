<?php

/* 
Sujet :
    1 - Afficher dans une table HTML (avec doctype ...) la liste des contacts avec les champs nom, prénom, et téléphone, et un champ supplémentaire "autres infos" qui est un lien qui permet d'afficher le détail de chaque contact.

    2 - Afficher sous la table HTML, le détail du contact quand on clique sur le lien "autres infos".
*/


// initialisation $contenu 
$contenu = '';

// Démarrage serveur
$pdo = new PDO('mysql:host=localhost;dbname=contacts','root',
'',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') 
);


// Requête
$resultat = $pdo->query("SELECT id_contact, nom, prenom, telephone FROM contact");

$contenu .= '<h1>Mes contacts :</h1>';


$contenu .= '<table border="1">';

    // La ligne des entêtes :
    $contenu .= '<tr>';
        // $contenu .= '<th>id contact</th>';
        $contenu .= '<th>Nom</th>';
        $contenu .= '<th>Prénom</th>';
        $contenu .= '<th>téléphone</th>';
        $contenu .= '<th>Autres infos</th>';   
    $contenu .= '</tr>';

        // Affichage des autres lignes : 
        while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $contenu .= '<tr>';

                // affichage des informations de chaque ligne $ligne :
                /* foreach($ligne as $info){  // affiche tous les champs 
                    $contenu .= '<td>' . $info . '</td>';
                } */

                // OU  // affiche que ce qu'on a voulu

                $contenu .= '<td>' . $ligne['nom'] . '</td>';
                $contenu .= '<td>' . $ligne['prenom'] . '</td>';
                $contenu .= '<td>' . $ligne['telephone'] . '</td>';
                
                $contenu .= '<td><a href="?id_contact='.$ligne['id_contact'].'">+ infos</a></td>';

            $contenu .= '</tr>';
        }
$contenu .= '</table>';


// 3 - traitement de $_GET:

var_dump($_GET);



if (isset($_GET['id_contact'])) {  // si existe l'indice "id_contact" dans $_GET, c'est que cet indice est passé dans l'url, donc l'internaute a cliqué un des liens "autres infos"

    $_GET['id_contact'] = htmlspecialchars($_GET['id_contact'], ENT_QUOTES); // pour se prémunir des injections CSS ou JS via l'url

    $resultat = $pdo->prepare("SELECT * FROM contact WHERE id_contact = :id_contact");

    $resultat->bindParam(':id_contact', $_GET['id_contact']);

    $resultat->execute();

    $contact = $resultat->fetch(PDO::FETCH_ASSOC); // on transforme $resultat en un objet associatif $contact

    if (!empty($contact)) {  // si $contact est vide, c'est que l'id contact n'existe pas (ou plus)

    /* foreach($contact as $indice => $valeur) {
        if ($indice == 'annee') {

            $contenu .= '<p>';
            $contenu .= 'Année de rencontre : ' . $valeur;
            $contenu .= '</p>'; 
        
        }elseif ($indice == 'id_contact'){
            $contenu .= '<p>';
            $contenu .= 'N° : ' . $valeur;
            $contenu .= '</p>';
        } else{
            $contenu .= '<p>';
            $contenu .= $indice . ' : ' . $valeur;
            $contenu .= '</p>';
        }

    }
 */
        // Version sans boucle :

        $contenu .= '<p>Nom : ' . $contact['nom'] . '</p>';
        $contenu .= '<p>Prénom : ' . $contact['prenom'] . '</p>';
        $contenu .= '<p>Téléphone : ' . $contact['telephone'] . '</p>';
        $contenu .= '<p>Email : ' . $contact['email'] . '</p>';
        $contenu .= '<p>Année de rencontre : ' . $contact['annee'] . '</p>';
        $contenu .= '<p>Relation : ' . $contact['type'] . '</p>';

    } else {
        $contenu .= '<p>Ce contact n\'existe pas.</p>';
    } //  (!empty($contact))


}  // fin if isset($_GET['id_contact'])

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <?php 
    echo $contenu;
    ?>

</body>
</html>

