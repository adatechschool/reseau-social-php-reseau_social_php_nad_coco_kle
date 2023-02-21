<?php session_start();?>
<article>
    <h3>
        <time>
        <a href="../pages/wall.php?user_id=<?php echo $post["author_id"] ?>"><?php echo $post['author_name']?></a>
        </time>
    </h3>
    <address>
        <?php echo $post['created'] ?>
    </address>
    <div>
        <p>
            <?php echo $post['content'] ?>
        </p>
    </div>
    <footer>
        <small>
            <form method="post" action="../assets/likes_management.php?user_id=<?php echo $_SESSION['connected_id']?>&post_id=<?php echo $post['id'] ?>">
                <input type="submit" name="postId" value="❤">
            </form>
            <?php echo $post['like_number'];
            require("assets/likes_management.php"); ?>
        </small>

        <?php
        require("tags_management.php");
        ?>

    </footer>
</article>