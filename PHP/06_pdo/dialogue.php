<?php
// ----------------------------
// Cas pratique : espace de commentaires
// ----------------------------

// Objectif : créer un formulaire pour poster des commentaires et le sécuriser.

/* Créer une BDD : dialogue
    Table        : Commentaire
    Champs       : id_commentaire      INT(3) PK - AI
                   pseudo              VARCHAR(20) 
                   message             TEXTE
                   date_enregistrement DATETIME


*/



// II. Connexion à la BDD et traitement de $_POST :
$pdo = new PDO('mysql:host=localhost;dbname=dialogue',  // driver mysql : serveur ; nom de la BDD
                'root', // pseudo de la BDD
                '',  // mot de passe de la BDD
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,   // option 1 : pour afficher les erreurs SQL
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')  // option 2 : définit le jeu de caractères des échanges avec la BDD
);





// var_dump($_POST);
// print_r($_POST);

if (!empty($_POST)) {  // signifie si le formulaire est remplie
    // Traitement contre les failles JS (XSS)  ou les failles CSS : on parle d'échappement des données reçues :
    // On commence par mettre du code CSS dans le champ "message" : <style>body{display:none}</style>
    // Pour s'en prémunir :
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);  //convertit les caractères spéciaux (<, >, &, "", '') en entités HTML (exemple : le "<" devient " &lt; " ) ce qui permet de rendre innofensives les balises HTML. on parle d'échappement des données reçues.
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);



    // Intsertion de commentaire de l'internaute en BDD : nous allons faire une première requête qui n'est pas protégée contre les injections et qui n'accepte pas les apostrophes :

    // $resultat = $pdo->query("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')");


    // Nous faisons l'injection SQL suivante dans le champ "message" : ok');DELETE FROM commentaire;(

    // Pour se prémunir des injections SQL faisons une requête préparée. Par ailleur, elle permettra la saisie d'apostrophes par l'internaute


    $resultat = $pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message)");  

    $resultat->bindParam(':pseudo', $_POST['pseudo']);
    $resultat->bindParam(':message', $_POST['message']);

    $resultat->execute();

    // Comment ça marche ? le fait de mettre des marqueurs dans la requête permet de ne pas concaténer les instructions SQL avce l'injection SQL. Par ailleurs, en faisant un bindParam, les instructions SQL sont dissociées les une des autres et neutralisées par PDO qui les transforment en strings innofensifs. En effet, le SGBD attends des valeurs à la place des marqueurs dont il sait qu'elles ne sont pas du code à exécuter

}


?>

<!-- I. formulaire de saisie des messages  -->
<h1>Votre message</h1>
<form method="post" action="">
    <label for="pseudo">Pseudo</label>
    <input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"><br><!-- l'opérateur "??" en php7 signifie "prend le premier qui existe". Ici on affiche donc $_POST['pseudo'] s'il existe, sinon un string vide -->

    <label for="message">Message</label>
    <textarea name="message" id="message" cols="30" rows="10"><?php echo $_POST['message'] ?? ''; ?></textarea><br>

    <input type="submit" name="envoi" value="Envoyer"> 

</form>







<?php
// III. Affichage des messages :

$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d/%m/%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H:%i:%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");

echo '<h2>' . $resultat->rowCount() . ' commentaire</h2>';
 
while ($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)) {
    // var_dump($commentaire);
    
    echo '<p>Par ' . $commentaire['pseudo'] . 'le ' . $commentaire['datefr'] . 'à' . $commentaire['heurefr'] . '</p>';

    echo '<p>' . $commentaire['message'] . '</p>';  

}


// Conclusion : faire systématiquement sur données reçues : 1 htmlspecialchars() et une requête préparée !