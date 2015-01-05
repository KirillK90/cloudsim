<?php

/**
 * Web-конфиг приложения.
 */

return CMap::mergeArray(
    (require_once __DIR__.'/common.php'),
    array(
        'preload'=>array(
            'bootstrap',
        ),

        'homeUrl' => array('/admin/profile'),
        'defaultController' => 'admin/site',

        'modules' => array_merge(
                array(
                    'admin',
                ),
                YII_DEBUG ? array(
                'gii' => array(
                    'class' => 'system.gii.GiiModule',
                    'password' => '123456',
                    'ipFilters' => array(
                        '127.0.0.1',
                        '::1',
                    ),
                    'generatorPaths' => array(
                        'bootstrap.yiistrap.gii',
                    )
                )
            ) : array()
        ),

        'components'=>array(
            'errorHandler'=>array(
                'errorAction'=>'admin/site/error',
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=>array(
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
                    array(
                        'class'=>'CEmailLogRoute',
                        'emails'=> array('kurkin@polygant.ru'),
                        'subject' => 'GeHr Error',
                        'sentFrom' => '"CCP Log"<errors@ccp.ru>',
//                        'except'=>'exception.CHttpException.*',
                        'utf8' => true,
                        'levels'=>'error',
                        'enabled' => !YII_DEBUG
                    )
                ),
            ),

            'user' => array(
                'class' => 'application.components.UWebUser',
                'loginUrl' => '/admin/site/login',
                'allowAutoLogin'=>true,
            ),

            'assetManager' => array(
                'forceCopy' => YII_DEBUG,
            ),

            'clientScript' => array(
                'packages' => (require_once __DIR__.'/packages.php'),
            ),

            'bootstrap' => array(
                'class' => 'bootstrap.components.TbApi',
            ),
        ),
    )
);
