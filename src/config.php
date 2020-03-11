<?php
$host = 'mysql';
$dbname = 'mydb';
$user = 'root';
$password = 'root';


// Formatage de la date par défaut
date_default_timezone_set('UTC+1');

// Connexion à la database
try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
}

catch(PDOException $e) {
    print "Erreur : " . $e->getMessage() . "<br/>";
    die();
}

?>