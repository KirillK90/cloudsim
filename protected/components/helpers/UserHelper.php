<?php

class UserHelper {
    
    public static function hash($password)
    {
        return md5($password);
    }
}