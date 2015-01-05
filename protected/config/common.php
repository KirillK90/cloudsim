<?php
$_SERVER['HTTPS'] = isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https';

return array(
    'basePath'=>__DIR__.DIRECTORY_SEPARATOR.'..',
    'name' => 'Облачный симулятор',

    'language' => 'ru',
    'aliases' => array(
        'vendors' => __DIR__.'/../vendors',
        'bootstrap' => __DIR__.'/../vendors/yiistrap',
    ),
    'preload'=>array(
        'log',
    ),
    'import' => array(
        'application.models.*',
        'application.models.forms.*',
        'application.components.*',
        'application.components.helpers.*',
        'bootstrap.helpers.*',
        'bootstrap.form.*',
        'bootstrap.widgets.*',
    ),

    'components' => array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'enabled'=>true,
                    'levels'=>'error, warning',
                ),
            ),
        ),

        'db' => array(
            'connectionString' => 'mysql:host='.DB_HOST.';dbname='.DB_NAME,
            'username' => DB_USERNAME,
            'password' => DB_PASSWORD,
            'charset' => 'utf8',
            'initSQLs' => array(
                "SET time_zone='+04:00';",
            ),

            'enableProfiling'=> YII_DEBUG,
            'enableParamLogging' => YII_DEBUG,

            'schemaCachingDuration' => 3600,
        ),

        'urlManager'=>array(
            'urlFormat'=>'path',
            'urlSuffix'=>'/',
            'showScriptName'=>false,
            'rules'=> (require_once __DIR__.'/rules.php'),
        ),
    ),

    'params'=>array(
    ),
);