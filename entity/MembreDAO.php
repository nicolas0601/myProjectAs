<?php

function  pre($var){
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
}

require_once('../connectionDB/ConnectionDB.php');
//require_once('MembreDTO.php');

    function userRegistration($params)
    {
        $bd = getbdd();
        $stmt = $bd->prepare("SELECT identifiant FROM membre WHERE mail=:mail");
        $stmt->bindParam(":mail", $params['mail']);
        $stmt->execute();
        $count = $stmt->rowCount();

        if ($count === 0 ) {

            $sql = "INSERT INTO membre(nom,dateN,mail,mPasse,civilite) 
                    VALUES (:nom, :dateN, :mail, :mPasse, :civilite)";

            $params['mPasse'] = hash('sha256', $params['mPasse']);

            try {
                $stmt = $bd->prepare($sql);
                $stmt->execute($params);

                $_SESSION['identifiant'] = $bd->lastInsertId(); // Last inserted row id

                $_SESSION['message'] = "Vous avez bien été enregistré";
            }  catch(Exception $e){
                $_SESSION['message'] = $e;
            }

        } else {
            $_SESSION['message'] = "vous êtes déjà membre, veuillez login";

        }

    }

function userUpdate($params)
{
    $bd = getbdd();

    $sql = "UPDATE membre SET civilite=:civilite, nom=:nom, mail=:mail,
                    dateN=:dateN, tel_mobile=:tel_mobile,
                      pays_id=:pays_id
                WHERE identifiant =:identifiant";

        try {

            $stmt = $bd->prepare($sql);
            $stmt->execute($params);

            $_SESSION['user'] = $params;
            $_SESSION['message'] = "Vous avez mis à jour votre profile";
            $_SESSION['update'] ='ok';

        }  catch(Exception $e){
            $_SESSION['message'] = $e;
            $_SESSION['update'] ='nok';
        }

}


//function userUpdate2($params)
//{
//    $bd = getbdd();
//
//    $sql = "UPDATE membre SET tel_mobile=:tel_mobile
//                WHERE identifiant =:identifiant";
//
//    try {
//
//        $stmt = $bd->prepare($sql);
//        $stmt->execute($params);
//
//        $_SESSION['user'] = $params;
//        $_SESSION['message'] = "Vous avez mis à jour votre profile";
//        $_SESSION['update'] ='ok';
//
//    }  catch(Exception $e){
//        $_SESSION['message'] = $e;
//        $_SESSION['update'] ='nok';
//    }
//
//}




    function userLogin($userMail, $pwd)
    {
        try {
            $db = getbdd();
            $hashPassword = hash('sha256', $pwd); //Password encryption
            $stmt = $db->prepare("SELECT identifiant From membre WHERE mail=:userMail and mPasse=:hashPassword");
            $stmt->bindParam(":userMail", $userMail);
            $stmt->bindParam(":hashPassword", $hashPassword);

            $stmt->execute();

            $count = $stmt->rowCount();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($count) {

                $_SESSION['identifiant'] = $data['identifiant']; // Storing user session value

                $_SESSION['message'] =  "Vous etes bien connecté"; //??

            } else {
                $_SESSION['message'] = "Mauvais email ou password. Merci de recommencer !";
            }
        } catch (PDOException $e) {
            $_SESSION['message'] = $e;
        }

    }


    function membreInfo($membreId)
    {

        try {
            $db = getbdd();
            $stmt = $db->prepare("SELECT civilite, nom, mail, dateN, tel_mobile,
  pays_departement, pays_nom_departement, pays_nom_ville  FROM membre m INNER JOIN pays ON m.pays_id = pays.pays_id   WHERE identifiant=:membreId");
            $stmt->bindParam("membreId", $membreId, PDO::PARAM_INT);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC); //User data
            $_SESSION['user'] =  $data;
        } catch (PDOException $e) {
            $_SESSION['message'] = $e;
        }
    }



    function logout()
    {

        $_SESSION = array();

        session_destroy();
        $_SESSION['message'] = "Vous êtes bien déconnecté. ";
    }

