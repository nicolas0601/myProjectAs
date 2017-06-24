
<!---->
<!--session_start();-->
<!---->
<!--if($_SERVER["REQUEST_METHOD"] == "POST") {-->
<!--// username and password sent from form-->
<!---->
<!--$myEmail = ($_POST['email']);-->
<!--$mypassword = ($_POST['pwd']);-->
<!---->
<!--$sql = $pdo->prepare("SELECT identifiant FROM membre WHERE mail = '$myEmail' and mPasse = '$mypassword'");-->
<!--$sql->execute();-->
<!--$row = $sql->fetchAll(PDO::FETCH_ASSOC);-->
<!--$active = $row['active'];-->
<!---->
<!--$count = mysqli_num_rows($active);-->
<!---->
<!--// If result matched $myusername and $mypassword, table row must be 1 row-->
<!---->
<!--if($count == 1) {-->
<!--session_register("email");-->
<!--$_SESSION['login_user'] = $myEmail;-->
<!---->
<!--header("location: vueEnsemble.php");-->
<!--}else {-->
<!--$error = "Your Login Name or Password is invalid";-->
<!--}-->
<!--}-->



<header>


    <div class="row" id="accueilHeader">
        <div class="container-fluid">





            <div class="col-sm-2" id="logo">
                <img class=img-responsive  src="/public/images/logoasmoza.png">
            </div>

            <div class="col-sm-4" id="slogan">
                <p>Savoir, c'est pouvoir!</p>
            </div>
            <form action=""  method="POST">
            <div class="nav navbar-nav navbar-right">


                <form name='form_ind06' action='' method='post'><button class="btn btn-default"
                            type="submit">Connexion</button><input type="hidden" name="tran_code" value="ind06"></form>
<!--                <a class="btn btn-default" href="membre/connexion.php">connexion</a>-->
            </div>
            </form>
        </div>
    </div>


</header>
