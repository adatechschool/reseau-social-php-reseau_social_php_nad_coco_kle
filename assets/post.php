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
        <small>❤
            <form method="post" action="../assets/likes_management.php?userid=<?php $_POST['user_id']?>?postid=<?php $_POST['postId'] ?>">
                <input type="submit" name="postId" value="<?php echo $post['id']?>">
            </form>
            <?php echo $post['like_number'];
            require("assets/likes_management.php"); ?>
        </small>

        <?php
        require("tags_management.php");
        ?>

    </footer>
</article>