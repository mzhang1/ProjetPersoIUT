<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=profil;charset=utf8', 'root', '');
					    //calendar
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
