<?php

use App\Model\Model;

include "../vendor/autoload.php";

$model = new Model();

$res = $model->checkUser('Yury', '12');
print_r($res);