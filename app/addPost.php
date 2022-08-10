<?php

ini_set('display_errors', 1);

require '../core/Db.php';
require '../core/Posts.php';

$model = new Posts();
$model->insertPost($_POST);
