<?php
include 'connect.env';
include 'header.php'
    ?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Actualités</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
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

            // Etape 2: Poser une question à la base de donnée et récupérer ses informations
            // cette requete vous est donnée, elle est complexe mais correcte, 
            // si vous ne la comprenez pas c'est normal, passez, on y reviendra
            $laQuestionEnSql = "SELECT posts.content,
                posts.created,
                users.alias as author_name,  
                count(likes.id) as like_number,  
                GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.id) AS taglist,
                GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.id) AS tagidlist
                FROM posts
                JOIN users ON  users.id=posts.user_id
                LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                LEFT JOIN likes      ON likes.post_id  = posts.id 
                GROUP BY posts.id
                ORDER BY posts.created DESC  
                LIMIT 5
                    "; // query pour select les tag SELECT * FROM `posts` WHERE `content` LIKE '%#tagname%'
            
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

                    <article>
                        <h3>
                            <time><?php echo $post['author_name'] ?></time>
                        </h3>
                        <address><?php echo $post['created'] ?></address>
                        <div>
                            <p><?php echo $post['content'] ?></p>
                        </div>
                        <footer>
                            <small>❤<?php echo $post['like_number'] ?></small>
                            <?php echo $post['tags.id'] ?>
                            <a href="tags.php?tag_id=<?php echo $post['taglist']?>">#<?php echo $post['taglist'] ?></a>,
                        </footer>
                    </article>
                    <?php
                }
                ?>

        </main>
    </div>
</body>

</html>