<?php session_start(); ?>

   
<?php
$thisPage = 'connexion';

// si le bouton connexion a été appuyer
if(isset($_POST['connexion']))
{
    // Si les 2 champs sont rempli
    if($_POST['user_email'] != '' && $_POST['user_mdp'] != '')
    {
        require('include/PDO.php');
        $c = new Connexion();
        $rep = $c->verif_user($_POST['user_email'], sha1($_POST['user_mdp']));
        
        if($rep != NULL)
        {
            $_SESSION['user_id'] = $rep['user_id'];
            $_SESSION['user_nom'] = $rep['user_nom'];
            $_SESSION['user_prenom'] = $rep['user_prenom'];
            $_SESSION['user_email'] = $rep['user_email'];
            $_SESSION['forme_juridique'] = $rep['forme_juridique'];
            $_SESSION['siret'] = $rep['siret'];
            $_SESSION['secteur_act'] = $rep['secteur_act'];
            $_SESSION['user_tel'] = $rep['user_tel'];
            $_SESSION['user_rue'] = $rep['user_rue'];
            $_SESSION['user_cp'] = $rep['user_cp'];
            $_SESSION['user_ville'] = $rep['user_ville'];
            $_SESSION['user_mdp'] = $rep['user_mdp'];
            $_SESSION['user_admin'] = $rep['user_admin'];

           //lien user à mettre 
            
            header('Location: dashbord/accueil.php');
            exit();
        }
        else
        {
            $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>L'email ou le mot de passe est incorrect !</div>";
        }
    }
    else
    {
        $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Tous les champs sont obligatoires !</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<head>
	<!-- Basics -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
         <link rel="icon" href="../img/Logo_simplyETL.jpg" type="image/x-icon">
	<title>Connexion</title>
	<!-- CSS Login -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/styles.css">
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css">   
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css" type="text/css">
	<!-- Plugin CSS -->
	<link rel="stylesheet" href="../css/animate.min.css" type="text/css">
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../css/creative.css" type="text/css">
</head>
    </head>
<body>
<!-- Entête de la page -->

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top" style="background-color: black">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a>
		    <img height="50px" width="100px" src="../img/Logo_simplyETL.jpg">
		</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                 <li><a class="page-scroll" href="../index.php">Acceuil</a></li>
		 <li><a class="page-scroll" href="../inscription.php">S'inscrire</a></li>
		 <li><a class="page-scroll" href="connexion.php">Connexion</a></li>
                   <!-- 
		  <li><a class="page-scroll" href="#contact">Contact</a></li>
		   -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
          <!-- Main HTML -->
<!-- Entête de la page -->

    <?php if(isset($erreur)){echo $erreur;} ?>
    <br/>
    <div id="container">
    <form method="post" action="connexion.php">
        <label>Adresse e-mail : </label>
        <input type="text" name="user_email" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" />
	<label>Mot de passe : </label>
	<p><a href="#">Mot de passe oublié ?</a></p>
        <input type="password" name="user_mdp" value="<?php if(isset($_POST['user_mdp'])){echo $_POST['user_mdp'];} ?>" />
        <input type="submit" value="Valider" name="connexion" />
    </form>
</div>
<!-- Pied de page de la page -->

</body>
</html>
<!-- jQuery -->
    <script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
    <script src="../js/jquery.easing.min.js"></script>
    <script src="../js/jquery.fittext.js"></script>
    <script src="../js/wow.min.js"></script>

<!-- Custom Theme JavaScript -->
    <script src="../js/creative.js"></script>

