<?php
include('connexionDB/connexionDB.php');
include('controller/MembreController.php');

$menbreController = new MembreController();



if (isset($_POST['mail']) && isset($_POST['pwd'])) {
//    var_dump($_POST);
    $userMail = $_POST['mail'];
    $pwd = $_POST['pwd'];
//    if (strlen(trim($userMail)) > 1 && strlen(trim($pwd)) > 1) {
    $membreId = $menbreController->userLogin($userMail, $pwd);
//        var_dump($membreId);
//        if ($membreId) {
//            $url = BASE_URL . 'index.php';
//            header("Location: $url");

// Page redirecting to home.php
//        } else {
//            $errorMsgLogin = "email ou mot de passe ne correspond pas";
//        }


}
