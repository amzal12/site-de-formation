<div class="index_cour_qcm">

            <?php
            //On vérifie si l'utilisateur est admin ou pas pour afficher le panneau d'ajout de cours
            if($_SESSION["admin"]=='oui'){
            echo '
                <form class="admin_add_cour" method="post">
                    <h2>Ajouter un nouveau cours</h2>
                    <input type="text" name="nomCours" id="add_cour" required><br>
                    <button class="btn-admin" name="cours" value="ajout" id="btn-ajout">Ajouter</button>
                </form>
            ';
            }
            ?>

            <p class="titre"><?php echo $groupe['nom_groupe'];?></p>

            <h2>Votre niveau : <?php echo $niveau[0]['niveau']?></h2>

            <div id="lecons">
 
            <?php
            foreach($cours as $cour)
            {
                echo "<form class='lecon' method='POST'>";
                echo '<input type="hidden" name="idCQ" value="'.$cour['id_cours'].'"/>';
                echo "<div>".$groupe['nom_groupe']." - ".$cour['nom_cours'];
                if($_SESSION['admin']=='oui')
                    echo "<button name='action' value='suppCQ' class='suppr_newTopic' style='margin-left:40px'>Supprimer</button> ";
                echo "</div>";

                echo "</form>";
                echo "<div class='deroulante'>";
                echo "<div class='lecon_cour' 
                    onclick=\"window.location='?p=indCours&idG=".$id_groupe."&idC=".$cour['id_cours']."'\">
                    Cours - ".$cour['nom_cours']."</div>";
                    echo "<div class='lecon_cour' 
                    onclick=\"window.location='?p=indCours&idG=".$id_groupe."&idQ=".$qcms[$cour['id_cours']]['id_qcm']."'\">
                    QCM - ".$cour['nom_cours']."</div>";
                echo "</div>";
            }
            ?>


            </div>

</div>