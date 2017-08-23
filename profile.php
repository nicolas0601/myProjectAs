<?php

include('view/layout/header.php');

if (isset($_SESSION)) {
//    pre($_SESSION);
    $user = $_SESSION['user'];
} else {
    header('Location: login.php');
    exit;
}
require_once('./connectionDB/ConnectionDB.php');
$db = getbdd();
$allPays = $db->prepare("SELECT * from pays");
$allPays->execute();
$pays = $allPays->fetchAll(PDO::FETCH_ASSOC);
$allPays->closeCursor();

$allSports = $db->prepare("SELECT * from sports");
$allSports->execute();
$sports = $allSports->fetchAll(PDO::FETCH_ASSOC);
//$allSports->closeCursor();

var_dump($user);


?>

<!---->
<!--<div class="alert alert-success">-->
<!--    <button type="button" class="close" data-dismiss="alert">×</button>-->
<!--    <strong>Yes !</strong> Vous etes bien connecté-->
<!--</div>-->

<div id="conteneur">


    <!--        <div class="floatLeft">-->

    <div class="flex-item">
        <div class="profil"><h3>Mon Profile</h3></div>

        Civilité : <?= $user['civilite'] ?>


        <br><br>

        Nom Complet :
        <?= $user["nom"] ?>

        <br><br>
        Email :
        <?= $user["mail"] ?>

        <br><br>
        Date de Naissance :
        <?= $user["dateN"] ?>

        <br><br>
        Portable :
        <?= $user['tel_mobile'] ?>

        <br><br>

        Département :
        <?= $user["pays_departement"] ?> <?= $user["pays_nom_departement"] ?>

        <br><br>
        Ville :
        <?= $user["pays_nom_ville"] ?>
        <br><br>


        Sport favoris :
        <?= $user["pays_nom_ville"] ?>

    </div>


    <!--<div id="floatRight">-->
    <div class="flex-item">
        <div class="profil"><h3>Modifié mon profil</h3></div>
        <div id="formProfile">

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
                    <label for="firstName" class="col-sm-4 control-label">Nom Complet</label>
                    <div class="col-sm-8">
                        <input type="text" name="nom" id="firstName" placeholder="Nom Comple" class="form-control"
                               value= <?= $user["nom"] ?> required autofocus>
                        <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
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
                    <label for="birthDate" class="col-sm-4 control-label">Date de Naissance</label>
                    <div class="col-sm-8">
                        <input type="date" name="dateN" id="birthDate" class="form-control"
                               value= <?= $user["dateN"] ?> required>
                    </div>
                </div>

                <div class="profil"><h3>Ajouter des informations</h3></div>
                <div class="form-group">
                    <label for="tel_mobile" class="col-sm-4 control-label">Portable</label>
                    <div class="col-sm-8">
                        <input type="text" name="tel_mobile" id="tel_mobile" class="form-control"
                               value= <?= $user["tel_mobile"] ?> required>

                        <!--                <span class="help-block">Last Name, First Name, eg.: Smith, Harry</span>-->
                    </div>
                </div>
                <!--                <div class="form-group">-->
                <!--                    <label for="pays_departement" class="col-sm-4 control-label">Département</label>-->
                <!--                    <div class="col-sm-8">-->
                <!--                        <input type="number" name="pays_departement" id="pays_departement" class="form-control"-->
                <!--                               value= --><? //= $user["pays_departement"] ?><!-- required>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="form-group">
                    <label for="pays_id" class="col-sm-4 control-label">Département</label>
                    <div class="col-sm-8">
                        <select name="pays_id" id="pays_id" class="form-control">
                            <?php foreach ($pays as $p) { ?>
                                <option value=" <?= $p["pays_id"] ?>"> <?php echo $p['pays_nom_ville'] ?> </option>

                            <?php } ?>

                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pays_id" class="col-sm-4 control-label">Sport favoris</label>
                    <div class="col-sm-8">
                        <select name="sport_id" id="sport_id" class="form-control">
                            <?php foreach ($sports as $sport) { ?>
                                <option value=" <?= $sport["sport_id"] ?>"> <?php echo $sport['sport_nom'] ?> </option>

                            <?php } ?>

                        </select>
                    </div>


                </div>
                <!--                        <div class="form-group">-->
                <!--                            <label for="ville" class="col-sm-3 control-label">Ville</label>-->
                <!--                            <div class="col-sm-9">-->
                <!--                                <input type="text" name="ville" id="ville" class="form-control"-->
                <!--                                       value="">-->
                <!--                            </div>-->
                <!--                        </div>-->
                <!---->
                <!--                        <div class="form-group">-->
                <!--                            <label for="sport" class="col-sm-3 control-label">Sport favoris</label>-->
                <!--                            <div class="col-sm-9">-->
                <!--                                <input type="text" name="sport" id="sport" class="form-control"-->
                <!--                                       value="">-->
                <!--                            </div>-->
                <!--                        </div>-->


                <div class="form-group">
                    <div class="col-sm-12 ">
                        <input type="hidden" name="identifiant" value= <?= $_SESSION["identifiant"] ?>>
                        <!--                    <input type="hidden" name="action" value="updateProfile">-->
                        <button type="submit" name="updateProfile" class="btn btn-primary btn-block">Mettre à
                            jour
                        </button>
                    </div>
                </div>

            </form>
        </div>
        <div id="btnModi">
            <button class="btn-toolbar" onclick="myFunction()">Modifié?</button>
        </div>
        <br/>
        <div id="RetourMenu">
            <a href="index.php"> <button class="btn-link">Accueil</button></a>
        </div>
    </div>


</div>


<script>
    function myFunction() {
        var x = document.getElementById('formProfile');
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
