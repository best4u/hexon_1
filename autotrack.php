<?php

/*
Plugin Name: Autotrack3
Description: Autotrack API v3.0 plugin
Version: 3.0
Author: Best4u
Author URI: http://best4u.nl
Text Domain: atBest4u
*/
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
add_action('admin_menu', 'autotrack_menu');

function autotrack_menu() {

    add_menu_page(
        '',                     // No need to have this
        'AutoTrack',            // Menu Label
        'manage_options',
        'instellingen',   // (*) Shared slug
        'instellingen',
        plugins_url('autotrack/images/icon.png'),
        1
    );

    add_submenu_page(
        'instellingen',   // (*) Shared slug
        'Autotrack instellingen',   // Subpage Title
        'Instellingen',             // Submenu Label
        'manage_options',
        'instellingen',   // (*) Shared slug
        'instellingen'
    );
    add_submenu_page(
        'instellingen',   // (*) Shared slug
        'Autotrack attributen',   // Subpage Title
        'Attributen',             // Submenu Label
        'manage_options',
        'attributen',   // (*) Shared slug
        'attributen'
    );

}

require_once('admin/settings-fields.php');
add_action( 'admin_init', 'setting_fields_setup' );

function instellingen() {
    require_once('admin/settings-page.php');
}

function attributen(){
    require_once('admin/attributes-page.php');
}


function load_custom_wp_admin_style($hook) {

    wp_enqueue_style( 'autotrack_admin_css', plugins_url('admin/css/style.css', __FILE__) );
    wp_enqueue_style( 'autotrack_admin_bootstrap', plugins_url('admin/css/bootstrap.css', __FILE__) );
    wp_enqueue_style( 'autotrack_admin_bootstrap-theme', plugins_url('admin/css/bootstrap-theme.css', __FILE__) );
    wp_enqueue_style( 'jquery-ui', plugins_url('admin/css/jquery-ui.min.css', __FILE__) );
    wp_enqueue_style( 'shitch-button', plugins_url('admin/css/jquery.switchButton.css', __FILE__) );
//    wp_enqueue_style( 'autotrack_admin_colorpicker_spectrum', plugins_url('admin/css/spectrum.css', __FILE__) ); //temporar deconectat, vedem ce canta IE

    wp_enqueue_script( 'autotrack_admin_js', plugins_url('admin/js/autotrack.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'autotrack_admin_bootstrap_js', plugins_url('admin/js/bootstrap.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'jquery-ui', plugins_url('admin/js/jquery-ui.min.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'swithc-button', plugins_url('admin/js/jquery.switchButton.js', __FILE__), array('jquery'), '', true );
//    wp_enqueue_script( 'autotrack_admin_colorpicker_spectrum', plugins_url('admin/js/spectrum.js', __FILE__), array('jquery'), '', true ); //temporar deconectat, vedem ce canta IE
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

require_once('admin/core/db_create.php');

register_activation_hook( __FILE__, 'drop_tables' );
register_activation_hook( __FILE__, 'db_install' );
register_activation_hook( __FILE__, 'insert_data_attr' );



require_once ("frontend/index.php");

// Front end ShortCodes

require_once ('frontend/core/occasions_functions.php');
add_shortcode('occasions_list', 'occasions_list');

