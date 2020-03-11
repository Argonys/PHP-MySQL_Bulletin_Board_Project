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
            // On prépare la requête
            $req = $bdd->prepare($sql);
            $req->bindValue(':new_password', $new_hashed_password);
            $req->bindValue(':email', $_SESSION['email']);
            // On essaie d'exécuter la requête
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




?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/profile1.css" media="all" />
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
                        <textarea placeholder="Write your signature here.." class="form-control" rows="7" id="signature"></textarea>
                        <button class="btn-success btn-sm mx-auto mt-2" style="width:20%" type=" button"><a class="text-white text-decoration-none">Submit</a> </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer class="page-footer font-small pt-">
        <div class="container-fluid text-center text-md-left">
            <div class="row">
                <div class="col-md-6 mt-md-0 mt-3">
                    <h5 class="text-uppercase">about the forum</h5>
                    <p>mettre description du forum ici</p>
                </div>
                <hr class="clearfix w-100 d-md-none pb-3">
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">boards</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 mb-md-0 mb-3">
                    <h5 class="text-uppercase">popular topics</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!">Link 1</a>
                        </li>
                        <li>
                            <a href="#!">Link 2</a>
                        </li>
                        <li>
                            <a href="#!">Link 3</a>
                        </li>
                        <li>
                            <a href="#!">Link 4</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright text-left pl-3 py-3">© 2020 Copyright:
            <a href=""> ForumManiac.com</a>
        </div>
    </footer>
</body>

</html>