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
                    <input type="hidden" name ="currentUserId" value="<?php echo $_SESSION['connected_id']?>">
                    <input type="hidden" name="postId" value="<?php echo $post['id'] ?>">
                </form>
                <?php

$currentUserId = isset ($_POST['currentUserId']) ? $_POST['currentUserId']:0;
$postId = isset ($_POST['postId']) ? $_POST['postId']:0;

if (isset($_POST['postId']) AND isset($_POST['currentUserId'])) {

    $lInstructionSql = "INSERT INTO likes (post_id, user_id)
                        SELECT * FROM (SELECT $postId, $currentUserId) AS tmp
                            WHERE NOT EXISTS (SELECT * FROM likes WHERE postId = $postId AND userId = $currentUserId)
                                LIMIT 1";
    $ok = $mysqli->query($lInstructionSql);
    if (!$ok){
        echo ("ERROR: " . $mysqli->error);
    } else { echo ("Merci de répandre l'amour <3")
        ;}
}
?>

<meta http-equiv="refresh" />
        </small>
        <?php
        require("tags_management.php");
        ?>

    </footer>
</article>