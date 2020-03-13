<?php

session_start();
require 'config.php';


// Avatar
$email = $_SESSION['email'];
function get_gravatar(
    $email,
    $s = 100,
    $d = 'mp',
    $r = 'g',
    $img = false,
    $atts = array()
) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($atts as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }
        $url .= ' />';
    }
    return $url;
}
$src = get_gravatar($email);




// if(isset($_GET['idtopic'])) {
$topic_id = htmlspecialchars($_GET['idtopic']);


// Script pour envoi d'un nouveau message
if(isset($_POST['send_message'])) {
    $message_content = $_POST['new_message'];
    $message_creation_date = date('Y-m-d H:i:s');
    $author_id = $_SESSION['idusers'];
    $topic_id = htmlspecialchars($_GET['idtopic']);
    // Ajout du topic dans la base de données
    $req = $bdd->prepare('INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics) VALUES(:content, :creation_date, :users_idusers, :topics_idtopics)');
    $req->bindValue(':content', $message_content, PDO::PARAM_STR);
    $req->bindValue(':creation_date', $message_creation_date, PDO::PARAM_STR);
    $req->bindValue(':users_idusers', $author_id);
    $req->bindValue(':topics_idtopics', $topic_id);
    $req->execute();


    // Ajout du premier message du topic dans la base de données

    // $req = $bdd->prepare('INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics) VALUES(:content, :creation_date, :users_idusers, :topics_idtopics)');
    // $req->bindValue(':content', $topic_description, PDO::PARAM_STR);
    // $req->bindValue(':creation_date', $creation_date, PDO::PARAM_STR);
    // $req->bindValue(':users_idusers', $user_id);
    // $req->bindValue(':topics_idtopics', $topic_id["idtopics"]);
    // $req->execute();
}
// <?php 
// $sql = 'SELECT * FROM topics
//         INNER JOIN messages ON idtopics = messages.topics_idtopics
//         WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 1)
//         GROUP BY idtopics
//         ORDER BY messages.creation_date DESC
//         LIMIT 9';
// $req = $bdd->prepare($sql);
// $req->execute();
// $board1_topics = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($board1_topics);
// foreach($board1_topics as $board1_topic) {
//     // Requête pour récupérer l'username de l'auteur du topic
//     $sqlGetAuthor = 'SELECT username FROM users
//     WHERE idusers = :idusers';
//     $req = $bdd->prepare($sqlGetAuthor);
//     $req->bindValue(':idusers', $board1_topic['users_idusers']);
//     $req->execute();
//     $author = $req->fetch(PDO::FETCH_ASSOC);

// $sql = 'SELECT * FROM messages
// INNER JOIN topics ON idtopics = messages.topics_idtopics
// GROUP BY idtopics
// ORDER BY messages.creation_date ASC
// LIMIT 9';
// $req = $bdd->prepare($sql);
// $req->execute();
// $topic_messages = $req->fetchAll(PDO::FETCH_ASSOC);
// foreach($topic_messages as $topic_message) {
// // Requête pour récupérer l'username de l'auteur du topic
//     $sqlGetAuthor = 'SELECT username FROM users
//     WHERE idusers = :idusers';
//     $req = $bdd->prepare($sqlGetAuthor);
//     $req->bindValue(':idusers', $topic_message['users_idusers']);
//     $req->execute();
//     $author = $req->fetch(PDO::FETCH_ASSOC);
// }










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
    <link rel="stylesheet" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js" type="text/javascript" ></script>
    <link rel="stylesheet" type="text/css" href="css/profile1.css" media="all" />
    <style>
        #row_style {
            margin-top: 30px;
        }

        #submit {
            display: block;
            margin: auto;
        }
    </style>
    <script>
        $(document).ready(function() {
            $("#submit").click(function() {
                $('html, body').animate({
                    scrollTop: $("#test").offset().top
                }, 500);
            });
        });

        $(function() {
            $("#editor").shieldEditor({
                height: 260
            });
        })
    </script>
</head>

<body>
    <div>
    <?php if (isset($_SESSION['logged_in'])): ?>
    <?php require "header_on.php"; ?> 
    <?php else: ?>
    <?php require "header_off.php" ?>
    <?php endif ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="">
                <h3 class="font-weight-bold">Topic title</h3>
            </a>
        </div>
        <div>
            <br>
        </div>
        <div class="d-flex flex-row">
            <div class="input-group search-box active-cyan-3 active-cyan-4 mb-4 col-5 pt-4 pl-3"><a class="">
                    <input type="text" id="search" class="form-control" placeholder="Search...">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </a>
            </div>
            <div class="pl-5 pt-4">
                <button class="btn d-flex flex-direction-left btn-warning" href="#" id="submit">Post a message</button>
            </div>
            <div class="pl-5 pt-4">
                <button class="btn btn-success d-flex flex-direction-left" href="#" value="Reload Page" onClick="window.location.reload()" id=" refresh">Refresh</button>
            </div>
            <div class="pl-5 pt-4">
                <button class="btn d-flex flex-direction-left btn-danger" href="" id="board">Back to board</button>
            </div>
        </div>
        <table class="table border">
            <thead>
                <tr>
                    <th class="border-right text-center" style="width: 20%" scope="col">Author</th>
                    <th class="text-center" scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
            <?php $sql = 'SELECT * FROM messages
                WHERE messages.topics_idtopics = :idtopics
                ORDER BY DATE(messages.creation_date) DESC
                            , messages.creation_date ASC
                LIMIT 20';
                $req = $bdd->prepare($sql);
                $req->bindValue(':idtopics', $topic_id);
                $req->execute();
                $topic_messages = $req->fetchAll(PDO::FETCH_ASSOC);
                var_dump($topic_messages);
                foreach($topic_messages as $topic_message) {
                // Requête pour récupérer l'username de l'auteur du topic
                    $sqlGetAuthor = 'SELECT username, signature, time_creation FROM users
                    WHERE idusers = :idusers';
                    $req = $bdd->prepare($sqlGetAuthor);
                    $req->bindValue(':idusers', $topic_message['users_idusers']);
                    $req->execute();
                    $author = $req->fetch(PDO::FETCH_ASSOC); ?>
                <tr>
                    <th class="border-right rounded" scope=" row">
                        <div class="username pt-2 text-center text-secondary"><?php echo $author['username']; ?></div>
                        <div class="bloc1-avatar flex-column d-flex  bg-red">
                            <img class="rounded-circle mt-3 mx-auto " style="width:30%" src=<?php echo $src; ?>>
                            <div class="userInfo text-center pt-2 text-secondary">
                                <small class="text-center">
                                    Registered since <?php echo $author['time_creation']; ?>
                                </small>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="postEdit row pl-4">
                            <div class="">
                                <small class="text-secondary font-italic">Posted : <?php echo $topic_message['creation_date']; ?>
                                </small>
                                <?php if (isset($topic_message['edition_date'])) { ?>
                                <small class="text-secondary font-italic pl-5">
                                    Edited : 20/02/2020
                                </small>
                                <?php } ?>
                            </div>
                            <a class="text-right col-7">
                            <?php if($_SESSION['idusers'] === $topic_message['users_idusers']) { ?>
                                <a href="#"> <i class="text-right text-primary fa fa-pencil fa-lg"></i></a>
                                <a href="#"> <i class="pl-5 text-danger fa fa-trash-o fa-lg"></i></a>
                            <?php } ?>
                            </a>

                            <div class="text-break pt-3 pb-5 font-weight-normal border-bottom">
                                <?php echo $topic_message['content']; ?>
                            </div>
                            <small class="text-secondary font-italic">
                                <?php echo $author['signature']; ?>
                            </small>
                    </th>
                </tr>
                <?php } ?>






                <tr>
                    <th class="border-right rounded" scope=" row">
                        <div class="username pt-2 text-center text-secondary">Alan LOUETTE</div>
                        <div class="bloc1-avatar flex-column d-flex  bg-red">
                            <img class="rounded-circle mt-3 mx-auto " style="width:30%" src=<?php echo $src; ?>>
                            <div class="userInfo text-center pt-2 text-secondary">
                                <small class="text-center">
                                    Registered since 10/02/2002
                                </small>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="postEdit row pl-4">
                            <div class="postEdit">
                                <small class="text-secondary font-italic">Posted : 07/05/2019
                                </small>
                                <small class="text-secondary font-italic pl-5">
                                    Edited : 20/02/2020
                                </small>
                            </div>

                        </div>
                        <div class="text-break pt-3 pb-5 font-weight-normal border-bottom"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in felis erat. Nulla venenatis purus elit, nec dignissim lorem eleifend ac. Curabitur auctor accumsan tortor, a varius neque dignissim ut. Etiam ac elit purus. Integer sollicitudin, nulla at pretium pellentesque, arcu ipsum tincidunt lectus, id congue velit ligula ac dui. Donec aliquet bibendum porta. Nam et mollis ipsum.

                            Cras neque libero, lacinia at aliquet in, lacinia et turpis. Proin non nunc massa. Aenean euismod ligula in turpis finibus placerat. Fusce quis varius enim. Suspendisse potenti. Nunc nec elit non nulla fringilla aliquam quis sit amet purus. Pellentesque ut convallis quam, eget bibendum leo.
                        </div>
                        <small class="text-secondary font-italic">
                            Cras neque libero, lacinia at aliquet in, lacinia et turpis. Proin non nunc massa. Aenean euismod ligula in turpis finibus placerat. Fusce quis varius enim. Suspendisse potenti. Nunc nec elit non nulla fringilla aliquam quis sit amet purus. Pellentesque ut convallis quam,
                        </small>
                    </th>
                </tr>
                <tr>
                    <th class="border-right rounded" scope=" row">
                        <div class="username pt-2 text-center text-secondary">Alan LOUETTE</div>
                        <div class="bloc1-avatar flex-column d-flex  bg-red">
                            <img class="rounded-circle mt-3 mx-auto " style="width:30%" src=<?php echo $src; ?>>
                            <div class="userInfo text-center pt-2 text-secondary">
                                <small class="text-center">
                                    Registered since 10/02/2002
                                </small>
                            </div>
                        </div>
                    </th>
                    <th>
                        <div class="postEdit row pl-4">
                            <div class="">
                                <small class="text-secondary font-italic">Posted : 07/05/2019
                                </small>
                                <small class="text-secondary font-italic pl-5">
                                    Edited : 20/02/2020
                                </small>
                            </div>
                            <a class="text-right col-7">
                                <a href="#"> <i class="text-right text-primary fa fa-pencil fa-lg"></i></a>
                                <a href="#"> <i class="pl-5 text-danger fa fa-trash-o fa-lg"></i></a>
                            </a>

                            <div class="text-break pt-3 pb-5 font-weight-normal border-bottom"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in felis erat. Nulla venenatis purus elit, nec dignissim lorem eleifend ac. Curabitur auctor accumsan tortor, a varius neque dignissim ut. Etiam ac elit purus. Integer sollicitudin, nulla at pretium pellentesque, arcu ipsum tincidunt lectus, id congue velit ligula ac dui. Donec aliquet bibendum porta. Nam et mollis ipsum.

                                Cras neque libero, lacinia at aliquet in, lacinia et turpis. Proin non nunc massa. Aenean euismod ligula in turpis finibus placerat. Fusce quis varius enim. Suspendisse potenti. Nunc nec elit non nulla fringilla aliquam quis sit amet purus. Pellentesque ut convallis quam, eget bibendum leo.
                            </div>
                            <small class="text-secondary font-italic">
                                Cras neque libero, lacinia at aliquet in, lacinia et turpis. Proin non nunc massa. Aenean euismod ligula in turpis finibus placerat. Fusce quis varius enim. Suspendisse potenti. Nunc nec elit non nulla fringilla aliquam quis sit amet purus. Pellentesque ut convallis quam,Cras neque libero, lacinia at aliquet in, lacinia et turpis. Proin non nunc massa.
                            </small>
                    </th>
                </tr>
            </tbody>
        </table>

        <div id="test" class="pt-5 bg-light position  d-flex justify-content-center">
            <div class="pl-5 w-50 text-break bg-light">
                <form action="" method="POST">
                    <textarea name="new_message" class="text-break" placeholder="Write your message here.." id="editor" cols="30" rows="10"></textarea>
                    <br>
                    <div class=" position pb-5 d-flex justify-content-center">
                        <button name="send_message" class="btn-primary btn-sm mx-auto mt-2" style="width:30%" type="submit"><a class="text-white font-weight-bold text-decoration-none">Submit</a> </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div>
        <?php require "footer.php" ?>
    </div>
</body>