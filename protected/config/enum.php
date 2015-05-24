<?php

/**
 * Interface EnumInterface
 * Просто чтобы не забыть про стандартные функции
 */
interface EnumInterface{
    static function getList();
    static function getName($key);
}

/**
 * Class Enum
 */
abstract class Enum implements EnumInterface{
    static function getName($key, $default = "N/A"){
        $list = static::getList();
        if (!array_key_exists($key, $list))
            return $default;

        return $list[$key];
    }

    public static function getValues()
    {
        return array_keys(static::getList());
    }
}

class UserAccessTypes extends Enum
{
    const ANY = "*"; //любой пользователь, включая анонимного.
    const GUEST = "?"; //анонимный пользователь.
    const AUTH = "@"; //аутентифицированный пользователь."

    static function getList()
    {
        return array(
            self::ANY => 'Любой',
            self::GUEST => 'Анонимный',
            self::AUTH => 'Аутентифицированный',
        );
    }
}

class UserRole extends Enum
{
    const ADMIN = 'admin';
    const USER = 'user';
    const GUEST = 'guest';

    static function getList()
    {
        return array(
            self::ADMIN => 'Админ',
            self::USER => 'Пользователь'
        );
    }
}

class TaskType extends Enum
{
    const LENYA_TASK = 'lenya_task';

    static function getList()
    {
        return array(
            self::LENYA_TASK => 'Лёнина задача',
        );
    }
}

class TaskStatus extends Enum
{
    const NEW_ONE = 'new_one';
    const WAIT = 'wait';
    const SUCCESS = 'success';
    const ERROR = 'error';

    static function getList()
    {
        return array(
            self::NEW_ONE => 'Новая задача',
            self::WAIT => 'В очереди',
            self::SUCCESS => 'Выполнено',
            self::ERROR => 'Ошибка',
        );
    }
}