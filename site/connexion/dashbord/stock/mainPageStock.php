<?php
    session_start();
    if(!$_SESSION['user_id']){
        header("Location:../../connexion.php");
    }
    $user_id = $_SESSION['user_id'];
?>
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
  <!-- NOTICE : URL des fichiers css à changer en fonction de l'installation -->
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Gestion des stocks</title>
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link href="../css/styles.css" rel="stylesheet">
    <link href="../css/stockStyle.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="ag-grid-master/dist/ag-grid.js">
    <link rel="stylesheet" type="text/css" href="ag-grid-master/dist/ag-grid-custom.js">
    <script>
        var user_id = <?php echo $_SESSION['user_id'];?>;
    </script>
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
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
               <!-- <li><a href="#">Dashboard</a></li>
                <li><a href="#">Settings</a></li>-->
               <!--<li><a href="#">Aide</a></li>-->
               <li><a href="../mes_informations.php">Modifier mon profil</a></li>
               <li><a href="../deconnexion.php">Déconnexion</a></li>
              </ul>
            </div>
          </div>
    </nav>

    <div class="container-fluid">

        <div class="row row-offcanvas row-offcanvas-left ">
            <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
              <ul class="nav nav-sidebar">
                <li><a href="../accueil.php">Accueil</a></li>
                <li><a href="../facture/index.php">Gestion des factures</a></li>
                <li><a href="../Calendar/index.php">Gestion de planning</a></li>
                <li class="active"><a href="mainPageStock.php">Gestion des stocks</a></li>
              </ul>
            </div><!--/span-->

            <!-- Stock window -->
            <div class="col-sm-9 col-md-10 stockContainer">
              <div class="row">
                <div class="col-md-offset-1 col-md-4 col-sm-12 selectContainer">
                    <label class="numberFiles">0</label> fiche(s) disponble(s)
                </div>
                <div class="col-md-offset-2 col-md-4 col-sm-12 productManagementContainer">
                    <label class="numberProducts">0</label> produit(s) disponble(s) pour la fiche de stock
                    <label class="stockFileName">"nom du fichier"</label>.
                    <button type="button" class="btn btn-primary affichageListeProduit">Afficher la liste des produits</button>
                </div>
              </div>
              <div class="row conteneurTable">
                <div class="col-md-6 conteneurTableEntree">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 tableEntree ag-fresh">
                            <!-- entry grid -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6 conteneurTableSortie">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 tableSortie">
                            <!-- out grid -->
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <!-- End stock window -->
            <!-- Products window -->
            <div class="col-sm-9 col-md-10 productContainer">
                <div class="row formHeader">
                    <div class="col-md-9 groupForm productForm">
                        <form>
                            <div class="form-group row">
                                <label for="nomProduit" class="col-md-2 form-control-label">Nom du produit</label>
                                <div class="col-md-4">
                                  <input id="nomProduit" type="text" class="form-control productNameField" placeholder="Nom du produit" disabled="true">
                                </div>
                                <label for="pu" class="col-md-2 form-control-label">Prix unitaire</label>
                                <div class="col-md-4">
                                  <input id="pu" type="text" class="form-control puField" placeholder="Prix unitaire" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="category" class="col-md-2 form-control-label">Catégorie</label>
                                <div class="col-md-4">
                                  <input id="category" type="text" class="form-control categoryProductField" placeholder="Catégorie" disabled="true">
                                </div>
                                <label for="pt" class="col-md-2 form-control-label">Prix total</label>
                                <div class="col-md-4">
                                  <input id="pt" type="text" class="form-control ptField" placeholder="Prix total" disabled="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="qte" class="col-md-2 form-control-label">Quantité</label>
                                <div class="col-md-4">
                                  <input id="qte" type="text" class="form-control qteField" placeholder="Quantité" disabled="true">
                                </div>
                                <label for="fournisseur" class="col-md-2 form-control-label">Fournisseur</label>
                                <div class="col-md-4">
                                  <input id="fournisseur" type="text" class="form-control fournisseurField" placeholder="Fournisseur" disabled="true">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row tableProductContainer">
                    <div class="row">
                        <label class="col-md-offset-1 col-md-2 col-xs-12 tableProductLabel">Produits disponibles</label>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-8 tableProduct">
                        </div>
                        <div class="col-md-2 buttonContainer">
                            <button type="button" class="btn btn-primary btn-sm createNewProduct">Créer un nouveau produit</button>
                            <button type="button" class="btn btn-info btn-sm confirmModifications" disabled="true">Sauvegarder les modifications</button>
                            <button type="button" class="btn btn-danger btn-sm deleteProduct" disabled="true">Supprimer le produit</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End products window -->
        </div>
    </div><!--/.container-->

    <footer>
      <p class="pull-right">©2016 Company</p>
    </footer>

    <!-- A changer selon la configuration -->
    <script src="../js/jquery-3.0.0.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="ag-grid-master/dist/ag-grid-custom.js"></script>
    <script src="agScripts.js.php"></script>
    <script src="../js/scripts.js"></script>
  </body>
</html>
