<?php

// saison en cours


//    var_dump($max_jr);
//DISTINCT éviter les doublons




$reqTwo = $pdo->prepare("SELECT DISTINCT co.comp_nom as comp, m.nom as equipe, class_nm as journee, class_saison_debut as debut, class_saison_fin as fin, 
            class_discipline as football, class_nb_point as point, class_rang as rang
             FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe 
             INNER JOIN competition co ON co.comp_id = c.class_competition
             WHERE m.nom = 'FC NANTES'
           
             ");

$reqOne = $pdo->prepare("SELECT DISTINCT co.comp_nom as comp, m.nom as equipe, class_nm as journee, class_saison_debut as debut, class_saison_fin as fin, 
            class_discipline as football, class_nb_point as point, class_rang as rang
             FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe 
             INNER JOIN competition co ON co.comp_id = c.class_competition
              WHERE m.nom = 'TOULOUSE FC'

             ");

//      var_dump('<pre>');
//    var_dump($classement);
//    var_dump('</pre>');

$reqTwo->execute();

$classementFcn = $reqTwo->fetchAll(PDO::FETCH_ASSOC);



$jsonClass = json_encode($classementFcn);


echo " <script> var fcn = $jsonClass  </script>";

$reqTwo->closeCursor();

$reqOne->execute();

$classementTou = $reqOne->fetchAll(PDO::FETCH_ASSOC).

    $jsonClassTou = json_encode($classementTou);
var_dump('<pre>');
var_dump($jsonClassTou);
var_dump('</pre>');

echo " <script> var toulouse = $jsonClassTou  </script>";




?>




<div class="mainSvg">

    <div class="data"></div>

</div>


<!--<div id="body">-->
<!--<h5>Vous trouverez sur ce site le maximum <br/>-->
<!--    d'informations pour pouvoir parier plus sereinement sur des match de football !</h5><br/>-->
<!---->
<!--    <form method="POST" action="recapitulatif.php" name="formulaire">-->
<!--     <label>Monsieur <input name="civilite" value="Mr" type="radio">&nbsp;Madame-->
<!---->
<!--        <input name="civilite" value="madame" type="radio">&nbsp;Mademoiselle-->
<!--       <input name="civilite" value="mademoiselle" type="radio"></label><br/>-->
<!---->
<!--        <label>Nom complet: <input type="text" name="nom" placeholder="ex:Lejeune Julien" required/></p></label><br/>-->
<!---->
<!--        <label>Date de naissance-->
<!--            <input name="naissance" value="naissance" type="date">-->
<!--        </label><br/>-->
<!---->
<!--        <label>Mail-->
<!--            <input name="mail" value="mail" type="email" placeholder="email" required>-->
<!--        </label><br/>-->
<!---->
<!--        <label>Mot de passe-->
<!--            <input name="mPass" value="mPass" type="password" placeholder="password" required>-->
<!--        </label><br/>-->
<!---->
<!--        <label><input value="valider" type="submit"></label>-->
<!---->
<!--    </form>-->
<!---->
<!--</div>-->










