<?php

    //Pour poster un nouveau message sur un topic
    if(isset($_REQUEST['postMessage']))
    {
            // Récupération des données du formulaire
            $message = $_POST['message'];
            $message = nl2br($message); //pour enregistrer les sauts de lignes
            $id_sujet = $_POST['id_suj'];
    
            if ($_pdo->ajoutMessageTopic($id_sujet, $message)) {
                echo "Message bien ajouté !";
            } else {
                echo "Erreur dans le message";
            }
    }


    if(isset($_POST['supprMessage'])){

        $idMess = $_POST['id_mess'];

        if ($_pdo->supprMessage($idMess)) {
                echo "Message supprimé !";
        } else {
                echo "Erreur lors de la suppression";
            }
    }


    if(isset($_POST['supprTopic'])){

        $idtopic = $_POST['id_topi'];

        if ($_pdo->supprTopic($idtopic)) {
                echo "Topic supprimé !";
        } else {
                echo "Erreur lors de la suppression";
            }
    }



    if(isset($_POST['bouton_change_etat_topic'])){

        
        $etatTopic = $_POST['etat_topic'];
        $idTopic = $_POST['id_topic'];

        if ($_pdo->ChangeEtatTopic($idTopic, $etatTopic)) {
                echo "Etat du topic modifié !";
        } else {
                echo "Erreur lors de la mise à jour";
            }        

    }

    //Pour poster un nouveau topic
    if(isset($_REQUEST['postTopic']))
    {    
            // Récupération des données du formulaire
            $titre = $_POST['titre'];
            $message = $_POST['message'];
            $message = nl2br($message); //por enregistrer les sauts de lignes
            $id_nouv_topic = $_pdo->ajoutTopic($titre, $message);
            if($id_nouv_topic)
            {
                echo "Nouveau topic bien ajouté !";
                //Pour rediriger sur le nouveau topic
                $_REQUEST['id_topic'] = $id_nouv_topic;
            } else {
                echo "Erreur dans le message";
            }
    }

    if(empty($topics)){
        $topics = $_pdo->getTopic();
    } 

    if (isset($_POST['btn_recherche_topic'])) {
        $mot_cle = $_POST['mot_recherche'];
        $topics = $_pdo->getTopic($mot_cle);
    } else {
        $topics = $_pdo->getTopic();
    }



    //Détermine si on doit être sur un topic ou sur la page d'accueil du forum
    if(!isset($_REQUEST['id_topic']))
        include('Vue/index_forum.php');
    else 
    {
        $idTopic = $_REQUEST['id_topic'];
        $titre = $_pdo->getSujetTopic($idTopic);
        $messages = $_pdo->getMessagesTopic($idTopic);
        include('Vue/sujetForum.php');
    }
?>

