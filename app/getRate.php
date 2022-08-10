<?php

ini_set('display_errors', 1);

require '../core/Db.php';
require '../core/Posts.php';


$model = new Posts();
$rating = $model->getRating();
echo json_encode($rating);