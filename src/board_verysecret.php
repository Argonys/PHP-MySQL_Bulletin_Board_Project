<?php

session_start();
require "config.php";

$errors = array();

// Script pour création de nouveau topic
if (isset($_POST['new_topic'])) {
    if (!isset($_SESSION['logged_in'])) {
        array_push($errors, "Vous devez être connecté pour créer un nouveau topi <a href='login.php'>Se connecter</a> ou <a href='register.php'>S'inscrire</a>");
    } else {
        $topic_title = $_POST['topic_title'];
        $topic_description = $_POST['topic_description'];
        $creation_date = date('Y-m-d H:i:s');
        $board_id = 6;
        $user_id = $_SESSION['idusers'];

        // Ajout du topic dans la base de données
        $req = $bdd->prepare('INSERT INTO topics (content, title, creation_date, boards_idboards, users_idusers) VALUES(:content, :title, :creation_date, :boards_idboards, :users_idusers)');
        $req->bindValue(':content', $topic_description, PDO::PARAM_STR);
        $req->bindValue(':title', $topic_title, PDO::PARAM_STR);
        $req->bindValue(':creation_date', $creation_date, PDO::PARAM_STR);
        $req->bindValue(':boards_idboards', $board_id);
        $req->bindValue(':users_idusers', $user_id);
        $req->execute();

        // Récupération de l'id du topic créé
        $req = $bdd->prepare('SELECT idtopics FROM topics WHERE idtopics = LAST_INSERT_ID()');
        $req->execute();
        $topic_id = $req->fetch(PDO::FETCH_ASSOC);

        // Ajout du premier message du topic dans la base de données
        $req = $bdd->prepare('INSERT INTO messages (content, creation_date, users_idusers, topics_idtopics) VALUES(:content, :creation_date, :users_idusers, :topics_idtopics)');
        $req->bindValue(':content', $topic_description, PDO::PARAM_STR);
        $req->bindValue(':creation_date', $creation_date, PDO::PARAM_STR);
        $req->bindValue(':users_idusers', $user_id);
        $req->bindValue(':topics_idtopics', $topic_id["idtopics"]);
        $req->execute();
    }
}
?>


<!-- COUNT TOPICS -->
<?php
$sql = 'SELECT COUNT(*) FROM topics
INNER JOIN messages ON idtopics = messages.topics_idtopics
WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 5)';

$req = $bdd->prepare($sql);
$req->execute();
$topics_count = $req->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- TEST DElete --->
<?php
foreach ($topics as $topics) {
    if ($topics->board_id == 5) {
        $topic_count++;
    }
}

if ($topic_count > 5) {
    $req2 = "DELETE * FROM topics WHERE board_id=5 EXCEPT SELECT TOP 5 * FROM topics WHERE board_id=5";
    $req2 = $bdd->prepare($sql);
    $req->execute();
}

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
    <link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
    <style>
        dd #row_style {
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
                <h3 class="font-weight-bold">Topics list : VERY SECRET ! </h3>
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
                <button class="btn d-flex flex-direction-left btn-warning" href="#" id="submit">Create a topic</button>
            </div>
            <div class="pl-5 pt-4">
                <button class="btn btn-success d-flex flex-direction-left" href="#" value="Reload Page" onClick="window.location.reload()" id=" refresh">Refresh</button>
            </div>
        </div>
        <?php include('errors.php'); ?>
        <div class="row black pt-5">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = 'SELECT * FROM topics
                                    INNER JOIN messages ON idtopics = messages.topics_idtopics
                                    WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 6)
                                    GROUP BY idtopics
                                    ORDER BY messages.creation_date DESC
                                    LIMIT 12';
                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board6_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board6_topics as $board6_topic) {
                        // Requête pour récupérer l'username de l'auteur du topic
                        $sqlGetAuthor = 'SELECT username FROM users
                                WHERE idusers = :idusers';
                        $req = $bdd->prepare($sqlGetAuthor);
                        $req->bindValue(':idusers', $board6_topic['users_idusers']);
                        $req->execute();
                        $author = $req->fetch(PDO::FETCH_ASSOC);

                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board6_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board6_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>' . $author['username'] . '-' . $board6_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board6_topic["idtopics"] . '"><button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <nav class="text-right" aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#">1 <span class="sr-only">(current)</span></a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
        <div id="test" class="position  d-flex justify-content-center">
            <div class="bordure px-5 py-5 w-75">
                <div class="row border pl-3 py-5 bg-light" id="row_style">
                    <h4 class="text-center text-secondary font-weight-bold">Create a topic <i class="fa fa-arrow-circle-right"></i></h4>
                    <div class="pl-5">
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="topic_title" class="form-control" placeholder="Title">
                            </div>
                            <textarea name="topic_description" id="editor" cols="30" rows="10"></textarea>
                            <br>
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit" name="new_topic" id="submit">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div>
        <br /><br /><br />
    </div>
    <div>
        <?php require "footer.php" ?>
    </div>
    <script src="js/scroll.js"></script>
</body>