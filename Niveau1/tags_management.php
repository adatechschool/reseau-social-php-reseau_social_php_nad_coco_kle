


<?php $explodeTag = explode(",", $post['taglist']) ?>
<?php $explodeTagId = explode(",", $post['tagidlist']) ?>
<?php 
    print_r($post['taglist']) ;
    print_r($post['tagidlist']) ;

while ($explodeTag) {

    $curentTag = array_pop($explodeTag);
    $curentTagId = array_pop($explodeTagId) ?>

    <a href="tags.php?tag_id=<?php echo $curentTagId ?>">#<?php echo $curentTag ?></a>
<?php
}
?>