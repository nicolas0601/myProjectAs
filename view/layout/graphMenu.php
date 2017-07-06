<div><h3>Ligue 1 2015/2016</h3></div>

<div class="responsive navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

        <li>
            <form name='form_ind01' action='' method='post'>
                <button type='submit'>Vue d'ensemble</button>
                <input type='hidden' name='tran_code' value='ind02'></form>
        </li>
        <li>
            <form name='form_ind02' action='' method='post'>
                <button type='submit'>Classement</button>
                <input type='hidden' name='tran_code' value='ind05'></form>
        </li>
        <li>
            <form name='form_ind03' action='' method='post'>
                <button type='submit'>Face à face</button>
                <input type='hidden' name='tran_code' value='ind03'></form>
        </li>
        <li>
            <form name='form_ind04' action='' method='post'>
                <button type='submit'>Statistiques</button>
                <input type='hidden' name='tran_code' value='ind04'></form>
        </li>

    </ul>
</div>


<?php

require_once('connectionDB/ConnectionDB.php');

$db = getBdd();
$maxSaison = 2015;
$equipeId1 = 14;
$equipeId2 = 156;
$compId = 530;

$reqMaxJr = $db->prepare("SELECT DISTINCT MAX(class_nm)
              FROM classement WHERE class_saison_debut = '$maxSaison' ");

$reqMaxJr->execute();


$tab_max_jr = $reqMaxJr->fetchAll();
//echo $tab_max_jr;
$max_jr = $tab_max_jr[0][0];

echo " <script> var journee = $max_jr  </script>";

$reqNbEq = $db->prepare("SELECT DISTINCT comp_nb_equipe as nbEquipe
              FROM competition 
              WHERE comp_id = '$compId' ");

$reqNbEq->execute();

// fetch one // fetch assoc
$tab_nb_eq = $reqNbEq->fetchAll();

$nb_eq = $tab_nb_eq[0][0];

echo " <script> var nbEquipe = $nb_eq  </script>";


if (isset($_POST['tran_code']) && $_POST['tran_code'] != '') {

    $transaction = $_POST['tran_code'];
    $req_tran = $db->prepare("SELECT DISTINCT tran_id, tran_page, tran_dossier
              FROM transaction WHERE tran_code = '$transaction'");
    $req_tran->execute();
    $tab_tran = $req_tran->fetchAll();
    $fichier = $tab_tran[0][2] . "/" . $tab_tran[0][1];

    include($fichier);
} else {
    //recupere le classement de la derniere journée
    include("view/fichierClassement/classement.php");

}
?>
