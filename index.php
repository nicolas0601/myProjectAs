<?php

function  pre($var){
    echo"<pre>";
    var_dump($var);
    echo"</pre>";
}

include('view/layout/header.php');

//var_dump($_POST);
//var_dump("session");
//var_dump($_SESSION);

if(isset($_POST['action']) && $_POST['action']==='toRegister'){

    header('Location: ./register.php');
    exit;
//    switch ($_POST['action']) {
//        case 'toRegister':
//            header('Location: ./register.php');
//            exit;
//            break;
//        case 'toProfile':
//            header('Location: ./profile.php');
//            exit;
//            break;
//        case 2:
//            echo "i égal 2";
//            break;
//    }
}



if (isset($_SESSION['identifiant'])) {

    include("view/layout/graphMenu.php");

} else {

    header('Location: ./login.php');
    exit;
}

include('view/layout/footer.php')
?>




