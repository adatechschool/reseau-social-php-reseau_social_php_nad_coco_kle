<?php
    include "../connect.env";
    //session_start();
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
                

<meta http-equiv="refresh" />
        </small>
        <?php
        require("write_a_comment.php");
        require("tags_management.php");
        require("display_comments.php");

        ?>

    </footer>
</article>