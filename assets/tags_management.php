<?php

$hastag = "#";

if (!isset($post['tagidlist'])) {
    if (!isset($_GET['tag_id'])) {
        $hastag = " ";
    }else{
     $post['tagidlist'] = intval($_GET['tag_id']);
    }
}

$explodeTag = explode(",", $post['taglist']);
$explodeTagId = explode(",", $post['tagidlist']);

while ($explodeTag) {

    $curentTag = array_shift($explodeTag);
    $curentTagId = array_shift($explodeTagId);
    ?>

    <a href="../pages/tags.php?tag_id=<?php echo $curentTagId ?>"><?php echo $hastag, $curentTag ?></a>
    <?php

}
?>