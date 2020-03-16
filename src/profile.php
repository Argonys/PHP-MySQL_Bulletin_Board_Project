<?php 

session_start(); 

require_once 'config.php'; 

// Si l'user n'est pas connecté, on le redirige vers la page d'accueil
if($_SESSION['logged_in'] === NULL) {
    header('location: index.php');
    exit;
}


$sql = 'SELECT * FROM users WHERE email LIKE :email';
        
// On prépare la requête
$req = $bdd->prepare($sql);
$email = $_SESSION['email'];
$req->bindValue(':email', $email);

// On essaie d'exécuter la requête
$req->execute();

// On récupère ce que vous renvoie la requête

?>



<?php
$email = 'alan.louette@gmail.com';
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="profile.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/profile1.css" media="all" />
</head>

<body>
    <div>
        <?php include "header_on.php"; ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bloc1 row">
            <div class="bloc1-avatar border-right rounded flex-column col-sm-3 d-flex  bg-red">
                <img class="rounded-circle mt-5 mx-auto " style="width:60%" src=<?php echo $src; ?> >

                <button class="btn-info btn mx-auto mt-5" href="https://fr.gravatar.com/emails/" style="width:60%" type=" button"><a class="text-white text-decoration-none" href="https://fr.gravatar.com/emails/">Edit avatar</a> </button>
                <div class="userInfo pl-5 pt-5 text-secondary">
                    Registered since 
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
                            <div class="usernameHidden"><label class="font-weight-light" for="newID">Please enter your new username... </label>
    
                                    <input type="text" class="newID" name="newID" />
                                    <button class="btn-success btn-sm mx-auto mt-2" style="width:20%" type="button"><a class="text-white text-decoration-none">Comfirm</a> </button>
                            
                            </div>
                        </section>

                    </div>
                </div>
                <div class=" passwordBox">
                    <div class="password col-sm-12  border-bottom pb-4">
                        <div class="password">
                            <h4 class=" font-weight-bold text-secondary pt-3">Change password
                                <a data-toggle="collapse" href="#collapsePassword" role="button" aria-expanded="false" aria-controls="collapseExample" id="logo1" class="fa fa-pencil pl-4"></a>
                        </div>

                        <section class="collapse" id="collapsePassword">
                            <div class="passwordHidden">
                                <label class="font-weight-light">Please enter your old password... <input type="password" class="oldPW" name="oldPW" /> </label>
                                <label class="font-weight-light">Please enter your new password... <input type="password" class="newPW" name="newPW" /></label>
                                <label class="font-weight-light">Please comfirm your new password... <input type="password" class="newPWC" name="nePWC" /></label>
                            </div>
                            <button class="btn-success btn-sm mx-auto mt-2" style="width:20%" type=" button"><a class="text-white text-decoration-none">Comfirm</a> </button>
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