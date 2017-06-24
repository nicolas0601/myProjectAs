

<?php






    //DISTINCT éviter les doublons
    $reqClassG = $pdo->prepare("SELECT DISTINCT co.comp_nom as comp, m.nom as equipe, class_nm as journee, class_saison_debut as debut, class_saison_fin as fin, 
            class_competition as competition, class_discipline as football, class_nb_point as point, class_rang as rang,
             class_resultat as buts,class_concede as be,(class_resultat-class_concede) as df, class_nb_victoire as V, class_nb_nul as N,class_nb_defaite as D FROM classement c
             INNER JOIN membre m ON m.identifiant = c.class_equipe 
             INNER JOIN competition co ON co.comp_id = c.class_competition
             WHERE  class_nm='$max_jr'
            
             ");



    $reqClassG->execute();

    $classement = $reqClassG->fetchAll(PDO::FETCH_ASSOC);

//      var_dump('<pre>');
//    var_dump($classement);
//    var_dump('</pre>');

    $reqClassG->closeCursor();

