<?php
ini_set('display_errors', 1);

require '../core/Db.php';
require '../core/Posts.php';

$model = new Posts();
$comments = $model->getComments();
echo json_encode($comments);
