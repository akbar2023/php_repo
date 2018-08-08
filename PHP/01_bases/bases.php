<style>
h2{
    font-size: 30px;
    color: coral;
}
</style>
<?php
//--------------------------
echo '<h2>Les balises PHP</h2>';
//-------------------------
?>

<?php
// Pour ouvrir un passage en PHP, on utilise la balise précédente
// Pour fermer un passage en PHP, on utilise la balise suivante :
?>
<p>Bonjour !</p> <!-- en dehors des balises d'ouverture et de fermeture de php, nous pouvons écrire du HTML -->

<?php
//  vous n'êtes pas obligé de fermer un passage en PHP en fin de script.
echo '<h2>Affichage dans le navigateur</h2>';
//  echo est une instruction qui permet d'afficher dans le navigateur. Notez que nous pouvons y mettre du HTML.

// toutes les instructions se termine par ";".

print 'Nous sommes Lundi <br>';  // autre instruction d'affichage.

// Deux autres instructions d'affichage existe (nous verrons plus loin) :

print_r('message');
echo '<br>';
var_dump('message');

// pour faire in commentaire php sur une seule ligne
/* 
Pour faire un commentaire 
sur plusieurs lignes
*/
//---------------------------------
echo '<h2>Variables : déclaration, affectation et type </h2>';
//---------------------------------
// Une variable est un espace mémoire portant un nom et permettant de conserver une valeur.
// En PHP, on déclare un variable avec le signe $.

$a = 127;  // on déclare la variable $a et lui affecte la valeur 127
echo gettype($a);  // gettype est une fonction prédéfinie qui retourne le type d'une variable. Ici un integer (entier)
echo '<br>';

$a = "une chaîne de caractère";
echo gettype($a);  // ici string
echo '<br>';

$b = '127';
echo gettype($b);  // un nombre écrit entre quotes ou guillemets est interprêté comme un string 
echo '<br>';

$a = true;  // true ou bien false
echo gettype($a);  // ici boolean 
echo '<br>';

// Par convention un bom de variable commence en minuscule, puis on met une majuscule à chaque mot. Il peut contenir des chiffres mais jamais au début ou un "_" (pas au début car signification particulière en orienté-objet, ni à la fin).

//---------------------------------
echo '<h2>Concaténation </h2>';
//---------------------------------
// En PHP on concatène par le symbole "." qui peut se tradui par "suivi de".
$x = 'Bonjour ';
$y = 'tout le monde !';
echo $x . $y . '<br>';  // affiche "Bonjour tout le monde !"

// Remarque sur echo :
echo $x , $y , '<br>';  // on peut séparer les arguments à afficher dans echo par une ",". Attention, ne marche pas avec print.

//---------------------------------
echo '<h2>Concaténation lors de l\'affectation </h2>';
//---------------------------------

$prenom1 = 'Bruno ';
$prenom1 .= 'Claire';  // l'opérateur ".=" peremet d'ajouter la valeur "Claire" à la valeur "Bruno " contenue dans $prenom1 sans l'écraser. Affiche donc "Bruno Claire".
echo $prenom1 . '<br>';

//---------------------------------
echo '<h2>Guillemets et quotes </h2>';
//---------------------------------
$message = "aujourd'hui";
$message = 'aujourd\'hui';  // on échappe les apostrophes dans les quotes simples (AltGr + 8)

$txt = 'Bonjour';
echo "$txt tout le monde <br>";  //  dans les guillemets la variable est évaluée : c'est son contenu qui est affiché
echo '$txt tout le monde <br>';  // dans les quotes simples, le nom de la variable est traité comme du texte brut

//---------------------------------
echo '<h2>Constantes </h2>';
//---------------------------------

// Une constante permet de conserver une valeur sauf que celle-ci ne pourra pas être modofiée durant l'exécution du ou des scripts. s'utilise par exemple pour conserver les paramètres de connexion à la BDDafin de ne pas pouvoir les altérer.

define('CAPITALE','Paris');  // déclare la constante appelée CAPITALE et lui affecte la valeur "Paris". Par convention les constantest s'écrivent en majuscules.
echo CAPITALE . '<br>';  // affiche Paris

//---------------------------------
echo '<h2>Opérateurs arithmétiques </h2>';
//---------------------------------
$a = 10;
$b = 2;
echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 10
echo $a * $b . '<br>'; // affiche 20
echo $a / $b . '<br>'; // affiche 5
echo $a % $b . '<br>'; // affiche 0 (modulo = reste de la division entière : 10 billes répartie sur 2 personnes, il m'en reste 0)

//----------
// Opération et affectation combinés :
$a = 10;
$b = 2;

$a += $b;  //  équivaut $a = $a + $b, $a vaut donc au final 12
$a -= $b;  //  équivaut $a = $a - $b, $a vaut donc au final 10

// Il existe aussi les opérateurs *=, /= et %=

// ----------
// Incrémenter et décrémenter :
$i = 0;
$i++;  // incrémentation : on ajoute +1 à $i
$i--;  // décrémentation : on retranche 1 à $i

//---------------------------------
echo '<h2>Structures conditionnelles </h2>';
//---------------------------------

// if...else
$a = 10;
$b = 5;
$c = 2;

if ($a > $b) {  // si $a est supérieur à $b ma condition est évaluée à true, on entre donc dans cette accolades qui suivent :
    echo '$a est supérieur à $b <br>';
} else {  // sinon, dans le cas contraire, on entre dans le else :
    echo '$a est inférieur à $b';
}
// ---------
// L'opérateur AND qui s'écrit && :
if ($a > $b && $b > $c) {  // si $a est supérieur à $b et si dans le même temps $b est supérieur à $c, alors on entre dans les accolades
    print 'OK pour les 2 conditions <br>';
}

// ----
// L'opérateur OR qui s'écrit ||
if ($a == 9 || $b > $c){ 
    echo 'OK pour aumoins une des 2 conditions <br>';
} else {
    echo 'Les 2 conditions sont fausses <br>';
}


// ---------
// if... elseif...else :

if ($a == 8){
    echo 'réponse 1 : $a est égal à 8 <br>';
} elseif ($a != 10) {  // notez la syntaxe "elseif" en un seul mot
    echo 'réponse 2 : $a est différent de 10 <br>';
} else{
    echo 'réponse 3 : les 2 conditions précédentes sont fausses <br>';
}

// Remarque : On ne met pas de ";" à la fin des structures conditionnelles.


// ---
// L'opérateur OU exclusif qui s'écrit XOR :
$question1 = 'mineur';
$question2 = 'je vote';  // exemple d'un questionnaire avec plusieurs possibles

if ($question1 == 'mineur' XOR $question2 == 'je vote'){  // avec le OU exclusif seulement l'une des 2 conditions doit être valide 
    echo 'Vos réponses sont cohérentes <br>';
} else{
    echo 'Vos réponses ne sont pas cohérentes <br>';  // si les 2 conditions sont vraies (cas "mineur vote") ou si les é conditions sont fausses ( cas de "majeur ne vote pas") nous entrons dans le else
}

// ----
// Condition ternaire :
// Syntaxe contractée de la condition if...elseif :
$a = 10;

echo ($a==10)?'$a est égal à 10' : '$a est différent de 10 <br>' ;  // dans la ternaire, le "?" remplace if, et le ":" remplace else. On affiche le premier string si la condition est vraie, sinon le second.

$resultat = ($a==10)?'$a est égal à 10' : '$a est différent de 10 <br>' ;

echo $resultat . '<br>';

// ---
// Différence entre == et === :
    $varA = 1;  // integer
    $varB = '1';  // string

if ($varA == $varB) {  // on compare uniquement en valeur avec l'opérateur ==
    echo '$varA est égal à $varB en valeur <br>';
}


if ($varA === $varB) {  // on compare à la fois en valeur et en type avec l'opérateur ===
    echo '$varA est égal à $varB en valeur et en type <br>';
} else {
    echo '$varA est différentr à $varB en valeur OU en type <br>';
}

// Pour mémoire, le simple = correspond à une affectation.

// -----------
// isset() et empty() :
// Définitions :
// empty() : teste si c'est vide (c'est-à-dire 0, '', NULL, false ou non défini)
// isset() : teste si c'est défini (si ça existe) ET a une valeur non NULL

$var1 = 0;
$var2 = '';
if (empty($var1)){  //  la condition est vraie car $var1 contient 0
    echo 'on a 0, vide, NULL, false ou non défini <br>';
}

if (isset($var2)){  // la condition est vraie car $var2 existe bien
    echo '$var2 est définie <br>';
}

// Si on met les lignes 217 et 218 en commentaire, la première condition reste vraie, car $var1 est non définie, et la seconde devient fausse, car $var2 n'existe pas.

// Contexte d'utilisation : les formulaires pour empty(), l'existance de variable ou d'array avec isset()avant de les utiliser.

// -------
// L'opérateur NOT qui s'écrit "!" :
$var3 = 'Je ne suis pas vide';

if(!empty($var3)) echo '$var3 n\'est pas vide <br>';  // ! pour NOT qui n'est pas une négation. Ici signifie si $var3 n'est pas vide

// phpinfo();  // fonction prédéfinie qui affiche des infos sur le contexte d'exécution du script

//---------------------------------
echo '<h2>Condition switch </h2>';
//---------------------------------
// La condition switch est une autre syntaxe pour écrire un if...elseif...else.
$couleur = 'jaune';
switch ($couleur) {
    case 'bleu' : // si $couleur contient la valeur "bleu", nous exécutons l'instruction après le ":" qui suit : 
    echo 'vous aimez le bleu';
    break;

    case 'rouge' : echo 'vous aimez le rouge';
    break;

    case 'vert' : echo 'vous aimez le vert';
    break;

    case 'blanc' : echo 'vous aimez le blanc';
    break;

    default : 
    // correspond à else, le cas par défaut dans lequel on entre si aucune valeur des valeurs précédentes n'est juste
    echo 'Vous n\'avez choisie aucune couleur de la liste <br>';
    break;
}

// Exercice : réécrivez le switch précédent en condition if... pour obtenir exactement le même résultat

$couleur = 'jaune';

if ($couleur == 'bleu'){
    echo 'Vous aimez le bleu';
}   
elseif ($couleur == 'rouge'){
    echo 'Vous aimez le rouge';
}   
elseif ($couleur == 'vert'){
    echo 'Vous aimez le vert';
}
elseif ($couleur == 'blanc'){
    echo 'Vous aimez le blanc';
} 
else{
    echo 'Vous n\'avez choisie aucune couleur de la liste';
}

//--------------------------
echo '<h2>Les fonctions prédéfinie </h2>';
//-------------------------
// Une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP.

// ----
// strpos() :
$email1 = 'prenom@site.fr';
echo strpos($email1, '@');  // indique la position 6 du caractère '@' dans la chaîne $email1 (compte à partir de 0)
echo '<br>';

$email2 = 'Bonjour';
echo strpos($email2, '@');  // cette ligne n'affiche rien, pourtant la fonction strpos retourne bien quelquechose. Pour l'analyser nous faisons un var_dump ci-dessous :

var_dump(strpos($email2, '@'));  // on voit grâce au var_dump que la fontion retourne false quand elle ne trouve pas l'@. var_dump est une instruction d'affichage améliorée que l'on utilise uniquement en phase de développement (on le retire en production).

echo '<br>';
// ----
// strlen() :
$phrase = 'mettez une phrase ici';
echo strlen($phrase);  // affiche la longuer de la chaîne de caractères, ici 21. Notez que strlen() compte le nombre d'octet, et que les caractères accentués comptent pour 2. Si vous voulez compter précisément le nombre de caractères, on utilise : mb_strlen().
echo '<br>';
// ---
// strtolower(), strtoupper(), trim() :
$message = '  Hello World  !   ';
echo strtolower($message) . '<br>';  // affiche tout en minuscule
echo strtoupper($message) . '<br>';  // affiche tout en majuscule

echo strlen($message) . '<br>';  // affiche la longueur avec les espaces
echo strlen(trim($message));  //  affiche la longueur sans les espaces  trim() supprime les espaces au début et à la fin de la chaîne de caractères. Puis strlen affiche la longueur de cette chaîne sans les espaces.

echo '<br>';
// ---
// die() ou exit() :
// exit('ici un message');  // affiche un message optionnel et arrête le script

// die('un autre message'); // die() est un alias de exit()  il fait la même chose.

// ---
// Le manuel PHP :
/* 
Pour chercher une fonction ou autre chose de php : faire google "PHP nom de la fonction".

    Exemple : "PHP trim"

    Le site de référence : php.net/manual/fr/

    A retenir : l'encadré blanc qui définit la fonction : en bleu les mots clés et les paramètres, en vert leur type, entre crochets les paramètres optionnels.
*/

//--------------------------
echo '<h2>Les fonctions utilisateurs </h2>';
//-------------------------
// Les fonctions sont des morceaux de codes encapsulés dans des accolades et portant un nom, qu'on appelle au besoinpour exécuter une action précise.

// Les fonctions qui ne sont pas prédéfinis mais déclarées par le développeur sont appelés fonctions utilisateur.

//  Fonctions sans paramètres :
function tiret() {  // on déclare une fonction avec le mot clé function, suivi du nom puis d'une paire de parenthèses (), et enfin d'une paire d'accolades {}
    echo '<hr>';
}

tiret();  // pour exécuter une fonction, on l'appelle par son nom suivi d'une paire de () 


// -------
// fonction avec paramètres et return :

function sayhello($name) {
    return 'Hello ' . $name . ', how are you?';  // alternative :
    // return "Hello $name, how are you?";
    echo 'test';  // après un return, les instructions de la fonction ne sont pas lues (ceci ne s'affichera pas)
}

echo sayhello('Rehaan');  // si la fonction possède un paramètre, il faut obligatoirement lui envoyer une valeur lors de l'appel de la fo,ction. La fonction nous retourne le string "Hello Rehaan, how are you?" grâce au mot clé return qui s'y trouve. Il faut donc faire un echo pour afficher le résultat.

// Exercice : écrivez une fonction appelée appliqueTva2 qui multiplie un nombre donné par un taux donné.

echo '<br>';
echo '<br>';
echo '<br>';


function appliqueTva($nombre) {
    return $nombre * 1.2;
}

// votre code :
function appliqueTva2($nombre, $taux = 1.23) {  // on peut initialiser un paramètre par défaut si on ne reçoit pas de valeurs : ici $taux prend la valeur de 1.23 par défaut si on ne lui en donne pas.
    return $nombre * $taux;
}

echo appliqueTva2(10, 1.2) . '<br>';
echo appliqueTva2(12) . '<br>';  // $taux ayant une valeur par défaut dans les () de la fonction ci-dessus, on est pas obligé de lui en donner un argument pour ce $taux.  affiche 14.76.

// --------------
// Exercice :
// écrivez la fonction factureEssence() qui calcule le coût totale de votre facture en fonction du nombre du nombre de litre d'essence que vous lui donnez en appelant la fonction. Cette fonction retourne la phrase "Votre facture est de x euros pour y litres d'essences" où x et y sont des variables.

// - Pour cela vous avez besoin du prix de litre. on vous donne une fonction prixLitre() qui vous communique ce prix. Utilisez-la donc dans votre fonction factureEssence().

function prixLitre() {
    return rand(100, 200)/100;  // calcul un prix aléatoire entre 1 et 2 (€)
}


// votre code :
echo '<br>';
echo '<br>';





function factureEssence($litreEssence) {
    $prix = prixLitre() * $litreEssence;
    // $prixLitre = prixLitre();
    echo '<br>';
    return 'votre facture est de ' . $prix . ' € pour' . $litreEssence . ' L. et au ' . prixLitre() . ' € par litre';
}

echo factureEssence(100);

echo '<br>';

//--------------------------
echo '<h2>Espace local et espace global </h2>';
//-------------------------

// De l'espace local à l'espace global :
function jourSemaine() {
    $jour = 'Mardi';  // variable locale
    return $jour;  // permet de sortir une valeur de la fonction
}

// echo $jour;  // ne fonctionne pas car cette variable est local à la fonction, donc connu et accesible uniquement à l'intérieur de la fonction

echo jourSemaine();  // on récupère la valeur retournée par le return de la fonction : affiche "Mardi"

echo '<br>';
// --------------
// De l'espace global à l'espace local :

$pays = 'France';  // variable globale

function affichePays() {
    global $pays;  // le mot clé "global" permet de récupérer une variable globale dans l'espace local de la fonction
    echo $pays; // on accède donc bien à cette variable
}

affichePays();  // pas de echo car la fonction le fait déjà     

//--------------------------
echo '<h2>Les structures itératives : les boucles </h2>';
//-------------------------

// Boucle "while" :
$i = 0;  // valeur de départ de la boucle

while ($i < 3){
    // ici le code à répéter
    echo "$i---";  // affiche "0---1---2---"
    $i++;  // on oublie pas d'incrémenter pour que la condition d'entrée dans la boucle deviennent fausse à un moment donné (sinon on obtient une boucle infinie)
}

echo '<br>';

// Exercice : à l'aide d'une boucle while, afficher dans un sélecteur les années depuis 1918 à 2018.

echo '<select>';

    $i = 1918;
    while ($i <= 2018) {
        echo "<option>$i</option>";
        $i++;
    }

echo '</select>';

echo '<br>';
// ------------
// Boucle do...while :
// La boucle do...while a la particularité de s'exécuter au moins une fois, puis tant que la condition est vraie.

$j = 0;
do{
    echo 'Je fais un tour de boucle';
    $j++;
} while($j > 10);  // la condition est évaluée à false tout de suite (1 n'étant pas supérieur à 10), et pourtant la boucle a tourné une fois. Attention au ";" après le while !

// ------------
// Boucle for :
// La boucle for est une autre syntaxe de la boucle while dans laquelle les paramètres valeurs de départ, conditiond'entrée dans la boucle et incrémentation sont regroupés dans les () du for.

for ($i = 0; $i < 10; $i++){  // tant que $i est inférieur à 10, on entre dans la boucle, puis on incrémente $i à la fin de la boucle avant de revenir à la condition
    echo $i . '<br>';  // on fait 10 tours pour les valeurs de $i allant de 0 à 9
}



// Exercie : afficher 12 <options> avec les valeurs de 1 à 12 à l'aide d'une boucle for.
echo '<br>';



echo '<select>';

for($k = 1; $k < 13; $k++) {
    //echo "<option>$k</option>"; // autre moyen de l'écrire :
    echo '<option>' . $k . '</option>';
}
echo '</select>';

// ----------
// Boucle foreach :
// Il existe aussi la boucle foreach que nous aborderons au chapitre des arrays. Elle sert à parcourir les éléments d'un tableau.

//--------------------------
echo '<h2>Exercices de mélanges HTML et PHP</h2>';
//-------------------------

// Exercice 1 : faites une boucle FOR qui affiche 0 à 9 sur la même ligne. résultat attendu : "0123456789".
echo '<table border="1">
    <tr>';
for($a = 0; $a < 10; $a++) {
    
    echo "<td>$a</td>";

}
echo '</tr>
</table>';

echo '<hr>';

// Exercice 3 : Faire une table de 10 lignes et de 10 colonnes, avec une valeur quelconque à l'intérieur dans un premier temps. puis dans un second temps numéroter les cellules de 0 à 99.

$numero = 0;  // pour le première cellule
echo '<table border="1">';

for ($b = 0; $b < 10; $b++){
    echo '<tr>';
        for($a = 0; $a < 10; $a++) {
                    echo "<td>$numero</td>";
                    $numero++;
                }
    echo '</tr>';
}

echo '</table>';

//--------------------------
echo '<h2>Les tableaux de données : arrays </h2>';
//-------------------------
// Un tableau ou array en agnlais, est déclaré comme une variable améliorée dans laquelle on stocke une multitude de valeurs. Ces valeurs peuvent être de n'importe quel type et possèdent un indice par défaut dont la numérotation commence à 0.

// Bien souvent on récupère les informations de la BDD sous forme de array (ou éventuellement d'objet).

// Déclarer un array :
$liste = array('Grégoire', 'Nathalie', 'Emilie', 'François', 'Georges');  // on déclare un array avec le mot clé "array"

// echo $loste  // erreur ('array to string conversion') car on ne peut pas afficher directement un array en PHP

// pour afficher rapidement le contenu de ce tableau :
echo '<pre>';
var_dump($liste);  // affiche le contenu du tableau avec certains infos en plus comme le type des éléments.
echo '</pre>';  // balise HTML qui permet de formater l'affichage de var_dump

echo '<pre>';
print_r($liste);
echo '<pre>';

// Fonction utilisateur pour afficher un print_r :

function debug($param) {
    echo '<pre>';
    print_r($param);
    echo '<pre>'; 
}

debug($liste);  // pour vérifier que notre fonction marche

// -----
// Autre moyen d'affecter des valeurs dans un tableau :
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];  // on peut utiliser la notation entre crochets pour déclarer un array

$tab [] = 'Suisse';  // les crochets vides permettent d'ajouter une valeur à la fin de notre array $tab

debug($tab);

// afficher la valeur "Italie" de l'array $tab.

echo $tab[1];  // pour accéder à une valeur d'un array, on met son indice entre [] après le nom de cet array

// ----
// Tableau associatif :
// Dans un tableau associatif nous pouvons choisir le nom des indices :
    $couleur = array(
        'j' => 'jaune',
        'b' => 'bleu',
        'v' => 'vert'
    );

    echo '<br>';

// pour accéder à un élément du tableau associatif :
        echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>';
    
        echo "La seconde couleur de notre tableau est le $couleur[b] <br>";  // affiche aussi "bleu". Un array écrit dans des guillemets ou des quotes perd les quotes autour de son indice

// Compter le nombre d'éléments contenu dans un array :
echo 'Taillle  du tableau : ' . count($couleur) . '<br>';  // affiche 3 (éléments)
echo 'Taillle  du tableau : ' . sizeof($couleur) . '<br>';  // sizeof() est pareil que count() dont il est un alias 

//--------------------------
echo '<h2>La boucle foreach pour les arrays </h2>';
//-------------------------

// foreach est un moyen de passer en revue un tableau. Elle fonctionne uniquement sur les tableaux et les objets.

foreach($tab as $valeur){  // le mot clé "as" fait partie de foreach et est obligatoire. La variable $valeur (que l'on nomme comme on veut) vient parcourir les valeurs du tableau $tab. Quand il n'y a qu'une seule variable après "as", elle parcourt systématiquement les VALEURS
    echo $valeur . '<br>';  // on affiche successivement à chaque tour de boucle les éléments du tableau
}


//  Parcourir la colonne des indices Et des valeurs :
foreach($tab as $indice => $valeur) {  // Quand il y a 2 variables après "as", la première parcourt les indices et la deuxième après "=>" parcourt les VALEURS

    echo $indice . 'correspond à ' . $valeur . '<br>';
}

// Exercice : 
/* 
- écrivez un array avec les indices prenom, nom, email et telephone et mettez y pour valeurs des informations fictives. Remarque : cet array ne concerne qu'une seule personne.

- puis avec un boucle foreach, affichez les valeurs de votre array dans des <p>, sauf le prenom qui doit être affiché dans un <h3>.
*/

$client = ['prenom' => 'Nelson', 'nom' => 'Mandela', 'email' => 'n.mandela@gmail.com', 'telephone' => '0102030516'];


foreach($client as $indice => $detail){
    if ($indice == 'prenom') {
        echo "<h3>$indice : $detail</h3>";
    } else{
    echo "<p>$indice : $detail</p>";
    }
}

//--------------------------
echo '<h2>Les arrays multidimensionnels </h2>';
//-------------------------
// Nous parlons de tableaux multidimensionnel quand un tableau est contenu dans un autre tableau. Chaque tableau représente une dimension

// Création d'un tableau multidimensionnel :

$tab_multi = array(
    0 => array(
        'prenom' => 'Julien',
        'nom' => 'Dupon',
        'tel' => '01 41 64 05 12'
    ),
    1 => array(
        'prenom' => 'Nicolas',
        'nom' => 'Duran',
        'tel' => '06 41 64 05 12'
    ),
    2 => array(
        'prenom' => 'Pierre',
        'nom' => 'Dulac'
    )
);

// Il est bien-sûr possible de choisir le nom des indices de notre array.

debug($tab_multi);

// Afficher la valeur "Julien" :

echo $tab_multi[0]['prenom'] . '<hr>';  // affiche Julien. Nous allons d'abord dans $tab_multi, puis à l'indice "0", puis à l'indice "prenom".

// ------
// Parcourir le tableau multidimensionnel avec le boucle for :
for ($i = 0; $i < count($tab_multi); $i++) {  // count($tab_multi) vaut "3" car il y a bien "3" éléments dans ce premier niveau de ce tableau
    echo $tab_multi[$i]['prenom'] . '<br>';  // $i prend successivement les valeurs 0 puis 1 puis 2. On affiche donc à chaque tour de boucle "Julien" puis "Nicolas" puis "Pierre"
}

echo '<hr>';

// Exercice :
// Afficher les 3 prenoms avec la boucle foreach.

foreach ($tab_multi as $indice => $valeur) {
    echo $indice . ' : ' . $valeur['prenom'] . '<br>';

}

echo '<hr>';

// Pour afficher tous les éléments d'un array multidimesionnel, on fait des boucles foreach imbriquées (une par dimension) :

    foreach($tab_multi as $indice => $valeur) {
        foreach($valeur as $label => $info) {  // $valeur étant lui même un array, je refais une foreach dessus pour lr parcourir
            echo $label . ' => ' . $info . '<br>';  // $label correspond aux indices de $valeur et $info aux valeurs

        }
    }


//--------------------------
echo '<h2>Les inclusions de fichiers </h2>';
//-------------------------

echo 'Première inclusion';
include 'exemple.inc.php';  // le fichier est "inclus" : en cas d'erreur lors de l'inclusion, include génère une erreur de type "warning" et continue l'exécution du script.

echo 'Deuxième inclusion';
include_once 'exemple.inc.php';  // le once vérifie si le fichier à déjà été inclus. Si c'est le cas, il ne le ré-inclut pas.

echo 'Troisième inclusion';
require 'exemple.inc.php';  // le fichier est requis : en cas d'erreur sur le nom ou le chemin du fichier, require génère une erreur de type "fatal error" et arrête l'exécution du script.

echo 'Quatrième inclusion';
require_once 'exemple.inc.php';  // le once vérifie si le fichier à déjà été inclus. Si c'est le cas, il ne le ré-inclut pas.

