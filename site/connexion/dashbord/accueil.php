
<!-- 
Système possibilité du stock :
Ajouter / supprimer / modifier des produits (avec des représentation kpi voir bootstrap dashbord)

Système possibilité de facture :
Ajouter / supprimer / modifier des factures avec des exports pdf (voir php fpdf)

Système de planning :
Faire un agenda ou on peut renter des notes  
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dashboard</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../../css/user/dashboard/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/user/styles.css" rel="stylesheet">
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
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>-->
	   <!--<li><a href="#">Aide</a></li>-->
	   <li><a href="mes_informations.php">Modifier mon profil</a></li>
	   <li><a href="deconnexion.php">Déconnexion</a></li>
          </ul>
          
        </div>
      </div>
</nav>

<div class="container-fluid">
      
      <div class="row row-offcanvas row-offcanvas-left">
        
         <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           
            <ul class="nav nav-sidebar">
	      <li class="active"><a href="accueil.php">Acceuil</a></li>
              <li><a href="#">Lien à faire</a></li>
              <li><a href="#">Lien à faire</a></li>
            </ul>
          
        </div><!--/span-->
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          <p class="visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </p>
          
	<h1 class="page-header">Dashboard</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder text-center">
	    <a href="#">
              <img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
              <h4>Gestion de plannin</h4>
              <span class="text-muted"></span>
	    </a> 
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
	    <a href="#">
              <img src="//placehold.it/200/66ff66/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
              <h4>Gestion de facture</h4>
              <span class="text-muted"></span>
	    </a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
		<a href="#">
              <img src="//placehold.it/200/6666ff/fff" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">
              <h4>Gestion de stock</h4>
              <span class="text-muted"></span>
		</a>
            </div>
            
          </div>

	</div>
</div><!--/.container-->

<footer>
  <p class="pull-right">©2016 Company</p>
</footer>
        
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>
