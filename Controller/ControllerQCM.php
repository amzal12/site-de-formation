<?php

    //Je récupère les infos du qcm dans la bdd

    $chemin = 'QCM/qcm'.$qcm['cours'].'.xml';
    
    $qcm =$_pdo->getQCM($_REQUEST['idQ']);

    if(isset($_REQUEST['qcm']))
    {
        // Vérifier si le fichier a été uploadé avec succès
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $chemin)) {
            echo "Le fichier ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " a été uploadé avec succès.";
        } else {
            echo "Il y a eu une erreur lors du téléchargement du fichier.";
        }
    }

    if (!file_exists($chemin)) {
        if($_SESSION['admin']=='oui')
            include("Vue/importeQCM.php");
        else
            {
                echo "<p>Le QCM est indisponible</p>";
            }
    } else { 
        $qcm_xml = simplexml_load_file($chemin);
        $nbQuestions = count($qcm_xml->children());
        include("Vue/qcm.php");
    }

?>
