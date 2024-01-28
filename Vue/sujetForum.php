<div class="index_Topic">
    <p class="titre_topic"><?php echo $titre['titre_topic'];?></p>
    <div id='toutes_les_reponses' class="all_answer">
        <?php
        foreach ($messages as $message) {
            echo "<div class ='reponses'>";
            echo "<p class='pseudo_forum'> " . $message['auteur'] . " </p>";
            
            if (isset($message['destinataire'])) {
                echo "<div class='citation'> <p> Réponse à : ". $message['destinataire'] . " :  " . $message['message_source'] . " </p> </div>";
            }
            echo " <p class='message'> " . $message['contenu_mess'] . " </p> ";
            echo "<p style='display:inline;'> Posté le : " . $message['date_poste'];
            if(isset($_SESSION["user"]) && $_SESSION["admin"] == "oui"){
                echo '<form method="post" class="right"  >
                        
                        <input class="suppr_newTopic" type="submit" name="supprMessage" value="Supprimer message"/>
                        <input type="hidden" name="id_mess" value="'.$message['id_message'].'">                        
                    </form>';
            }
            echo "</p> </div> </br>";

            
        }
        ?>
        
    </div>


<?php
    if(isset($_SESSION["user"])){

      echo '  <div id="nouveau_mess" class="new_topic">
            
            <form class="form_newTopic" method="post">
            <h3>Ecrire un nouveau message</h3>
                <textarea class="msg_newTopic" placeholder="Redigez votre message.." name="message" rows="15" cols="50" required></textarea> </br>
               
                 <input type="hidden" name="id_suj" value="'.$idTopic.'">
                
                <input class="btn_newTopic" type="submit" name="postMessage" value="Envoyez"/>
                <input type="hidden" name="id_message_cite" id="id_message_cite" value="">
                <input type="hidden" name="id_auteur_message_cite" id="id_auteur_message_cite" value="">
            </form>
        </div>';
    }
?>
</div>
<?php

    if(isset($_SESSION["user"]) && $_SESSION["admin"] == "oui"){
        echo '<form id="change_etat_topic" class="etat_topic" method="POST">
              <input type="hidden" name="id_topic" value="'. $_GET['id_topic']  .'">

              <label for="etat_topic">État du topic :</label>
              <select name="etat_topic" id="etat_topic">
                <option value="ouvert">Ouvert</option>
                <option value="ferme">Fermé</option>
              </select>
              <br>
              <input class="suppr_newTopic" type="submit" name="bouton_change_etat_topic" value="Changer état" />
            </form>';
            }

?>

<a class="btn_retour" href="?p=forum"> Retour à la liste des sujets </a>

