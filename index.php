<?php
require_once __DIR__.'/protected/config/env.php';

if (defined('YII_DEBUG') && YII_DEBUG) {
    $yii = 'yii/yii.php';
    ini_set('display_errors', true);
    error_reporting(E_ALL);
}
else {
    $yii = 'yii/yiilite.php';
}

$config = __DIR__.'/protected/config/main.php';

require_once $yii;
Yii::createWebApplication($config)->run();