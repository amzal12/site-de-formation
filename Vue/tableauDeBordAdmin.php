<!--Vue qui affiche le tableau admin quand on clique sur l'onglet "Panel Admin"-->


<!--Un css temporaire-->
<style>
      /* Style de la bulle rectangulaire qui contient le panneau */
      .panneau-admin {
        background-color: #f2f2f2;
        border: 2px solid #ddd;
        border-radius: 10px;
        box-shadow: 0px 0px 10px #888;
        width: 800px;
        margin: auto;
        padding: 20px;
        margin-top: 200px;
      }

      /* Style de la liste des étudiants */
      .liste {
        list-style-type: none;
        margin: 0;
        padding: 0;
      }

      .element_liste {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
        padding: 10px;
      }

      .admin {
        color: red;
      }

      /* Style de la barre de recherche */
      #search {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 5px;
        margin-bottom: 10px;
        float: right;
      }

      /* Style des boutons d'administration */
      .admin-buttons button {
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        cursor: pointer;
      }

      .titre_liste {
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 170px;
      }

      .admin-buttons button:hover {
        background-color: #3e8e41;
      }

      /* Style de la liste des cours */
      .cours {
        margin-top: 20px;
      }


      .cours ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
      }

      .cours li {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #ddd;
        padding: 10px;
      }

      /* Style des boutons de suppression de cours */
      .cours-buttons button {
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        margin-right: 5px;
        cursor: pointer;
      }

      .cours-buttons button:hover {
        background-color: #d32f2f;
      }
    </style>




    <div class="panneau-admin">
      <h1>Panneau Admin</h1>
      <input type="text" id="search" placeholder="Rechercher un étudiant...">
      <br/>
      <br/>
      <br/>
      <h2>Liste des utilisateurs</h2>
      <ul class="liste">
        <li class="element_liste">
          <span><strong>Pseudo</strong></span>
          <span><strong>Adresse mail</strong></span>
          <div class="titre_liste"> </div>
        </li>


        <?php

        foreach($utilisateurs as $utilisateur)
        {
            echo'
                <form method="POST">
                <li class="element_liste">
                    <input type="hidden" name="p" value="panAdmin"/>
                    <input type="hidden" name="id" value="'.$utilisateur['id_user'].'"/>
                <span ';

            if($utilisateur['id_role']==1)
                echo 'class="admin"';
            echo '
                    >'.$utilisateur['pseudo'].'</span>
                    <span>'.$utilisateur['mail'].'</span>
                    <div class="admin-buttons" method="POST">
            ';

            if($utilisateur['id_role']!=1)
                echo '  <button name="admin" value="passeAdmin">Admin</button>';
            
            echo '
                        <button name="admin" value="suppEtu">Supprimer</button>
                    </div>
                </li>
                </form>
            ';
        }

        ?>

        <!-- Ajouter ici plus d'éléments de liste pour les autres étudiants -->
      </ul>
      
      <div class="cours">
      <h2>Liste des cours</h2>
        <ul class="liste">


        <?php

        foreach($cours as $cour)
        {
            echo'
            <form method="post">
            <li class="element_liste">
                <input type="hidden" name="id" value="'.$cour['id_groupe'].'"/>
                <span>'.$cour['nom_groupe'].'</span>
                <div class="cours-buttons">
                <button name="admin" value="suppCours">Supprimer</button>
                </div>
            </li>
            </form>
            ';
        }
        ?>


          <!-- Ajouter ici plus d'éléments de liste pour les autres cours -->
        </ul>
      </div>
    </div>