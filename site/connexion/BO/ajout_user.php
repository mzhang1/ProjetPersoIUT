<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Panneau d'administration</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Ajout d'un utilisateur</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>-->
	   <!--<li><a href="#">Aide</a></li>-->
	   <li><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
          
        </div>
    </div>
</nav>

<div class="container-fluid">
	<div class="row row-offcanvas row-offcanvas-left">
		<div class="col-sm-12 col-md-12 adminPanel">
			<form method='post' action='administration.php' class="form-horizontal" role="form">
				<div class="form-group">
				  <label for="email">Adresse Email:</label>
				  <input type="email" name='email' class="form-control" id="email">
				</div>
				<div class="form-group">
				  <label for="nom">Nom:</label>
				  <input type="nom" name='nom' class="form-control" id="nom">
				</div>
				<div class="form-group">
				  <label for="prenom">Prénom:</label>
				  <input type="prenom" name='prenom' class="form-control" id="prenom">
				</div>
				<div class="form-group">
				  <label for="mdp">Mot de passe:</label>
				  <input type="password" name='mdp' class="form-control" id="mdp">
				</div>
				<div class="form-group">
				  <label for="tel">Téléphone:</label>
				  <input type="text" name='tel' class="form-control" id="tel">
				</div>
				<div class="form-group">
				  <label for="ville">Ville:</label>
				  <input type="text" name='ville' class="form-control" id="ville">
				</div>
				<button type="submit" class="btn btn-default">Ajouter</button>
			</form>
		</div>
	</div>
</div>

<footer>
  <p class="pull-right">Copyright ©2016 SimplyETL, Inc.</p>
</footer>
        
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
