<?php
//include('../Model/connexionDB.php');
//include('../entity/Membre.php');
//namespace Model;
/*.*.
 * Created by PhpStorm.
 * User: PC Dell
 * Date: 21/06/2017
 * Time: 10:54
 */
//class MembreController
//{
//    private $conn;
//
//    function __construct($cont)
//    {
//        $database = new Model();
//        $db = $database->getBdd();
//        $this->conn = $db;
//    }


class MembreController
{

    public function userLogin($userMail, $pwd)
    {

        try {

            $db = getDB();

            $hash_password = hash('sha256', $pwd); //Password encryption
            $stmt = $db->prepare("SELECT identifiant From membre WHERE mail=:userMail and mPasse=:hash_password
         ");
            $stmt->bindParam("userEmail", $userMail, PDO::PARAM_STR);
            $stmt->bindParam("hash_password", $hash_password, PDO::PARAM_STR);

            $stmt->execute();

            $count = $stmt->rowCount();
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            $db = null;
            if ($count) {
                $_SESSION['identifiant'] = $data->identifiant; // Storing user session value
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }


    public function userRegistration($nom, $dateN,$mail, $pwd)
    {
        try{
            $db = getDB();
            $st = $db->prepare("SELECT identifiant FROM membre WHERE mail=:mail");
            $st->bindParam("mail", $mail,PDO::PARAM_STR);
            $st->execute();
            $count=$st->rowCount();
            if($count<1)
            {
                $stmt = $db->prepare("INSERT INTO membre(nom,dateN,mail,mPasse) VALUES (:nom, :dateN, :email,:hash_password)");
                $stmt->bindParam("nom", $nom) ;
                $stmt->bindParam("dateN", $dateN) ;
                $stmt->bindParam("mail", $mail) ;
                $hash_password= hash('sha256', $pwd); //Password encryption
                $stmt->bindParam("hash_password", $hash_password) ;
                $stmt->execute();
                $membreId=$db->lastInsertId(); // Last inserted row id
                $db = null;
                $_SESSION['identifiant']=$membreId;
                return true;
            }
            else
            {
                $db = null;
                return false;
            }

        }
        catch(PDOException $e) {
            echo '{"error":{"text":'. $e->getMessage() .'}}';
        }
    }




}




