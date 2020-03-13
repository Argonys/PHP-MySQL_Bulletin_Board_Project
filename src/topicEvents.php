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
    <link rel="stylesheet" type="text/css" href="profile.css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
    <script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
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
                }, 1000);
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
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header d-flex col">
            <a class="navbar-brand" href="#">Forum<b>Maniac</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
            <ul class="nav navbar-nav">
                <li class="nav-item px-3"><a href="#" class="nav-link">Home</a></li>
                <li class="nav-item px-3"><a href="#" class="nav-link">General</a></li>
                <li class="nav-item px-3"><a href="#" class="nav-link">Developpement</a></li>
                <li class="nav-item px-3"><a href="#" class="nav-link">Small talk</a></li>
                <li class="nav-item px-3"><a href="#" class="nav-link">Events</a></li>
            </ul>
            <form class="navbar-form form-inline">
                <div class="input-group search-box">
                    <input type="text" id="search" class="form-control" placeholder="Search here...">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item">
                    <a data-toggle="dropdown" class="nav-link dropdown active" href="#">Profile <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#" class="dropdown-item text-center">Paramètres</a></li>
                        <li><a href="#" class="dropdown-item text-center">Action 1</a></li>
                        <li><a href="#" class="dropdown-item text-center">Action 2</a></li>
                        <li><a href="#" class="dropdown-item text-center">Action 3</a></li>
                    </ul>
                </li>
                <li class="nav-item pt-2"><a href="" class="btn btn-primary mt-1 mb-1">Log out</a></li>
            </ul>
        </div>
    </nav>
    </div>
    <div class="container bg-white rounded">
        <div class="bg-primary rounded text-center py-1 mt-3">
            <a class="text-white text-decoration-none" href="">
                <h3 class="font-weight-bold">Topics list : EVENTS</h3>
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
        <div class="row black pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb">
                            <div class="card-body mb bg-light">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb">
                            <div class="card-body mb bg-light">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pb-5">
                        <div class="card mb bg-light">
                            <div class="card-body mb">
                                <h5 class="card-title text-secondary font-weight-bold">Topic title</h5>
                                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi non quis exercitationem culpa nesciunt nihil aut nostrum explicabo reprehenderit optio amet ab temporibus asperiores quasi cupiditate. </p>
                                <p class="card-text"><small>Auteur - Date de création</small></p>
                                <button type="button" class="btn btn-primary mb">Read more</button>
                            </div>
                        </div>
                    </div>
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
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Title">
                        </div>
                        <textarea id="editor" cols="30" rows="10"></textarea>
                        <br>
                        <div class="form-group">
                            <button class="btn btn-primary" id="submit">Create</button>
                        </div>
                    </div>
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