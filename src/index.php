<?php

session_start();
require "config.php";






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
    <link rel="stylesheet" type="text/css" href="css/main.css" media="all" />
</head>

<body>
    <div>
        <?php var_dump($_SESSION); ?>
    </div>
    <div>
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <?php require "header_on.php"; ?>
        <?php else : ?>
            <?php require "header_off.php"; ?>
        <?php endif ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board.php?idboard=1">
                <h3 class="font-weight-bold">GENERAL</h3>
            </a>
        </div>
        <div class="row black pt-5">
            <div class="container">
                <div class="row">
                    <?php

                    $sql = 'SELECT * FROM topics
                            INNER JOIN messages 
                            ON idtopics = messages.topics_idtopics
                            WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 1)
                            GROUP BY idtopics
                            ORDER BY messages.creation_date DESC
                            LIMIT 3';

                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board1_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board1_topics as $board1_topic) {
                        $sqlGetAuthor = 'SELECT username FROM users
                                WHERE idusers = :idusers';
                        $req = $bdd->prepare($sqlGetAuthor);
                        $req->bindValue(':idusers', $board1_topic['users_idusers']);
                        $req->execute();
                        $author = $req->fetch(PDO::FETCH_ASSOC);

                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board1_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board1_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>' . $author['username'] . '-' . $board1_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board1_topic["idtopics"] . '"<button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div classe="rdMore text-center">
                    <div class="nav-item text-center pb-5 pt-2"><a href="board.php?idboard=1" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>

            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board?idboard=2.php.php">
                <h3 class="font-weight-bold">DEVELOPPEMENT</h3>
            </a>
        </div>
        <div class="row black pt-5 ">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = 'SELECT * FROM topics
                            INNER JOIN messages ON idtopics = messages.topics_idtopics
                            WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 2)
                            GROUP BY idtopics
                            ORDER BY messages.creation_date DESC
                            LIMIT 3';
                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board2_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board2_topics as $board2_topic) {
                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board2_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board2_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>AUTEUR ICI' . $board2_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board2_topic["idtopics"] . '"<button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                </div>
                <div classe="rdMore text-center">
                    <div class="nav-item text-center pb-5 pt-2"><a href="board.php?idboard=2" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board.php?idboard=3">
                <h3 class="font-weight-bold">SMALL TALKS</h3>
            </a>
        </div>
        <div class="row black pt-5 ">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = 'SELECT * FROM topics
                            INNER JOIN messages ON idtopics = messages.topics_idtopics
                            WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 3)
                            GROUP BY idtopics
                            ORDER BY messages.creation_date DESC
                            LIMIT 3';
                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board3_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board3_topics as $board3_topic) {
                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board3_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board3_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>AUTEUR ICI' . $board3_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board3_topic["idtopics"] . '"<button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                </div>
                <div classe="rdMore text-center">
                    <div class="nav-item text-center pb-5 pt-2"><a href="board.php?idboard=3" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board.php?idboard=4">
                <h3 class="font-weight-bold">EVENTS</h3>
            </a>
        </div>
        <div class="row black pt-5 ">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = 'SELECT * FROM topics
                            INNER JOIN messages ON idtopics = messages.topics_idtopics
                            WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 4)
                            GROUP BY idtopics
                            ORDER BY messages.creation_date DESC
                            LIMIT 3';
                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board4_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board4_topics as $board4_topic) {
                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board4_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board4_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>AUTEUR ICI' . $board4_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board4_topic["idtopics"] . '"<button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                </div>
                <div classe="rdMore text-center">
                    <div class="nav-item text-center pb-5 pt-2"><a href="board.php?idboard=4" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>

    </div>
    <div>
        <?php require "footer.php"; ?>
    </div>
</body>

</html>