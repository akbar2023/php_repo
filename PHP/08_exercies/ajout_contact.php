<?php
$contenu = '';

$inscription = false;

$pdo = new PDO('mysql:host=localhost;dbname=contacts','root',
                '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') 
            );


// ----------------- fonction de requête ------------------------
function executeRequete($req, $param = array()) {  // cette requête attend 2 valeurs : 1 requête SQl (obligatoire) et un array qui associe les marqueurs aux valeurs (non obligatoire car on a affecté au paramètre $param un array() vide par défaut)
    
    // Echappement des données reçues avec htmlspecialchars :
    if (!empty($param)) { // si l'array $param n'est pas vide, je peux faire la boucle :
        foreach($param as $indice => $valeur) {
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES);  // on échappe les valeurs de $param que l'on remet à leur palce dans $param[$indice]
        }
    }

    global $pdo;  // permet d'avoir accès à la variable $pdo définie dans l'espace global (c'est-à-dire hors de cette fonction) au sein de cette fonction

    $result = $pdo->prepare($req);  // on prépare la requête envoyée à notre fonction
    $result->execute($param);  // on exécute la requête en lui donnant l'array présent dans $param qui associe tous les marquers à leur valeur
    return $result;  // on retourne le résultat de la requête de SELECT


} // fin executeRequete()


/* 
1 - Créer une base de données "contacts" avec une table "contact" :
        id_contact       PK AI INT(3)
        nom              VARCHAR(20)
        prenom           VARCHAR(20)
        telephone        VARCHAR(10)
        annee_rencontre  YEAR
        email            VARCHAR(200)
        type_contact     ENUM('ami', 'famille', 'professionnel', 'autre')
        
2 - Créer un formulaire html (avec doctype...) afin d'ajouter des contacts dans le BDD. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.

3 - Sur le formulaire effectuer les contrôles nécessaire :
    - les champs nom et prenom contiennent 2 caractères minimum
    - le champ telephone contient 10 chiffres
    - L'année de rencontre doit être une année valide
    - Le type de contact doit être conforme à la liste des contacts
    - L'email doit être valide

    En cas d'erreur de saisie, afficher les messages d'erreur au-dessus du formulaire.

4 - Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/
print_r($_POST);

if (!empty($_POST)) {
    // Nom
    if (!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20 ) $contenu .= '<div>Le nom doit contenir entre 2 et 20 caractères</div>';
    
    //Prénom
    if (!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20 ) $contenu .= '<div>Le prénom doit contenir entre 2 et 20 caractères</div>';
    
    // Téléphone
    if (!isset($_POST['telephone']) || strlen($_POST['telephone']) != 10 || !is_numeric($_POST['telephone'])) $contenu .= '<div>Le numéro est incorrecte !</div>';

    // Annee
    if (!isset($_POST['annee']) || strlen($_POST['annee']) != 4 || !is_numeric($_POST['annee']) || $_POST['annee'] > 2018|| $_POST['annee'] < 1918) $contenu .= '<div>L\'année de votre rencontre est incorrecte !</div>';

    // Email
    if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div>Email est incorrecte</div>';  

    // Type de contact
    if (!isset($_POST['type']) || $_POST['type'] != 'ami' && $_POST['type'] != 'famille' && $_POST['type'] != 'professionnel' && $_POST['type'] != 'autre') $contenu .= '<div>Le type de votre contact est invalide !</div>';


    // -----------------------------


    if (empty($contenu)) {  // si $contenu est vide c'est qu'il n'y a pas d'erreur

        // On échappe toutes les valeurs de $_POST :
        foreach($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlspecialchars($valeur, ENT_QUOTES);
        }
    
        // On fait un erequête préparée :
        $result = $pdo->prepare("INSERT INTO contact(nom, prenom, telephone, annee, email, type) VALUES (:nom, :prenom, :telephone, :annee, :email, :type)");
    
        $result->bindParam(':nom', $_POST['nom']);
        $result->bindParam(':prenom', $_POST['prenom']);
        $result->bindParam(':telephone', $_POST['telephone']);
        $result->bindParam(':annee', $_POST['annee']);
        $result->bindParam(':email', $_POST['email']);
        $result->bindParam(':type', $_POST['type']);
    
    
        // Version avec boucle foreach :
        // foreach ($_POST as $indice => &$valeur) {
        //     $result->bindParam($indice, $valeur);
        // }
    
    
    
    
        $req = $result->execute();  // la méthode execute() renvoie un boolean selon que la requête à marchée (true) ou pas (false)
    
        // Afficher un message de réussite ou d'échec :
        if ($req) {
            $contenu .= '<div>L\'employé à bien été ajouté</div>';
        } else {
            $contenu .= '<div>Une erreur est survenue lors de l\'eregistrement.</div>';
        }
    
    } // fin empty $contenu

} // fin !empty $_POST






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire d'ajout de contacts</title>
</head>
<body>

<h1>Ajouter un contact</h1>

<?php echo $contenu; ?>

<form action="" method="post">

    <label for="nom">Nom :</label>  
    <input type="text" name="nom" id="nom">  <br><br>

    <label for="prenom">Prenom :</label>  
    <input type="text" name="prenom" id="prenom"> <br><br>

     <label for="telephone">Téléphone :</label>  
    <input type="text" name="telephone" id="telephone"> <br><br>

    <label for="annee">Année de rencontre :</label>
    <select name="annee" id="annee">
        <?php 
        
        // $annee_actuelle = annee() {
        //  return time() + (365*24*60*60); 
        // }
        
        // $annee_actuelle = 2018;
        
        for($i = 2018; $i >= 1918; $i--) {
            echo "<option>$i</option>";
        }
        ?>
    </select> <br><br>

    <label for="email">Email :</label>     
    <input type="email" name="email" id="email"> <br><br>

    <label for="type">Relation :</label>
    <select name="type" id="type">

        <option value="ami">ami</option>
        <option value="famille">famille</option>
        <option value="professionnel">professionnel</option>
        <option value="autre">autre</option>

    </select> <br><br>

    <input type="submit" name="validation" value="Enregistrer">


</form>
    
</body>
</html>

