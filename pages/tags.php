<?php
    include '../assets/notConnected.php';
    include '../connect.env'; 
    include '../assets/header.php'
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>URB.exe - tags</title> 
        <meta name="author" content="Klervy, Corentin, Nadège">
        <link rel="stylesheet" href="../style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <?php
            // Le mur concerne un mot-clé en particulier
            $tagId = intval($_GET['tag_id']);
            ?>
            
            <aside>
                <?php

                // Récupérer le nom du mot-clé
                $laQuestionEnSql = "SELECT * FROM tags WHERE id= '$tagId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $tag = $lesInformations->fetch_assoc();
                ?>
                <img src="../img/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>#TAGS</h3>
                    <p>Les dernières news à propos de
                        <br># <?php echo $tag['label'] ?>
                    </p>

                </section>
            </aside>
            <?php require("../assets/likes_management.php"); ?>
            <main>
                <?php
                // Récupérer tous les messages avec un mot clé donné
                $laQuestionEnSql = "
                    SELECT posts.content,
                    posts.created,
                    posts.id,
                    users.alias as author_name,
                    users.id as author_id,  
                    count(likes.id) as like_number,  
                    GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.label) AS tagidlist
                    FROM posts_tags as filter 
                    JOIN posts ON posts.id=filter.post_id
                    JOIN users ON users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE filter.tag_id = '$tagId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }

                // Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
                while ($post = $lesInformations->fetch_assoc())
                {
                    require("../assets/post.php");
                } ?>
            </main>
        </div>
    </body>
</html>