<?php

//Controller pour la page du panneau admin


//Lorsqu'on fait une action d'un admin
if(isset($_POST['admin']))
{
    $administrer = $_POST['admin'];
    $id = $_POST['id'];
    //Supprime un utilisateur
    if($administrer == "suppEtu")
        $_pdo->supprimeUtilisateur($id);
    //Passe un utilisateur admin
    if($administrer == "passeAdmin")
        $_pdo->changeRoleUtilisateur($id, 1);
    //Supprime un cours, à modifier pour supprimer un groupe de cours qui supprime ces cours à lui
    if($administrer == "suppCours")
        $_pdo->supprimeGroupe($id);
}

//Récupère les infos à afficher, la liste d'utilisateurs et la liste de cours
$utilisateurs = $_pdo->getUtilisateurs();
$cours = $_pdo->getGroupes();

include("Vue/tableauDeBordAdmin.php");
?>