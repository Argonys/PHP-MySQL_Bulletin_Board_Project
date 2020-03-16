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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="css/header_on.css">
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
                        <li class="nav-item active px-3"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item px-3"><a href="board_general.php" class="nav-link">General</a></li>			
                        <li class="nav-item px-3"><a href="board_development.php" class="nav-link">Developpement</a></li>
                        <li class="nav-item px-3"><a href="board_talks.php" class="nav-link">Small talk</a></li>
                        <li class="nav-item px-3"><a href="board_events.php" class="nav-link">Events</a></li>
                    </ul>
                    <form class="navbar-form form-inline">
                        <div class="input-group search-box">								
                            <input type="text" id="search" class="form-control" placeholder="Search here...">
                            <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                        </div>
                    </form>
                    <ul class="nav navbar-nav navbar-right ml-auto">			
                        <li class="nav-item">
                        <a data-toggle="dropdown" class="nav-link dropdown" href="#">Profile <b class="caret"></b></a>
                        <ul class="dropdown-menu">					
                                <li><a href="profile1.php" class="dropdown-item text-center">Dashboard</a></li>
                                <li><a href="#" class="dropdown-item text-center">Change username</a></li>
                                <li><a href="#" class="dropdown-item text-center">Modify password</a></li>
                                <li><a href="#" class="dropdown-item text-center">Change signature</a></li>
                            </ul>
                        </li>
                        <li class="nav-item pt-2"><a href="logout.php" class="btn btn-primary mt-1 mb-1">Log out</a></li>
                    </ul>
                </div>
            </nav>
        </body>
</html>  
