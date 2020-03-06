<?php
$host = 'mysql';
$dbname = 'mydb';
$user = 'root';
$password = 'root';


// Connexion à la database
try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
}

catch(PDOException $e) {
    print "Erreur : " . $e->getMessage() . "<br/>";
    die();
}

?>