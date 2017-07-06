<?php

include('view/layout/header.php');

if (isset($_SESSION)) {
//    pre($_SESSION);
    $user = $_SESSION['user'];
} else {
    header('Location: login.php');
    exit;
}


?>


    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Yes !</strong> Vous etes bien connecté
    </div>
    <div class="box">

        <div class="profil"><h3>Mon Profile</h3></div>

        <div class="floatLeft">


            <h6>Civilité: <?= $user['civilite'] ?></h6>

            <br><br>

            <h6> Nom Complet: <?= $user["nom"] ?></h6>

            <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
            <br><br>
            <h6> Email: <?= $user["mail"] ?></h6>

            <br><br>

            <h6> Date de Naissance: <?= $user["dateN"] ?></h6>


        </div>


        <div id="floatRight">

            <form action="./controller/MembreController.php" method="post" class="form-horizontal">

                <div class="form-group">
                    <label class="control-label col-sm-3">Civilité</label>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-7">
                                <label class="radio-inline">
                                    <input type="radio" id="femaleRadio" value="Mme" name="civilite"
                                        <?= ($user['civilite'] === 'Mme') ? 'checked' : ''; ?>
                                    >Madame
                                </label>
                            </div>
                            <div class="col-sm-5">
                                <label class="radio-inline">
                                    <input type="radio" id="maleRadio" value="Mlle" name="civilite"
                                        <?= ($user['civilite'] === 'Mlle') ? 'checked' : ''; ?>
                                    >Mademoiselle
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="radio-inline">
                                    <input type="radio" id="uncknownRadio" value="Mr" name="civilite"
                                        <?= ($user['civilite'] === 'Mr') ? 'checked' : ''; ?>
                                    >Monsieur
                                </label>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="firstName" class="col-sm-3 control-label">Nom Complet</label>
                    <div class="col-sm-9">
                        <input type="text" name="nom" id="firstName" placeholder="Nom Comple" class="form-control"
                               value= <?= $user["nom"] ?> required autofocus>
                        <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" name="mail" id="mail" placeholder="mail" class="form-control"
                               value= <?= $user["mail"] ?> required>
                    </div>
                </div>
                <!--        <div class="form-group">-->
                <!--            <label for="password" class="col-sm-3 control-label">Date de Naissances</label>-->
                <!--            <div class="col-sm-9">-->
                <!--                <input type="date" name="birthDate" id="password" placeholder="Date de Naissances" class="form-control" required>-->
                <!--            </div>-->
                <!--        </div>-->
                <div class="form-group">
                    <label for="birthDate" class="col-sm-3 control-label">Date de Naissance</label>
                    <div class="col-sm-9">
                        <input type="date" name="dateN" id="birthDate" class="form-control"
                               value= <?= $user["dateN"] ?> required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 ">
                        <input type="hidden" name="identifiant" value= <?= $_SESSION["identifiant"] ?>>
                        <!--                    <input type="hidden" name="action" value="updateProfile">-->
                        <button type="submit" name="updateProfile" class="btn btn-primary btn-block">Mettre à jour
                        </button>
                    </div>
                </div>
            </form>


        </div>
        <div id="btnModi">
            <button class="btn-warning" onclick="myFunction()">Modifié?</button>
        </div>
    </div>

    <div class="box">

        <div class="floatLeft">


            <h6>Portable : <?= $user['tel_mobile'] ?></h6>

            <br><br>

            <h6>Département: <?= $user["nom"] ?></h6>

            <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
            <br><br>
            <h6> Ville: <?= $user["mail"] ?></h6>

            <br><br>

            <h6>Sport favoris: <?= $user["dateN"] ?></h6>


        </div>


        <div id="floatRight">

            <form action="./controller/MembreController.php" method="post" class="form-horizontal">

                <div class="form-group">
                    <label for="portable" class="col-sm-3 control-label">Portable</label>
                    <div class="col-sm-9">
                        <input type="text" name="portable" id="portable" class="form-control"
                               value= <?= $user["tel_mobile"] ?> required>

                        <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="departement" class="col-sm-3 control-label">Département</label>
                    <div class="col-sm-9">
                        <input type="text" name="departement" id="departement" class="form-control"
                               value="">
                    </div>
                </div>
                <!--        <div class="form-group">-->
                <!--            <label for="password" class="col-sm-3 control-label">Date de Naissances</label>-->
                <!--            <div class="col-sm-9">-->
                <!--                <input type="date" name="birthDate" id="password" placeholder="Date de Naissances" class="form-control" required>-->
                <!--            </div>-->
                <!--        </div>-->
                <div class="form-group">
                    <label for="ville" class="col-sm-3 control-label">Ville</label>
                    <div class="col-sm-9">
                        <input type="text" name="ville" id="ville" class="form-control"
                               value= "">
                    </div>
                </div>

                <div class="form-group">
                    <label for="sport" class="col-sm-3 control-label">Sport favoris</label>
                    <div class="col-sm-9">
                        <input type="text" name="sport" id="sport" class="form-control"
                               value= "">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12 ">
                        <input type="hidden" name="identifiant" value= <?= $_SESSION["identifiant"] ?>>
                        <!--                    <input type="hidden" name="action" value="updateProfile">-->
                        <button type="submit" name="updateProfile" class="btn btn-primary btn-block">Mettre à jour
                        </button>
                    </div>



            </form>


        </div>
    </div>


    <script>
        function myFunction() {
            var x = document.getElementById('floatRight');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
    </script>


<?php

include('view/layout/footer.php');

?>