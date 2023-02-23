<?php
include "../connect.env";
//session_start();
?>

<article>
    <h3>
        <div>
            <strong><a href="../pages/wall.php?user_id=<?php echo $post["author_id"] ?>">Par <?php echo $post['author_name'] ?></a></strong>,
            <?php echo $post['created']; ?><br>
        </div>
    </h3>
    <br>


    <div>
        <p>
            <?php echo $post['content']; ?>
        </p>
        <div id="tag">
            <?php require("tags_management.php"); ?>
        </div>
    </div>
    <footer>
        <div id="footer_post">

            <div>
                <?php
                // si le like existe déjà (ligne récupérée dans ma requete précédente) -> no button affiché
                // sinon : afficher le bouton <3
                $lInstructionSql8 = "SELECT * FROM likes
                                        WHERE post_id = " . $post['id'] . " AND user_id =" . $_SESSION['connected_id'];

                $lesInformations8 = $mysqli->query($lInstructionSql8);
                $isLiked = $lesInformations8->fetch_assoc();
                //echo "<pre>" . print_r($isLiked, 1) . "</pre>";
                if (!$isLiked) {
                    ?>
                    <form method="post" action="">
                        <input type="submit" name="like" value="❤">

                        <input type="hidden" name="currentUserId" value="<?php echo $_SESSION['connected_id'] ?>">
                        <input type="hidden" name="postId" value="<?php echo $post['id'] ?>">
                    </form>
                <?php }
                ;

                ?>
            </div>

            <div id="comments_parent">
                <?php require("write_a_comment.php"); ?>
                <?php require("display_comments.php"); ?>
            </div>

        </div>
    </footer>
</article>