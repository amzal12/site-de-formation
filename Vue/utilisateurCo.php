<!--Vue qui affiche la partie droite du navBar quand l'utilisateur est connecté -->

<div class="side-profil">

        <div class="h-side-profil">
           <p class="h-h">Salut !</p>  <button class="btn_close_login"></button>
       </div>
   
       
           <div class="login">
            <img src="https://media.idownloadblog.com/wp-content/uploads/2017/03/Twitter-new-2017-avatar-001.png" class="side-pic"> 
            <p class="logo"><?php echo $_SESSION['user']?></p> 
           
       </div>
   
           <form class="log_form" method="GET">
              <button type="text" class="btn-side-profil" name="p" value="profil"> PROFIL </button>
</form>
<form class="log_form" method="POST">
                
      <em>Changer thème : </em>
<!--SWITCH COULEUR-->
      <div class="theme-switch-wrapper"> 
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
        </label>
      </div>
               <label class="unlog_label">
               <button class="btn_disconnect" name="action" value="deco">Deconnexion</button>
                   
               </label>
             
           </form>
           
   
       
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





const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);




function switchTheme(e) {
    if (e.target.checked) {
        document.documentElement.setAttribute('data-theme', 'dark');
        localStorage.setItem('theme', 'dark'); //add this
    }
    else {
        document.documentElement.setAttribute('data-theme', 'light');
        localStorage.setItem('theme', 'light'); //add this
    }    
}


const currentTheme = localStorage.getItem('theme') ? localStorage.getItem('theme') : null;

if (currentTheme) {
    document.documentElement.setAttribute('data-theme', currentTheme);

    if (currentTheme === 'dark') {
        toggleSwitch.checked = true;
    }
}
</script>