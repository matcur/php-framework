<?php
/**
 * @var $post \App\Models\Post
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>
        <h1><?php echo $post->title?></h1>
        <div><?php echo $post->id?></div>
    </div>
</body>
</html>