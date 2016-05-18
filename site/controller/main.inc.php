<?php
    include("html/base/navbar.html.php");
    switch($action){
        case "Accueil":
            include("html/mainPages/accueil.html.php");
            break;
        case "Inscription":
            include("html/mainPages/inscription.html.php");
            break;
    }
?>