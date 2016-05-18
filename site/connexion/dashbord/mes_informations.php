<?php
session_start();

include('../include/bdd.php'); //inclusion de la page bdd.php evite de refaire le code

if(isset($_SESSION['user_id'])) // si l'utilisateur est connecté
{
    
$thisPage = 'profil 2';
?>
<!DOCTYPE html>

<html>
    <head>
	<title>Profil 2</title>
       <?php include('../include/menu_dash.php'); ?>
    </head>
    <body>
	
<!-- Entête de la page -->
    <center>
<div id="contenu">
    <h1>Mon profil</h1> 
    <center><a href='profil.php'>Changer de mot de passe</a></center><br/>
<?php 
if(isset($_POST['modif']))
//modif pareil que celui du input modifier avec le name
{
  //  if()
  //  {
        $sql = "UPDATE user SET user_nom = :nom, user_prenom = :prenom, user_email = :mail, forme_juridique = :juridique, siret = :numero, secteur_act = :secteur, user_tel = :tel, user_rue = :rue, user_cp = :cp, user_ville = :ville WHERE user_id = :id";
//sql pour la modif dans bdd
        $requete = $db->prepare($sql);
        $requete->execute(array( //array = tableau
            ':id' => $_SESSION['user_id'],//ma session active
            ':prenom' => $_POST['prenom'],
            ':nom' => $_POST['nom'],
            ':mail' => $_POST['mail'],
            ':juridique' => $_POST['juridique'],
            ':numero' => $_POST['numero'],
            ':secteur' => $_POST['secteur'],
            ':tel' => $_POST['tel'], 
            ':rue' => $_POST['rue'], 
            ':cp' => $_POST['cp'],
            ':ville' => $_POST['ville']
            ));// mes post pour update 
               // name = pareil que dans execute
        
        echo 'Les changements ont été effectués et seront effective lors de votre prochaine connexion !';
//    }

}
?>
    <form method="post" action="">  
        
        <TABLE BORDER=0>
        <TR>
                <TD>Nom :</TD>
                <TD>
                    <INPUT type="text" name="nom" value="<?php echo $_SESSION['user_nom'];?>">
                </TD>
        </TR>
        <TR>
                <TD>Prénom :</TD>
                <TD>
                    <INPUT type="text" name="prenom" value="<?php echo $_SESSION['user_prenom'];?>" >
                </TD>
        </TR>
        
        <TR>
                <TD>Téléphone :</TD>
                <TD>
                    <INPUT type="text" name="tel" value="<?php echo $_SESSION['user_tel'];?>">
                </TD>
        </TR>
        <TR>
                <TD>E-Mail :</TD>
                <TD>
                <INPUT type="text" name="mail"value="<?php echo $_SESSION['user_email'];?>" >
                </TD>
        </TR>
        
        <TR>
                <TD>Forme juridique :</TD>
                <TD>
                <INPUT type="text" name="juridique"value="<?php echo $_SESSION['forme_juridique'];?>" >
                </TD>
        </TR>
        <TR>
                <TD>Siret :</TD>
                <TD>
                <INPUT type="text" name="numero"value="<?php echo $_SESSION['siret'];?>" >
                </TD>
        </TR>
        <TR>
                <TD>Secteur d'activé :</TD>
                <TD>
                <INPUT type="text" name="secteur"value="<?php echo $_SESSION['secteur_act'];?>" >
                </TD>
        </TR>    
        
        <TR>
                <TD>Rue :</TD>
                <TD>
                    <INPUT type="text" name="rue" value="<?php echo $_SESSION['user_rue'];?>">
                </TD>
        </TR>
        <TR>
                <TD>Code Postal :</TD>
                <TD>
                    <INPUT type="text" name="cp"value="<?php echo $_SESSION['user_cp'];?>">
                </TD>
        </TR>
       
         <TR>
                <TD>Ville :</TD>
                <TD>
                <INPUT type="text" name="ville" value="<?php echo $_SESSION['user_ville'];?>" >
                </TD>
        </TR>
        <tr>
				<td colspan="2"><br/></td>
			</tr>
			<tr>
				<td></td>
				<td><INPUT type="submit" value="Enregistrer" name="modif"></td>
			</tr>
	

        </TABLE>
    </form>
</div>
     </center>

<!-- Pied de page de la page -->

    </body>
</html>
<?php
}
else
{
	header('Location: index.php');
	exit();
}
?>
<!--

<TABLE BORDER=0>
<TR>
	<TD>Nom</TD>
	<TD>
	<INPUT type=text name="nom">
	</TD>
</TR>

<TR>
	<TD>Prénom</TD>
	<TD>
	<INPUT type=text name="prenom">
	</TD>
</TR>

<TR>
	<TD>Sexe</TD>
	<TD>
	Homme : <INPUT type=radio name="sexe" value="M">
	<br>Femme : <INPUT type=radio name="sexe" value="F">
	</TD>
</TR>

<TR>
	<TD>Fonction</TD>
	<TD>
	<SELECT name="fonction">
		<OPTION VALUE="enseignant">Enseignant</OPTION>
		<OPTION VALUE="etudiant">Etudiant</OPTION>
		<OPTION VALUE="ingenieur">Ingénieur</OPTION>
		<OPTION VALUE="retraite">Retraité</OPTION>
		<OPTION VALUE="autre">Autre</OPTION>
	</SELECT>
	</TD>
</TR>
<TR>
	<TD>Commentaires</TD>
	<TD>
	<TEXTAREA rows="3" name="commentaires">
	Tapez ici vos commentaires</TEXTAREA>
	</TD>
</TR>

<TR>
	<TD COLSPAN=2>
	<INPUT type="submit" value="Envoyer">
	</TD>
</TR>
</TABLE>
</FORM>

-->

