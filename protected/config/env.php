<?php

/**
 * Подключение файла с параметрами, зависимыми от текущей среды.
 * 
 * Имя среды берётся из константы ENV. Если она не объявлена, считывается
 * из файла current_env. Если файл отсутствует, именем среды считается dev.
 * Файл с параметрами берётся из директории env c именем $env.php.
 */

if (defined('ENV')) {
    $env = ENV;
}
elseif (file_exists(__DIR__.'/current_env')) {
    $env = file_get_contents(__DIR__.'/current_env');
}
else {
    $env = 'dev';
}

if (!defined('ENV')) {
    define('ENV', $env);
}

$envFile = __DIR__.'/env/'.$env.'.php';
if (!file_exists($envFile)) {
    die('No file for current env ('.htmlspecialchars($env).')');
}

$revFile = __DIR__.'/revision';
if (file_exists($revFile)) {
    define('REVISION', file_get_contents($revFile));
}
else {
    define('REVISION', null);
}

require_once $envFile;
require_once 'enum.php';
require_once 'constants.php';
unset($envFile);