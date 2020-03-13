<?php
// On inclut le fichier de connexion à la database
require_once "connectionDBB.php";


$username = '';
$email = '';
$errors = array();
$signature = '';


// Si le bouton pour s'inscrire est cliqué, alors
if (isset($_POST['register'])) {
    // ATTENTION, addslashes n'est apparemment pas la meilleure fonction à utiliser ici

    $username = addslashes($_POST['username']);
    $email = addslashes($_POST['email']);
    $password_1 = addslashes($_POST['password_1']);
    $password_2 = addslashes($_POST['password_2']);


    // S'assurer que tous les champs sont remplis/valides
    if (empty($username)) {
        array_push($errors, "Le nom d'utilisateur est requis.");
    }

    if (empty($email)) {
        array_push($errors, "L'adresse email est requise.");
    }

    if (empty($password_1)) {
        array_push($errors, "Le mot de passe est requis.");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Les mots de passe ne correspondent pas.");
    }

    // Si tout est bon, envoyer les données de l'user dans la database
    if (empty($errors)) {
        // Hachage du password
        // /!\ Attention, la longueur du résultat issu du hachage peut être assez long
        // (IL faudrait mettre 255char max dans la dbb)
        $password = password_hash($password_1, PASSWORD_DEFAULT);
        $req = $bdd->prepare('INSERT INTO users(username, email, password) VALUES(:username, :email, :password)');
        $req->bindValue(':username', $username, PDO::PARAM_STR);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->bindValue(':password', $password, PDO::PARAM_STR);
        $req->execute();   
    }
} 
?>

