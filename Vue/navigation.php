<!--Vue qui génère notre barre de navigation, c'est en modifiant la variable "p" du GET qu'on change de page-->


<nav class="navbar">
        <a href="?p=accueil" class="logo">TROIS MOUSCODEURS</a>
        <div class="nav-links">
            <ul>
                <?php

                /*
                * Modifier les conditions pour avoir une navBar cohérente
                * J'ai pas trop taffer dessus, j'enlève de la navbar la page sur laquelle on
                * est mais j'pense que c'est pas forcément nécessaire, à voir
                */

                if(isset($_SESSION['user']) && $_SESSION['admin']=='oui')
                    echo '<li class="li_nav"><a href="?p=panAdmin" >Panel Admin</a></li>';
                    echo '<li class="li_nav"><a href="?p=forum" >Forum</a></li>';
                if(!isset($_SESSION['user']))
                    echo '<li class="li_nav"><a href="#forma" >Nos formations</a></li>';
                else
                    echo '<li class="li_nav"><a href="?p=indCours" >Cours</a></li>';

                    
                if(!isset($_SESSION['user']))
                    echo '<li class="li_nav"><a href="#propos" >À propos</a></li>';

                
                if(!isset($_SESSION['user']))
                    echo '<button class="btn_login">Connexion</button>';
                else
                    echo '<img src="https://media.idownloadblog.com/wp-content/uploads/2017/03/Twitter-new-2017-avatar-001.png" class="user-pic">';
                ?>
            </ul>
        </div>
    </nav>