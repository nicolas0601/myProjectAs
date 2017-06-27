<?php

//$reqMatch = $pdo->prepare("SELECT DISTINCT renc_equipe_a as equipeA, renc_equipe_b as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
//                            renc_date_rencontre as dateMatch
//                            FROM rencontre r
//                            INNER JOIN membre m ON m.identifiant = r.renc_equipe_a
//                            WHERE m.identifiant = ?
//                            ORDER BY renc_date_rencontre
//                            ");
////INNER JOIN membre me ON me.identifiant = r.renc_equipe_b
//
//$reqMatch->bindParam(1, $equipeId1);
//
//$reqMatch->execute();
//
//$matchEq = $reqMatch->fetchAll();
//
//$reqMatch->bindParam(1, $equipeId2);
//$reqMatch->execute();
//
//$matchEq = $reqMatch->fetchAll();
//
//echo "<pre>";
//var_dump($matchEq);
//echo "</pre>";
//$reqMatch->closeCursor();
////    $reqTwo->execute();
////
////    $classementTwo = $reqTwo->fetchAll(PDO::FETCH_ASSOC);
//
////var_dump('<pre>');
////var_dump($classementTwo);
////var_dump('</pre>');
//
////    $jsonClass = json_encode($classementTwo);
///*var_dump('<pre>');
//var_dump($jsonClass);
//var_dump('</pre>');*/


$reqMaxJr = $db->prepare("SELECT DISTINCT MAX(class_nm)
              FROM classement
              WHERE class_saison_debut = '$maxSaison' ");

$reqMaxJr->execute();


$tab_max_jr = $reqMaxJr->fetchAll();

$max_jr = $tab_max_jr[0][0];
//    var_dump($max_jr);
//DISTINCT éviter les doublons
$reqClassG = $db->prepare("SELECT DISTINCT co.comp_nom as comp, m.nom as equipe, class_nm as journee, class_saison_debut as debut, class_saison_fin as fin, 
            class_competition as competition, class_discipline as football, class_nb_point as point, class_rang as rang,
             class_resultat as buts,class_concede as be,(class_resultat-class_concede) as df, class_nb_victoire as V, class_nb_nul as N,class_nb_defaite as D 
             FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe 
             INNER JOIN competition co ON co.comp_id = c.class_competition
             WHERE  class_nm='$max_jr'
             ORDER BY class_rang
            
             ");


//    $reqTwo = $pdo->prepare("SELECT DISTINCT co.comp_nom as comp, m.nom as equipe, class_nm as journee, class_saison_debut as debut, class_saison_fin as fin,
//            class_discipline as football, class_nb_point as point, class_rang as rang,
//             class_resultat as buts,class_concede as be,(class_resultat-class_concede) as df, class_nb_victoire as V, class_nb_nul as N,class_nb_defaite as D FROM classement c
//             INNER JOIN membre m ON m.identifiant = c.class_equipe
//             INNER JOIN competition co ON co.comp_id = c.class_competition
//
//             ");


$reqClassG->execute();

$classements = $reqClassG->fetchAll(PDO::FETCH_ASSOC);

//      var_dump('<pre>');
//    var_dump($classement);
//    var_dump('</pre>');

$reqClassG->closeCursor();

$req2 = $db->prepare("SELECT DISTINCT  m.nom as equipe, 
             class_nb_point as point, class_rang as rang,
              class_nb_victoire as v, class_nb_nul as n,class_nb_defaite as d FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe 
             INNER JOIN competition co ON co.comp_id = c.class_competition
             WHERE  class_nm='$max_jr'
             ORDER BY class_rang
            
             ");

$req2->execute();

$reqEtatDeForme = $req2->fetchAll(PDO::FETCH_ASSOC);

//      var_dump('<pre>');
//    var_dump($reqEtatDeForme);
//    var_dump('</pre>');

$req2->closeCursor();

$donnee = json_encode($reqEtatDeForme);
//echo "<pre>";
//var_dump($donnee);
//echo "</pre>";
echo "<script> var dataForm = $donnee </script>";


?>

<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <TR>
            <TD colspan=9 align="center">LIGUE 1</TD>
        </TR>
        <tr>
            <th>POS</th>
            <th>Equipe</th>
            <th>J</th>
            <th>V</th>
            <th>N</th>
            <th>D</th>
            <th>Buts</th>
            <th>DF</th>
            <th>POINTS</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($classements as $classement): ?>
            <tr>
                <td>
                    <p><?= $classement['rang'] ?></p>

                </td>
                <td>
                    <p><?= $classement['equipe'] ?></p>

                </td>
                <td>
                    <p><?= strtoupper($classement['journee']) ?></p>
                </td>

                <td>
                    <p><?= $classement['V'] ?></p>
                </td>
                <td>
                    <p><?= $classement['N'] ?></p>
                </td>
                <td>
                    <p><?= $classement['D'] ?></p>
                </td>
                <td>
                    <p><?= $classement['buts'] ?>: <?= $classement['be'] ?></p>
                </td>
                <td>
                    <p><?= $classement['df'] ?></p>
                </td>
                <td>
                    <p><?= $classement['point'] ?></p>
                </td>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div id="etatForm">

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <TR>
                <TD colspan=6 align="center">ETAT DE FORME</TD>
            </TR>
            <tr>
                <th>POS</th>
                <th>Equipe</th>
                <th>POINTS</th>
                <th><span style=" color:green ">V% </span> <span style="color:yellow">N% </span>
                    <span style=" color:red">D% </span></th>

            </tr>
            </thead>
            <tbody class="forme">
            <?php foreach ($reqEtatDeForme as $classement): ?>
                <tr>
                    <td>
                        <p><?= $classement['rang'] ?></p>

                    </td>
                    <td>
                        <p><?= $classement['equipe'] ?></p>

                    </td>
                    <td>
                        <div class="point">


                        </div>

                    </td>



                    <td>
                        <div class="vnd">


                        </div>


                    </td>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="mainSvg">

    <div class="vnd2"></div>

</div>





