<?php
session_start();
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