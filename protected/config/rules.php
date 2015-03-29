<?php

/**
 * Маршруты для URL manager'а
 */

return array(
    'gii'=>'gii',
    'gii/<controller:\w+>'=>'gii/<controller>',
    'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
    
//    '<action:(login|logout)>' => 'admin/site/<action>',

//    'admin/<controller:url>/<id:\d+>'=>'admin/<controller>/index',
//    'admin/<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin/<controller>/<action>',
//    'admin/<controller:\w+>/'=>'admin/<controller>/index',
//    'admin/<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
//    'admin'=>'admin/dashboard',

    'email/<id:[a-f0-9]{32}>' => 'confirm/email',
    
    '<controller:\w+>' => '<controller>/index',
    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>/<leaf:[0-9a-zA-Z_\-]+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

);