<?php

/**
 * Маршруты для URL manager'а
 */

return array(
    'gii'=>'gii',
    'gii/<controller:\w+>'=>'gii/<controller>',
    'gii/<controller:\w+>/<action:\w+>'=>'gii/<controller>/<action>',
    
    'email/<id:[a-f0-9]{32}>' => 'confirm/email',
    
    '<controller:\w+>' => '<controller>/index',
    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

);