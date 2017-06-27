<?php

include('Model/connexionDB.php');
include('controller/MembreController.php');

$menbreController = new MembreController();

//requête transaction

if (!empty($_POST['loginSubmit']))
{
    $userMail=$_POST['mail'];
    $pwd=$_POST['pwd'];
    if(strlen(trim($userMail))>1 && strlen(trim($pwd))>1 )
    {
        $membreId=$menbreController->userLogin($userMail,$pwd);

        if($membreId)
        {
            $url=BASE_URL.'index.php';
            header("Location: $url"); // Page redirecting to home.php
        }
        else
        {
            $errorMsgLogin="email ou mot de passe ne correspond pas";
        }
    }
}




if (!empty($_POST['registration']))
{
    $nom=$_POST['nom'];
    $dateN=$_POST['dateN'];
    $mail=$_POST['email'];
    $pwd=$_POST['pwd'];
    /* Regular expression check */
    $username_check = preg_match('~^[A-Za-z0-9_]{3,20}$~i', $nom);
    $email_check = preg_match('~^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$~i', $mail);
    $password_check = preg_match('~^[A-Za-z0-9!@#$%^&*()_]{6,20}$~i', $pwd);

    if($username_check && $email_check && $password_check && strlen(trim($nom))>0)
    {
        $membreId=$menbreController->userRegistration($nom,$dateN,$mail,$pwd);
        if($membreId)
        {
            $url=BASE_URL.'login.php';
            header("Location: $url"); // Page redirecting to home.php
        }
        else
        {
            $errorMsgReg="Username or Email already exists.";
        }
    }
}


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
$db = getDB();
$maxSaison = 2015;
$equipeId1 = 14;
$equipeId2 = 156;
$compId = 530;

$reqMaxJr = $db->prepare("SELECT DISTINCT MAX(class_nm)
              FROM classement
              WHERE class_saison_debut = '$maxSaison' ");

$reqMaxJr->execute();


$tab_max_jr = $reqMaxJr->fetchAll();
echo $tab_max_jr;
$max_jr = $tab_max_jr[0][0];

echo " <script> var journee = $max_jr  </script>";

$reqNbEq= $db->prepare("SELECT DISTINCT comp_nb_equipe as nbEquipe
              FROM competition
              WHERE comp_id = '$compId' ");

$reqNbEq->execute();

// fetch one // fetch assoc
$tab_nb_eq = $reqNbEq->fetchAll();

$nb_eq = $tab_nb_eq[0][0];

echo " <script> var nbEquipe = $nb_eq  </script>";



echo "<div id=\"body\">";

  echo "<div><h3>Ligue 1 2015/2016</h3></div>
    
<div class=\"responsive navbar-collapse\" id=\"bs-example-navbar-collapse-1\">
    <ul class=\"nav navbar-nav\">";

 echo "    
         <li><form name='form_ind01' action='' method='post'><button type='submit'>Vue d'ensemble</button><input type='hidden' name='tran_code' value='ind02'></form></li>
         <li><form name='form_ind02' action='' method='post'><button type='submit'>Classement</button><input type='hidden' name='tran_code' value='ind05'></form></li>
        <li><form name='form_ind03' action='' method='post'><button type='submit'>Face à face</button><input type='hidden' name='tran_code' value='ind03'></form></li>
        <li><form name='form_ind04' action='' method='post'><button type='submit'>Statistiques</button><input type='hidden' name='tran_code' value='ind04'></form></li>


    </ul>";
echo "</div>";


if(isset($_POST['tran_code']) && $_POST['tran_code']!='') {

//    var_dump($_POST['tran_code']);
    $transaction = $_POST['tran_code'];
    $req_tran = $db->prepare("SELECT DISTINCT tran_id, tran_page, tran_dossier
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
    //recupere le classement de la derniere journée
    //include("view/classement.php");

}

echo "ffffff </div>";


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


