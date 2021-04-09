<?php
/**
 * @var $posts \Blog\Models\Post[]
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <?php foreach ($posts as $post) {?>
        <div>
            <h1><?php echo $post->title?></h1>
            <div><?php echo $post->id?></div>
        </div>
    <?php } ?>
</body>
</html>