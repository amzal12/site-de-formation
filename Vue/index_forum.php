<div class="index_newTopic">
<link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">


		<div id="liste_sujets" class="lst_sujets">
		<h1> Notre forum </h1>

			<?php

			echo ' <form method="post" class="rechercheTopic">
						<h4> Rechercher un topic </h4>
						<label> </label>
						<input type="text" class="search_bar" placeholder="Recherche" name="mot_recherche" required/>
						<input class="btn_recherche_topic" type="submit" name="btn_recherche_topic" value="Rechercher"/>
					</form>';
               
                foreach ($topics as $topic) {
					echo "<div class='sujets' ";

					if($topic['etat']=="ouvert"){
						echo ">";
					   }
						else{
						echo "style=background-color:grey;>";
						}

                    echo "<a class='a_sujet' href='?p=forum&id_topic=".$topic['id_topic']."'>" . "<div class='titre_sujet'>" .  $topic['titre_topic'] . "</div>" . "   <div class='side_sujet'> Etat :  " . $topic['etat'] ;


					 
					 
					
					  echo "  " . $topic['date_derniere_maj'] . " </div> " ;
					if(isset($_SESSION["user"]) && $_SESSION["admin"] == "oui"){
		                echo '<form method="post">
		                        
		                        <input class="suppr_newTopic" type="submit" name="supprTopic" value="Supprimer topic"/>
		                        <input type="hidden" name="id_topi" value="'.$topic['id_topic'].'">                        
		                    </form>';
          			  }		else {

          			  }	
					  echo "</a>";
					echo "</div>";
                     

                    
                }
			?>
		</div>

		<?php

			if(isset($_SESSION["user"])){

				echo '<div id="nouveau_topic" class="new_topic">

				

				

				<form method="post" class="form_newTopic">
				<h3> Créer un nouveau topic</h3>
					<label> </label> <textarea class="title_newTopic" placeholder="Ecrivez votre titre ici" name="titre" rows="1" cols="50" required></textarea> </br>
					<label> </label> <textarea class="msg_newTopic" placeholder="Rédigez votre message" name="message" rows="15" cols="50" required></textarea> </br>

					<input class="btn_newTopic" type="submit" name="postTopic" value="Envoyer"/>

				</form>
				

	        </div>';

			}
			
       ?>
</div>

