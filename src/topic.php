<?php

session_start();
require 'config.php';
require_once 'parsedown.php';


if (isset($_GET['idtopic'])) {
    $topic_id = htmlspecialchars($_GET['idtopic']);
}


// Rechercher le titre du topic actuel
$sql = 'SELECT title FROM topics WHERE idtopics = :idtopics';
$req = $bdd->prepare($sql);
$req->bindValue(':idtopics', $topic_id);
$req->execute();
$title = $req->fetch(PDO::FETCH_ASSOC);

// Récupérer tous les messages du topic correspondant
$sql = 'SELECT * FROM messages
        WHERE messages.topics_idtopics = :idtopics
        ORDER BY DATE(messages.creation_date) DESC
                    , messages.creation_date ASC
        LIMIT 15';
$req = $bdd->prepare($sql);
$req->bindValue(':idtopics', $topic_id);
$req->execute();
$topic_messages = $req->fetchAll(PDO::FETCH_ASSOC);



$errors = array();

// Script pour envoi d'un nouveau message
if (isset($_POST['send_message'])) {
    if (!isset($_SESSION['logged_in'])) {
        array_push($errors, "Vous devez être connecté pour envoyer un message. <a href='login.php'>Se connecter</a> ou <a href='register.php'>S'inscrire</a>");
    }

    $message_content = $_POST['new_message'];
    $message_creation_date = date('Y-m-d H:i:s');
    $author_id = $_SESSION['idusers'];
    $topic_id = htmlspecialchars($_GET['idtopic']);

    if (empty($message_content)) {
        array_push($errors, "You can't send a message that is empty !");
    }

    if (empty($errors)) {
        // Ajout du topic dans la base de données
        $req = $bdd->prepare('INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics) VALUES(:content, :creation_date, :users_idusers, :topics_idtopics)');
        $req->bindValue(':content', $message_content, PDO::PARAM_STR);
        $req->bindValue(':creation_date', $message_creation_date, PDO::PARAM_STR);
        $req->bindValue(':users_idusers', $author_id);
        $req->bindValue(':topics_idtopics', $topic_id);
        $req->execute();
    }
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
    <link rel="stylesheet" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/css/emoji.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
    <!-- Emoji-picker -->
    <link href="lib/css/emoji.css" rel="stylesheet">
    <style>
        #row_style {
            margin-top: 30px;
        }

        #submit {
            display: block;
            margin: auto;
        }
    </style>
</head>

<body>
    <div>
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <?php require "header_on.php"; ?>
        <?php else : ?>
            <?php require "header_off.php" ?>
        <?php endif ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="">
                <h3 class="font-weight-bold"><?php echo $title['title']; ?></h3>
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
                <button class="btn d-flex flex-direction-left btn-danger" href="board.php?idboard=<?php echo $id_board; ?>" id="board">Back to board</button>
            </div>
        </div>
        <?php include('errors.php'); ?>
        <table class="table border">
            <thead>
                <tr>
                    <th class="border-right text-center" style="width: 20%" scope="col">Author</th>
                    <th class="text-center" scope="col">Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($topic_messages as $topic_message) {
                    // Requête pour récupérer l'username de l'auteur du topic
                    $sqlGetAuthor = 'SELECT username, signature, creation_date, src_avatar FROM users
                    WHERE idusers = :idusers';
                    $req = $bdd->prepare($sqlGetAuthor);
                    $req->bindValue(':idusers', $topic_message['users_idusers']);
                    $req->execute();
                    $author = $req->fetch(PDO::FETCH_ASSOC); ?>
                    <tr>
                        <th class="border-right rounded" scope=" row">
                            <div class="username pt-2 text-center text-secondary"><?php echo $author['username']; ?></div>
                            <div class="bloc1-avatar flex-column d-flex bg-red">
                                <img class="rounded-circle mt-3 mx-auto " style="width:30%" src=<?php echo $author['src_avatar']; ?>>
                                <div class="userInfo text-center pt-2 text-secondary">
                                    <small class="text-center">
                                        Registered <?php echo $author['creation_date']; ?>
                                    </small>
                                </div>
                            </div>
                        </th>
                        <th>
                            <div class="postEdit row pl-4">
                                <small class="text-secondary font-italic">Posted : <?php echo $topic_message['creation_date']; ?>
                                </small>
                                <?php if (isset($topic_message['edition_date'])) { ?> <small class="text-secondary font-italic pl-5">
                                        Edited : 20/02/2020
                                    </small>
                                <?php } ?>
                                <div class="pl-5 d-flex justify-content-end">
                                    <?php if ($_SESSION['idusers'] === $topic_message['users_idusers']) { ?>
                                        <a href="#"> <i class="text-right text-primary fa fa-pencil fa-lg"></i></a>
                                        <a href="#"> <i class="pl-5 text-danger fa fa-trash-o fa-lg"></i></a>
                                    <?php } ?>
                                </div>

                            </div>
                            <div class="text-break pt-3 pb-5 font-weight-normal border-bottom">
                                <?php
                                $parsedown = new Parsedown();
                                echo $parsedown->text($topic_message['content']);
                                ?>
                            </div>
                            <small class="text-secondary font-italic">
                                <?php
                                $parsedown = new Parsedown();
                                echo $parsedown->text($author['signature']);
                                ?>
                            </small>
                        </th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="test" class="pt-5 bg-light position  d-flex justify-content-center">
            <div class="pl-5 w-50 text-break bg-light">
                <form action="" method="POST" class="emoji-picker-container">
                    <textarea data-emojiable="true" name="new_message" class="text-break" placeholder="Write your message here.." cols="30" rows="10"></textarea>
                    <!-- J'ai delete le id="editor" du textarea pour éviter les conflits avec emoji-picker -->
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

    <!-- Begin emoji-picker JavaScript -->
    <script src="lib/js/config.js"></script>
    <script src="lib/js/util.js"></script>
    <script src="lib/js/jquery.emojiarea.js"></script>
    <script src="lib/js/emoji-picker.js"></script>
    <!-- End emoji-picker JavaScript -->

    <script>
        $(function() {
            // Initializes and creates emoji set from sprite sheet
            window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[data-emojiable=true]',
                assetsPath: 'lib/img/',
                popupButtonClasses: 'fa fa-smile-o'
            });
            // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
            // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
            // It can be called as many times as necessary; previously converted input fields will not be converted again
            window.emojiPicker.discover();
        });
    </script>

    <script src="js/scroll.js"></script>
</body>