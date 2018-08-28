<?php
// Exercice :

/* 
Vous allez créer la page de gestion des membres dans le back-office :
1 - Seul les admin ont accès à cette page. Les autres sont redirigés vers la page connexion.php.
2 - Afficher sur cette page tous les membres sous forme de table HTML, avec toutes les infos sauf le mot de passe.
3 - Afficher le nombre de membre
*/
require_once '../inc/init.inc.php';

if (!internauteEstConnecteEtAdmin()) {
    header('location:../connexion.php');
    exit();
}


$resultat = $pdo->query("SELECT * FROM membre");


$contenu .= '<table border="1">';
    $contenu .= '<tr>';
        $contenu .= '<th>n° id</th>';
        $contenu .= '<th>Pseudo</th>';
        $contenu .= '<th>Nom</th>';
        $contenu .= '<th>Prénom</th>';
        $contenu .= '<th>Email</th>';
        $contenu .= '<th>Civilité</th>';
        $contenu .= '<th>Ville</th>';
        $contenu .= '<th>Code postal</th>';
        $contenu .= '<th>Adresse</th>';
        $contenu .= '<th>Statut</th>';
    $contenu .= '</tr>';

    
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            $contenu .= '<tr>';

            foreach ($ligne as $indice => $valeur) {

                // Affichage de chaque ligne à chaque tour de boucle sauf "mdp"
                if ($indice != 'mdp') {
                    $contenu .= '<td>' . $valeur . '</td>';
                }

            }

            $contenu .= '</tr>';
        }

$contenu .= '</table>';


// Le nombre de membres :
$contenu .= '<div class="m-4 bg-primary d-inline">Nous sommes ' .$resultat -> rowCount() . ' membre(s)</div>'; 



// --------------------- AFFICHAGE ---------------------
require_once '../inc/haut.inc.php';
?>
<h1 class="m-4">Gestion des membres</h1>
<?php

echo $contenu;
require_once '../inc/bas.inc.php';