<?php
session_start();
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Asmoza</title>

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
<!--            <div class="container-fluid">-->

                <div class="col-sm-2" id="logo">
                    <img class=img-responsive src="./public/images/logoasmoza.png">
                </div>

                <div class="col-sm-3" id="slogan">
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

                    echo "
                                    <div class=\"navigbar\" id='menuLogo'>
                                    <ul>
                                                       <li> <a href=\"\" >
                                      <i class=\"fa fa-home\"></i>Accueil
                                    </a></li>
                                    
                                      <li> <a href=\"\">
                                     <i class=\"glyphicon glyphicon-list-alt\"></i>Article
                                    </a></li>
                                      <li>  <a href=\"\">
                                       <i class=\"glyphicon glyphicon-stats\"></i>Statistique
                                    </a></li>
                                    
                                      <li>  <a href=\"\">
                                       <i class=\"glyphicon glyphicon-search\"></i>Recherche
                                    </a></li>
                                    
                                      <li>  <a href=\"\">
                                      <i class=\"glyphicon glyphicon-transfer\"></i>Transfert
                                      
                                    </a></li>
                                    
                                      <li>  <a href=\"\">
                                        <i class=\"glyphicon glyphicon-usd\"></i>Paris
                                    </a></li>
                                    
                                       <li> <a href=\"\">
                                      <i class=\"fa fa-envelope\"></i>Message
                                    </a></li>
                                    
                                      <li>  <a href=\"\">
                                    <i class=\"fa fa-comment\"></i>Discussion
                                    </a></li>
                                    
                                    
                                <li>  <form id=\"hide\" action=\"./controller/MembreController.php\" method=\"POST\" name=\"profile\">
                         <input type=\"hidden\" name=\"action\" value=\"toProfile\">
                      
                         
                       <a href=\"\" type=\"submit\" name=\"profile\" onclick=\"document.getElementById('hide').submit()\"><i class=\"fa fa-user\"></i> Profile</a>
                         </form>
                   </li>
                    
                                    
                                    </ul>
                                    </div>";

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
                               <button  type=\"submit\" name=\"login\">Se connecter</button>
                        </div>
                    </a>";
                    }
                }
                ?>
            </div>

<!--        </div>-->


    </header>


    <div id="body">

<?php
if (isset($_SESSION['message']) And isset( $_SESSION['identifiant']) ) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);

}

//else{
//    echo "<div class='alert alert-danger'>" . $_SESSION['message'] . "</div>";
//}

else if (isset($_SESSION['message']) And isset( $_SESSION['user']) ) {
    echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);

}

else {
    echo "<div class='alert alert-danger'>" . $_SESSION['message'] . "</div>";
    unset($_SESSION['message']);

}


?>