<?php
    include("html/base/navbar.html.php");
    require_once("back/connexion/connexion.class.php");
    switch($action){
        case "demandeConnexion":
            include("html/mainPages/connexion.html.php");
            break;
        case "verifConnexion":
            $connexion = new Connexion();
            $response = $connexion->verifIdentifiants($_POST['user_email'],$_POST['user_mdp']);
            $retour = $response;
            if(is_array($retour)){
                if(isset($retour["success"])){
                    if($retour["userData"]["user_admin"] == 1 && $uc == "admin") {
                        header("Location:index.php?uc=admin&action=mainPage");
                    }
                    else{
                        header("Location:index.php?uc=user&action=showDashBoard");
                    }
                }
                else{
                    $error = $retour["error"];
                    header("Location:index.php?uc=connexion&action=demandeConnexion&errorMsg=$error");
                }
            }
            break;
        case "deconnexion":
            if(isset($_SESSION['user_id'])){
                unset($_SESSION);
                unset($_COOKIE);
                session_destroy();
                header ('Location: index.php');
                exit();
            }
            else {
                header('location: index.php');
            }
            break;
    }
?>