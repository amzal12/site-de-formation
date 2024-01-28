<?php

//Si l'utilisateur est connecté, on lui recommande des cours/QCM sinon on lui montre la page d'index
if(isset($_SESSION['user']))
{
    $_pdo->getNiveauUser($_SESSION['user_id']);
    if($_pdo)
    include("Vue/recommandation.php");
}
else 
    include("Vue/index.php");

?>
