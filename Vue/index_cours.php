<div class="index_cours">

<?php
//Si l'utilisateur est admin, on lui affiche le panneau d'ajout de groupe
if($_SESSION["admin"]=='oui'){
  echo '
    <form class="admin_add_cour" method="post">
        <h2>Ajouter un nouveau cours</h2>
        <input type="text" name="nomCours" id="add_cour" required><br>
        <button class="btn-admin" name="cours" value="ajoutG" id="btn-ajout">Ajouter</button>
    </form>
  ';
}

?>


  <h1>Hey <?php echo $_SESSION['user'];?> !</h1>

 

  <div id="cours">
  <h2>Cours</h2>

    <?php
      foreach($groupes as $groupe)
      {
        echo "<div class='cour' onclick=\"window.location='?p=indCours&idG=".$groupe['id_groupe']."'\">".$groupe['nom_groupe']."</div>";
      }
    ?>

  </div>

</div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

/* BOUTONS ADMINS  */

/*$(document).ready(function(){
  $("#btn_ajout").click(function(){
    
  });
});

$(document).ready(function(){
  $("#btn_modif").click(function(){
    $(".side-profil").css("display", "none");
  });
});

$(document).ready(function(){
  $("#btn_suppr").click(function(){
    $(".side-profil").css("display", "none");
  });
});*/



/* AJOUT DE COURS  */
let cours_div = document.querySelector('div[id$="cours"]');

function ajoutCour(nomCour)
{
  let newCour = document.createElement("div");
  newCour.textContent=nomCour;
 newCour.className = 'cour';
 cours_div.append(newCour);
 cours_div.appendChild(newCour);
 
};


//ajoutCour("CSS");






</script>
</body>

</html>