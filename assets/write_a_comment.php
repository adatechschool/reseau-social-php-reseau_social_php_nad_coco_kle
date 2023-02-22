<section>
  <form method="post" >
    <dl>
      <dt><label for='commentToSend'>Ecrivez ici</label></dt>
      <dd><input type='text' name='commentToSend'></dd>
    </dl>
    <input type='submit'>
  </form>
</section>
<?php


  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $userId = $_SESSION['connected_id'];
      $parent_post_id = $post['id'];
      $new_comment = $_POST['commentToSend'];
      // Step 4: Sanitize the input
      $new_comment = $mysqli->real_escape_string($new_comment);
          
      // Step 5: Insert the post into the database
      $comment_query = "INSERT INTO posts 
                          (id, user_id, content, created, parent_id)
                          VALUES 
                          (NULL, '$userId', '$new_comment', NOW(), $parent_post_id)";
                          
      $isok = $mysqli->query($comment_query);

      if ($isok) {
          echo "Le commentaire a été ajouté avec succès.";
          header("Location: {$_SERVER['REQUEST_URI']}");
          exit();
      } else {
          echo "Le commentaire a échoué : " . $mysqli->error;
      }
    }