<?php
session_start();
?>
<header>
    <a href='../pages/admin.php'><img src="../img/resoc.jpg" alt="Logo de notre réseau social"/></a>
        <nav id="menu">
            <a href="../pages/news.php">Actualités</a>
            <a href="../pages/wall.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mur</a>
            <a href="../pages/feed.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Flux</a>
            <a href="../pages/tags.php?tag_id=1">Mots-clés</a>
        </nav>
        <nav id="user">
            <a href="#">Profil</a>
            <ul>
                <li><a href="../pages/login.php">Se connecter</a></li>
                <li><a href="../pages/settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Paramètres</a></li>
                <li><a href="../pages/followers.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes suiveurs</a></li>
                <li><a href="../pages/subscriptions.php?user_id=<?php echo $_SESSION['connected_id'] ?>">Mes abonnements</a></li>
                <li><a href="../pages/logout.php">Se déconnecter</a></li>
            </ul>
        </nav>
</header>