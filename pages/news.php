<?php
    include '../connect.env';
    include '../assets/header.php';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <aside>
                <img src="../img/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez les derniers messages de
                        tous les utilisatrices du site.</p>
                </section>
            </aside>
            <main>        
                <?php
                if ($mysqli->connect_errno)
                {
                    echo "<article>";
                    echo("Échec de la connexion : " . $mysqli->connect_error);
                    echo("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                    echo "</article>";
                    exit();
                }

            $laQuestionEnSql = "SELECT posts.content,
            posts.created,
            posts.id,
            users.alias as author_name,
            users.id as author_id,
            count(likes.id) as like_number,
            GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.id) AS taglist,
            GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.id) AS tagidlist
        FROM posts
        JOIN users ON users.id=posts.user_id
        LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
        LEFT JOIN tags ON posts_tags.tag_id  = tags.id
        LEFT JOIN likes ON likes.post_id  = posts.id
        GROUP BY posts.id
        ORDER BY posts.created DESC
        LIMIT 5"; // query pour select les tag SELECT * FROM `posts` WHERE `content` LIKE '%#tagname%'
            
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo "<article>";
                echo ("Échec de la requete : " . $mysqli->error);
                echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
                exit();
            }

                // Parcourir ces données et les ranger bien comme il faut dans du html
                // NB: à chaque tour du while, la variable post ci dessous reçois les informations du post suivant.
                while ($post = $lesInformations->fetch_assoc())
                {           
                ?>
            <?php require("../assets/post.php")?>

            <?php
            }
            ?>

        </main>
    </div>
</body>

</html>
