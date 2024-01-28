<?php
// Ouverture de session
session_start();

//Récupération du Model
include("Model/Model.php");
$_pdo = Model::getBDD();

//Initialisation du routeur si besoin
if(!isset($_REQUEST['p']))
    $choixTraitement = "accueil";
else
    $choixTraitement = $_REQUEST['p'];

//Un echo utile car les message d'erreur sont des fois derrière la navbar
echo '<br/><br/><br/><br/><br/><br/>';


//Actions sur la session de l'utilisateur
if(isset($_REQUEST['action']))
{
    //Si l'utilisateur veut se connecté, déconnecté ou s'inscrire, on lance ces différents scripts
    switch($_REQUEST['action'])
    {
        case 'co' : {include("Controller/ControllerUtilisateur.php"); break;}
        case 'deco' : {include("Controller/ControllerUtilisateur.php");break;}
        case 'inscription' : {include("Controller/ControllerUtilisateur.php");break;}
    }
}

/*
* Création de nos pages, l'entête et la navbar sont dans le premier include,
* le switch s'occupe du contenu de nos pages et le foot ferme le body et l'html
*/
include("Controller/ControllerNavigation.php");
switch($choixTraitement)
{
    case 'accueil': {include("Controller/ControllerIndex.php");break;}
	case 'indCours': {include("Controller/ControllerIndexCours.php");break;}
    case 'forum': {include("Controller/ControllerForum.php");break;}
    case 'propos': {include("Controller/ControllerPropos.php");break;}
    case 'panAdmin': {include("Controller/ControllerAdmin.php");break;}
    case 'profil': {include("Controller/ControllerProfil.php");break;}
    case 'pref': {include("Controller/ControllerPref.php");break;}
    //Ici faudrais faire un message d'erreur plus propre sur une page à part entière
	default : {echo '<p><br/><br/><br/><br/>erreur ! -> '.$choixTraitement.'</p>';break;}
}
include("Vue/foot.php");


?>
