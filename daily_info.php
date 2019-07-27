<?php

/**
 * @package Aristech
 * Plugin Name: Daily Info
 * Description : Daily info timer
 * Author: Aristech
 * Version: 1.0.0
 * License: GPL2
 **/
if (!defined('ABSPATH')) {
    die;
}



class Daily_Info
{

    public $plugin;


    function __construct()
    {
        $this->update();
        $this->plugin       = plugin_basename(__FILE__);
        $this->template     = plugin_dir_path(__FILE__) . '/templates/';
        $this->aristech_monday     = get_option("aristech_monday", "");
        $this->aristech_tuesday     = get_option("aristech_tuesday", "");
        $this->aristech_wednesday     = get_option("aristech_wednesday", "");
        $this->aristech_thursday     = get_option("aristech_thursday", "");
        $this->aristech_friday     = get_option("aristech_friday", "");
        $this->aristech_saturday     = get_option("aristech_saturday", "");
        $this->aristech_sunday     = get_option("aristech_sunday", "");
    }

    function register()
    {

        add_action('wp_enqueue_scripts', array($this, 'front_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueAdmin'));
        add_action('admin_menu', array($this, 'admin_menu_option'));
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        add_action('admin_footer', array($this, 'aristech_admin_footer_function'));
        add_shortcode('daily_info', array($this, 'aristech_dailyInfo'));
        add_action(
            'rest_api_init',
            function () {
                $arg = [
                    'validate_callback' => function ($param, $request, $key) {
                        return (is_string($param));
                    },
                ];
                $name_arg = array_merge(
                    $arg,
                    [
                        "name" => "Aristech",
                        'description' => 'int representing a valid week day',
                    ]
                );
                register_rest_route('rest_aristech', '/dailyInfo', [
                    'methods'  => 'get',
                    'callback' => array($this, 'rest_dailyInfo'),
                    'args' => [
                        'day' => array_merge(
                            $name_arg,
                            [
                                'required' => true,
                            ]
                        ),
                    ]
                ]);
            }
        );
    }

    public function settings_link($links)
    {

        $settings_link = '<a href="admin.php?page=daily_info">Settings</a>';

        array_push($links, $settings_link);
        return $links;
    }

    function admin_menu_option()
    {
        wp_enqueue_media();
        add_menu_page('Daily Info', 'Daily Info', 'manage_options', 'daily_info', array($this, 'admin_page'), 'dashicons-calendar-alt', 200);
    }

    function rest_dailyInfo(WP_REST_Request $request)
    {
        $day = $request->get_param('day');
        $day = (isset($day) || !(empty($day))) ? $day : 1;

        switch ($day) {
            case 1:
                $dailyInfo   =   $this->aristech_monday;
                break;
            case 2:
                $dailyInfo   =   $this->aristech_tuesday;
                break;
            case 3:
                $dailyInfo   =   $this->aristech_wednesday;
                break;
            case 4:
                $dailyInfo   =   $this->aristech_thursday;
                break;
            case 5:
                $dailyInfo   =   $this->aristech_friday;
                break;
            case 6:
                $dailyInfo   =   $this->aristech_saturday;
                break;
            case 0:
                $dailyInfo   =   $this->aristech_sunday;
                break;
            default:
                # code...
                break;
        }
        return $dailyInfo;
    }

    function enqueueAdmin()
    {
        wp_enqueue_script('jquery');
        wp_enqueue_script('timepicker', '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js');
        // wp_enqueue_script('timepicker');
        wp_enqueue_style('jquery-ui-css', '//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css');

        wp_enqueue_script('repeater', plugin_dir_url(__FILE__) . 'js/repeater.js', array('jquery'), false, true);
        wp_enqueue_script('adm_script', plugin_dir_url(__FILE__) . 'js/aristech_admin_script.js', array('jquery'), false, true);
    }

    function aristech_admin_footer_function()
    { ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                $('input.timepicker').timepicker({
                    timeFormat: 'HH:mm',
                    interval: 15,
                    // minTime: '07:00',
                    // maxTime: '21:00',
                    // startTime: '07:00',
                    // dynamic: false,
                    // dropdown: true,
                    // scrollbar: true
                });
                $(document.body).on('click', '.addData', function() {
                    $('input.timepicker').timepicker({
                        timeFormat: 'HH:mm',
                        interval: 15,
                        // minTime: '07:00',
                        // maxTime: '21:00',
                        // startTime: '07:00',
                        // dynamic: false,
                        // dropdown: true,
                        // scrollbar: true
                    });
                })
            });
        </script>
    <?php
    }

    function update()
    {
        if (array_key_exists('submit_scripts_update', $_POST)) {

            $week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

            foreach ($week_days as $day) {
                $list_day = array();
                if (isset($_POST['group-' . $day])) {
                    foreach ($_POST['group-' . $day] as $key => $value) {

                        $list = array();
                        foreach ($value as $k => $v) {

                            // echo $k;
                            $list[] = array(
                                $k => $v
                            );
                        }
                        $list_day[] = array(
                            $day . '_' . $key => $list
                        );
                    }

                    update_option('aristech_' . $day, $list_day);
                }
            }
        }
    }

    function aristech_dailyInfo()
    {
        ob_start();
        require_once plugin_dir_path(__FILE__) . 'templates/front.php';
        $data = ob_get_contents();
        ob_end_clean();
        return $data;
    }

    function front_scripts()
    {
        wp_enqueue_script('dailyInfo', plugin_dir_url(__FILE__) . 'js/dailyInfo.js', array(), '0.0.1', true);
        wp_enqueue_script('chunk', plugin_dir_url(__FILE__) . 'js/2.221e2eba.chunk.js', array(), '0.0.1', true);
        wp_enqueue_script('main', plugin_dir_url(__FILE__) . 'js/main.02405f97.chunk.js', array(), '0.0.1', true);
        wp_localize_script('main', 'wpApiDailyInfo', array(
            'siteUrl' => get_site_url()
        ));
    }




    function admin_page()
    {
        require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
    }
}

if (class_exists('Daily_Info')) {
    $Daily_Info = new Daily_Info();
    $Daily_Info->register();
}

//activate
require_once plugin_dir_path(__FILE__) . 'inc/aristech_dailyInfo_activate.php';
register_activation_hook(__FILE__, array('AristechDailyInfoActivate', 'activate'));

//deactivate
require_once plugin_dir_path(__FILE__) . 'inc/aristech_dailyInfo_deactivate.php';
register_deactivation_hook(__FILE__, array('AristechDailyInfoDeactivate', 'deactivate'));
