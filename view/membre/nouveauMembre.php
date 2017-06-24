


<div class="wrapper">
    <form class="form-horizontal" role="form">
        <h3>Inscrivez-vous gratuitement</h3>
        <div class="form-group">
            <label for="firstName" class="col-sm-3 control-label">Nom Complet</label>
            <div class="col-sm-9">
                <input type="text" id="firstName" placeholder="Nom Comple" class="form-control" autofocus>
<!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <input type="mail" id="mail" placeholder="mail" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Mot de Passe</label>
            <div class="col-sm-9">
                <input type="password" id="password" placeholder="Mot De Passe" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="birthDate" class="col-sm-3 control-label">Date de Naissance</label>
            <div class="col-sm-9">
                <input type="date" id="birthDate" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-3">Civilité</label>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" id="femaleRadio" value="Female">Madame
                        </label>
                    </div>
                    <div class="col-sm-5">
                        <label class="radio-inline">
                            <input type="radio" id="maleRadio" value="Male">Mademoiselle
                        </label>
                    </div>
                    <div class="col-sm-4">
                        <label class="radio-inline">
                            <input type="radio" id="uncknownRadio" value="Unknown">Monsieur
                        </label>
                    </div>
                </div>
            </div>
        </div> <!-- /.form-group -->


        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block">Registration</button>
            </div>
        </div>
    </form> <!-- /form -->
</div> <!-- ./container -->