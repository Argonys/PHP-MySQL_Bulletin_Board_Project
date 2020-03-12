<?php 
session_start(); 

require_once 'config.php';

// Si l'user n'est pas connecté, on le redirige vers la page d'accueil
if($_SESSION['logged_in'] === NULL) {
    header('location: index.php');
    exit;
}



// Script pour générer l'avatar
$email = $_SESSION['email'];
function get_gravatar($email, $s = 100, $d = 'mp', $r = 'g', $img = false, $atts = array())
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val)
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
$src = get_gravatar($email);





$req = $bdd->prepare('SELECT * FROM users WHERE username LIKE :username');
$req->bindValue(':username', $_POST['new_username']);
$req->execute();
$username_isValid = $req->fetch();


// Changement d'username
if (isset($_POST['change_username'])) {
    if (empty($_POST['new_username'])) {
        echo "Please enter a valid username.";
    } elseif ($username_isValid) {
        echo "This username is already taken. Please enter an other username.";
    } else {
        $new_username = $_POST['new_username'];
        // On prépare les options de la requête (requête préparée)
        $sql = 'UPDATE users SET username = :new_username WHERE email LIKE :email';
        // On prépare la requête
        $req = $bdd->prepare($sql);
        $req->bindValue(':new_username', $new_username);
        $req->bindValue(':email', $_SESSION['email']);
        // On essaie d'exécuter la requête
        $req->execute();
        $_SESSION['username'] = $new_username;
        header('location: profile1.php');
    }
}


// Changement de password
if (isset($_POST['change_password'])) {

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    if(password_verify($current_password, $_SESSION['password'])) {

        if($new_password === $confirm_new_password) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = 'UPDATE users SET password = :new_password WHERE email LIKE :email';
            $req = $bdd->prepare($sql);
            $req->bindValue(':new_password', $new_hashed_password);
            $req->bindValue(':email', $_SESSION['email']);
            $req->execute();
            $_SESSION['password'] = $new_hashed_password;
            header('location: profile1.php');
        } else {
            echo "Les deux passwords ne correspondent pas.";
        }
    } else { 
        echo "You didn't write well your current password.";
    }
}


// Changement de signature
if(isset($_POST['change_signature'])) {
    $new_signature = $_POST['new_signature'];
    // On prépare les options de la requête (requête préparée)
    $sql = 'UPDATE users SET signature = :new_signature WHERE email LIKE :email';
    $req = $bdd->prepare($sql);
    $req->bindValue(':new_signature', $new_signature);
    $req->bindValue(':email', $_SESSION['email']);
    $resp = $req -> execute();
    // On garde en session sa nouvelle signature et on le renvoie sur la page profile.
    $_SESSION['new_signature'] = $new_signature;
    header('location: profile1.php');
}





?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="profile.js"></script>
    <link rel="stylesheet" type="text/css" href="css/profile1.css" media="all" />
    <link rel="stylesheet" href="css/header_on.css">
</head>
<body style="margin-top: auto;
    background-color: #f1f1f1;">
    <div>
    <?php
    require "header_on.php"; ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bloc1 row">
            <div class="bloc1-avatar border-right rounded flex-column col-sm-3 d-flex  bg-red">
                <img class="rounded-circle mt-5 mx-auto " style="width:60%" src=<?php echo $src; ?> >
                <button class="btn-info btn mx-auto mt-5" href="https://fr.gravatar.com/emails/" style="width:60%" type=" button"><a class="text-white text-decoration-none" href="https://fr.gravatar.com/emails/">Edit avatar</a> </button>
                <div class="userInfo pl-5 pt-5 text-secondary">
                    Registered since <?php echo $_SESSION['creation_date']; ?><br />
                    <?php echo $_SESSION['email']; ?>
                </div>
            </div>
            <div class=" bloc1-description col-sm-7 bg-blue d-flex align-items-start flex-column">
                <div class="usernameBox">
                    <div class="username col-sm-12 border-bottom pb-4 ">
                        <div class="usernameV">
                            <h4 class="font-weight-bold text-secondary pt-5"><?php echo $_SESSION['username']; ?>
                                <a data-toggle="collapse" href="#collapseUser" role="button" aria-expanded="false" aria-controls="collapseExample" id="logo1" class="fa fa-pencil pl-4"></a>
                        </div>
                        <section class="collapse" id="collapseUser">
                            <div class="usernameHidden">
                                <form action="" method="POST">
                                    <label class="font-weight-light" for="newID">Please enter your new username... </label>
                                    <input type=" text" class="newID" name="new_username" />
                                    <button name="change_username" class="btn-success btn-sm mx-auto mt-2" style="width:20%" type="submit"><a class="text-white text-decoration-none">Comfirm</a> </button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <p><?php echo $errors; ?>
                <div class=" passwordBox">
                    <div class="password col-sm-12  border-bottom pb-4">
                        <div class="password">
                            <h4 class=" font-weight-bold text-secondary pt-3">Change password
                                <a data-toggle="collapse" href="#collapsePassword" role="button" aria-expanded="false" aria-controls="collapseExample" id="logo1" class="fa fa-pencil pl-4"></a>
                        </div>
                        <section class="collapse" id="collapsePassword">
                            <div class="passwordHidden">
                                <form action="" method="POST">
                                    <label class="font-weight-light">Please enter your old password... </label>
                                    <input type="password" class="oldPW" name="current_password" />
                                    <label class="font-weight-light">Please enter your new password... </label>
                                    <input type="password" class="newPW" name="new_password" />
                                    <label class="font-weight-light">Please confirm your new password... </label>
                                    <input type="password" class="newPWC" name="confirm_new_password" /><br />
                                    <button class="btn-success btn-sm mx-auto mt-2" style="width:20%" name="change_password" type="submit"><a class="text-white text-decoration-none">Comfirm</a> </button>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="signature col-sm-12">
                    <div class="signature border-bottom pb-4">
                        <div class="labelSignature">
                            <label for="signature" type="text">
                                <h4 class="font-weight-bold text-secondary pt-3">Your signature
                                    <a data-toggle="collapse" href="#collapseSignature" role="button" aria-expanded="false" aria-controls="collapseExample" id="logo1" class="fa fa-pencil pl-4"></a>
                            </label>
                        </div>
                        <form action="" method="POST">
                            <textarea placeholder="Write your signature here.." class="form-control" name="new_signature" rows="7" id="signature"><?php echo($_SESSION['new_signature']); ?></textarea>
                            <button class="btn-success btn-sm mx-auto mt-2" style="width:20%" name="change_signature" type="submit"><a class="text-white text-decoration-none">Submit</a> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
    <?php require "footer.php" ?>
    </div>
</body>

</html>