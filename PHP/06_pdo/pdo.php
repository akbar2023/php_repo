<?php 
// --------------------------
//      PDO
// --------------------------

// PDO pour PHP Data Objects est une extension de PHP qui définit une interface pour accèder à une base de données depuis PHP (via du SQL).

function debug($param) {
    echo '<pre>';
    var_dump($param);
    echo '</pre>';
}


// ---------------------------
// 01 - Connexion à la BDD
// ---------------------------
echo '<h3> 01 - Connexion à la BDD </h3>';

$pdo = new PDO('mysql:host=localhost;dbname=entreprise',  // driver mysql : serveur ; nom de la BDD
                'root', // pseudo de la BDD
                '',  // mot de passe de la BDD
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,   // option 1 : pour afficher les erreurs SQL
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')  // option 2 : définit le jeu de caractères des échanges avec la BDD
);

// $pdo est un objet issu de la classe prédéfinie PDO. Il représente la connexion à la BDD.

// ---------------------------
// 02 - exec() avec INSERT, DELETE et UPDATE
// ---------------------------
echo '<h3> 02 - exec() avec INSERT, DELETE et UPDATE </h3>';

// Notre première requête SQL :
$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('test', 'test', 'm', 'test', '2016-02-08', '2500') ");


// exec() est utilisée pour ma formulation de requête ne retournant pas de jeu de résultat : INSERT, DELETE, UPDATE.

/* 
Valeur de retour (dans $resultat) :
    -en cas de succès : 1 ou plus, qui correspond au nombre de lignes affectées par la reqête
    -en cas d'échec : false 
*/

echo "Nombre d'enregistrement affectés par l'INSERT : $resultat <br>";
echo 'Dernière id généré après la requête : ' . $pdo->lastInsertId();  // méthode qui permet de récupérer depuis la BDD le dernier id inséré par la requête précédente

$resultat = $pdo->exec("DELETE FROM employes WHERE prenom = 'test' ");

echo "<br> Nombre d'enregistrement affectés par le DELETE : $resultat";


// ---------------------------
// 03 - query() avec SELECT et fetch() avec 1 seul résultat
// ---------------------------

echo '<h3> 03 - query() avec SELECT et fetch() avec 1 seul résultat </h3>';

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel' ");

// Au contraire de exec() query() est utilisé pour les requêtes qui retournent un ou plusieurs résultats provenant de la BDD : SELECT. Notez que query() peut aussi être utilisé avec INSERT, UPDATE ou DELETE.

/* 
Valeurs de retour : 
    - en cas de succès : nouvel objet issue de la classe prédéfinie PDOStatement
    - en cas d'échec : false
*/

debug($result);

// $result est le résultat de la requête sous une forme inexploitable directement : il faut donc le transformer avec la méthode fetch() :
    $employe = $result->fetch(PDO::FETCH_ASSOC);  // la méthode fetch() avec son paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un array ASSOCIATIF exploitable (ici $employe) indexé le nom des champs de la table.

    debug($employe);  //Pour voir l'array associatif

    echo 'Je suis ' . $employe['prenom'] . ' ' . $employe['nom'] . ' du service ' . $employe['service'] . '.';
 

// --------
// Les trois autres méthodes de fetch() :

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel' ");
$employe = $result->fetch(PDO::FETCH_NUM);  // transforme $result en un array indexé numériquement

debug($employe);
echo $employe[1] . '<br>';  // affiche Daniel


$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel' ");

$employe = $result->fetch();  // sans paramètre fetch() mélange array associatif et array numérique
debug($employe);  
echo $employe['prenom'] . '<br>';  // ou alors
echo $employe[1] . '<br>';


$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel' ");
$employe = $result->fetch(PDO::FETCH_OBJ);  // transforme en un objet avec les noms des champs de la table comme propriétés de cet objet 
debug($employe);

echo $employe->prenom . '<br>';


// Attention : après une requête il faut choisir l'un des fetch(). si l'on veut en refaire un, il faut refaire la requête : en effet, on ne peut pas effectuer plusieurs transformations successives sur le même objet $result.



/* Exercice : afficher le service de l'employé dont l'id_employe est 417 (production). */

$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417 ");

$employe = $result->fetch(PDO::FETCH_ASSOC); // on transforme l'objet  $result (qui n'est pas exploitable directement) en un array associatif avec pour indice le nom du champ du SELECT (ici service)

debug($employe);  // on voit ici le contenu de l'array associatif 

echo 'Le service de l\'employée est : ' . $employe['service'];



// Si le requête retourne qu'un seul résultat pas de boucle. Si elle peut potentiellement en retourner plusieurs => boucle.



// ---------------------------
// 04 - fetch() avec boucle while (plusieurs résultats)
// ---------------------------

echo '<h3> 04 - fetch() avec boucle while (plusieurs résultats) </h3>';


$resultat = $pdo->query("SELECT * FROM employes");  // cette requête retourne plusieurs résultats, on fait donc une boucle pour les parcourir

echo 'Nombre d\'employés : ' . $resultat->rowCount() . '<br>';  // permet de compter le nombre de lignes retournés par le SELECT (exemple : nombre de produits selectionnés dans une boutique)

while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {  // fetch retourne la ligne SUIVANTE du jeu de résultats en un array associatif. La boucle while permet de faire avancer le curseur dans le jeu de résultat et s'arrête quand le curseur est arrivé à la fin (tant qu'il y a un employé, il transforme ses données en associatif)
   
    // debug($employe);   // $employe est un array associatif qui contient les données d'un seul employé à chaque tour de boucle
    
    
    echo '<div>'. '<br>';
        echo $employe['prenom'] . '<br>';
        echo $employe['nom'] . '<br>'; 
        echo $employe['service'] . '<br>';  

    echo '--------- </div>'. '<br>';            

}

// Attention : il n'y a pas un array avec tous les enregistrement dedans, mais un array par enregistrement, un array par employé !


// ---------------------------
// 05 - Exercice
// ---------------------------

echo '<h3> 05 - Exercice </h3>';
// Afficher la liste des différents services dans une liste <ul><li>.

$resultat = $pdo->query("SELECT DISTINCT service FROM employes");  // Fonctionne aussi ici avec GROUP BY, mais ce dernier est plustôt utilisé avec les fonctions d'aggrégats (pour faire des sommes) comme : SUM(), COUNT(), MIN(), MAX(), et AVG()
$employe = $resultat->fetch(PDO::FETCH_ASSOC);


echo '<ul>';
while ($employe = $resultat->fetch(PDO::FETCH_ASSOC)) {
    
    echo '<li>' . $employe['service'] . '</li>';

}
echo '</ul>';


// ---------------------------
// 06 - fetchAll()   (fetch = transformer)
// ---------------------------

echo '<h3> 06 - fetchAll()   (fetch = transformer) </h3>';

$resultat = $pdo->query("SELECT * FROM employes");

debug($resultat);

$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);  // retourne toutes les lignes de résultats dans un tableau multidimensionnel (sans faire de boucle) : nous avons 1 array associatif par employé à chaque indice numérique.   

debug($donnees);  // array multidimensionnelle

// Pour afficher son contenu, on fait une boucle foreach : 
echo '<hr>';
foreach($donnees as $employe) {
    // debug($employe);  // $employes correspond au sous array qui représente 1 employé à chaque tour de boucle

    echo "<div>
            <p>$employe[prenom]</p>  
            <p>$employe[nom]</p>
            <p>$employe[salaire]€</p>            
        </div><hr>";// on ne met pas de quotes ici entre les indices car ils sont entourés de ("")
}

// Si nous avions voulu afficher TOUTES les infos de façon dynamique, nous aurions fait 2 foreach imbriquées l'une dans l'autre.


// ---------------------------
// 07 - Table HTML
// ---------------------------

echo '<h3> 07 - Table HTML </h3>';

// On veut afficher dynamiquement les résultats de la requête sous forme de table HTML.

$resultat = $pdo->query("SELECT id_employes, prenom, nom, service, salaire FROM employes ORDER BY salaire DESC");

echo '<table border="1">';

    // La ligne d'entêtes :
    echo '<tr>';
        echo '<th>id employés</th>';
        echo '<th>Prénom</th>';
        echo '<th>Nom</th>';
        echo '<th>Service</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';

        // Affichage des autres lignes : 
        while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
                // affichage des informations de chaque ligne $ligne :
                foreach($ligne as $info){
                    echo '<td>' . $info . '</td>';
                }

            echo '</tr>';
        }
echo '</table>';


// ---------------------------
// 08 - Requête préparée et bindParam()
// ---------------------------

echo '<h3> 08 - Requête préparée et bindParam() </h3>';

$nom = 'sennard';

// 1- Préparer la requête :
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // :nom est un marquer nominatif qui attend qu'on lui donne une valeur

// 2- Lier les marquers aux valeurs :
 $resultat->bindParam(':nom', $nom);   // (bind = lier)  // bindParam() reçoit exclusivement une variable vers laquelle pointe le marqueur. On ne êut pas y mettre une valeur directement, sinon il faut utiliser bindValue() à laplace de bindParam().  

// 3- Exécuter la requête :
$resultat->execute();

// 4- Affichage 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees); 

/* 
prepare() permet de préparer la requête mais ne l'exécute pas.
execute() permet d'exécuter une requête préparée.

Valeurs de retour :
        prepare() renvoie toujours un objet PDOstatement
        execute() : 
            En cas de succès : TRUE
            En cas d'échec : FALSE

Les requêtes préparées sont préconisées si vpus exécutez plusieurs fois la même requête et ainsi éviter de refaire le cycle complet(analyse/interprétation/exécution) réalisé par le SGBD (on ne refait que le execute).

Les requêtes préparées sont souvent utilisées pour assainir les données (ce que nous verrons dans un chapitre ultérieur).

*/

// ---------------------------
// 09 - Requête préparée : point complémentaires
// ---------------------------

echo '<h3> 09 - Requête préparée : point complémentaires </h3>';

echo '<h4>Le marqeur "?"</h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ? ");   // on prépare dans un premier temps, la requête avec des marquers sous forme de "?"

$resultat->execute(array('durand', 'damien'));  // "durand" va remplacer le premier "?" et "damien" va remplacer de second "?"

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);  // pas de while car il n'y a qu'un seul résultat

echo $donnees['prenom'] . ' ' . $donnees['nom'] . ' ' . $donnees['service'] . '.';
 


// ---------
echo '<h4>execute() sans bindParam() : </h4>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom ");

$resultat->execute(array(':nom' => 'chevel', ':prenom'=>'daniel'));  // on peut associer directement dans les () de execute() les marquers de la requête SQL à leur valeur. Notez qu'il est possible de ne pas mettre les ":" avant le nom des marqeurs dans cet array 

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);  
echo $donnees['prenom'] . ' ' . $donnees['nom'] . ' ' . $donnees['service'] . '.';
















/*
*****************************  RESUME  **************************

L'ordre de travail avec la BDD :

            1) connexion à la BDD
            2) faire la requête 
            3) fetch()
            4) echo

*/