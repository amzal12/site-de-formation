<?php

//Connexion d'un utilisateur
if($_REQUEST['action'] == "co")
{
    $mail = $_REQUEST['addMail'];
    $mdp = $_REQUEST['mdp'];
    $infos = $_pdo->getUtilisateur($mail, $mdp);
    if(!empty($infos["pseudo"]))
    {
        $_SESSION['user'] = $infos["pseudo"];
        $_SESSION['user_id'] = $infos["id_user"];
        if($infos["id_role"]!=1)
            $_SESSION['admin'] = "non";
        else
            $_SESSION['admin'] = "oui";
        //renvoie sur la page des cours après une connection
        $choixTraitement = "indCours";
    } else
    {
        //P'têt le mettre de manière plus propre mais ça fait le café
        echo '<br/><br/><br/><br/>';
        echo "Mail et/ou mot de passe invalide ";
    }
}

//Déconnection d'un utilisateur
if($_REQUEST['action'] == "deco")
{
    $_SESSION = array();
    session_destroy();
    echo '<br/><br/><br/><br/>';
    echo "Déconnection réussie";
    //renvoie sur la page d'accueil après une déconnection
    $choixTraitement = "accueil";
}

//Inscription d'un utilisateur
if($_REQUEST['action'] == "inscription")
{
    $pseudo = $_REQUEST['pseudo'];
    $mail = $_REQUEST['addMail'];
    //Je vérifie pas si le mot de passe a été confirmé, faudra le faire p'têt en javascript
    $mdp = $_REQUEST['mdp'];

    if($_pdo->ajoutUtilisateur($pseudo, $mail, $mdp))
    {
        //Pour récupérer son id
        $infos = $_pdo->getUtilisateur($mail, $mdp);
        $_SESSION['user'] = $pseudo;
        $_SESSION['user_id'] = $infos["id_user"];
        //à changer
        $_SESSION['admin'] = "non";

        //renvoie sur la page des cours après une connection
        $choixTraitement = "indCours";
    }
    else
    {
        //P'têt le mettre de manière plus propre mais ça fait le café
        echo '<br/><br/><br/><br/>';
        echo "Erreur dans la création de votre compte, vérifiez si vous êtes déjà inscrit ";
    }
}


?>
