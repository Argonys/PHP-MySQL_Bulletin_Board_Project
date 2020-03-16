<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="css/header_off.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header d-flex col">
            <a class="navbar-brand" href="index.php">Forum<b>Maniac</b></a>
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
                <li class="nav-item px-3"><a href="board.php?idboard=1" class="nav-link">General</a></li>
                <li class="nav-item px-3"><a href="board.php?idboard=2" class="nav-link">Developpement</a></li>
                <li class="nav-item px-3"><a href="board.php?idboard=3" class="nav-link">Small talk</a></li>
                <li class="nav-item px-3"><a href="board.php?idboard=4" class="nav-link">Events</a></li>
            </ul>
            <form class="navbar-form form-inline">
                <div class="input-group search-box">
                    <input type="text" id="search" class="form-control" placeholder="Search here...">
                    <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
                </div>
            </form>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Log in</a>

                </li>
                <li class="nav-item"><a href="register.php" class="btn btn-primary mt-1 mb-1">Register</a></li>
            </ul>
        </div>
    </nav>
</body>

</html>