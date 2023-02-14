<?php
include 'connect.env'; 
include 'header.php'
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des abonnements de
                    l'utilisatrice
                    n° <?php echo intval($_GET['user_id']) ?>
                    est abbonée
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                
                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }
               
                
                while ($tag = $lesInformations->fetch_assoc())
                {
                    
                    ?>

                   <article>
                    <img src="user.jpg" alt="blason"/>
                    <h3><strong><?php echo $tag['alias'] ?></strong></h3>
                    <p><?php echo $tag['email'] ?></p> 
                    <p><?php echo $tag['id'] ?></p>                   
                </article>
                <?php } ?>
                
            </main>
        </div>
    </body>
</html>
