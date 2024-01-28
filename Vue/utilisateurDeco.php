<!--Vue affiché à droite de la navBar pour afficher un bouton de connexion quand l'utilisateur est déconnecté-->

<div class="side-login">

     <div class="h-login">
        <p class="h-h">Bon retour !</p>  <button class="btn_close_login"></button>
    </div>


        <div class="login"> <p class="logo">NOM SITE</p> 
        <p>pas encore chez nous ? <a href="#" class="a-register">je m'inscris !</a></p>
    </div>

        <form class="log_form" method="POST">
            <label class="log_label">Adress email <input type="email" name="addMail" class="log_input" required></label>
            <label class="log_label">Mot de passe <input type="password" name="mdp" class="log_input" required></label>
            <label><input type="checkbox" name="memo" > Se souvenir de moi</label>
            <label class="log_label">
            <button class="btn_connect" name="action" value="co" type="submit">Je me connecte</button>
                
            </label>
            <a href="#">j'ai oublié mon mot de passe</a>
        </form>
        

    <div class="connect">
        

        <p class="blabla">Vos données blablabla Lorem ipsum machin chouette on revend vos données au bingladesh.</p>
    </div>
    </div>



<!-- Side Register -->
<div class="side-register">

    <div class="h-login">
       <p class="h-h">Bienvenue parmis nous !</p>  <button class="btn_close_login"></button>
   </div>


    <div class="register"> <p class="logo">REGISTER</p> 
    <p> vous possedez un compte ? <a href="#" class="a-connecte">je me connecte !</a></p>
    </div>

       <form class="log_form" method="POST">
           
           <label class="reg_label">Pseudo <input type="text" name="pseudo" class="log_input" required></label>
           <label class="reg_label">Adress email <input type="email" name="addMail" class="log_input" required></label>
           <label class="reg_label">Mot de passe <input type="password" name="mdp" class="log_input" required></label>
           <label class="reg_label">Confirmez le mot de passe<input type="password" name="confMdp" class="log_input" required></label>
           <label class="log_label"><button class="btn_connect" name="action" value="inscription">Je m'inscris !</button></label>
          
       </form>
       

   <div>
       <p class="blabla">* Champs obligatoires.</p>
   </div>
   </div>


   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script>

/* bouton connexion */
$(document).ready(function(){
  $(".btn_login").click(function(){
    $(".side-login").css("display", "block");
  });
});

/* bouton profil */
$(document).ready(function(){
  $(".user-pic").click(function(){
    $(".side-profil").css("display", "block");
  });
});

/* fermer side connexion/register/profil */
$(document).ready(function(){
  $(".btn_close_login").click(function(){
    $(".side-login").css("display", "none");
    $(".side-register").css("display", "none");
    $(".side-profil").css("display", "none");
  });
});

/* bouton login -> register*/
$(document).ready(function(){
  $(".a-register").click(function(){
    $(".side-register").css("display", "block");
    $(".side-login").css("display", "none");
  });
});

/* bouton register -> login */
$(document).ready(function(){
  $(".a-connecte").click(function(){
    $(".side-register").css("display", "none");
    $(".side-login").css("display", "block");
  });
});
</script>