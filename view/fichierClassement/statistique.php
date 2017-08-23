<?php
////request total home win during the season
//$homeWin= $db->prepare("SELECT COUNT(renc_id) FROM rencontre WHERE renc_resultat_a>renc_resultat_b
//AND renc_saison_debut = 2015
//AND renc_saison_fin = 2016");
//
//$homeWin->execute();
//$win = $homeWin->fetchAll(PDO::FETCH_ASSOC);
////var_dump($win);
//$homeWin->closeCursor();
//
////request total draw during the season
//$reDraw = $db->prepare("SELECT COUNT(renc_id) FROM rencontre WHERE renc_resultat_a=renc_resultat_b
//AND renc_saison_debut = 2015
//AND renc_saison_fin = 2016");
//
//$reDraw->execute();
//$draw = $reDraw->fetchAll(PDO::FETCH_ASSOC);
////var_dump($drawTo);
//$reDraw->closeCursor();
//
////request total away win during the season
//$awayWin = $db->prepare("SELECT COUNT(renc_id) FROM rencontre WHERE renc_resultat_a<renc_resultat_b
//AND renc_saison_debut = 2015
//AND renc_saison_fin = 2016");
//
//$awayWin->execute();
//$away = $awayWin->fetchAll(PDO::FETCH_ASSOC);
//var_dump($away);
//$awayWin->closeCursor();

$req = $db->prepare("SELECT COUNT(renc_id)as homeWin FROM rencontre WHERE renc_resultat_a>renc_resultat_b
AND renc_saison_debut = 2015
AND renc_saison_fin = 2016
UNION 
SELECT COUNT(renc_id)as draw FROM rencontre WHERE renc_resultat_a=renc_resultat_b
AND renc_saison_debut = 2015
AND renc_saison_fin = 2016
UNION 
SELECT COUNT(renc_id)as awayWin FROM rencontre WHERE renc_resultat_a<renc_resultat_b
AND renc_saison_debut = 2015
AND renc_saison_fin = 2016

");



$req->execute();
$allWin = $req->fetchAll(PDO::FETCH_COLUMN);
//var_dump(array_sum($allWin));
$req->closeCursor();
//put string into integer
$graphWin = json_encode($allWin, JSON_NUMERIC_CHECK);

echo "<script> var graphWin = $graphWin; </script>";






//request goals home and away
$goalsBySeason = $db->prepare("SELECT DISTINCT  renc_saison_fin as fin, SUM(renc_resultat_a) as eqDo, SUM(renc_resultat_b) as eqEx 
                               FROM rencontre
                               GROUP BY renc_saison_fin
                               ");

$goalsBySeason->execute();
$goals = $goalsBySeason->fetchAll(PDO::FETCH_ASSOC);
//var_dump($goals);
$goalsBySeason->closeCursor();

//request 5 best attack
//select with where to get the last ranking table
$fiveBestAttack = $db->prepare("SELECT DISTINCT m.nom as equipe,class_nm as classement, class_resultat as buts
                                FROM classement C
                                INNER JOIN membre m On m.identifiant = c.class_equipe
                                WHERE class_nm = (SELECT max(class_nm)FROM classement)
                                ORDER BY buts DESC 
                                LIMIT 5
");
$fiveBestAttack->execute();


$fbas = $fiveBestAttack->fetchAll(PDO::FETCH_ASSOC);
//var_dump($fbas);
$fiveBestAttack->closeCursor();//free connection to server and let other request to be executed


$fiveBestDefense = $db->prepare("SELECT DISTINCT m.nom as equipe,class_nm as classement, class_concede as be
                                FROM classement C
                                INNER JOIN membre m On m.identifiant = c.class_equipe
                                WHERE class_nm = (SELECT max(class_nm)FROM classement)
                                ORDER BY be ASC 
                                LIMIT 5
");
$fiveBestDefense->execute();

$fbds = $fiveBestDefense->fetchAll(PDO::FETCH_ASSOC);
//var_dump($fbds);
$fiveBestDefense->closeCursor();//free connection to server and let other request to be executed






?>



<div class="divStat">


</div>


<div class="pageMargin">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <TR>
                <TD colspan=9 align="center">But</TD>
            </TR>
            <tr>
                <th>Match joué</th>
                <th>Total victoire à domicile</th>
                <th>Total match nul</th>
                <th>Total victoires à l'extérieur</th>



            </tr>
            </thead>
            <tbody>

                <tr>
                    <td><?= array_sum($allWin) ?></td>
                    <?php foreach ($allWin as $win): ?>
                    <td>
                        <p><?= $win ?></p>
                    </td>
                    <?php endforeach; ?>

                </tr>

            </tbody>
        </table>
    </div>

</div>



<div class="pageMargin">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <TR>
                <TD colspan=9 align="center">But</TD>
            </TR>
            <tr>
                <th>Saison</th>
                <th>Buts</th>
                <th>Buts par match</th>
                <th>Buts à domicile</th>
                <th>Buts à l'extérieur</th>


            </tr>
            </thead>
            <tbody>
            <?php foreach ($goals as $goal): ?>
                <tr>
                    <td>
                        <p><?= $goal['fin'] ?></p>

                    </td>
                    <td>
                        <p><?= $goal['eqDo'] + $goal['eqEx'] ?></p>

                    </td>
                    <td>
                        <p><?= $goal['eqDo'] ?></p>
                    </td>
                    <td>
                        <p><?= $goal['eqDo'] ?></p>
                    </td>
                    <td>
                        <p><?= $goal['eqEx'] ?></p>
                    </td>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pageMargin">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <TR>
                <TD colspan=9 align="center">Les 5 meilleurs attaques</TD>
            </TR>
            <tr>
                <th>Equipe</th>
                <th>Buts par match</th>
                <th>Buts marqués</th>


            </tr>
            </thead>
            <tbody>
            <?php foreach ($fbas as $fba): ?>
                <tr>
                    <td>
                        <p><?= $fba['equipe'] ?></p>

                    </td>
                    <td>
                        <p><?= round(strtoupper($fba['buts']) / $fba['classement'], 2) ?></p>

                    </td>
                    <td>
                        <p><?= strtoupper($fba['buts']) ?></p>
                    </td>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pageMargin">
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <TR>
                <TD colspan=9 align="center">Les 5 meilleurs défenses</TD>
            </TR>
            <tr>
                <th>Equipe</th>
                <th>Buts par match</th>
                <th>Buts encaissés</th>


            </tr>
            </thead>
            <tbody>
            <?php foreach ($fbds as $fbd): ?>
                <tr>
                    <td>
                        <p><?= $fbd['equipe'] ?></p>

                    </td>
                    <td>
                        <p><?= round(strtoupper($fbd['be']) / $fbd['classement'], 2) ?></p>

                    </td>
                    <td>
                        <p><?= strtoupper($fbd['be']) ?></p>
                    </td>


                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>