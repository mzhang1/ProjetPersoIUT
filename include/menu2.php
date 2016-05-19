 <div id="acceuil"> <img src="../../images/home.png"/> <a href="../../acceuil.php">Accueil</a> </div>
    <div id="heureetdate">
      <form name="clock" onSubmit="0" id="clock">
       <img src="../../images/clock.png"/>
        <?php
$date = date("d/m/Y");
Print("$date");
?>
        <br>
        <strong>
        <input type="text" name="date" size="5" readonly class="style">
        </strong>
      </form>
    </div>
    <div class="logo_wrapper"><a href="../../acceuil.php"><img src="../../images/logo.png" height="50"/></a></div>
 


<?php

/* 
<?php include('include/menu2.php'); ?>
 */

?>