<?php
include '../assets/notConnected.php';
include '../assets/header.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>URB.exe - news</title>
    <meta name="author" content="Klervy, Corentin, Nadège">
    <link rel="stylesheet" href="../style.css" />
</head>

<body>
    <div id="wrapper">
        <aside>
            <img src="../img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Quoi d'neuf docteur ?</h3>
                <p>Les dernières news de nos utilisateurs.trices !</p>
            </section>
        </aside>
        <?php require("../assets/likes_management.php"); ?>
        <main>
            <?php
            if ($mysqli->connect_errno) {
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                exit();
            }

            $laQuestionEnSql = "SELECT posts.content,
            posts.created,
            posts.id,
            users.alias as author_name,
            users.id as author_id,
            posts.parent_id as enfant_post_id,
            count(likes.id) as like_number,
            GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.label) AS taglist,
            GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.label) AS tagidlist
            FROM posts
            JOIN users ON users.id=posts.user_id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
            LEFT JOIN tags ON posts_tags.tag_id  = tags.id
            LEFT JOIN likes ON likes.post_id  = posts.id
            GROUP BY posts.id
            ORDER BY posts.created DESC
            LIMIT 15"; // query pour select les tag SELECT * FROM `posts` WHERE `content` LIKE '%#tagname%'
            
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            // Parcourir ces données et les ranger bien comme il faut dans du html
            // NB: à chaque tour du while, la variable post ci dessous reçois les informations du post suivant.
            while ($post = $lesInformations->fetch_assoc()) {
                if ($post['enfant_post_id'] == null) {
                    require("../assets/post.php");
                }
            } ?>

        </main>
    </div>
</body>

</html>