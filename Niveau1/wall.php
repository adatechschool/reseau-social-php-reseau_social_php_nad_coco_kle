<?php
include 'connect.env';
include 'header.php';
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
        // On récupère l'id de l'utilisateur à qui appartient le mur
        $userId = intval($_GET['user_id']);
        // A MODIFIER AVEC LES SESSIONS / on récupère l'id de l'utilisateur en cours qui souhaite s'abonner
        $currentUserId = isset($_SESSION['connected_id']) ? intval($_SESSION['connected_id']) : 0; // fixed notice and added isset()
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
                <p>Sur cette page vous trouverez tous les messages de l'utilisatrice :
                    <?php echo $user["alias"] ?>
                    (n°
                    <?php echo $userId ?>)
                </p>
               
            
        
                <?php // Exécute la requête SQL pour ajouter l'utilisateur courant comme follower de l'utilisateur avec l'ID spécifié
                    $sql = "INSERT INTO followers (following_user_id, followed_user_id)
                    SELECT * FROM (SELECT '$currentUserId', '$userId') AS tmp
                        WHERE NOT EXISTS (
                    SELECT * FROM followers WHERE following_user_id = '$currentUserId' AND followed_user_id = '$userId'
                        ) LIMIT 1";

                    if(isset($_POST['subscribe']))
                    {
                        $result = $mysqli->query($sql);
                        echo "Vous êtes abonné(e) à " . $user["alias"];
                        //Vérifie si la requête SQL a réussi
                        if (!$result) {
                        //Si la requête a échoué, affiche un message d'erreur
                        echo "<br>";
                        echo "Erreur lors de l'ajout de l'utilisateur comme follower: " . $mysqli->error;
                         } else {
                        //Si la requête a réussi, affiche un message de confirmation
                        echo "<br>";
                        echo "L'utilisateur a été ajouté comme follower.";
                        } ;
                    } 
                    ?> 
                     
                    <p id="subscribe">
                        <form method="post" action="wall.php?user_id= <?php echo $userId ?>">
                            <input type="submit" name="subscribe" value="S'abonner à <?php echo $user["alias"] ?>">
                        </form>
                    </p>
                        
                    <?php // Exécute la requête SQL pour supprimer l'utilisateur courant comme follower de l'utilisateur avec l'ID spécifié
                    $sql = "DELETE FROM followers WHERE following_user_id = $currentUserId AND followed_user_id = $userId";
                    if(isset($_POST['unsubscribe']))
                    {
                        $result = $mysqli->query($sql);
                        echo "Vous êtes désabonné(e) à " . $user["alias"];
                        //Vérifie si la requête SQL a réussi
                        if (!$result) {
                        //Si la requête a échoué, affiche un message d'erreur
                        echo "<br>";
                        echo "Erreur lors de la suppression de l'utilisateur comme follower: " . $mysqli->error;
                         } else {
                        //Si la requête a réussi, affiche un message de confirmation
                        echo "<br>";
                        echo "L'utilisateur a été retiré comme follower.";
                        } ;
                    } ;        
                    ?> 
                    <p id="unsubscribe">
                        <form method="post" action="wall.php?user_id= <?php echo $userId ?>">
                            <input type="submit" name="unsubscribe" value="Se désabonner de <?php echo $user["alias"] ?>">
                        </form>
                    </p>                 

                             <!-- je veux qu'au reload je vérifie si je suis déjà abonné alors tu ne m'affiche pas le bouton --> 
            </section>
            <section>
                <form method="post" action="wall.php?user_id= <?php echo $userId ?>">
                    <dl>
                        <dt><label for='postToSend'>Ecrivez ici</label></dt>
                        <dd><input type='text' name='postToSend'></dd>
                    </dl>
                    <input type='submit'>
                </form>
            </section>

            <?php

            // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Etape 2: récupérer ce qu'il y a dans le formulaire 
                $new_post = $_POST['postToSend'];
                //Etape 4 : Petite sécurité
                $new_post = $mysqli->real_escape_string($new_post);
                //Etape 5 : construction de la requete
                $lInstructionSql = "INSERT INTO posts 
                                    (id, user_id, content, created, parent_id)
                                    VALUES 
                                    (NULL, '$userId', '$new_post', NOW(), NULL)";
                // Etape 6: exécution de la requete
                $ok = $mysqli->query($lInstructionSql);

                if (!$ok) {
                    echo "Le post a échouée : " . $mysqli->error;
                } else {
                    // Step 2 of Post/Redirect/Get pattern: send HTTP redirect response
                    //it redirect the user to the page state where the form was not send, or a thanks page
                    header("Location: {$_SERVER['REQUEST_URI']}");
                    exit();
                }
            }

            ?>
        </aside>

        <main>
            <?php
            /**
             * Etape 3: récupérer tous les messages de l'utilisatrice
             */
            $laQuestionEnSql = "SELECT posts.content,
            posts.created,
            users.alias as author_name,
            users.id as author_id,
            COUNT(likes.id) as like_number,
            GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.id) AS taglist,
            GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.id) AS tagidlist
        FROM posts
        JOIN users ON users.id=posts.user_id
        LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
        LEFT JOIN tags ON posts_tags.tag_id  = tags.id
        LEFT JOIN likes ON likes.post_id  = posts.id
        WHERE posts.user_id='$userId' 
        GROUP BY posts.id
        ORDER BY posts.created DESC;
        ";
                    $lesInformations = $mysqli->query($laQuestionEnSql);
                    if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli-> error);
            }

            /**
             * Etape 4: @todo Parcourir les messsages et remplir correctement le HTML avec les bonnes valeurs php
             */
            while ($post = $lesInformations->fetch_assoc()) {

                // echo "<pre>" . print_r($post, 1) . "</pre>";
                ?>
            <?php require("post.php")?>

            <?php } ?>
        </main>
    </div>            
</body>
</html>