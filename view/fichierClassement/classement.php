<?php



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

    $classement = $reqClassG->fetchAll(PDO::FETCH_ASSOC);

//      var_dump('<pre>');
//    var_dump($classement);
//    var_dump('</pre>');

    $reqClassG->closeCursor();

$reqMatch = $db->prepare("SELECT DISTINCT renc_equipe_a as equipeA, renc_equipe_b as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
                            renc_date_rencontre as dateMatch
                            FROM rencontre r
                            INNER JOIN membre m ON m.identifiant = r.renc_equipe_a
                            WHERE m.identifiant = ? 
                            ORDER BY renc_date_rencontre
                            ");
//INNER JOIN membre me ON me.identifiant = r.renc_equipe_b

$reqMatch->bindParam(1, $equipeId1);

$reqMatch->execute();

$matchEq = $reqMatch->fetchAll();

$reqMatch->bindParam(1, $equipeId2);
$reqMatch->execute();

$matchEq = $reqMatch->fetchAll();

echo "<pre>";
var_dump($matchEq);
echo "</pre>";
$reqMatch->closeCursor();
//    $reqTwo->execute();
//
//    $classementTwo = $reqTwo->fetchAll(PDO::FETCH_ASSOC);

//var_dump('<pre>');
//var_dump($classementTwo);
//var_dump('</pre>');

//    $jsonClass = json_encode($classementTwo);
    /*var_dump('<pre>');
    var_dump($jsonClass);
    var_dump('</pre>');*/

?>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>POS</th>
                <th>Equipe</th>
                <th>J</th>
                <th>V</th>
                <th>N</th>
                <th>D</th>
                <th>Buts</th>
                <th>DF</th>
                <th>PTS</th>

            </tr>
            </thead>
            <tbody>
            <?php foreach ($classement as $classemen): ?>
                <tr>
                    <td>
                        <p><?= $classemen['rang'] ?></p>

                    </td>
                    <td>
                        <p><?= $classemen['equipe'] ?></p>

                    </td>
                    <td>
                        <p><?= strtoupper($classemen['journee']) ?></p>
                    </td>

                    <td>
                        <p><?= $classemen['V'] ?></p>
                    </td>
                    <td>
                        <p><?= $classemen['N'] ?></p>
                    </td>
                    <td>
                        <p><?= $classemen['D'] ?></p>
                    </td>
                    <td>
                        <p><?= $classemen['buts'] ?>: <?= $classemen['be'] ?></p>
                    </td>
                    <td>
                        <p><?= $classemen['df'] ?></p>
                    </td>
                    <td>
                        <p><?= $classemen['point'] ?></p>
                    </td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>









