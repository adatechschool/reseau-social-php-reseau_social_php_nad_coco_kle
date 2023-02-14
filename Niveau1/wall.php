<?php
include 'connect.env';
include 'header.php'
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div id="wrapper">
        <?php
        $userId = intval($_GET['user_id']);
        ?>

        <aside>
            <?php
            /* Etape 3: récupérer le nom de l'utilisateur*/
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            ?>

            <img src="user.jpg" alt="Portrait de l'utilisatrice" />

            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez tous les message de l'utilisatrice :
                    <?php echo $user["alias"] ?>
                    (n°
                    <?php echo $userId ?>)
                    <?php if ($user["user_id"] != 5)?>
                    <form method="POST" action="wall.php">
                     <input type="hidden" name="user_id" value="<?php echo $userId ?>">
                    <button type="submit">S'abonner à <?php echo $user["alias"] ?></button>
                    </form>
                </p>
            </section>

            <section>
                <form method="post" action="wall.php?user_id= <?php echo $userId ?>">
                    <dl>
                        <dt><label for='postToSend'>Ecrivez içi</label></dt>
                        <dd><input type='text' name='postToSend'></dd>
                    </dl>
                    <input type='submit'>
                </form>
            </section>

            <?php

            // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
            $enCoursDeTraitement = isset($_POST['postToSend']);
            if ($enCoursDeTraitement) {
                // Etape 2: récupérer ce qu'il y a dans le formulaire 
                $new_post = $_POST['postToSend'];
                //Etape 4 : Petite sécurité
                $new_post = $mysqli->real_escape_string($new_post);
                //Etape 5 : construction de la requete
                $lInstructionSql = "INSERT INTO posts 
                                    (id, user_id, content, created, parent_id)
                                    VALUES 
                                    (NULL, '  $userId  ','  $new_post  ', NOW(), NULL)";
                // Etape 6: exécution de la requete
                $ok = $mysqli->query($lInstructionSql);
                if (!$ok) {
                    echo "Le post a échouée : " . $mysqli->error;
                } else {
                    echo "Le post est envoyé : " . $new_post;
                }
            }
            ?>
        </aside>

        <main>
            <?php
            /**
             * Etape 3: récupérer tous les messages de l'utilisatrice
             */
            $laQuestionEnSql = "
                    SELECT posts.content, posts.created, users.alias as author_name, 
                    COUNT(likes.id) as like_number, GROUP_CONCAT(DISTINCT tags.label) AS taglist 
                    FROM posts
                    JOIN users ON  users.id=posts.user_id
                    LEFT JOIN posts_tags ON posts.id = posts_tags.post_id  
                    LEFT JOIN tags       ON posts_tags.tag_id  = tags.id 
                    LEFT JOIN likes      ON likes.post_id  = posts.id 
                    WHERE posts.user_id='$userId' 
                    GROUP BY posts.id
                    ORDER BY posts.created DESC  
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
            }

            /**
             * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
             */
            while ($post = $lesInformations->fetch_assoc()) {

                // echo "<pre>" . print_r($post, 1) . "</pre>";
                ?>
                <article>
                    <h3>
                        <time datetime='2020-02-01 11:12:13'>31 février 2010 à 11h12</time>
                    </h3>
                    <address>par
                        <?php echo $post["author_name"] ?>
                    </address>
                    <div>
                        <p>
                            <?php echo $post["content"] ?>
                        </p>
                    </div>
                    <footer>
                        <small>♥
                            <?php echo $post["like_number"] ?>
                        </small>
                        <a href="">#
                            <?php echo $post["taglist"] ?>
                        </a>,
                    </footer>
                </article>
            <?php } ?>


        </main>
    </div>
</body>

</html>