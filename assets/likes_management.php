<?php
include "../connect.env";

$authorId = $_POST['user_id'];
$postId = $_POST['postId'];
echo $postId . ", " . $authorId;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_like = $_POST['post.php'];
    $lInstructionSql = "INSERT INTO likes 
                        (user_id, post_id)
                        VALUES 
                        ($authorId, $postId)";
    $ok = $mysqli->query($lInstructionSql);
    if (!$ok){
        echo ("erreur de like" . $mysqli->error);
    } else { echo ("tada");
    }
}

// for ($i=0; $i<likes.length; $i++) {

// }

/**
* chaque post_id= le même id, incrémenter le compteur (à défaut par zéro)
* parcourir la table des likes
* ne pas rajouter de like si user_id a déjà liké
*/
?>