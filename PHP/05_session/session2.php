<?php

// Ouverte ou création d'une session :
session_start();

echo 'La session est accessible dans tous les scripts du site, comme ici : <br>';
var_dump($_SESSION);  // on accède bien aux informations contenus dans la session 

// Ce fichier (=page) n'a rien à voir avec l'atre page, il n'y a pas d'inclusion, il pourrait être dans un autre dossier, s'appeler n'importe comment, les infos de la session restent accessibles grâce au session_start(). 