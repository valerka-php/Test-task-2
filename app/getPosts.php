<?php

ini_set('display_errors', 1);

require '../core/Db.php';
require '../core/Posts.php';

$model = new Posts();
$posts = $model->getPosts();
echo json_encode($posts);