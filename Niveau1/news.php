<?php
include 'connect.env';
include 'header.php';
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Actualités</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div id="wrapper">
        <aside>
            <img src="user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez les derniers messages de
                    tous les utilisatrices du site.</p>
            </section>
        </aside>
        <main>
            <?php
            /*
            // C'est ici que le travail PHP commence
            // Votre mission si vous l'acceptez est de chercher dans la base
            // de données la liste des 5 derniers messsages (posts) et
            // de l'afficher
            // Documentation : les exemples https://www.php.net/manual/fr/mysqli.query.php
            // plus généralement : https://www.php.net/manual/fr/mysqli.query.php
            */



            //verification
            if ($mysqli->connect_errno) {
                echo "<article>";
                echo ("Échec de la connexion : " . $mysqli->connect_error);
                echo ("<p>Indice: Vérifiez les parametres de <code>new mysqli(...</code></p>");
                echo "</article>";
                exit();
            }

            // Etape 2: Poser une question à la base de donnée et récupérer ses informations
            // cette requete vous est donnée, elle est complexe mais correcte, 
            // si vous ne la comprenez pas c'est normal, passez, on y reviendra
            $laQuestionEnSql = "SELECT posts.content,
            posts.created,
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
        LIMIT 5;
        
                    "; // query pour select les tag SELECT * FROM `posts` WHERE `content` LIKE '%#tagname%'
            
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo "<article>";
                echo ("Échec de la requete : " . $mysqli->error);
                echo ("<p>Indice: Vérifiez la requete  SQL suivante dans phpmyadmin<code>$laQuestionEnSql</code></p>");
                exit();
            }

            // Etape 3: Parcourir ces données et les ranger bien comme il faut dans du html
            // NB: à chaque tour du while, la variable post ci dessous reçois les informations du post suivant.
            while ($post = $lesInformations->fetch_assoc()) {
                ?>
            <?php require("post.php")?>

            <?php
                // avec le <?php ci-dessus on retourne en mode php 
            } // cette accolade ferme et termine la boucle while ouverte avant.
            ?>

        </main>
    </div>
</body>

</html>
