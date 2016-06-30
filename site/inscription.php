<?php session_start(); ?>  
<?php
$thisPage = 'inscription';

if(isset($_POST['inscription']))
{
    if($_POST['user_mdp'] != '' && $_POST['user_mdp2'] != '' && $_POST['user_prenom'] != '' && $_POST['user_nom'] != '' && $_POST['user_email'] != '' && $_POST['forme_juridique'] != '' && $_POST['siret'] != '' && $_POST['secteur_act'] != '' && $_POST['user_tel'] != '' && $_POST['user_rue'] != '' && $_POST['user_cp'] != '' && $_POST['user_ville'] != '')
    {
        if($_POST['user_mdp'] == $_POST['user_mdp2'])		// Si les 2 mots de passe sont égaux
        {
            // On crypte le mot de passe
            $user_mdp = sha1($_POST['user_mdp']);

            require('connexion/include/PDO.php');
            $c = new Connexion();
			
			if($c->verif_email($_POST['user_email']) != false)
			{
			   $c->ajouter_user($user_mdp, $_POST['user_prenom'], $_POST['user_nom'], $_POST['user_email'], $_POST['forme_juridique'], $_POST['siret'], $_POST['secteur_act'], $_POST['user_tel'], $_POST['user_rue'], $_POST['user_cp'], $_POST['user_ville']);
			
				// Inscription réussi
				header('Location: connexion/connexion.php');		// On est redirigé vers la page de connexion
				exit();
			}
			else
			{
				$erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Cette adresse email existe déjà !</div>";
			}
        }
        else
        {
            $erreur = "<br/><br/><br/><br/><div style='font-size: 30px; text-align: center; color: red;'>La confirmation de mot de passe ne correspond pas avec le mot de passe !</div>";
        }
    }
    else
    {
        $erreur = "<br/><br/><div style='font-size: 30px; text-align: center; color: red;'>Tous les champs sont obligatoires !</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
	
<title>Inscription</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
     <link rel="icon" href="img/Logo_simplyETL.jpg" type="image/x-icon">


    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">   
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">
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
		    <img height="50px" width="100px" src="img/Logo_simplyETL.jpg">
		</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                 <li><a class="page-scroll" href="index.php">Acceuil</a></li>
		 <li><a class="page-scroll" href="inscription.php">S'inscrire</a></li>
		 <li><a class="page-scroll" href="connexion/connexion.php">Connexion</a></li>
                   <!-- 
		  <li><a class="page-scroll" href="#contact">Contact</a></li>
		   -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<div id="contenu">
    
    <section id="services">
    <center> <h2>Inscription</h2> </center><br/>
    
    <form method="post">
        <table border="0" align="center" width="70%">
                <tr>
                        <td><label>Adresse e-mail : </label></td>
                        <td><input type="email" name="user_email" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" /></td>
                </tr>
                
                 <tr>
                        <td><label>Forme juridique : </label></td>
                        <td><input type="text" name="forme_juridique" value="<?php if(isset($_POST['forme_juridique'])){echo $_POST['forme_juridique'];} ?>" /></td>
                </tr>
                 <tr>
                        <td><label>Siret : </label></td>
                        <td><input type="text" name="siret" value="<?php if(isset($_POST['siret'])){echo $_POST['siret'];} ?>" /></td>
                </tr>
                 <tr>
                        <td><label>Secteur d'activité : </label></td>
                        <td><input type="text" name="secteur_act" value="<?php if(isset($_POST['secteur_act'])){echo $_POST['secteur_act'];} ?>" /></td>
                </tr>
                                
                <tr>
                        <td><label>Mot de passe : </label></td>
                        <td><input type="password" name="user_mdp" value="<?php if(isset($_POST['user_mdp'])){echo $_POST['user_mdp'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Confirmation du mot de passe :</label></td>
                        <td><input type="password" name="user_mdp2" /></td>
                </tr>
                <tr>
                        <td><label>Prénom : </label></td>
                        <td><input type="text" name="user_prenom" value="<?php if(isset($_POST['user_prenom'])){echo $_POST['user_prenom'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Nom : </label></td>
                        <td><input type="text" name="user_nom" value="<?php if(isset($_POST['user_nom'])){echo $_POST['user_nom'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Téléphone : </label></td>
                        <td><input type="text" name="user_tel" value="<?php if(isset($_POST['user_tel'])){echo $_POST['user_tel'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Rue : </label></td>
                        <td><input type="text" name="user_rue" value="<?php if(isset($_POST['user_rue'])){echo $_POST['user_rue'];} ?>" /></td>
                </tr>
                <tr>
                        <td><label>Code Postal : </label></td>
                        <td><input type="text" name="user_cp" value="<?php if(isset($_POST['user_cp'])){echo $_POST['user_cp'];} ?>" maxlength="5" /></td>
                </tr>
                <tr>
                        <td><label>Ville : </label></td>
                        <td><input type="text" name="user_ville" value="<?php if(isset($_POST['user_ville'])){echo $_POST['user_ville'];} ?>" /></td>
                </tr>
                <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                </tr>
                <tr>
                        <td></td>
                        <td><input type="submit" value="inscription" name="inscription" /></td>
                </tr>
                <tr>
                        <td colspan="2"><?php if(isset($erreur)){echo $erreur;} ?></td>
                </tr>
        </table>
    </form>
    </section>
</div>

<div class="footer">
<p>Copyright ©2016 SimplyETL, Inc.</p>
</div>
</body>
</html>

<style>
.footer {
    background-color: #0099cc;
    color: #ffffff;
    text-align: center;
    font-size: 12px;
    padding: 15px;
}
</style>

<!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>
    <script src="js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/creative.js"></script>