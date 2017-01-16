<?php

/*
Plugin Name: Autotrack3
Description: Autotrack API v3.0 plugin
Version: 3.0
Author: Best4u
Author URI: http://best4u.nl
Text Domain: atBest4u
*/

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

    wp_enqueue_style( 'autotrack_admin_css', plugins_url('css/style.css', __FILE__) );
    wp_enqueue_script( 'autotrack_admin_js', plugins_url('js/autotrack.js', __FILE__), array('jquery'), '', true );
}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );


require_once ("frontend/index.php");