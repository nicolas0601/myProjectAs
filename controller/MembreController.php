<?php
include('../Model/Model.php');
include('../entity/Membre.php');
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


class MembreController{

private $db;

fucntion function __construct($pdo)
{
   $this->db = $pdo;
}

public function create($nom; $mail $mPasse)

//
//    public function insert(Membre $membre)
//    {
//        $stmt = $this->conn->prepare("INSERT INTO membre (nom,dateN, mail, mPasse,) VALUES (:nom, :dateN :mail, :mPasse)");
//        $stmt->bindParam(':nom', $nom);
//        $stmt->bindParam(':dateN', $nom);
//        $stmt->bindParam(':mail', $mail);
//        $stmt->bindParam(':mPasse', $mPasse);
//
//        $nom = $membre->getNom();
//        $dateN = $membre->getDateN();
//        $mail = $membre->getMail();
//        $mPasse = $membre->getMPasse();
//
//        try {
//            $stmt->execute();
//
//            $membre->setIdentifiant($this->conn->lastInsertId());
//
//            return $membre;
//        } catch (\Exception $e) {
//            return null;
//        }










//    public function create($fname,$lname,$email,$contact)
//    {
//        try
//        {
//            $stmt = $this->db->prepare("INSERT INTO tbl_users(first_name,last_name,email_id,contact_no)
//            VALUES(:fname, :lname, :email, :contact)");
//            $stmt->bindparam(":fname",$fname);
//            $stmt->bindparam(":lname",$lname);
//            $stmt->bindparam(":email",$email);
//            $stmt->bindparam(":contact",$contact);
//            $stmt->execute();
//            return true;
//        }
//        catch(PDOException $e)
//        {
//            echo $e->getMessage();
//            return false;
//        }
//
//    }

}