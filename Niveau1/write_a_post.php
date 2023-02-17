<section>
<form method="post" action="wall.php?user_id= <?php echo $userId ?>">
                    <dl>
                        <dt><label for='postToSend'>Ecrivez ici</label></dt>
                        <dd><input type='text' name='postToSend'></dd>
                    </dl>
                    <input type='submit'>
                </form>
</section>

<?php

// Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Etape 2: récupérer ce qu'il y a dans le formulaire 
    $new_post = $_POST['postToSend'];
    //Etape 4 : Petite sécurité
    $new_post = $mysqli->real_escape_string($new_post);
    //Etape 5 : construction de la requete
    $lInstructionSql = "INSERT INTO posts 
                        (id, user_id, content, created, parent_id)
                        VALUES 
                        (NULL, '$userId', '$new_post', NOW(), NULL)";
    // Etape 6: exécution de la requete
    $ok = $mysqli->query($lInstructionSql);

    if (!$ok) {
        echo "Le post a échouée : " . $mysqli->error;
    } else {
        // Step 2 of Post/Redirect/Get pattern: send HTTP redirect response
        //it redirect the user to the page state where the form was not send, or a thanks page
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }
}

?>