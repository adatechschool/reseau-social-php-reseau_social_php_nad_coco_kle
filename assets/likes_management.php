<?php
include "../connect.env";


$userId = isset ($_GET['user_id']) ? $_GET['user_id']:0;
$postId = isset ($_GET['post_id']) ? $_GET['post_id']:0;

echo "this is l'user: " . $userId;
echo "<br>";
echo "this is the post: " . $postId;
echo "<br>";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lInstructionSql = "INSERT INTO likes (post_id, user_id)
                        SELECT * FROM (SELECT $postId, $userId) AS tmp
                            WHERE NOT EXISTS (SELECT * FROM likes WHERE post_id = $postId AND user_id = $userId)
                                LIMIT 1";
    $ok = $mysqli->query($lInstructionSql);
    if (!$ok){
        echo ("erreur" . $mysqli->error);
    } else { echo ("tada!")
        ;}
}

// for ($i=0; $i<likes.length; $i++) {

// }

/**
* chaque post_id= le même id, incrémenter le compteur (à défaut par zéro)
* parcourir la table des likes
* ne pas rajouter de like si user_id a déjà liké
*/
?>