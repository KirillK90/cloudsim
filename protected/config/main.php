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

        'homeUrl' => array('/index'),
        'defaultController' => 'site',

        'modules' => array_merge(array(),
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
                'errorAction'=>'site/error',
            ),

            'log'=>array(
                'class'=>'CLogRouter',
                'routes'=> (require_once __DIR__.'/log_routes.php'),
            ),

            'user' => array(
                'class' => 'application.components.UWebUser',
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
