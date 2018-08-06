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
function appliqueTva2($nombre, $taux) {
    return $nombre * $taux;
}

echo appliqueTva2(10, 1.2);





