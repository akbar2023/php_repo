<?php

// var_dump($_POST);
$info = '';

if (!empty($_POST)){  // est équivalent à if($_POST) : signifie que $_POST n'est pas vide, donc que le formulaire a été soumis
    $info = '<p>Ville : ' . $_POST['ville'] . '</p>';
    $info .= '<p>Code Postal : ' . $_POST['codePostal'] . '</p>';
    $info .= '<p>Adresse : ' . $_POST['adresse'] . '</p>';
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
<h1>Données Reçues :</h1>
<?php echo $info; ?>
    

    
</body>
</html>