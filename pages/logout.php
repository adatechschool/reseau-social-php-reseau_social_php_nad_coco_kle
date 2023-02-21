<?php 
session_start();
    if ( isset($_SESSION['connected_id']) ) {
        unset($_SESSION['connected_id']);
    }   
?>
<!-- Renvoyer vers le formulaire de connexion de la page login -->
<html>
<meta http-equiv="refresh" content="1; url=login.php" />
</html>
