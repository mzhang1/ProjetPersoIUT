<!-- Css de la page de connexion -->
<link rel="stylesheet" href="css/connexion/reset.css">
<link rel="stylesheet" href="css/connexion/animate.css">
<link rel="stylesheet" href="css/connexion/styles.css">

<?php
    if(isset($_REQUEST['errorMsg'])){
        //Le message d'erreur est défini en fonction de l'indice relié (voir errorMessages.php)
        echo "<div class='errorMessage'>".$errorMessage[$_REQUEST['errorMsg']]."</div>";
    }
?>
<br/>
<div id="container" class="connectFormContainer">
    <form method="post" class="connectForm" action="index.php?uc=connexion&action=verifConnexion">
        <label>Adresse e-mail : </label>
        <input type="text" name="user_email" class="connectEmail" value="<?php if(isset($_POST['user_email'])){echo $_POST['user_email'];} ?>" />
        <label>Mot de passe : </label>
        <p><a href="#">Mot de passe oublié ?</a></p>
        <input type="password" name="user_mdp" class="connectMdp" value="<?php if(isset($_POST['user_mdp'])){echo $_POST['user_mdp'];} ?>" />
        <input type="submit" value="Valider" name="connexion" />
    </form>
</div>