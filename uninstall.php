<?php

/**
 * @package Aristech
 */


if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

global $wpdb;
$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

foreach ($week_days as $day) {
    $aristech = 'aristech_' . $day;
    $item = esc_sql($aristech);
    $wpdb->query("DELETE FROM wp_options WHERE option_name = '$item'");
}
