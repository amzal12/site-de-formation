<!--Vue qui affiche le contenu d'un cours -->


<div class="index_cours">

    <?php
    //Si l'utilisateur est admin, alors on lui affiche le panneau qui permet de modifier le cours
    if($_SESSION["admin"]=='oui'){
        $contenu_admin = '
            <form class="admin_add_cour" method="post">
                <h2>Modifier le cours ?</h2>
                <button class="btn-admin" name="cours" value="modif">Modifier</button>
            </form>';
        if(!isset($_POST["cours"]))
        {
            echo $contenu_admin;
        } else {
            if($_POST["cours"] != "modif") {
                echo $contenu_admin;
            }
        }
    }

    ?>

    <?php
    //On charge le contenu du cours dans un string
    $contenu_cours = '
        <h1>'.$cour['nom_cours'].'</h1>
        <br/>
        <h2>Difficulté : '.$cour['difficulte'].' </h2>
        <br/>
        <p>'.nl2br($cour['contenu_cours']).'</p>
        <br/>
    ';

    if(isset($_POST["cours"])){
        //Si le cours est en mode "modifié", alors on lui montre le formulaire pour modifier le cours
        if($_POST["cours"] == "modif")
        {
            echo '
                <form method="post">
                <label for="titreCours">Nom du cours :</label>
                <input type="text" name="titreCours" value="'.$cour['nom_cours'].'"required><br><br>
            
                <label for="difficulte">Difficulté :</label>
                <select id="difficulte" name="difficulte">
                <option value="facile">Facile</option>
                <option value="intermédiaire">Intérmédiaire</option>
                <option value="difficile">Difficile</option>
                </select><br><br>
            
                <label for="contenuCours">Contenu du cours :</label><br>
                <textarea id="contenu-cours" name="contenuCours" rows="10" cols="50" required>'.$cour['contenu_cours'].'</textarea>
                <br/>
                <label for="import">Importer fichier :</label>
                <input type="file" name="fileToUpload">
                <br><br>
            
                <input type="submit" name="cours" value="Valider">
                </form>
            ';
        //Si non on affiche simplement le contenu du cours
        } else {
            echo $contenu_cours;
        }
    } else 
        echo $contenu_cours;

    //Retour à la page de sélection de cours
    echo "<a href='?p=indCours&idG=".$id_groupe."'.>Retour index cours</a>";
    ?>

    
</div>
