<?php
//Affiche juste la page du profil
if(isset($_POST['action']))
{
    if($_POST['action'] == "valider_modif")
    {
        $pseudo = $_POST['pseudo'];
        $age = $_POST['age'];
        $anniv = $_POST['anniv'];
        $bio = $_POST['bio'];
        $_pdo->setParamUtilisateur($_SESSION['user_id'], $pseudo,$anniv, $age, $bio);
    }
}
$infos = $_pdo->getUtilisateurInfo($_SESSION['user_id']);

include("Vue/profil.php");
?>