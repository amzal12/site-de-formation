<?php
echo "<br/><br/><br/><br/>";


//Pour l'ajout et modification de cours
if(isset($_REQUEST['cours']))
{
    //Ajout d'un cours dans un groupe de cours
    if($_REQUEST['cours'] == "ajout")
    {
        $testo = $_pdo->ajoutCoursQCM($_REQUEST['idG'],$_REQUEST['nomCours'],'facile','Nouveau cours');
    }
    //Ajout d'un groupe de cours
    if($_REQUEST['cours'] == "ajoutG")
    {
        $_pdo->ajoutGroupe($_REQUEST['nomCours']);
    }
    //Modification d'un cours
    if($_REQUEST['cours'] == "Valider")
    {
        $id_cours = $_REQUEST['idC'];
        $titre = $_REQUEST['titreCours'];
        $difficulte = $_REQUEST['difficulte'];
        $contenu_cours = $_REQUEST['contenuCours'];
        /*
        //Tentative d'upload d'un fichier media
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "Media/cours".$id_cours)) {
            echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été uploadé avec succès.";
        } else {
            echo "Il y a eu une erreur lors du téléchargement du fichier.";
        }
        */
        $_pdo->modifierCours($id_cours, $titre, $difficulte, $contenu_cours);
    }
}

//Pour afficher la page d'un cours
if(isset($_REQUEST['idG']))
{

    if(isset($_REQUEST['action']))
    {
        if($_REQUEST['action'] == "suppCQ")
        {
            $id_cours_qcm = $_REQUEST['idCQ'];
            $_pdo->supprimeCours($id_cours_qcm);
            $_pdo->supprimeQCM($id_cours_qcm);

        }
    }

    $id_groupe = $_REQUEST['idG'];

    if(isset($_REQUEST['niv']))
    {
        $id_qcm = $_REQUEST['niv'];
        $qcm =$_pdo->getQCM($id_qcm);
        $_pdo->passeNiveau($_SESSION['user_id'],$id_groupe,$qcm['diffi']);
    }

    
    $groupe = $_pdo->getGroupe($id_groupe);
    $cours = $_pdo->getGroupeCours($id_groupe);
    $niveau = $_pdo->getNiveauUserCours($_SESSION['user_id'],$id_groupe);
    if(!$niveau)
    {
        $niveau[0]['niveau'] = "Aucun";
    }
    $qcms = array();
    foreach($cours as $cour)
    {
        $qcm = $_pdo->getQCMCours($cour['id_cours']);
        $qcms[$cour['id_cours']] = $qcm;
    }

    //Si on veut afficher un cours précis
    if(isset($_REQUEST['idC']))
    {
        $cour =$_pdo->getCour($_REQUEST['idC']);
        include("Vue/cours.php");
    } 
    //Si on veut afficher un QCM précis
    else if(isset($_REQUEST['idQ']))
    {
        include("Controller/ControllerQCM.php");
    }
    //Sinon on inclus juste la page du cours
    else {
        include("Vue/cours_qcm.php");
    }
}
//Sinon on affiche tout les cours disponible
else 
{
    $groupes = $_pdo->getGroupes();
    include("Vue/index_cours.php");
}
?>
