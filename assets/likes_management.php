<?php
include "../connect.env";


$authorId = isset ($_GET['user_id']) ? $_GET['user_id']:0;
$postId = isset ($_GET['postId']) ? $_GET['postId']:0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lInstructionSql = "INSERT INTO likes (post_id, user_id)
                        VALUES ($postId, $authorId)";
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