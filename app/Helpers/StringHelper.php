<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Generate random string
     * 
     * @param int $length
     * @return string
     */
    public static function quickRandom($length = 8)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
}
