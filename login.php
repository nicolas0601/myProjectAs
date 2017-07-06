<?php

include('view/layout/header.php');
//var_dump($_POST);
//var_dump("session");
//var_dump($_SESSION);
?>

<div class="wrapper">
    <form action="./controller/MembreController.php" method="post" class="form-signin" name="login">
        <h2 class="form-signin-heading-center">Connectez-vous</h2>
        <input type="email" class="form-control" name="mail" placeholder="Email Address" required/>
        <input type="password" class="form-control" name="pwd" placeholder="Mot de Passe" required/>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <input type="hidden" name="action" value="login">
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Se Connecter</button>
    </form>
    <!--can change to link-->
        <a href="register.php"><button class="btn btn-lg btn-default btn-block" >Créer un compte</button></a>
<!--    <form class="form-signin" action='./index.php' method='post'>-->
<!--        <input type="hidden" name="action" value="toRegister">-->
<!--        <button class="btn btn-lg btn-default btn-block" type="submit">Créer un compte</button>-->
<!--    </form>-->

</div>

<?php

include('view/layout/footer.php');

?>

