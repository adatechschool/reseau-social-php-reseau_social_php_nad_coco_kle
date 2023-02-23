<?php
include '../connect.env';
include '../assets/blank_header.php';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>URB.exe - registration</title>
    <meta name="author" content="Klervy, Corentin, Nadège">
    <link rel="stylesheet" href="../style.css" />
</head>

<body>
    <div id="wrapper">

        <aside>
            <h2>REGISTER</h2>
            <p>Bienvenue chez URB.exe !
                    <br>
                    <br>Ici, tu peux partager ta passion : tes conseils, tes expériences (#storytime), tes plus belles citations et photos autour de l'exploration urbaine !
                    <br>
                    <br>Rejoins vite nos 100.000 abonné.e.s !
                </p>
        </aside>
        <main>
            <article>
                <?
                /*if($_GET['msg']){
                echo $_GET['msg'];
                }*/
                ?>
                <h2>Inscription</h2>
                <?php
                // Traitement du formulaire
                $enCoursDeTraitement = isset($_POST['email']);
                if ($enCoursDeTraitement) {
                    // On ne fait ce qui suit que si un formulaire a été soumis.
                    // Récupérer ce qu'il y a dans le formulaire
                    $new_email = $_POST['email'];
                    $new_alias = $_POST['pseudo'];
                    $new_passwd = $_POST['motpasse'];

                    // Petite sécurité pour éviter les injection sql
                    $new_email = $mysqli->real_escape_string($new_email);
                    $new_alias = $mysqli->real_escape_string($new_alias);
                    $new_passwd = $mysqli->real_escape_string($new_passwd);
                    // On crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                    $new_passwd = md5($new_passwd);
                    // NB: md5 est pédagogique mais n'est pas recommandée pour une vraies sécurité
                    // Construction de la requete
                    $lInstructionSql = "INSERT INTO users (id, email, password, alias) "
                        . "VALUES (NULL, "
                        . "'" . $new_email . "', "
                        . "'" . $new_passwd . "', "
                        . "'" . $new_alias . "'"
                        . ");";
                    // Exécution de la requete
                    $ok = $mysqli->query($lInstructionSql);
                    if (!$ok) {
                        echo "L'inscription a échouée : " . $mysqli->error;
                    } else {
                        echo "Votre inscription est un succès : " . $new_alias . "<br>";
                        echo "<br>";
                        echo "Connectez-vous :<a href='login.php'> <strong>Cliquez ici !</strong></a>";
                    }
                }
                ?>
                <?php if (!$enCoursDeTraitement || $mysqli->error) { ?>
                    <form action="registration.php" method="post">
                        <input type='hidden' name='id' value='<?php echo $ok["id"] ?>'>
                        <dl>
                            <dt><label for='pseudo'>Pseudo</label></dt>
                            <dd><input type='text' name='pseudo'></dd>
                            <dt><label for='email'>E-Mail</label></dt>
                            <dd><input type='email' name='email'></dd>
                            <dt><label for='motpasse'>Mot de passe</label></dt>
                            <dd><input type='password' name='motpasse'></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                    <p>
                        Déjà un compte ?
                        <a href='login.php'><strong>Connectez-vous.</strong></a>
                    </p>
                <?php } ?>
            </article>
        </main>
    </div>
</body>

</html>