<?php
session_start();
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--    <title>--><?php //echo $page_title; ?><!--</title>-->

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/css/bootstrap.min.css">
        <link rel="stylesheet" href="public/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/css/ie10-viewport-bug-workaround.css">
        <link rel="stylesheet" href="public/css/styles.css">
        <link rel="stylesheet" href="public/css/faceAFace.css">
        <link rel="stylesheet" href="public/css/etatDeForme.css">
        <script src="public/js/jquery.min.js"></script>

    </head>
<body>


    <header>


        <div class="row" id="accueilHeader">
            <div class="container-fluid">

                <div class="col-sm-2" id="logo">
                    <img class=img-responsive src="./public/images/logoasmoza.png">
                </div>

                <div class="col-sm-4" id="slogan">
                    <p>Savoir, c'est pouvoir!</p>
                </div>
                <?php
                if (isset($_SESSION['identifiant'])) {

                    echo "<form action=\"./controller/MembreController.php\" method=\"POST\" name=\"profile\">
                         <input type=\"hidden\" name=\"action\" value=\"toProfile\">
                        <div class=\"nav navbar-nav navbar-right\">
                                <button type=\"submit\" name=\"profile\">Profile</button>
                        </div>
                    </form>";


                    echo "<form action=\"./controller/MembreController.php\" method=\"POST\" name=\"logout\">
                        <div class=\"nav navbar-nav navbar-right\">
                                <button class=\"btn btn-primary\" type=\"submit\" name=\"logout\" value=\"logout\">Déconnexion</button>
                        </div>
                    </form>";
                } else {


                    if (strpos($_SERVER['REQUEST_URI'], 'login')) {
                        echo "<a href=\"register.php\" method=\"POST\" name=\"toRegister\">
                        <div class=\"nav navbar-nav navbar-right\">
                                <button type=\"submit\" name=\"login\">Créer un compte</button>
                        </div>
                    </a>";
                    } else {
                        echo "<a href=\"login.php\" method=\"POST\" name=\"login\">
                        <div class=\"nav navbar-nav navbar-right\">
                                <button type=\"submit\" name=\"login\">se Connecter</button>
                        </div>
                    </a>";
                    }


                }
                ?>
            </div>
        </div>


    </header>


    <div id="body">

<?php
if (isset($_SESSION['message'])) {
    echo "<div>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);
}
?>