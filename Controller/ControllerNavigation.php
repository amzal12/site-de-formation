<?php

//Inclus l'entête d'un fichier html, c'est là où y'a notre style et le nom de notre site
include("Vue/entete.php");
//Inclus la barre de navigation
include("Vue/navigation.php");
//Vérifie si l'utilisateur est connecté pour savoir si on inclus un bouton de connexion ou un bouton
//de profil
if(!isset($_SESSION['user']))
    include("Vue/utilisateurDeco.php");
else
    include("Vue/utilisateurCo.php");
?>
