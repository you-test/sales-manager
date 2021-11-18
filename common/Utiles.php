<?php

class Utils
{
    public static function h($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'utf8mb4');
    }
}
