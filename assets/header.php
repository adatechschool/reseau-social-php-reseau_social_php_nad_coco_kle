<?php
include "../connect.env";
?>
<header>
    <a href='../pages/admin.php'><img src="../img/urbexe.png" alt="notre logo :)"/></a>
        <nav id="menu">
            <a href="../pages/news.php">news</a>
            <a href="../pages/wall.php?user_id=<?php echo $_SESSION['connected_id'] ?>">wall</a>
            <a href="../pages/feed.php?user_id=<?php echo $_SESSION['connected_id'] ?>">feed</a>
            <a href="../pages/tags.php?tag_id=1">tags</a>
            <a> <form id= "searchbox" action="" method="post"> 
            THÉO_SEARCH_BAR<br><input class="research" type="text" size= "40" name="search" placeholder=" Rechercher un utilisateur">
                <input class="button-submit" type="submit" value="🔍">
            </form></a>
        </nav>
        <nav id="user">
            <a href="#">profil</a>
            <ul>
                <li><a href="../pages/settings.php?user_id=<?php echo $_SESSION['connected_id'] ?>">paramètres</a></li>
                <li><a href="../pages/followers.php?user_id=<?php echo $_SESSION['connected_id'] ?>">mes followers</a></li>
                <li><a href="../pages/subscriptions.php?user_id=<?php echo $_SESSION['connected_id'] ?>">mes abonnements</a></li>
                <li><a href="../pages/logout.php">se déconnecter</a></li>
            </ul>
        </nav>
</header>
<?php

// PART SEARCH

if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $search_query = "SELECT * FROM `users` WHERE alias= '$search' ";
    $search_response = $mysqli->query($search_query);
    $search_user = $search_response->fetch_assoc();
    if ($search_user) {
        header("Location: wall.php?user_id=" . $search_user['id']);
    }
}
?>