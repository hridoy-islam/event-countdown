<?php

/**
 * Plugin Name:       Event Countdown
 * Plugin URI:        https://github.com/hridoy-islam
 * Description:       This plugin is about showing countdown for events, comming soon, sales offer promotion and others
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Ridoy Islam
 * Author URI:        https://github.com/hridoy-islam
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       event-countdown
 * Domain Path:       /languages
 */



define('EVCOUNT_ASSETS', plugin_dir_url(__FILE__) . '/assets/');

class eventCountDown
{
    private $version;
    function __construct()
    {

        $this->version = '1.0';

        // Admin Menu Page

        add_action('plugins_loaded', array($this, 'evcount_textdomain'));
        add_action('wp_enqueue_scripts', array($this, 'evcount_enqueue_script'));
        add_shortcode('evcountdown', array($this, 'evc_shortcode'));
    }


    // Add Shortcode

    function evc_shortcode($atts)
    {

        $atts = shortcode_atts(
            array(
                'size' => '100',
                'color' => 'black',
                'bg' => 'yellow',
                'date' => '2020-06-14',
                'time' => '09:00:00',
                'dayonly' => false,
            ),
            $atts
        );
        // Passing data to js
        $this->evc_size = $atts['size'];
        $this->evc_color = $atts['color'];
        $this->evc_bg = $atts['bg'];
        $this->evc_date = $atts['date'];
        $this->evc_time = $atts['time'];
        $this->evc_dayonly = $atts['dayonly'];
        $this->evc_timezone = get_option('timezone_string');

        // Translating Year, Day, Month Strings
        $translated_strings = array(
            'year' => __('Year', 'event-countdown'),
            'month' => __('Month', 'event-countdown'),
            'day' => __('Day', 'event-countdown'),
            'hour' => __('Hour', 'event-countdown'),
            'minute' => __('Minute', 'event-countdown'),
            'second' => __('Second', 'event-countdown'),
            'size' => __($this->evc_size, 'event-countdown'),
            'color' => __($this->evc_color, 'event-countdown'),
            'time' => __($this->evc_time, 'event-countdown'),
            'date' => __($this->evc_date, 'event-countdown'),
            'zone' => __($this->evc_timezone, 'event-countdown'),
            'bg' => __($this->evc_bg, 'event-countdown'),
            'dayonly' => __($this->evc_dayonly, 'event-countdown'),
        );

        wp_localize_script('evcount_main', 'evcountTranslate', $translated_strings);

        // print_r($outvalue);
        return "<div id='counter'></div>";
    }

    function evcount_textdomain()
    {
        // Text Domain Loaded 
        load_plugin_textdomain('event-countdown', false, dirname(__FILE__) . '/languages');
    }

    function evcount_enqueue_script()
    {

        // Style Loaded  
        wp_enqueue_style('evcount_css', EVCOUNT_ASSETS . 'public/css/countdowncube.css', null, $this->version);

        // Scripts Loaded
        wp_enqueue_script('evcount_moment_min', EVCOUNT_ASSETS . 'public/js/moment.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('evcount_moment_time', EVCOUNT_ASSETS . 'public/js/moment-timezone-with-data-2012-2022.min.js', array('jquery'), $this->version, true);
        wp_enqueue_script('evcount_cube_js', EVCOUNT_ASSETS . 'public/js/countdowncube.js', array('jquery'), $this->version, true);
        wp_enqueue_script('evcount_main', EVCOUNT_ASSETS . 'public/js/main.js', array('jquery'), $this->version, true);


       



    }
}

new eventCountDown();
