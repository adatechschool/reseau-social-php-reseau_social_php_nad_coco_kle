<?php
$likePost = isset($_POST['postId']);
            if ($likePost) {
                $postId = $_POST['postId'];
                $userId = $_POST['currentUserId'];
                $ajoutLike = "INSERT INTO likes "
                    . "(id, user_id, post_id)"
                    . "VALUES (NULL, "
                    . $_SESSION['connected_id'] . ", "
                    . $postId . ")"
                ;
                $ok = $mysqli->query($ajoutLike);
                if (!$ok) {
                    echo ("Échec de la requete : " . $mysqli->error);
                } else {
                    echo "work";
                }
            }
?>