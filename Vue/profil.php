<!--Vue qui affiche le profil d'un utilisateur de l'onglet "Profil" -->

<div class="index_profil">
        <div class="profil-box">
            <div>
                <img src="https://media.idownloadblog.com/wp-content/uploads/2017/03/Twitter-new-2017-avatar-001.png" class="user-pic-1">
            </div>
            <div class="white">
                <h1 id="Pseudo" class="padtop_p"   style="text-decoration: underline;"><?php echo $infos['pseudo']?></h1>
                <h3 id="Age"  class="padtop_p">Age: <?php echo $infos['age']?></h3>
                <h3 id="Anniv"  class="padtop_p">Anniversaire: <?php echo $infos['anniv']?></h3>
                <p id="Bio" class="bio_p"><?php echo $infos['bio']?></p>
        </div>
       <div> <a href="?p=accueil&action=deco" ><button class="btn_disconnect btn_discoprofile" name="action" value="deco">Deconnexion</button></a> 
       <button class="btn_modifprofile" name="action" value="modif">Modifier</button> 
    </div>
</div>

<div class="edit-box">
            <div>
                <img src="https://media.idownloadblog.com/wp-content/uploads/2017/03/Twitter-new-2017-avatar-001.png" class="user-pic-1">
            </div>
            <div class="white">
        <form method="POST">
                <input id="Pseudo_modif" class="bio_txt"  placeholder="Votre pseudo" name="pseudo" value=<?php echo "'".$infos['pseudo']."'"?>></input>
                <input id="Age_modif" placeholder="Votre age" class="bio_txt" name="age" value=<?php echo "'".$infos['age']."'"?>></input>
                <input id="Anniv_modif" placeholder="Votre date d'anniversaire" class="bio_txt" name="anniv" value=<?php echo "'".$infos['anniv']."'"?>></input>
                <textarea id="Bio_modif" placeholder="Votre Bio" class="bio_textarea" name="bio" ><?php echo $infos['bio']?></textarea>
        </div>
       <div> <button class="btn_disconnect btn_discoprofile annule_modif" name="action" value="annuler_modif">Annuler</button>
       <button class="btn_modifprofile valide_profile" name="action" value="valider_modif">Valider</button> 
       </form>
    </div>
       </div>


<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>

$(document).ready(function(){
  $(".btn_modifprofile").click(function(){
    $(".profil-box").css("display", "none");
    $(".edit-box").css("display", "block");
  });
});

$(document).ready(function(){
  $(".annule_modif").click(function(){
    $(".profil-box").css("display", "block");
    $(".edit-box").css("display", "none");
   
    $(".bio_txt").val("");
    $(".bio_textarea").val("");
  });
});

</script>
