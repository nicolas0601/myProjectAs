<?php

$reqMatch = $db->prepare("SELECT DISTINCT m.nom as equipe,  renc_equipe_a as equipeA, renc_equipe_b as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
                            renc_date_rencontre as dateMatch
                            FROM rencontre r
                            INNER JOIN membre m ON m.identifiant = r.renc_equipe_a
                            WHERE r.renc_equipe_a = ? AND r.renc_equipe_b = ?
                            ORDER BY renc_date_rencontre Desc
                            ");
//$reqMatch = $pdo->prepare("SELECT DISTINCT m.nom as equipe,renc_equipe_a as equipeA, renc_equipe_b as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
//                            renc_date_rencontre as dateMatch
//                            FROM rencontre r
//                            INNER JOIN membre m ON m.identifiant = r.renc_equipe_a
//                            WHERE r.renc_equipe_a = ? AND  r.renc_equipe_b = ?
//                            ORDER BY renc_date_rencontre
//                            ");
//INNER JOIN membre me ON me.identifiant = r.renc_equipe_b

$reqMatch->bindParam(1, $equipeId1);
$reqMatch->bindParam(2, $equipeId2);

$reqMatch->execute();

$matchEq1 = $reqMatch->fetchAll();

//echo "<pre>";
//var_dump($matchEq1);
//echo "</pre>";


$reqMatch->bindParam(1, $equipeId2);
$reqMatch->bindParam(2, $equipeId1);
$reqMatch->execute();


$matchEq2 = $reqMatch->fetchAll();

//echo "<pre>";
//var_dump($matchEq2);
//echo "</pre>";
$reqMatch->closeCursor();

// requete résultat des 5 derniers matchs
$reqLastFive = $db->prepare("SELECT DISTINCT renc_equipe_a as equipeA, renc_equipe_b as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
                            renc_date_rencontre as dateMatch 
                            FROM rencontre r 
                            WHERE r.renc_equipe_a = ? OR  r.renc_equipe_b = ?
                            ORDER BY renc_date_rencontre DESC
                            LIMIT 5
                            ");


$reqLastFive->bindParam(1, $equipeId1);
$reqLastFive->bindParam(2, $equipeId1);

$reqLastFive->execute();

$reqLastFive1 = $reqLastFive->fetchAll();
//
//echo "<pre>";
//var_dump($reqLastFive1);
//echo "</pre>";

$reqLastFive->bindParam(1, $equipeId2);
$reqLastFive->bindParam(2, $equipeId2);
$reqLastFive->execute();

$reqLastFive2 = $reqLastFive->fetchAll();
////
//echo "<pre>";
//var_dump($reqLastFive2);
//echo "</pre>";
//$reqLastFive->closeCursor();
//$reqMatch->bindParam(1, $equipeId1);
$reqLastFive->closeCursor();

// saison en cours


//    var_dump($max_jr);
//DISTINCT éviter les doublons

//

$reqFF = $db->prepare("SELECT DISTINCT class_equipe as equipe, class_nm as journee,
             class_rang as rang
             FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe
             INNER JOIN competition co ON co.comp_id = c.class_competition
              WHERE m.identifiant = ? AND c.class_saison_debut= ?
             ORDER BY class_nm");
//$reqFF = $pdo->prepare("SELECT DISTINCT class_equipe as equipe, class_nm as journee,
//             class_rang as rang
//             FROM classement c
//             INNER JOIN membre m ON m.identifiant = c.class_equipe
//             INNER JOIN competition co ON co.comp_id = c.class_competition
//              WHERE m.identifiant in(?, ?) AND c.class_saison_debut= ?
//             ORDER BY class_nm");

$reqFF->bindParam(1, $equipeId1);
$reqFF->bindParam(2, $maxSaison);

$reqFF->execute();
//fetch assoc
$classement1 = $reqFF->fetchAll();

//echo "<pre>";
//var_dump($classement1);
//echo "</pre>";


// verify if needed
//$reqFF->closeCursor();


$reqFF->bindParam(1, $equipeId2);
$reqFF->bindParam(2, $maxSaison);

$reqFF->execute();
//fetch assoc
$classement2 = $reqFF->fetchAll();
// verify if needed
$reqFF->closeCursor();


$tableau = array();
for ($i = 0; $i < sizeof($classement1); $i++) {
    $j = $i + 1;
    $tableau[$i]['journee'] = $j;

    if ($j == $classement1[$i][1]) {
        $tableau[$i]['rang_eq1'] = $classement1[$i][2];
    } else {
        $tableau[$i]['rang_eq1'] = NULL;
    }

    if ($j == $classement2[$i][1]) {
        $tableau[$i]['rang_eq2'] = $classement2[$i][2];
    } else {
        $tableau[$i]['rang_eq2'] = NULL;
    }
    /*$tableau[$i]['eq1']=$classement1[$i][0];
    $tableau[$i]['rang_eq1']=$classement1[$i][2];
    $tableau[$i]['eq2']=$classement2[$i][0];
    $tableau[$i]['rang_eq1']=$classement2[$i][2];*/

}


$donnee = json_encode($tableau);
//echo "<pre>";
//var_dump($donnee);
//echo "</pre>";
echo "<script> var dataGraph = $donnee </script>";


//?>


<div class="match">
    <form>
        <select name="equipe">
            <?php foreach ($matchEq1 as $match): ?>
                <option><?= $match['equipeA'] ?> </option>
            <?php endforeach; ?>
        </select>
    </form>


    <ul class="list-group">
        <?php foreach ($matchEq1 as $match): ?>
            <li class="list-group-item list-group-item-success"><?= $match['butDo'] ?> :<?= $match['butEx'] ?> </li>

            <!--        <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>-->
            <!--        <li class="list-group-item list-group-item-warning">Porta ac consectetur ac</li>-->
            <!--        <li class="list-group-item list-group-item-danger">Vestibulum at eros</li>-->
        <?php endforeach; ?>
    </ul>
    <div class="equipeB">
        <form>
            <select name="equipe">
                <?php foreach ($matchEq1 as $match): ?>
                    <option><?= $match['equipeB'] ?> </option>
                <?php endforeach; ?>
            </select>
        </form>



    </div>
</div>

<div id="squareMatch">
<h4>Les cinq dernières rencontres</h4>
    <div class="squareEq1">

        <p> Performance<?php foreach ($reqLastFive1 as $five1): ?>
                <?php if ($five1['butDo'] > $five1['butEx'] && $five1['renc_equipe_a']= $equipeId1){
                    echo "<span style='background-color:green;'>V</span>";



                } else if ($five1['butDo'] = $five1['butEx']) {
                    echo "<span style='background-color:yellow;'>N</span>";



                } else if ($five1['butDo'] < $five1['butEx'] ){
                    echo "<span style='background-color:red;'>D</span>";


                }

                ?>
            <?php endforeach; ?>


        </p>

    </div>

    <div class="squareEq2">

        <p> Performance<?php foreach ($reqLastFive2 as $five2): ?>
                <?php if ($five2['butDo'] > $five2['butEx'] && $five2['equipeA']= $equipeId2) {
                    echo "<span style='background-color:green;'>V</span>";



                } else if ($five2['butDo'] = $five2['butEx']) {
                    echo "<span style='background-color:yellow;'>N</span>";



                }  else if ($five2['butDo'] < $five2['butEx'] && $five2['equipeA']= $equipeId2) {
                    echo "<span style='background-color:red;'>D</span>";

                }

                ?>
            <?php endforeach; ?>


        </p>

    </div>
</div>
    <div class="data">


    </div>




