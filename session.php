<?php
if(!empty($_SESSION['identifiant']))
{
    $session_membreId=$_SESSION['uid'];
    include('controller/MembreController.php');
    $membreClass = new MembreController();
}
if(empty($session_membreId))
{
    $url=BASE_URL.'index.php';
    header("Location: $url");
}

