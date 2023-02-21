<?php
    include '../assets/header.php';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>KleCoNa - Connexion</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper" >
            <aside>
                <h2>Présentation</h2>
                <p>Bienvenue sur notre réseau social.</p>
            </aside>
            <main>
                <article>
                    <h2>Connexion</h2>
                    <?php
                    /**
                     * TRAITEMENT DU FORMULAIRE
                     */
                    // Vérifier si on est en train d'afficher ou de traiter le formulaire
                    $enCoursDeTraitement = isset($_POST['email']);
                    if ($enCoursDeTraitement)
                    {
                        $emailAVerifier = $_POST['email'];
                        $passwdAVerifier = $_POST['motpasse'];

                        // Ouvrir une connexion avec la base de donnée.
                        $mysqli = new mysqli("localhost", "root", "root", "socialnetwork");
                        // Petite sécurité pour éviter les injection sql :
                        $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                        $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                        // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                        $passwdAVerifier = md5($passwdAVerifier);
                        // Construction de la requete
                        $lInstructionSql = "SELECT * FROM users WHERE email LIKE '$emailAVerifier'";
                        // Vérification de l'utilisateur
                        $res = $mysqli->query($lInstructionSql);
                        $user = $res->fetch_assoc();
                        if ( ! $user OR $user["password"] != $passwdAVerifier)
                        {
                            echo "La connexion a échoué. ";
                            
                        } else
                        {
                            echo "Votre connexion est un succès, " . $user['alias'] . ". Redirection vers votre feed.";
                            // Se souvenir que l'utilisateur s'est connecté pour la suite
                            $_SESSION['connected_id']=$user['id'];
                            $_SESSION['user_alias']=$user['alias'];
                        ?>
                        <meta http-equiv="refresh" content="1; url=feed.php?user_id=<?php echo $_SESSION['connected_id'] ?>" />
                        <?php
                        }
                    }
                    ?>                     
                    <form action="login.php" method="post">
                        <input type='hidden'name='???' value='achanger'>
                        <dl>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email'name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password'name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                    <p>
                        Pas de compte?
                        <a href='registration.php'>Inscrivez-vous.</a>
                    </p>
                </article>
            </main>
        </div>
    </body>
</html>
