<?php

//
//pre($_POST);
//pre($_SESSION);

// saison en cours
$yearsQuery = $db->prepare("SELECT DISTINCT class_saison_debut FROM classement ORDER BY class_saison_debut DESC");

$yearsQuery->execute();

$years = $yearsQuery->fetchALL(PDO::FETCH_ASSOC);

$maxSaison = $years[0]['class_saison_debut']; //2015

//DISTINCT éviter les doublons
// face à face : for the points on the graph
$reqMaxJr = $db->prepare("SELECT DISTINCT MAX(class_nm)
              FROM classement
              WHERE class_saison_debut = '$maxSaison' ");

$reqMaxJr->execute();

$tab_max_jr = $reqMaxJr->fetchAll(PDO::FETCH_NUM);

$max_jr = $tab_max_jr[0][0]; //19


echo " <script> var journee =  $max_jr; </script>";


$compId = 530;

$reqNbEq = $db->prepare("SELECT DISTINCT comp_nb_equipe as nbEquipe
              FROM competition
              WHERE comp_id = '$compId' ");

$reqNbEq->execute();

// fetch one // fetch assoc
$tab_nb_eq = $reqNbEq->fetchAll(PDO::FETCH_NUM);
$nb_eq = $tab_nb_eq[0][0];

echo " <script> var nbEquipe = $nb_eq;  </script>";


$teamListQuery = $db->prepare("SELECT 
                                                a.identifiant, a.nom
                                            FROM
                                                paris_asmoza.rencontre
                                                    INNER JOIN
                                                membre a ON a.identifiant = rencontre.renc_equipe_a
                                                    INNER JOIN
                                                membre b ON b.identifiant = rencontre.renc_equipe_b 
                                            UNION SELECT 
                                                 b.identifiant, b.nom
                                            FROM
                                                paris_asmoza.rencontre
                                                    INNER JOIN
                                                membre a ON a.identifiant = rencontre.renc_equipe_a
                                                    INNER JOIN
    membre b ON b.identifiant = rencontre.renc_equipe_b");

$teamListQuery->execute();

$teamList = $teamListQuery->fetchALL(PDO::FETCH_ASSOC);


$equipeId1 = 14;
$equipeId2 = 156;


//$reqMatch->closeCursor();

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

$reqLastFive->closeCursor();


// ********************************************* data for graph with 3 lines *****************************

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

echo "<script> var dataGraph = $donnee </script>";

?>


<div id="resultatEntreDeuxEq">
    <div class="center-block">
        <form name='form_team' action='./controller/FaceAFaceController.php' method='post'>

            <div class="equipeUn"><select name="team1">
                    <?php foreach ($teamList as $team): ?>
                        <!--                    show which team is selected-->
                        <option value='<?= $team['identifiant'] ?>'
                            <?= (isset($_SESSION['team1']) && $_SESSION['team1'] === $team['identifiant']) ?
                                'selected' : null
                            ?>
                        >
                            <?= $team['nom'] ?>
                        </option>

                    <?php endforeach; ?>
                </select>
            </div>
            <div id="submitFaF"> <button name="teamSubmit" type='submit'>Score</button></div>

            <div class="equipeDeux"><select name="team2">

                    <?php foreach ($teamList as $team): ?>
                        <option value='<?= $team['identifiant'] ?>'
                            <?= (isset($_SESSION['team2']) && $_SESSION['team2'] === $team['identifiant']) ?
                                'selected' : null
                            ?>
                        >
                            <?= $team['nom'] ?>
                        </option>

                    <?php endforeach; ?>
                </select>

            </div>
        </form>
    </div>


    <div class="resultatCentre">
        <ul class="list-group">


            <?php
            // if there is a match result
            if (isset($_SESSION['matchFF'])) {

                $equipeA = $_SESSION['matchFF'][0]['equipeA'];
                $equipeB = $_SESSION['matchFF'][0]['equipeB'];

                foreach ($_SESSION['matchFF'] as $match) {
                    if ($match['equipeA'] == $equipeA) {
                        echo '<li class="list-group-item list-group-item-success">'
                            . $match['butDo'] . ' : ' . $match['butEx'] .
                            '</li>';
                    } else {
                        echo '<li class="list-group-item list-group-item-success">'
                            . $match['butEx'] . ' : ' . $match['butDo'] .
                            '</li>';
                    }
                }
            }


            //            <!--        <li class="list-group-item list-group-item-info">Cras sit amet nibh libero</li>-->
            //            <!--        <li class="list-group-item list-group-item-warning">Porta ac consectetur ac</li>-->
            //            <!--        <li class="list-group-item list-group-item-danger">Vestibulum at eros</li>-->
            ?>


        </ul>

    </div>
</div>

<div id="squareMatch">
    <h4>Les cinq dernières rencontres</h4>
    <div class="squareEq1">

        <p> Performance<?php foreach ($reqLastFive1 as $five1): ?>
                <?php
                if (($five1['butDo'] > $five1['butEx'] && $five1['equipeA'] == $equipeId1) || $five1['butDo'] < $five1['butEx'] && $five1['equipeB'] == $equipeId1) {
                    echo "<span style='background-color:green;'>V</span>";

                } else if ($five1['butDo'] == $five1['butEx']) {
                    echo "<span style='background-color:yellow;'>N</span>";

                } else {
                    echo "<span style='background-color:red;'>D</span>";

                }

                ?>
            <?php endforeach; ?>


        </p>

    </div>

    <div class="squareEq2">

        <p> Performance<?php foreach ($reqLastFive2 as $five1): ?>
                <?php

                if (($five1['butDo'] > $five1['butEx'] && $five1['equipeA'] == $equipeId2) || $five1['butDo'] < $five1['butEx'] && $five1['equipeB'] == $equipeId2) {
                    echo "<span style='background-color:green;'>V</span>";

                } else if ($five1['butDo'] == $five1['butEx']) {
                    echo "<span style='background-color:yellow;'>N</span>";

                } else {
                    echo "<span style='background-color:red;'>D</span>";

                }

                ?>
            <?php endforeach; ?>


        </p>

    </div>
</div>
<div class="data">


</div>




