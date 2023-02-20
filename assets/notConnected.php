<?php
    //vérification si le membre est passé par la page de login :
    if(!isset($_SESSION['user_alias'])){
        $msg = "Désolé, vous devez être identifié pour acceder au site.";
        // si la variable de session login n'est pas enregistré : retour sur la page index.php
        header("location:../pages/registration.php?msg=$msg");
    }
?>