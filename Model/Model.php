<?php

/**
 * Created by PhpStorm.
 * User: PC Dell
 * Date: 21/06/2017
 * Time: 14:24
 */
$dsn='mysql:dbname=paris_asmoza;host=127.0.0.1;port:3306';
$user = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
    echo $e->getMessage();
    die();
}

//include_once '../controller/MembreController.php';
//
//$crud = new MembreController($pdo);

// class Model {
//
//     private static $dbName = 'paris_sportif_asmoza' ;
// private static $dbHost = 'localhost' ;
// private static $dbUsername = 'root';
// private static $dbUserPassword = '';
// private static $cont = null;
//
// public function __construct() {
//     die('Init function is not allowed'); }
//
//
//     public static function connect() {
//
//     if ( null == self::$cont )
//
//     { try { self::$cont = new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName,
//         self::$dbUsername, self::$dbUserPassword); }
//
//         catch(PDOException $e) { die($e->getMessage());
//}
//}
//    return self::$cont;
//}
//
//    public static function disconnect()
//    {
//        self::$cont = null;
//    }
//}
//


//namespace Model;
//use \PDO;
//class Model
//{
//    /** Objet PDO d'accès à la BD */
//    private $bdd;
//
//    /**
//     * Fonction de connexion à la base
//     * @return \PDO  On retourne l'objet $bdd à la fonction de requêtes
//     */
//    public function getBdd(){
//        try{
//            if ($this->bdd==null){
//                $hote='127.0.0.1';
//                $port='3306';
//                $db= 'paris_sportif_asmoza';
//                $user='root';
//                $password='';
//
//                $this->bdd = new PDO('mysql:host='.$hote.
//                    ';port='.$port.
//                    ';dbname='.$db,
//                    $user,
//                    $password,
//                    array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION)
//                );
//            }
//        }
//        catch(\Exception $e){
//            echo 'Là il y a une erreur : '.$e->getTraceAsString();
//        }
//        return $this->bdd;
//    }
//
//    /**
//     * fonction de requetage de base de données
//     * @param $sql
//     * @param null $params
//     * @return mixed
//     */
//    public function executeRequest($sql, $params = null){
//        if ($params == null){
//            $result= $this->getBdd()->query($sql);
//        }
//        else{
//            $result= $this->getBdd()->prepare($sql);
//            $result->execute($params);
//        }
//        return $result;
//    }
//
//}
//
//



















//class Model
//{
//
//    private  $dbName = 'paris_sportif_asmoza' ;
//    private  $dbHost = '127.0.0.1' ;
//    private $port = '3306';
//    private  $dbUsername = 'root';
//    private  $dbUserPassword = '';
//    public  $conn;
////
////    public function __construct()
////    {
////        die('Init function is not allowed'); }
//
//
//    public function dbConnection()
//    {
////
////        $this->conn = null;
//        try
//        {
//            $this->conn = new PDO( "mysql:host=". $this->dbHost . ";dbname=" . $this->dbName . ";host=" . $this->port, $this->dbUsername,
//                $this->dbUserPassword);
//            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        }
//
//        catch (PDOException $e) {
//            echo "Connection error: " . $e->getMessage();
////        die($e->getMessage());
//        }
//
//        return $this->conn;
//    }
//
//    public function disconnect()
//    {
//        $this->conn = null;
//    }
//}


