<form method="post">
  <input type='text' name='commentToSend' placeholder="et toi? t'en penses quoi?">

  <input type='submit' value="go">
</form>
<?php


if (isset($_POST['commentToSend'])) {
  $userId = $_SESSION['connected_id'];
  $parent_post_id = $post['id'];
  $new_comment = $_POST['commentToSend'];
  $new_comment = $mysqli->real_escape_string($new_comment);

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