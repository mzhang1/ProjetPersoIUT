

    <div id="menu">
      <ul id="MenuBar1" class="MenuBarVertical">
        <li><a href="liste_article.php" class="boutonblan1"><img src="../../images/article.png"/> Articles</a> </li>
        <li><a class="MenuBarItemSubmenu" href="../gestionstock/vue_globale.php"><img src="../../images/stock.png"/> Stock
          <?php if ($totalRows_teststock > 0) { // Show if recordset not empty ?>
            <span id="notif"> <?php echo $row_nombreenalert['count(reference)']; ?> </span>
            <?php } // Show if recordset not empty ?>
          </a>
          <ul>
            <li><a href="../gestionstock/entree_stock.php"><img src="../../images/menuentree.png"/> Entrées</a></li>
            <li><a href="../gestionstock/sortie_stock.php"><img src="../../images/menuesortie.png"/> Sorties</a></li>
          </ul>
        </li>
        <li><a href="../gestionfournisseur/liste_fournisseur.php"><img src="../../images/fournisseur.png"/> Fournisseurs</a> </li>
        <li><a href="../gestionclient/liste_client.php"> <img src="../../images/client.png"/> Clients</a> </li>
        <li><a class="MenuBarItemSubmenu" href="../gestionachat/commande.php"><img src="../../images/achat.png"/> Achats</a>
          <ul>
            <li><a href="../gestionachat/commande.php"><img src="../../images/menucommande.png"/> Commandes</a></li>
            <li><a href="../gestionachat/depense.php"><img src="../../images/depense.png"/> Dépenses</a></li>
          </ul>
        </li>
        <li><a class="MenuBarItemSubmenu" href="../gestionvente/ventes.php"><img src="../../images/vente.png"/> Ventes
          <?php if ($totalRows_testecheance > 0) { // Show if recordset not empty ?>
            <span id="notif"><?php echo $row_listeecheance['count(distinct numerofacture)']; ?></span>
            <?php } // Show if recordset not empty ?>
          </a>
          <ul>
            <li><a href="../gestionvente/ventes.php"><img src="../../images/menuvente.png"/> Ventes</a></li>
            <li><a href="../gestionvente/devis.php"><img src="../../images/devis.png"/> Devis</a></li>
            <li><a href="../gestionvente/Tarifs.php"><img src="../../images/tarifs.png"/> Tarifs</a></li>
            <li><a href="../gestionvente/reglement_facture.php"><img src="../../images/facture.png"/> Factures
              <?php if ($totalRows_testecheance > 0) { // Show if recordset not empty ?>
                <span id="notif"><?php echo $row_listeecheance['count(distinct numerofacture)']; ?></span>
                <?php } // Show if recordset not empty ?>
              </a></li>
          </ul>
        </li>
        <li><a href="../gestiontaxes/declaration_revenus.php"><img src="../../images/revenu.png"/> Taxes</a></li>
        <li><a href="../gestiondocuments/document.php"><img src="../../images/document.png"/> Documents</a></li>
        <li>
          <?php
//Afficher région si...
if ($_SESSION ['MM_UserGroup'] != 'simple') { ?>
            <a href="../expertcompta/expertcompta.php"><img src="../../images/compta.png"/>Comptabilité</a>
            <?php } ?>
        </li>
      </ul>
    </div>





<?php

/* 
<?php include('include/menu1.php'); ?>
 */

?>