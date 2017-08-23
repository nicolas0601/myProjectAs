<?php

session_start();
include('../connectionDB/connectionDB.php');


if (isset($_POST['teamSubmit'])) {

    if (empty($_POST['team1'])|| empty($_POST['team2'])) {
        $_SESSION['message'] = "Veuillez selectionner 2 équipes.";
    } else {
        $db = getbdd();
        $stmt = $db->prepare("SELECT a.nom as equipeA, b.nom as equipeB, renc_resultat_a as butDo, renc_resultat_b as butEx,
                            renc_date_rencontre as dateMatch
                            FROM rencontre r
                            INNER JOIN
								membre a ON a.identifiant = r.renc_equipe_a
									INNER JOIN
								membre b ON b.identifiant = r.renc_equipe_b 
                            WHERE r.renc_equipe_a in (?, ?) AND r.renc_equipe_b in (?, ?)
                            ORDER BY renc_date_rencontre Desc");

        $stmt->bindParam(1, $_POST['team1']);
        $stmt->bindParam(2, $_POST['team2']);

        $stmt->bindParam(3, $_POST['team1']);
        $stmt->bindParam(4, $_POST['team2']);

        try {
            $stmt->execute();
        } catch (PDOException $e) {
            $_SESSION['message'] = "Unexpected error occurred !";

        }

        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);

        $_SESSION['matchFF'] = $result;
        $_SESSION['team1']= $_POST['team1'];
        $_SESSION['team2']= $_POST['team2'];
//        pre($result);
//        pre($_SESSION);
//        die;

//        if (!empty($result)) {
//            $_SESSION['matchFF'] = $result;
//        } else {
//            $_SESSION['message'] = "pas de match joué";
//        }
        header("Location: ../index.php");
    }

}