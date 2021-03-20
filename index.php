<?php
require "Database.php";
require "User.php";
session_start();
$db = new Database();
$conn = $db->connect();
$result = $conn->query("SELECT * FROM news ORDER BY date DESC ");
$i = 0;

?>
<!DOCTYPE html>
<html>

    <head>
        <title>OD Tanki</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap css-->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

        <!-- Main css-->
        <link rel="stylesheet" href="style/style.css">

        <!-- Google Jquery CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap js -->
        <script src="bootstrap/js/bootstrap.min.js"></script>

        <!--mainscript-->
        <script src="js/main.js"></script>

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Purple+Purse&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300&display=swap" rel="stylesheet">

    </head>
    <body>
        <!-- Page preloader -->
        <div class="meaningless">
            <div></div>
        </div>

        <script>
            $(document).ready(function () {
                if (<?php if (isset($_COOKIE['logged'])) echo 'true'; else echo 'false'; ?>){
                    $("#login").hide();
                    $(".dropp").show();
                } else {
                    $("#login").show();
                    $(".dropp").hide();
                }
                $("#login").click(function () {
                    location.href = "login.php";
                });

                $(".play_link").click(function () {
                    $(".open-game").click();
                });

            });
        </script>
        <!-- Navigation bar-->
        <div class="container navigation">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top ">
                <a href="#" class="navbar-brand ml-3">
                    <img src="" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MyNavbar" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="MyNavbar">
                    <ul class="navbar-nav nav-tabs  pl-lg-3  mt-0 ml-md-5 mr-auto" >
                        <li class="nav-item ml-3 mr-3">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item ml-3 mr-3">
                            <a class="nav-link" href="news.php">News</a>
                        </li>
                        <li class="nav-item ml-3 mr-3">
                            <a class="nav-link" href="discussion.php">Discussions</a>
                        </li>
                    </ul>
                    <button class="btn btn-outline-light ml-3 mr-3 open-game" id="login">Sign in</button>
                    <div class="btn-group dropp">
                        <button class="btn btn-outline-light dropdown-toggle" data-toggle="dropdown"><?php
                            if (isset($_COOKIE['logged'])) echo $_SESSION['user']->getUsername();
                            ?></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="update.php" >Change password</a>
                            <?php
                            if (isset($_COOKIE['logged']) && $_SESSION['user']->isAdmin())
                                echo '<a class="dropdown-item" href="adminControl.php">Control admins</a>'
                            ?>
                            <span class="dropdown-item" id="logout" >Logout</span>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
        <!-- End of navigation-->

        <!-- Carousel part -->
        <header class="container">
            <div id="MyCarousel" class="carousel slide" data-ride="carousel" data-interval="3000">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/carousel/first.jpg">
                        <div class="carousel-caption d-none d-md-block">
                            <h2><a class="play_link" >Play</a> "Tanki 1990"</h2>
                        <h3>with your friend</h3>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/carousel/second.jpg">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Rise up</h2>
                            <h3>your rank to the general rank</h3>
                        </div>
                    </div>
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="img/carousel/third.jpg">
                        <div class="carousel-caption d-none d-md-block">
                            <h2>Complete</h2>
                            <h3>all levels</h3>
                        </div>
                    </div>

                </div>

            </div>
        </header>
        <!-- End of carousel -->

        <!-- Content part -->
        <main>
            <div class="latest-news ">
                <div class="container ann">
                    <span class="text-annuncement">Latest news</span>
                    <button type="button" id="more" >More..</button>
                </div>
                <div class="lat-news">
                    <?php while($row = $result->fetch_assoc()){ ?>
                    <div>
                        <div class="news-image">
                            <img src="<?php echo $row['url'];?>" alt="wait">
                        </div>
                        <div>
                        <p><?php echo $row['title'] ?></p>
                        <span><?php echo $row['text']; ?></span><br>
                        <span><?php echo $row['date']; ?></span>
                        </div>
                    </div>
                    <?php
                    $i++;
                    if($i >= 2) break;
                    } ?>
                </div>

            </div>
            <div class="gameplay">
                <div class="container ann">
                    <span class="text-annuncement">Gameplay</span>
                </div>
                <div class="gameplay-content">
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/top.jpg" alt="wait">
                        </div>
                        <p>Click on w or "up" to move up </p>
                    </div>
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/bot.jpg" alt="wait">
                        </div>
                        <p>Click s or "down" to move down</p>
                    </div>
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/left.jpg" alt="wait">
                        </div>
                        <p>Click a or "left" to move left</p>
                    </div>
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/right.jpg" alt="wait">
                        </div>
                        <p>Click d or "right" to move right</p>
                    </div>
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/shooting.png" alt="wait">
                        </div>
                        <p>Upgrade you shooting skills</p>
                    </div>
                    <div>
                        <div class="g-img">
                            <img src="img/gameplay/game.jpg" alt="wait">
                        </div>
                        <p>There are some stones and bushes on the map</p>
                    </div>

                </div>
            </div>
                <h2>See all features and make unforgettable memories.</h2>
        </main>

        <!-- Footer -->
        <footer class="page-footer font-small bg-dark pt-4">
            <div class="container footer">
                <div class="info">
                    <h5 class="text">OD Tanki</h5>
                    <p>There you can play tanki with your friend</p>
                </div>

                <div class="links">
                    <h5 class="">There is some useful links for you where you cam install the game:</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://play.google.com/store/apps/details?id=com.supreme.tanks&hl=ru" target="_blank">Google play</a>
                        </li>
                        <li>
                            <a href="https://trashbox.ru/link/tanchiki-1990-tanki-s-dendi-android" target="_blank"> Trash box</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
        <!-- Footer -->
    </body>
</html>