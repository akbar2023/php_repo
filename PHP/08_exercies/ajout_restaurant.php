<?php
/* 
Sujet :
1 - Créer une BDD 'restaurants' avec une table 'restaurant' :
    id_restaurant   PK AI INT(3)
    nom             VARCHAR(20)
    adresse         VARCHAR(255)
    telephone       VARCHAR(10)
    type            ENUM('gastronomique', 'brasserie', 'pizzeria', 'autre')
    note            INT(1)
    avis            TEXT

2 - Créer un formulaire HTML (avec doctype ...) afin d'ajouter un restaurant en BDD. les champs type et note (de 1à 5) sont des menus déroulant.

3 - Effectuer les vérifications suivants :
        Le champ nom contient 2 caractères minimum
        Le champ adresse ne doit pas être vide
        Le téléhone doit contenir 10 chiffres
        Le type doit être conforme à la liste des types de la BDD
        La note est un entier entre 0 et 5
        L'avis ne doit pas être vide
        En cas d'erreur de saisie, afficher un message au-dessus du formulaire

4 - Ajouter un ou plusieurs rastaurants à la BDD et afficher un message de succès ou d'échec lors de l'enregistrement.

*/

$contenu = '';


// Démarrage serveur
$pdo = new PDO('mysql:host=localhost;dbname=restaurant','root',
'',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') 
);

// ---------- Traitement du formulaire ----------- 

if (!empty($_POST)) {
    // Nom
       if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20 ) $contenu .= '<div>Le nom doit contenir entre 2 et 20 caractères.</div>';

    // Adresse
    if (!isset($_POST['adresse'])) $contenu .= '<div>Le champ adresse est vide !</div>';

    // Téléphone
       if (!isset($_POST['telephone']) || strlen($_POST['telephone']) != 10 || !ctype_digit($_POST['telephone'])) $contenu .= '<div>Le numéro est incorrecte !</div>'; // ctype_digit() vérifie bien que le champ comporte bien un nombre entier (sans virgule) contrairement à is_numeric()

    // Note
    if (!isset($_POST['note']) || strlen($_POST['note']) != 1 || !ctype_digit($_POST['note'])) $contenu .= '<div>La note est incorrecte !</div>'; // ctype_digit() vérifie bien que le champ comporte bien un nombre entier (sans virgule) contrairement à is_numeric()


    // Type de restaurant
       if (!isset($_POST['type']) || ($_POST['type'] != 'gastronomie' && $_POST['type'] != 'brasserie' && $_POST['type'] != 'pizzeria' && $_POST['type'] != 'autre')) $contenu .= '<div>Le type de votre restaurant est incorrect !</div>';


   // -----------------------------
   if (empty($contenu)) {  // si $contenu est vide c'est qu'il n'y a pas d'erreur
   
           // On échappe toutes les valeurs de $_POST :
           foreach($_POST as $indice => $valeur) {
               $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
           }
       
           // On fait une requête préparée :
           $result = $pdo->prepare("INSERT INTO restaurants(nom, adresse, telephone, type, note, avis) VALUES (:nom, :adresse, :telephone, :type, :note, :avis)");
       
           $result->bindParam(':nom', $_POST['nom']);
           $result->bindParam(':adresse', $_POST['adresse']);
           $result->bindParam(':telephone', $_POST['telephone']);
           $result->bindParam(':type', $_POST['type']);
           $result->bindParam(':note', $_POST['note']);
           $result->bindParam(':avis', $_POST['avis']);      
       
           $req = $result->execute();  // la méthode execute() renvoie un boolean selon que la requête à marchée (true) ou pas (false)
       
           // Afficher un message de réussite ou d'échec :
           if ($req) {
               $contenu .= '<div>Le restaurant à bien été ajouté</div>';
           } else {
               $contenu .= '<div>Une erreur est survenue lors de l\'eregistrement.</div>';
           }
       
       } // fin empty $contenu
   
   } // fin !empty $_POST ------ traitement formulaire



?>


 <!-- ******** Affichage ********* -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <?php echo $contenu; ?>
    
    <form action="" method="post">

        <div>
            <label for="nom">Nom :</label> <br>
            <input type="text" name="nom" id="nom">
        </div>

        <div>
            <label for="adresse">Adresse :</label> <br>
            <textarea name="adresse" id="adresse"></textarea>
        </div>

        <div>
            <label for="telephone">Télephone :</label> <br>
            <input type="text" name="telephone" id="telephone">
        </div>

        <div>
            <label for="type">Type :</label> <br>
            <select name="type" id="type">
                <option value="">***</option>
                <option value="gastronomique">Gastronomique</option>
                <option value="brasserie">Brasserie</option>
                <option value="pizzeria">Pizzeria</option>
                <option value="autre">Autre</option>
            </select>
        </div>

        <div>
            <label for="note">Note :</label> <br>
            <select name="note" id="note">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div>
            <label for="avis">Avis :</label> <br>
            <textarea name="avis" id="avis"></textarea>
        </div>

        <div><input type="submit" name="validation" value="Enregistrer"></div>
     
    
    </form>

</body>
</html>