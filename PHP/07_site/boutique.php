<?php
require_once 'inc/init.inc.php';

// 1 - affichage des catégories de vêtements :

$resultat = executeRequete("SELECT DISTINCT categorie FROM produit"); // DISTINCT pour dédoublonner les catégories existantes. $resultat est un objet PDOStatement

$contenu_gauche .= '<div class="list-group">';
    // Affichage de la catégorie "tous";
    $contenu_gauche .= '<a href="?categorie=tous" class="list-group-item">Tous</a>';

    // Affichage des autres catégories (provenant de la BDD) :
    while ($cat = $resultat-> fetch(PDO::FETCH_ASSOC)) {
        // debug($cat); // on voit que les catégories sont dans cet array $cat à l'indice "categorie"
        $contenu_gauche .= '<a href="?categorie=' . $cat['categorie'] . '" class="list-group-item">' . $cat['categorie'] . '</a>';  // on met l'array $cat['categorie'] à la place de "tous" pour récupérer à chaque your de boucle chacune des catégories présentent dans cet array (voir le debug ci-dessus)
    }

$contenu_gauche .= '</div>';


// 2 - Affichage des produits selon la catégorie choisie :

if (isset($_GET['categorie']) && $_GET['categorie'] != 'tous') {
// si existe "categorie" dans $_GET (donc dans l'url), c'est qu'on a cliqué sur une catégorie. De plus, si elle est différente de "tous" c'est qu'on a choisi eune catégorie en particulier (robe, pull ...). On sélectionne donc tous les produits de cette catégorie :
    $donnees = executeRequete("SELECT * FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie']));
} else {
    // Dans le cas contraire on affiche tous les produits :
    $donnees = executeRequete("SELECT * FROM produit");
}  

while ($produit = $donnees-> fetch(PDO::FETCH_ASSOC)) {
    // debug($produit);  // on a un array avec un seul produit à l'intérieur à chaque tour de boucle
    // ici on met tout le HTML de présentation de produit :
    $contenu_droite .= '<div class="col-sm-4 mb-4">';
        $contenu_droite .= '<div class="card">';

        // Image cliquable du produit :
            $contenu_droite .= '<a href="fiche_produit.php?id_produit='. $produit['id_produit'] .'"><img class="card-img-top" src=" ' . $produit['photo'] . ' " alt=" ' . $produit['titre'] . ' "></a>'; 

            // Les infos du produit :
            $contenu_droite .= '<div class="card-body">';
                $contenu_droite .= '<h4>' . $produit['titre'] . '</h4>';
                $contenu_droite .= '<h5>' . $produit['prix'] . ' €</h5>';
                $contenu_droite .= '<p>' . $produit['description'] . '</p>';
            $contenu_droite .= '</div>'; // FIN "card-body"

        $contenu_droite .= '</div>';  // FIN .card
    $contenu_droite .= '</div>';  // FIN '<div class="col-sm-4 mb-4">'
}



// ------------------- AFFICHAGE -----------------
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Vêtements</h1>
<div class="row">
    
    <div class="col-md-3">

            <?php echo $contenu_gauche; ?>        

    </div>
    <div class="col-md-9">

        <div class="row">
            <?php echo $contenu_droite; ?>
        </div>
    
    </div>

</div>


<?php
require_once 'inc/bas.inc.php';