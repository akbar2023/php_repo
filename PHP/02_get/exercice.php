<?php
// Exercice : 
/*
 1 - Vous créez un page "profil" qui affiche un nom et un prenom.

 2 - Vous y ajoutez un lien en GET "modifier mon profil" et un second "supprimer mon profil".
    Ces liens passent dans l'url à la page exercice.php elle-même que l'on a cliqué sur le lien "modifier mon profil" ou sur "supprimer mon profil". Pensez qu'il faut un indice et une valeur pour chaque action.

3 - Si on a cliqué sur "modifier mon profil", c'est-à-dire que vous avez reçus cette info en GET, vous affichez le message "Vous avez demandé la modification de votre profil", et si c'est la suppression qui est demandé alors affichez "vous avez demandé la suppression de votre profil". 
*/

$message = '';  // variable pour contenir les messages de l'internaute


// var_dump($_GET);

if(isset($_GET['modifier']) && ($_GET['modifier'] == 'true') ){  // il faut vérifier d'abord l'existance de l'indice 'modifier' dans $_GET AVANT d'en vérifier la valeur
    $message = '<p>Vous avez demandé à modifier votre profil</p>';
}

if(isset($_GET['supprimer']) && ($_GET['supprimer'] == 'true') ){  // il faut vérifier d'abord l'existance de l'indice 'modifier' dans $_GET AVANT d'en vérifier la valeur
    $message = '<p>Vous avez demandé à supprimer votre profil</p>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h1>Profil</h1>

<?php echo $message; ?>

    <p>Nom : KHAN</p>
    <p>Prénom : Akbar</p>
    <div></div>
    <p><a href="exercice.php?modifier=true">Modifier mon profil</a></p>
    <p><a href="exercice.php?supprimer=true">Supprimer mon profil</a></p>
</body>
</html>


    

