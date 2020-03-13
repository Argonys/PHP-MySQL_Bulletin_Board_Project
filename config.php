<?php
$host = 'g4yltwdo6z0izlm6.chr7pe7iynqr.eu-west-1.rds.amazonaws.com';
$dbname = 'ca6izbl05k1wtouv';
$user = 'srbyg4ivyi12g4zz';
$password = 'ygtd43pcrnfdn3z5';

// Connexion à la database
try {
    $bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $user, $password);
}

catch(PDOException $e) {
    print "Erreur : " . $e->getMessage() . "<br/>";
    die();
}
