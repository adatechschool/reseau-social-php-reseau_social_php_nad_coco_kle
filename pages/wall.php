<?php
    include '../assets/notConnected.php';
    include '../connect.env';
    include '../assets/header.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mur</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="../style.css" />
</head>

<body>
    <div id="wrapper">
        <?php
        // On récupère l'id de l'utilisatrice à qui appartient le mur
        $userId = intval($_GET['user_id']);
        // On récupère l'id de l'utilisatrice en cours qui souhaite s'abonner
        $currentUserId = isset($_SESSION['connected_id']) ? intval($_SESSION['connected_id']) : 0;
        ?>

        <aside>
            <?php
            // On récupère l'id utilisatrice
            $laQuestionEnSql3 = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations3 = $mysqli->query($laQuestionEnSql3);
            $user = $lesInformations3->fetch_assoc();
            ?>

            <img src="../img/user.jpg" alt="Portrait de l'utilisatrice" />

            <section>
                <h3>Présentation</h3>   
                <p>Sur cette page vous trouverez tous les messages de l'utilisatrice :
                    <?php echo $user["alias"] ?>
                    (n°
                    <?php echo $userId ?>)
                </p>
        
                <?php // Exécute la requête SQL pour ajouter l'utilisatrice courante comme follower de l'utilisatrice dont on visite la page
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

                    // Exécute la requête SQL pour supprimer l'utilisateur courant comme follower de l'utilisateur avec l'ID spécifié
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

                    if (isset($_SESSION['connected_id']) AND ($currentUserId != $userId)){
                        $isfollowed = "SELECT * FROM followers WHERE following_user_id = '$currentUserId' AND followed_user_id = '$userId'";
                        $result_followed = $mysqli->query($isfollowed);
                        $checkfollow = $result_followed->fetch_assoc();
    
                        if(!$checkfollow)  { ?>
                            <p id="subscribe">
                            <form method="post" action="wall.php?user_id=<?php echo $userId ?>">
                                <input type="submit" name="subscribe" value="S'abonner à <?php echo $user["alias"] ?>">
                            </form>
                        </p> 
                        <?php  } elseif ($checkfollow) { ?>
                        <p id="unsubscribe">
                            <form method="post" action="wall.php?user_id=<?php echo $userId ?>">
                                <input type="submit" name="unsubscribe" value="Se désabonner de <?php echo $user["alias"] ?>">
                            </form>
                        </p>
                        <?php
                        }
                    } ?>                
            </section>
        </aside>
<?php

$likePost = isset($_POST['postId']);
            if ($likePost) {
                $postId = $_POST['postId'];
                $userId = $_POST['currentUserId'];
                $ajoutLike = "INSERT INTO likes "
                    . "(id, user_id, post_id)"
                    . "VALUES (NULL, "
                    . $_SESSION['connected_id'] . ", "
                    . $postId . ")"
                ;
                $ok = $mysqli->query($ajoutLike);
                if (!$ok) {
                    echo ("Échec de la requete : " . $mysqli->error);
                } else {
                    echo "work";
                }
            }
?>
        <main>
            <?php
            // Récupérer tous les messages de l'utilisatrice
            $laQuestionEnSql2 = "SELECT posts.content,
            posts.created,
            posts.id,
            posts.id,
            users.alias as author_name,
            users.id as author_id,
            COUNT(likes.id) as like_number,
            GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.label) AS taglist,
            GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.label) AS tagidlist
            FROM posts
            JOIN users ON users.id=posts.user_id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
            LEFT JOIN tags ON posts_tags.tag_id  = tags.id
            LEFT JOIN likes ON likes.post_id  = posts.id
            WHERE posts.user_id='$userId' 
            GROUP BY posts.id
            ORDER BY posts.created DESC;
            ";

            $lesInformations2 = $mysqli->query($laQuestionEnSql2);
            if (!$lesInformations2) {
                echo ("Échec de la requete : " . $mysqli->error);
            };

            require("../assets/write_a_post.php");
            
            while ($post = $lesInformations2->fetch_assoc()) {
                require("../assets/post.php");
           } 
            ?>
            
        </main>
    </div>
</body>
</html>