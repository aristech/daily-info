<?php

/**
 * @package Aristech
 */

class AristechDailyInfoDeactivate
{
    public static function deactivate()
    {
        flush_rewrite_rules();
    }
}
