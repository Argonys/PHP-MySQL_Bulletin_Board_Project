<?php

session_start();
require "config.php";

// Script pour la date de création du compte en format jour-mois-année
if (isset($_SESSION['logged_in'])) {
    $sql = 'SELECT * FROM users WHERE email LIKE :email';
    $req = $bdd->prepare($sql);
    $req->bindValue(':email', $_SESSION['email']);
    $req->execute();
    $userData = $req->fetch(PDO::FETCH_ASSOC);
    $_SESSION['idusers'] = $userData['idusers'];
    // Création de creation_date en format jour-mois-année dans la variable $_SESSION
    $_SESSION['creation_date'] = date('d-m-Y', strtotime($_SESSION["time_creation"]));
}



// Script pour avatar et envoi dans la base de données
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




$sql = 'INSERT INTO users (src_avatar) VALUES (:src_avatar)';
$req = $bdd->prepare($sql);
$req->bindValue(':src_avatar', $src)





// $sql = 'SELECT * FROM topics
// INNER JOIN messages ON idtopics = messages.topics_idtopics
// WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 1)
// GROUP BY idtopics
// ORDER BY messages.creation_date DESC
// LIMIT 3';
// $req = $bdd->prepare($sql);
// $req->execute();



// $sql = 'SELECT * FROM topics
// INNER JOIN messages ON idtopics = messages.topics_idtopics
// WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 2)
// GROUP BY idtopics
// ORDER BY messages.creation_date DESC
// LIMIT 3';
// $req = $bdd->prepare($sql);
// $req->execute();
// $TopicsFromBoard2 = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($TopicsFromBoard2);



// $sql = 'SELECT username FROM users WHERE idusers LIKE :idusers';
// $req->bindValue(':idusers', $boards1_topics['users_idusers']);
// $req = $bdd->prepare($sql);
// $req->execute();
// $boards1_topics['author'] = $req->fetch(PDO::FETCH_ASSOC);
// var_dump($board1_topics['author']);



// $sql = $pdo->query("SELECT * 
// FROM users 
// INNER JOIN topics 
// ON users.id = topics.users_id 
// WHERE boards_id = 1 
// ORDER BY created_at DESC
// LIMIT " . $limit);

// $sql = 'SELECT * FROM topics
// INNER JOIN messages 
// ON idtopics = messages.topics_idtopics
// WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 1)
// GROUP BY idtopics
// ORDER BY messages.creation_date DESC
// LIMIT 3';


// $sql = 'SELECT idusers, username
// FROM users 
// INNER JOIN topics 
// ON users.idusers = topics.users_idusers
// WHERE boards_idboards = 1 
// ORDER BY created_at DESC
// LIMIT 3';
// $req = $bdd->prepare($sql);
// $req->execute();
// $topics = $req->fetchAll(PDO::FETCH_ASSOC);
// var_dump($topics);


// $sqlreq = 'SELECT username FROM users WHERE idusers = :idusers'
//                                 $request = $bdd->prepare($sqlreq);
//                                 $request->bindValue(':idusers', $board1_topic['users_idusers']);
//                                 $request->execute();
//                                 $topic_author = $request->fetch(PDO::FETCH_ASSOC);
//                                 var_dump($topic_author);


//                                 $sqlreq = 'SELECT username FROM users WHERE idusers = :idusers'
//                                 $request = $bdd->prepare($sqlreq);
//                                 $request->bindValue(':idusers', $board1_topic['users_idusers']);
//                                 $request->execute();
//                                 $topic_author = $request->fetch(PDO::FETCH_ASSOC);
//                                 var_dump($topic_author);





// INNER JOIN users
// ON idtopics = users.idusers
// WHERE topics_users.idusers = users.idusers';
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
    <link rel="stylesheet" type="text/css" href="css/profile1.css" media="all" />
</head>

<body>
    <div>
        <?php var_dump($_SESSION); ?>
    </div>
    <div>
        <?php if (isset($_SESSION['logged_in'])) : ?>
            <?php require "header_on.php"; ?>
        <?php else : ?>
            <?php require "header_off.php" ?>
        <?php endif ?>
    </div>
    <div class="container bg-white rounded">
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board_general.php">
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
                    var_dump($board1_topics);
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
                    <div class="nav-item text-center pb-5 pt-2"><a href="board_general.php" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>

            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board_development.php">
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
                    <div class="nav-item text-center pb-5 pt-2"><a href="board_development.php" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board_talks.php">
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
                    <div class="nav-item text-center pb-5 pt-2"><a href="board_talks.php" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board_events.php">
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
                    <div class="nav-item text-center pb-5 pt-2"><a href="board_events.php" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>







        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="board_events.php">
                <h3 class="font-weight-bold">RANDOM</h3>
            </a>
        </div>
        <div class="row black pt-5 ">
            <div class="container">
                <div class="row">
                    <?php
                    $sql = 'SELECT * FROM topics
                            INNER JOIN messages ON idtopics = messages.topics_idtopics
                            WHERE topics.boards_idboards = (SELECT idboards FROM boards WHERE idboards = 5)
                            GROUP BY idtopics
                            ORDER BY messages.creation_date DESC
                            LIMIT 3';
                    $req = $bdd->prepare($sql);
                    $req->execute();
                    $board5_topics = $req->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($board5_topics as $board5_topic) {
                        echo '<div class="col-md-4 pb-5">';
                        echo '<div class="card mb bg-light">';
                        echo '<div class="card-body mb">';
                        echo '<h5 class="card-title text-secondary font-weight-bold">' . $board5_topic['title'] . '</h5>';
                        echo '<p class="card-text">' . $board5_topic['content'] . '</p>';
                        echo '<p class="card-text"><small>AUTEUR ICI' . $board5_topic['creation_date'] . '</small></p>';
                        echo '<a href="topic.php?idtopic=' . $board5_topic["idtopics"] . '"<button type="button" class="btn btn-primary mb">Read more</button></a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>

                </div>
                <div classe="rdMore text-center">
                    <div class="nav-item text-center pb-5 pt-2"><a href="board_random.php" class="btn btn-secondary text-white text-center mt-1 mb-1">More topics...</a></div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php require "footer.php" ?>
    </div>
</body>

</html>