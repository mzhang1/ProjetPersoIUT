<?php
    include("html/base/userNavbar.html.php");
    if(!$_SESSION["user_email"]){
        $action = null;
    }
    switch($action){
        case "showDashboard":
            include("html/user/mainPageUser.html.php");
            break;
    }
?>
