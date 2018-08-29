<?php
/* 
Sujet : 
    - Créer une fonction qui permet de convertir une date FR en date US, ou inversement.
    Cette fonction prend 2 paramètres : une date et le format de conversion "US" ou "FR".

    - Vous validez que le paramètre format de sortie est bien "US" ou "FR". La fonction retourne un message si ce n'est pas le cas.
*/

$aujoudhui = date('d-m-Y'); // donne la date du jour au format indiqué

echo $aujoudhui . '<br>';

// ----
// Convertir une date d'un format vers un autre :

$date = '2018-08-23';

echo 'La date au format US : ' . $date . '<br>';

$objetDate = new DateTime($date);
echo 'La date au format FR : ' . $objetDate->format('d-m-Y');  // La méthode format() permet de convertir un objet date selon le format indiqué



echo '<hr>';

// Exercice :

function dateConvert($date, $format) {

    $objetDate = new DateTime($date);

    if ($format == 'FR') {
        $date = $objetDate->format('d-m-Y');
        return "La date au format $format : $date";
    } elseif ($format == 'US') {
       $date = $objetDate->format('Y-m-d');
        return "La date au format $format : $date";
    } else {
        return '<p>Le format est inconnu</p>';
    }
    
}

echo dateConvert('23-08-1998', 'US');

// Correction :

function afficheDate($date, $format) {
// Vérifier la valeur du $format :
    if ($format !='US' && $format !='FR') {
        return '<p>Erreur sur le format !</p>';
    }

// Une fois le(s) paramètre(s) validés, on fait le traitement :
    if ($format == 'US') {
        $objetDate = new DateTime($date);
        return '<p>La date au format US : ' . $objetDate->format('Y-m-d') . '</p>';
    } else {
        $objetDate = new DateTime($date);
        return '<p>La date au format FR : ' . $objetDate->format('d-m-Y') . '</p>';
    }

}

echo afficheDate('23-08-1998', 'US');


