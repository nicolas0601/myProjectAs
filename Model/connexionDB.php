<?php

/**
 * Created by PhpStorm.
 * User: PC Dell
 * Date: 21/06/2017
 * Time: 14:24
 */
//$dsn='mysql:dbname=paris_asmoza;host=127.0.0.1;port:3306';
//$user = 'root';
//$password = '';
//
//try {
//    $pdo = new PDO($dsn, $user, $password);
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//}
//catch(PDOException $e) {
//    echo $e->getMessage();
//    die();
//}

session_start();
/* DATABASE CONFIGURATION */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'paris_asmoza');
define("BASE_URL", "http://localhost/projetStage/"); // Eg. http://yourwebsite.com


/**
 * @return PDO
 */
function getDB()
{
    $dbhost = DB_SERVER;
    $dbuser = DB_USERNAME;
    $dbpass = DB_PASSWORD;
    $dbname = DB_DATABASE;
    try {
        $dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        $dbConnection->exec("set names utf8");
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;

    }

    catch (PDOException $e) {

        echo 'Connection failed: ' . $e->getMessage();
    }
}






















