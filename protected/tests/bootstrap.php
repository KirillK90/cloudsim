<?php

// change the following paths if necessary
require_once __DIR__.'/../config/env.php';
require_once __DIR__.'/../yiit.php';
require_once __DIR__.'/WebTestCase.php';
$config=dirname(__FILE__).'/../config/main.php';
Yii::createWebApplication($config);
