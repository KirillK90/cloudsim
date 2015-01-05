<?php 
/**
 * Класс создан для обеспечения вспомогательными методами для отладки
 */

class HDates {

    /**
     * Возвращает дату в формате Y-m-d H:i:s
     * @param $str
     * @return string
     */
    public static function long($str = null)
    {
        return date("Y-m-d H:i:s",  $str ? strtotime($str) : null);
    }

    /**
     * Возвращает дату в формате Y-m-d
     * @param $str
     * @return string
     */
    public static function short($str)
    {
        return date("Y-m-d", $str ? strtotime($str) : null);
    }

    /**
     * Возвращает дату в формате Y-m-d H:i
     * @param $str
     * @return string
     */
    public static function ui($str)
    {
        return date("Y-m-d H:i",  $str ? strtotime($str) : null);
    }
}
?>