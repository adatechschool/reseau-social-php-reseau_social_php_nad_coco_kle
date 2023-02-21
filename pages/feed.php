<?php
    include '../assets/notConnected.php';
    include '../connect.env'; 
    include '../assets/header.php';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Flux</title>         
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="../style.css"/>

    </head>
    <body>
        <div id="wrapper">
            <?php $userId = intval($_GET['user_id']);?>
            
            <aside>
                <?php
                $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();
                ?>
                <img src="../img/user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez tous les message des utilisatrices
                        auxquelles est abonnée l'utilisatrice <?php echo $user['alias'] ?> (n° <?php echo $userId ?>)
                    </p>
                </section>
            </aside>
            <main>
                <?php
                $laQuestionEnSql = "SELECT posts.content,
                posts.created,
                posts.id,
                users.alias as author_name,
                users.id as author_id,
                count(likes.id) as like_number,
                GROUP_CONCAT(DISTINCT tags.label ORDER BY tags.label) AS taglist,
                    GROUP_CONCAT(DISTINCT tags.id ORDER BY tags.label) AS tagidlist
            FROM followers
            JOIN users ON users.id=followers.followed_user_id
            JOIN posts ON posts.user_id=users.id
            LEFT JOIN posts_tags ON posts.id = posts_tags.post_id
            LEFT JOIN tags ON posts_tags.tag_id  = tags.id
            LEFT JOIN likes ON likes.post_id  = posts.id
            WHERE followers.following_user_id=$userId 
            GROUP BY posts.id
            ORDER BY posts.created DESC;";
         
                $lesInformations = $mysqli->query($laQuestionEnSql);
                if ( ! $lesInformations)
                {
                    echo("Échec de la requete : " . $mysqli->error);
                }
                
                while ($post = $lesInformations->fetch_assoc()) {
                    require("../assets/post.php");
                }?>
            </main>
        </div>
    </body>
</html>
