<?php

//include('Model/connexionDB.php');
//
//session_start();
//
//if (empty($_POST['mail'])
//    || empty($_POST['pwd'])
//) {
//    $_SESSION['message'] = "Tous les champs sont obligatoires !";
//
//    header('Location: login.php');
//    exit();
//}
//
//
//
////try {
////    $pdo = new PDO($pdo, $params['login'], $params['pwd']);
////    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
////} catch (PDOException $e) {
////    echo $e->getMessage();
////}
//
//
//$stmt = $pdo->prepare("SELECT * FROM membre WHERE mail = :email");
//$stmt->bindParam(':email', $mail);
//
//$mail = $_POST['mail'];
//
//try {
//    $stmt->execute();
//} catch (PDOException $e) {
//    $_SESSION['message'] = "Unexpected error occurred !";
//    header('Location: login.php');
//    die;
//}
//
//$user = null;
//
//while ($row = $stmt->fetch()) {
//    if($row['mPasse'] === $_POST['pwd']) {
//        $user = $row;
//    }
//}
//
//if(!empty($user)) {
//    $user['pwd'] = null;
//
//    $_SESSION['user'] = $user;
//
//    header("Location: index.php");
//} else {
//    $_SESSION['message'] = "Bad credentials !";
//    header('Location: login.php');
//}

//requête transaction


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $page_title; ?></title>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/ie10-viewport-bug-workaround.css">
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/faceAFace.css">
    <link rel="stylesheet" href="public/css/etatDeForme.css">


</head>
<body>
<?php
include('view/header.php');





echo "<div id=\"body\">";



if(isset($_POST['tran_code']) && $_POST['tran_code']!='') {

//    var_dump($_POST['tran_code']);
    $transaction = $_POST['tran_code'];
    $req_tran = $pdo->prepare("SELECT DISTINCT tran_id, tran_page, tran_dossier
              FROM transaction
              WHERE tran_code = '$transaction'");
    $req_tran->execute();
    $tab_tran = $req_tran->fetchAll();
    $fichier = $tab_tran[0][2]."/".$tab_tran[0][1];

    //var_dump($req_tran);
    include($fichier);
}
else
{
    include 'view/membre/connexion.php';

}

echo "</div>";


include('view/footer.php')

?>

<script src="public/js/jquery.min.js"></script>
<script src="public/js/d3.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script src="public/js/ie10-viewport-bug-workaround.js"></script>
<script src="public/js/courbeClass.js"></script>
<script src="public/js/etatDeForme.js"></script>
</body>
</html>


