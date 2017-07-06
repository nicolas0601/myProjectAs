<?php
session_start();
require_once('../entity/MembreDAO.php');
// create

if (isset($_POST['registration'])) {

    unset($_POST['registration']);
    userRegistration($_POST);

    if (isset($_SESSION['identifiant'])) {
        header('Location: ../index.php');
        exit;
    } else {
        header('Location: ../register.php');
        exit;
    }
}

// read login
if (isset($_POST['login'], $_POST['mail'], $_POST['pwd'])
    && !empty($_POST['mail']) && !empty($_POST['pwd'])
) {
//    var_dump($_POST);
    $userMail = $_POST['mail'];
    $pwd = $_POST['pwd'];

    userLogin($userMail, $pwd);

    if (isset($_SESSION['identifiant'])) {

        header('Location: ../index.php');
        exit;
    } else {
        header('Location: ../login.php');
        exit;
    }

}

// read profile
if (isset($_POST['profile'])) {

    membreInfo($_SESSION['identifiant']);
    header('Location: ../profile.php');
    exit;
}



//update
if (isset($_POST['updateProfile']) ) {

    unset($_POST['updateProfile']);



    userUpdate($_POST);

    if ($_SESSION['update'] === 'ok') {
        header('Location: ../index.php'); //?? to which page ??
        exit;
    } else {
        header('Location: ../profile.php');
        exit;
    }
}

//
//if (isset($_POST['updateProfile2'])) {
//
//    unset($_POST['updateProfile2']);
//
//    userUpdate2($_POST);
//
//    if ($_SESSION['update'] === 'ok') {
//        header('Location: ../index.php'); //?? to which page ??
//        exit;
//    } else {
//        header('Location: ../profile.php');
//        exit;
//    }
//}



if (isset($_POST['logout'])) {

    logout();
    header('Location: ../login.php');
    exit;
}


?>
