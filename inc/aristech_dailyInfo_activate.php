<?php

/**
 * @package Aristech
 */

class AristechDailyInfoActivate
{
    public static function activate()
    {
        flush_rewrite_rules();
    }
}
