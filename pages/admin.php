<?php
    include '../assets/notConnected.php';
    include '../assets/header.php'
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>URB.exe - admin</title> 
        <meta name="author" content="Klervy, Corentin, Nadège">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper" class='admin'>
            <aside>
                <h2>Mots-clés</h2>
                <?php
                //Trouver tous les mots clé 
                $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Vérification
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }
               
                while ($tag = $lesInformations->fetch_assoc())
                {?>
                    <article>
                        <h3><?php echo $tag['label'] ?></h3>
                        <p></p>
                        <nav>
                            <a href="tags.php?tag_id=<?php echo $tag['id']?>">#<?php echo $tag['label'] ?></a>
                        </nav>
                    </article>
                <?php } ?>
            </aside>
            <main>
                <h2>Utilisatrices</h2>
                <?php

                $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
                $lesInformations = $mysqli->query($laQuestionEnSql);

                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                    exit();
                }

                while ($tag = $lesInformations->fetch_assoc())
                {
                    ?>
                    <article>
                        <h3><?php echo $tag['alias'] ?></h3>
                        <p><?php echo $tag['id'] ?></p>
                        <nav>
                            <a href="wall.php?user_id=<?php echo $tag['id'] ?>">Mur</a>
                            | <a href="feed.php?user_id=<?php echo $tag['id'] ?>">Flux</a>
                            | <a href="settings.php?user_id=<?php echo $tag['id'] ?>">Paramètres</a>
                            | <a href="followers.php?user_id=<?php echo $tag['id'] ?>">Suiveurs</a>
                            | <a href="subscriptions.php?user_id=<?php echo $tag['id'] ?>">Abonnements</a>
                        </nav>
                    </article>
                <?php } ?>
            </main>
        </div>
    </body>
</html>
