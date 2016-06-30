<html>
  <head>
    <title>modification de données en PHP :: partie2</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Dashboard</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../../css/bootstrap.min.css" rel="stylesheet">
		
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="../../css/styles.css" rel="stylesheet">
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
          <!--<a class="navbar-brand" href="../index.php">Revenir au site</a>-->
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           <!-- <li><a href="#">Dashboard</a></li>
            <li><a href="#">Settings</a></li>-->
	   <!--<li><a href="#">Aide</a></li>-->
	   <li><a href="../../mes_informations.php">Modifier mon profil</a></li>
	   <li><a href="../../deconnexion.php">Déconnexion</a></li>
          </ul>
          
        </div>
      </div>
</nav>

<div class="container-fluid">
      
      <div class="row row-offcanvas row-offcanvas-left">
        
         <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
           
            <ul class="nav nav-sidebar">
	      <li class="active"><a href="../../accueil.php">Acceuil</a></li>
             <!-- <li><a href="#">Lien à faire</a></li>
              <li><a href="#">Lien à faire</a></li>-->
            </ul>
          
        </div><!--/span-->
        
        <div class="col-sm-9 col-md-10 main">
  <?php
  //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "" ) ;
 
  //sélection de la base de données:
  $db = mysql_select_db( "profil" ) ;
 
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel enregistrement modifier
  $id_producto = $_GET["modifier"] ;
 
  //requête SQL:
  $sql = "SELECT *
            FROM productos_demo
	    WHERE id_producto = ".$id_producto;
 
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
 
  //affichage des données:
  if( $result = mysql_fetch_object( $requete ) )
  {
  ?>
<form name="insertion" action="modification3.php" method="POST">
  <input type="hidden" name="id_producto" value="<?php echo($id_producto) ;?>">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>Code produit</td><!-- codigo_producto-->
      <td><input type="text" name="codigo_producto" value="<?php echo($result->codigo_producto) ;?>"></td>
    </tr>
    
    <tr align="center">
      <td>Nom du produit</td> <!-- nombre_producto-->
      <td><input type="text" name="nombre_producto" value="<?php echo($result->nombre_producto) ;?>"></td>
    </tr>
    
    <tr align="center">
    <td>Prix du produit</td> <!-- precio_producto-->
      <td><input type="text" name="precio_producto" value="<?php echo($result->precio_producto) ;?>"></td>
    </tr>

    <tr align="center">
      <td colspan="2"><input type="submit" value="modifier"></td>
    </tr>
    
  </table>
</form>
  <?php
  }//fin if 
  ?>
</div><!--/.container-->

<footer>
  <p class="pull-right">Copyright ©2016 SimplyETL, Inc.</p>
</footer>
        
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="../../js/bootstrap.min.js"></script>
		<script src="../../js/scripts.js"></script>
	</body>
</html>