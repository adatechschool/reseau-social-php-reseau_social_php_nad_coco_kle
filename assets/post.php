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
            <form method="post" action=""></form>
            <?php echo $post['like_number'] ?>
        </small>

        <?php
        require("tags_management.php");
        require("likes_managements.php");
        ?>

    </footer>
</article>