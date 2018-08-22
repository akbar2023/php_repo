<?php

echo '<h1>Les commerciaux et leur salaire</h1>';

/*   Exercice : 
- afficher dans une liste <ul><li> le prénom, le nom et le salaire des employés appartenant au service commercial (un <li> par commercial), en utilisant une requête préparée.
- afficher le nombre de commerciaux.
*/


// 1- Connexion à la BDD

$pdo = new PDO('mysql:host=localhost;dbname=entreprise','root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')  );

// 2- On fait la requête :
$service = 'commercial';

$employe = $pdo->prepare("SELECT id_employes, prenom, nom, salaire FROM employes WHERE service = :commercial");

$employe->bindParam(':commercial', $service); 

$employe->execute();

echo '<ul>';
while ($infos = $employe->fetch(PDO::FETCH_ASSOC)) {
    echo '<li>' . $infos['prenom'] . ' ' . $infos['nom'] . ' ' . $infos['salaire'] . ' €' . '</li>';
}
echo '</ul>';

// affiche le nombre de commerciaux
echo 'Nombre d\'employés commerciaux : ' . $employe->rowCount() . '<br><br>';


// -------------------------
// Version table HTML :

$employe->execute();

echo '<table border="1">';
    // les entêtes :
    echo '<tr>';
        echo '<th>Prénom</th>';
        echo '<th>Nom</th>';
        echo '<th>Salaire</th>';
    echo '</tr>';
    while ($infos = $employe->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>' .
        '<td>'. $infos['prenom']. '</td>
        <td>' . ' ' . $infos['nom']. '</td> 
        <td>' . ' ' . $infos['salaire'] . ' €'. '</td>'.
        '</tr>';
    }

    echo '</table>';