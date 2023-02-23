<!--btn display and on click by id to differentiate posts -->
<input type = "submit"  value ="Voir les commentaires"onclick="showComments(<?php echo $post['id']; ?>)"></input>

<div id="comments-<?php echo $post['id']; ?>" style="display:none;">
    <?php
        //build the query and display in a loop
        $parent_post = $post['id'];
        $commentQuery = "SELECT posts.*, 
                        users.alias as author_alias 
                        FROM 
                        posts 
                        JOIN users ON posts.user_id = users.id 
                        WHERE 
                        posts.parent_id = $parent_post
                        LIMIT 3";
        
        $commentResult = $mysqli->query($commentQuery);

        while ($comment = $commentResult->fetch_assoc()) {
            echo "<div class='comments'>",$comment['author_alias']," - ",$comment['content'],"</div>","<br>"; 
        }
    ?>
</div>

<script>
    function showComments(postId) {
        // Toggle the display of the comments div
        var commentsDiv = document.getElementById("comments-" + postId);
        if (commentsDiv.style.display === "none") {
            commentsDiv.style.display = "block";
        } else {
            commentsDiv.style.display = "none";
        }
    }
</script>