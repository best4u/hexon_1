<?php
ini_set('max_execution_time', 300);
/*
Plugin Name: Autotrack3
Description: Autotrack API v3.0 plugin
Version: 3.0
Author: Best4u
Author URI: http://best4u.nl
Text Domain: atBest4u
*/
//require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );
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
    wp_enqueue_style( 'font-awesome_admin', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'autotrack_admin_fsweetalert_css', plugins_url('admin/css/sweetalert.css', __FILE__) );
    wp_enqueue_style( 'autotrack_admin_bootstrap-theme', plugins_url('admin/css/bootstrap-theme.css', __FILE__) );
    wp_enqueue_style( 'jquery-ui', plugins_url('admin/css/jquery-ui.min.css', __FILE__) );
    wp_enqueue_style( 'shitch-button', plugins_url('admin/css/jquery.switchButton.css', __FILE__) );
//    wp_enqueue_style( 'autotrack_admin_colorpicker_spectrum', plugins_url('admin/css/spectrum.css', __FILE__) ); //temporar deconectat, vedem ce canta IE

    wp_enqueue_script( 'autotrack_admin_js', plugins_url('admin/js/autotrack.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'autotrack_admin_sweetalert_js', plugins_url('admin/js/sweetalert.min.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'autotrack_admin_bootstrap_js', plugins_url('admin/js/bootstrap.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'jquery-ui', plugins_url('admin/js/jquery-ui.min.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'swithc-button', plugins_url('admin/js/jquery.switchButton.js', __FILE__), array('jquery'), '', true );
//    wp_enqueue_script( 'autotrack_admin_colorpicker_spectrum', plugins_url('admin/js/spectrum.js', __FILE__), array('jquery'), '', true ); //temporar deconectat, vedem ce canta IE

    wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function plugin_frontend_scripts() {


    wp_enqueue_style( 'fotorama_css', 'http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css' );
    wp_enqueue_style( 'formstyler_css', plugins_url('frontend/core/views/plugins/formstyler/jquery.formstyler.css', __FILE__) );
    wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'nouislider', plugins_url('frontend/core/views/plugins/nouislider/nouislider.min.css', __FILE__) );
    wp_enqueue_style( 'icomoon', plugins_url('frontend/core/views/icomoon/style.css', __FILE__) );
    wp_enqueue_style( 'styles_plugin', plugins_url('frontend/core/views/styles.css', __FILE__) );
//
    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), '', true );
//    wp_enqueue_script( 'fotorama', 'http://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.4/numeral.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'fotorama', 'http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', array('jquery'), '', true );
    wp_enqueue_script( 'formstyler_js', plugins_url('frontend/core/views/plugins/formstyler/jquery.formstyler.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'nouislider_js', plugins_url('frontend/core/views/plugins/nouislider/nouislider.min.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'wNumb', plugins_url('frontend/core/views/plugins/wNumb.js',__FILE__), array('jquery'), '', true );
//    wp_enqueue_script( 'mainAuto_js', plugins_url('frontend/core/views/jsAuto/jquery.number.min.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'mainAuto_js', plugins_url('frontend/core/views/jsAuto/mainAuto.js',__FILE__), array('jquery'), '', true );


}

add_action( 'wp_enqueue_scripts', 'plugin_frontend_scripts' );

require_once('admin/core/db_create.php');

register_activation_hook( __FILE__, 'drop_tables' );
register_activation_hook( __FILE__, 'db_install' );
register_activation_hook( __FILE__, 'insert_data_attr' );
register_activation_hook( __FILE__, 'insert_data_settings' );

// Generate xml
require_once('frontend/core/occasions_functions.php');

register_activation_hook( __FILE__, 'generate_xml' );

function cron_add_minute( $schedules ) {

    // Adds once every minute to the existing schedules.

    $schedules['everyminute'] = array(
        'interval' => 60,
        'display' => __( 'Once Every Minute' )
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'cron_add_minute' );

function cronstarter_activation() {
    if( !wp_next_scheduled( 'mycronjob' ) ) {
        wp_schedule_event( time(), 'daily', 'mycronjob' );
    }
}
add_action('wp', 'cronstarter_activation');

// unschedule event upon plugin deactivation
function cronstarter_deactivate() {

    $timestamp = wp_next_scheduled ('mycronjob');

    wp_unschedule_event ($timestamp, 'mycronjob');
}
register_deactivation_hook (__FILE__, 'cronstarter_deactivate');


function my_repeat_function() {

    $ocassions_obj = new Ocassions();
    $dealerId = get_option("at_dealer_id");
    $filertObj = new Filter();
    $all_occasions = $filertObj->get_occasions($dealerId,$ocassions_obj,'1','1000000000');

    if($all_occasions){

        $domen = "http://".$_SERVER['SERVER_NAME'];
        $page = get_option("at_url_page_adverts");

        $domtree = new DOMDocument('1.0', 'UTF-8');


        $xmlRoot = $domtree->createElement("xml");

        $xmlRoot = $domtree->appendChild($xmlRoot);

        $currentTrack = $domtree->createElement("occasion");
        $currentTrack = $xmlRoot->appendChild($currentTrack);


        foreach($all_occasions->items as $item){

            $currentTrack->appendChild($domtree->createElement('name',$ocassions_obj->get_car_name($item)));
            $currentTrack->appendChild($domtree->createElement('url',''.$domen.'/'.$page."/?overview=".$item->advertentieId.""));
        }

        $domtree->save('xml_car_sitemap.xml');

    }

}

add_action ('mycronjob', 'my_repeat_function');

// End generate xml

require_once ("frontend/index.php");

// Front end ShortCodes

require_once ('frontend/core/occasions_functions.php');
add_action('wp_head', 'addGraph',1);

add_shortcode('occasions_list', 'occasions_list_overview');
add_shortcode('home_occasions', 'get_home_occasions');




