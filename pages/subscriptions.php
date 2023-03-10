<?php
include '../assets/notConnected.php';
include '../connect.env';
include '../assets/header.php'
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>URB.exe - subscriptions</title>
    <meta name="author" content="Klervy, Corentin, Nadège">
    <link rel="stylesheet" href="../style.css" />
</head>

<body>
    <div id="wrapper">
        <aside>
            <img src="../img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <p>Sur cette page vous trouverez la liste des abonnements de
                    l'utilisatrice
                    n°
                    <?php echo intval($_GET['user_id']) ?>
                </p>
            </section>
        </aside>
        <main class='contacts'>
            <?php
            // Récupérer l'id de l'utilisateur
            $userId = intval($_GET['user_id']);
            // Récupérer le nom de l'utilisateur
            $laQuestionEnSql = "
                SELECT users.*
                FROM followers
                LEFT JOIN users ON users.id=followers.followed_user_id
                WHERE followers.following_user_id='$userId'
                GROUP BY users.id
                ";

            $lesInformations = $mysqli->query($laQuestionEnSql);

            // Vérification
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            while ($sub = $lesInformations->fetch_assoc()) { ?>

                <article>
                    <img src="../img/user.jpg" alt="blason" />
                    <h3><a href="wall.php?user_id=<?php echo $sub["id"] ?>"><?php echo $sub["alias"] ?></a></h3>
                    <p>
                        <?php echo $sub['email'] ?>
                    </p>
                </article>
            <?php } ?>

        </main>
    </div>
</body>

</html>