<?php
    session_start();
    //vérification si le membre est passé par la page de login :
    if(!isset($_SESSION['connected_id'])){
        $msg = "Désolé, vous devez être identifié pour acceder au site.";
        // si la variable de session login n'est pas enregistré : retour sur la page de connection
        header("location:../pages/registration.php?msg=$msg");
    }
?>