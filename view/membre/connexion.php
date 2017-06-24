<?php
session_start()
?>
<div class="wrapper">
    <form action="/login.php" method="POST" class="form-signin">
        <h2 class="form-signin-heading">Connectez-vous</h2>
        <input type="text" class="form-control" name="mail" placeholder="Email Address" required=""  />
        <input type="password" class="form-control" name="pwd" placeholder="Mot de Passe" required=""/>
        <label class="checkbox">
            <input type="checkbox" value="remember-me" id="rememberMe" name="rememberMe"> Remember me
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Se Connecter</button>
        <form name='form_ind07' action='' method='post'>  <button class="btn btn-lg btn-default btn-block" type="submit">Créer un compte</button><input type="hidden" name="tran_code" value="ind07"></form>
    </form>
</div>

<?php

if ($_POST['submit']){


}


?>

<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-sm-6 col-md-4 col-md-offset-4">-->
<!--            <h1 class="text-center login-title">Sign in to continue to Bootsnipp</h1>-->
<!--            <div class="account-wall">-->
<!--                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"-->
<!--                     alt="">-->
<!--                <form class="form-signin">-->
<!--                    <input type="text" class="form-control" placeholder="Email" required autofocus>-->
<!--                    <input type="password" class="form-control" placeholder="Password" required>-->
<!--                    <button class="btn btn-lg btn-primary btn-block" type="submit">-->
<!--                        Sign in</button>-->
<!--                    <label class="checkbox pull-left">-->
<!--                        <input type="checkbox" value="remember-me">-->
<!--                        Remember me-->
<!--                    </label>-->
<!--                    <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>-->
<!--                </form>-->
<!--            </div>-->
<!--            <a href="#" class="text-center new-account">Create an account </a>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->