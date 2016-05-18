<?php
    session_start();
    $uc = (isset($_REQUEST['uc'])) ? $_REQUEST['uc'] : "main";
    $action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : "Accueil";
    include("html/base/head.html.php");
    include("html/messages/errorMessages.php");
    if(isset($_SESSION["user_admin"])){
        $admin = ($_SESSION["user_admin"] == 1) ? true : false;
        if($uc = "admin"){
            $uc = "administration";
        }
    }

    switch($uc){
        case "main":
            include("controller/main.inc.php");
            break;
        case "connexion":
            include("controller/connexion.inc.php");
            break;
        case "administration":
            include("controller/admin.inc.php");
            break;
        case "user":
            include("controller/user.inc.php");
            break;
    }

    if($action != "demandeConnexion") {
        include_once('html/base/footer.html.php');
    }
    include_once("html/base/JSscripts.html.php");
?>