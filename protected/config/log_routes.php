<?php

/**
 * Маршруты для URL manager'а
 */

return array(
    array(
        'class'=>'CWebLogRoute',
        'showInFireBug' => false,
        'levels'=>'error, warning, trace, profile, info',
        'categories'=>'debug.dump',
        'enabled'=>YII_DEBUG && empty($_SERVER['HTTP_X_REQUESTED_WITH']),
    ),
    array(
        'class'=>'CProfileLogRoute',
        'enabled'=>YII_DEBUG && empty($_SERVER['HTTP_X_REQUESTED_WITH']),
        'levels'=> 'debug',
    ),
    array(
        'class'=>'CWebLogRoute',
        'enabled'=>YII_DEBUG && empty($_SERVER['HTTP_X_REQUESTED_WITH']),
        'levels'=>'notice, warning, error',
    ),
    array(
        'class'=>'CFileLogRoute',
        'logFile'=>'dump.log',
        'categories'=>'debug.dump',
        'levels'=>'error, warning, notice, trace, info',
    ),
);