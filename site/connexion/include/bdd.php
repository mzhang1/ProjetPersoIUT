<?php
try //co a la bdd
{
    $db = new PDO('mysql:host=localhost;dbname=profil', 'root', '');
    $db->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);      
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // affiche le detail des l'erreurs php
} 
catch (Exception $e) // en cas d'erreur
{
die('Erreur : '.$e->getMessage());
}
?>