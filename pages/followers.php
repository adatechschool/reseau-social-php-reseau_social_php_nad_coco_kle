<?php
    include '../assets/notConnected.php';
    include '../connect.env';
    include '../assets/header.php'
    ?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>URB.exe - followers </title>
    <meta name="author" content="Klervy, Corentin, Nadège">
    <link rel="stylesheet" href="../style.css" />
</head>

<body>
    <div id="wrapper">
        <aside>
            <img src="../img/user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Mes abonné.e.s</h3>
                <p>Sur cette page vous trouverez la liste des personnes qui
                    suivent les messages de l'utilisatrice n° <?php echo intval($_GET['user_id']) ?>
                </p>

            </section>
        </aside>
        <main class='contacts'>
            <?php
            $userId = intval($_GET['user_id']);
            // Récupérer le nom de l'utilisateur
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id";
            $lesInformations = $mysqli->query($laQuestionEnSql);

            while ($follower = $lesInformations->fetch_assoc()) {
                ?>
                <article>
                    <img src="../img/user.jpg" alt="blason" />
                    <h3><a href="wall.php?user_id=<?php echo $follower["id"] ?>"><?php echo $follower["alias"] ?></a></h3>
                    <p>
                        <?php echo $follower["email"] ?>
                    </p>
                </article>
            <?php
            }
            ?>
        </main>
    </div>
</body>
</html>