<?php 
/**
 * Réinitialiser les variables de la superglobale $_SESSION à zéro
 */
    if ( isset($_SESSION['connected_id']) ) {
        session_unset($_SESSION['connected_id']);
    }   
?>

<!-- Renvoyer vers le formulaire de connexion de la page login -->
<html>
<meta http-equiv="refresh" content="1; url=login.php" />
</html>
