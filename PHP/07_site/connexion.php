<?php
require_once 'inc/init.inc.php';

// 2 - Déconnexion de l'internaute

if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {  // si l'internaute à cliqué sur "Se déconnecter"
    session_destroy();  // on supprime toute la session du membre. Rappel : cette instruction ne s'exécute qu'en fin des script

}

// 3 - On vérifie si l'internaute est déjà  connecté :
if (internauteEstConnecte()) {  // s'il est connecté on le rencoie vers son profil :
    header('location:profil.php');
    exit();  // pour quitter le script

}



// debug($_POST);

// 1 - Traitement du formulaire :
if (!empty($_POST)) { // si le formulaire est soumis

    // validation des champs :
    if (!isset($_POST['pseudo']) || empty($_POST['pseudo'])) {
        $contenu .= '<div class="bg-danger">Le pseudo est requis.</div>';
    }

    if (!isset($_POST['mdp']) || empty($_POST['mdp'])) {
        $contenu .= '<div class="bg-danger">Le mot de passe est requis.</div>';
    }

    if (empty($contenu)) { // S'il n'y a pas d'erreur sur le formulaire ($contenu est vide quand il n'y a pas d'erreur)
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp']));

        if ($membre->rowCount() >0 ) {  // si le nombre de ligne est supérieur à 0, alors le login et le mdp existent ensemble en BDD
        // On crée une session avec les informations du membre :
            $informations = $membre->fetch(PDO::FETCH_ASSOC);  // on fait un fetch pour transformer l'objet $membre en un array associatif qui contient en indice le nom de tous les champs de la requête
            debug($informations);

            $_SESSION['membre'] = $informations;  // nous créons une session avec les infos du membre qui proviennent de la BDD

            header('location:profil.php');
            exit(); // on redirige l'internaute vers sa page de profil, et on quitte ce script avec la fonction exit()

        } else {
            // sinon c'est qu'il y a erreur sur les identifiants (ils n'existent pas ou pas pour le même membre)
            $contenu .= '<div class="bg-danger">Erreur sur les identifiants.</div>';
        }
    
    }  // Fin if (empty($contenu))

} // fin if (!empty($_POST))







// ------------------ AFFICHAGE -----------------
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Connexion</h1>
<?php echo $contenu; ?>

<form action="" method="post">

    <label for="pseudo">Pseudo</label><br>
    <input type="text" name="pseudo" id="pseudo" value=""><br><br>

    <label for="mdp">Mot de passe</label><br>
    <input type="password" name="mdp" id="mdp" value=""><br><br>

    <input type="submit" value="Se connecter" class="btn">

</form>




<?php
require_once 'inc/bas.inc.php';