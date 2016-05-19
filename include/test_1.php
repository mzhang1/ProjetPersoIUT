<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        Page de départ
        3 menu :  explication de l'application ( => la page elle-même ) /
	inscription ( => page lien) /
	connexion( => sous dossier lien ) 
        
    <?php 
    include('include/menu1.php');
    ?>
    </body>
</html>


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

 // name = pareil que dans execute

-->