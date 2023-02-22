<?php
    include "../connect.env";
    session_start();
?>

<article>
    <h3>
        <time>
        <a href="../pages/wall.php?user_id=<?php echo $post["author_id"] ?>"><?php echo $post['author_name']?></a>
        </time>
    </h3>
    <address>
        <?php echo $post['created'] ;?>
        
    </address>
    <div>
        <p>
            <?php echo $post['content'] ?>
        </p>
    </div>
    <footer>
        <small>
                <form method="post" action="">
                    <input type="submit" name="like" value="❤">
                    <?php
                    $lInstructionSql = "SELECT * FROM likes
                    WHERE post_id = " . $post['id'] . " AND user_id =" . $_SESSION['connected_id'];
                    echo $lInstructionSql;

                    $lesInformations = $mysqli->query($lInstructionSql);
                    if (!$lesInformations){
                        echo ("ERROR: " . $mysqli->error);
                    } else { 
                        echo ("Brava !");
                    }
                    // si le like existe déjà (ligne récupérée dans ma requete précédente) -> no button affiché
                    // sinon : afficher le bouton <3
                    ?>
                    <input type="hidden" name ="currentUserId" value="<?php echo $_SESSION['connected_id']?>">
                    <input type="hidden" name="postId" value="<?php echo $post['id'] ?>">
                </form>

                <?php

$currentUserId = (isset($_POST['currentUserId'])) ? $_POST['currentUserId'] : 0;
$postId = (isset($_POST['postId'])) ? $_POST['postId'] : 0;

if ($postId!=0 AND $currentUserId!=0) {
    
    if ( ! $lesInformations)
    {
        echo("Échec de la requete : " . $mysqli->error);
        exit();
    }
   
    while ($like = $lesInformations->fetch_assoc()) {
        $lInstructionSql = "INSERT INTO `likes` (`id`, `user_id`, `post_id`)
                            VALUES (NULL, $currentUserId, $postId)";
        $ok = $mysqli->query($lInstructionSql);
        if (!$ok){
            echo ("ERROR: " . $mysqli->error);
        } else { 
            echo ("Merci de répandre l'amour <3");
        }
    }
}
?>

<meta http-equiv="refresh" />
        </small>
        <?php
        require("tags_management.php");
        ?>

    </footer>
</article>