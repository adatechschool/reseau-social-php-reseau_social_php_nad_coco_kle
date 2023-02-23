<section>
  <form method="post" action="../pages/wall.php?user_id=<?php echo $userId ?>">
      <div>
        <input id="write_post" placeholder="Quelles nouvelles aujourd'hui ?" type='text' name='postToSend'>

      </div>
      <input type='submit'>
  </form>
</section>

<?php

// Vérifier si on est en train d'afficher ou de traiter le formulaire
if (isset($_POST['postToSend'])) {

  $new_post = $_POST['postToSend'];
  // Sécurité pour empêcher les injections sql
  $new_post = $mysqli->real_escape_string($new_post);

  preg_match_all("/#\w+/", $new_post, $post_tags);

  // Inclure le post dans la base de données
  $lInstructionSql = "INSERT INTO posts 
                        (id, user_id, content, created, parent_id)
                        VALUES 
                        (NULL, '$userId', '$new_post', NOW(), NULL)";
  $ok = $mysqli->query($lInstructionSql);
  $post_id = $mysqli->insert_id;

  // Insérer les tags dans la base de données
  if ($ok && !empty($post_tags[0])) {
    $tag_ids = array();
    foreach ($post_tags[0] as $post_tag) {
      $post_tag = substr($post_tag, 1);
      // Vérifier si le tag existe déjà dans la table tags
      $lInstructionSql = "SELECT id FROM tags WHERE label = '$post_tag' ORDER BY label ASC";
      $result = $mysqli->query($lInstructionSql);
      if ($result->num_rows > 0) {
        // Si le tag existe déjà, retrouver le tag_id
        $row = $result->fetch_assoc();
        $tag_id = $row['id'];
      } else {
        // Si le tag n'existe pas, l'insérer dans la table tags
        $lInstructionSql = "INSERT INTO tags (label) VALUES ('$post_tag')";
        $ok = $mysqli->query($lInstructionSql);
        $tag_id = $mysqli->insert_id;
      }
      if (!$ok) {
        break;
      }
      $tag_ids[] = $tag_id;
    }
    if ($ok) {
      foreach ($tag_ids as $tag_id) {
        $lInstructionSql = "INSERT INTO posts_tags (post_id, tag_id) VALUES ($post_id, $tag_id)";
        $ok = $mysqli->query($lInstructionSql);
        if (!$ok) {
          break;
        }
      }
    }
  }

  if ($ok) {
    echo "Le post a été ajouté avec succès.";
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit();
  } else {
    echo "Le post a échoué : " . $mysqli->error;
  }
}