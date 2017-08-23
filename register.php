<?php

include('view/layout/header.php');



?>

<div class="wrapper">
    <form action="./controller/MembreController.php" method="post" class="form-horizontal" role="form">


        <h5>La commnunauté des passionnées de sports et des paris sportifs</h5>

        <h5>Suivez les performances de vos équipes favorites</h5>
        <h5>Inscrivez-vous gratuitement</h5>

        <div class="form-group">
            <label class="control-label col-sm-3">Civilité</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" id="femaleRadio" value="Mme" name="civilite">Madame
                        </label>
                    </div>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" id="maleRadio" value="Mlle" name="civilite">Mademoiselle
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" id="uncknownRadio" value="Mr" name="civilite">Monsieur
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Nom Complet</label>
            <div class="col-sm-9">
                <input type="text" name="nom" id="firstName" placeholder="Nom Comple" class="form-control" required autofocus>
<!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="email" name="mail" id="mail" placeholder="mail" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Mot de Passe</label>
            <div class="col-sm-9">
                <input type="password" name="mPasse" id="password" placeholder="Mot De Passe" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="birthDate"  class="col-sm-3 control-label">Date de Naissance</label>
            <div class="col-sm-9">
                <input type="date" name="dateN" id="birthDate" class="form-control" required>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
<!--                <input type="hidden" name="action" value="register">-->
                <button type="submit" name="registration" class="btn btn-primary btn-block">Inscription</button>
            </div>
        </div>
    </form>
</div>

<?php

include('view/layout/footer.php');

?>