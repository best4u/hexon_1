<?php
ini_set('max_execution_time', 300);
/*
Plugin Name: Best4u Cars API
Description: Best4u Cars API "Hexon"
Version: 1.0
Author: Best4u
Author URI: http://best4u.nl
Text Domain: atBest4u
*/

add_action('admin_menu', 'autotrack_admin_menu');

function autotrack_admin_menu() {

    add_menu_page(
        '',                     // No need to have this
        'Best4u Cars API',            // Menu Label
        'manage_options',
        'instellingen',   // (*) Shared slug
        'instellingen',
        plugins_url('autotrack/images/icon.png'),
        1
    );

    add_submenu_page(
        'instellingen',   // (*) Shared slug
        'API instellingen',   // Subpage Title
        'Instellingen',             // Submenu Label
        'manage_options',
        'instellingen',   // (*) Shared slug
        'instellingen'
    );
    add_submenu_page(
        'instellingen',     // (*) Shared slug
        'API attributen',   // Subpage Title
        'Attributen',      // Submenu Label
        'manage_options',
        'attributen',       // (*) Shared slug
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

    if(isset($_GET['page']) && ($_GET['page'] == 'attributen' || $_GET['page'] == 'instellingen')){
        wp_enqueue_style( 'autotrack_admin_bootstrap', plugins_url('admin/css/bootstrap.css', __FILE__) );
    }

    
    wp_enqueue_style( 'font-awesome_admin', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'autotrack_admin_fsweetalert_css', plugins_url('admin/css/sweetalert.css', __FILE__) );
    wp_enqueue_style( 'autotrack_admin_bootstrap-theme', plugins_url('admin/css/bootstrap-theme.css', __FILE__) );
    wp_enqueue_style( 'jquery-ui', plugins_url('admin/css/jquery-ui.min.css', __FILE__) );
    wp_enqueue_style( 'shitch-button', plugins_url('admin/css/jquery.switchButton.css', __FILE__) );

    wp_enqueue_style( 'shitch-button', plugins_url('admin/css/tether.css', __FILE__) );

    wp_enqueue_script( 'autotrack_admin_js', plugins_url('admin/js/autotrack.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'autotrack_admin_sweetalert_js', plugins_url('admin/js/sweetalert.min.js', __FILE__), array('jquery'), '', true );
    // wp_enqueue_script( 'autotrack_admin_bootstrap_js', plugins_url('admin/js/bootstrap.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'jquery-ui', plugins_url('admin/js/jquery-ui.js', __FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'swithc-button', plugins_url('admin/js/jquery.switchButton.js', __FILE__), array('jquery'), '', true );
    // wp_enqueue_script( 'tether', plugins_url('admin/js/tether.js', __FILE__), array('jquery'), '', true );


    wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

function plugin_frontend_scripts() {        


    wp_enqueue_style( 'fotorama_css', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css' );
    wp_enqueue_style( 'formstyler_css', plugins_url('frontend/core/views/plugins/formstyler/jquery.formstyler.css', __FILE__) );
    wp_enqueue_style( 'normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css' );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'nouislider', plugins_url('frontend/core/views/plugins/nouislider/nouislider.min.css', __FILE__) );
    wp_enqueue_style( 'icomoon', plugins_url('frontend/core/views/icomoon/style.css', __FILE__) );
    wp_enqueue_style( 'styles_plugin_print', plugins_url('frontend/core/views/printStyles.css', __FILE__),array(),'','print');
    wp_enqueue_style( 'styles_plugin', plugins_url('frontend/core/views/styles.css', __FILE__) );
//
    wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array('jquery'), '', true );

    wp_enqueue_script( 'fotorama', 'https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js', array('jquery'), '', true );
    wp_enqueue_script( 'formstyler_js', plugins_url('frontend/core/views/plugins/formstyler/jquery.formstyler.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'nouislider_js', plugins_url('frontend/core/views/plugins/nouislider/nouislider.min.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'wNumb', plugins_url('frontend/core/views/plugins/wNumb.js',__FILE__), array('jquery'), '', true );

    wp_enqueue_script( 'mainAuto_js_print', plugins_url('frontend/core/views/jsAuto/printThis.js',__FILE__), array('jquery'), '', true );
    wp_enqueue_script( 'mainAuto_js', plugins_url('frontend/core/views/jsAuto/mainAuto.js',__FILE__), array('jquery'), '', true );


}

add_action( 'wp_enqueue_scripts', 'plugin_frontend_scripts' );

require_once('admin/core/db_create.php');

register_activation_hook( __FILE__, 'drop_tables' );
register_activation_hook( __FILE__, 'db_install' );
register_activation_hook( __FILE__, 'insert_data_attr' );
register_activation_hook( __FILE__, 'insert_data_settings' );


require_once('frontend/core/CarsController.php');

require_once ("frontend/index.php");

// Front end ShortCodes

require_once ('frontend/core/CarsController.php');
add_action('wp_head', 'addGraph',0,0);
//The functions which is used in shortcodes you can find in CarsController.php the second attribute of add_shortcode is name of function

// Shortcode to list all cars with pagination , here we can use attributes "count" - count of cars for pagination and "carrosserievorm" -- Body shape
add_shortcode('occasions_list', 'occasions_list_overview');
// Shortcode to list all cars without pagination , here we can use attributes "count" - count of cars for pagination and "carrosserievorm" -- Body shape
add_shortcode('occasions_list_all', 'occasions_list_overview_all');
// Shortcode to list all company cars
add_shortcode('company_occasions_list', 'company_occasions_list');
// The latest cars to be displayed on home page (the count of cars we can set from admin settings)
add_shortcode('home_occasions', 'get_home_occasions');
// The Shortcode for the work graph 
add_shortcode('open_hours_company', 'get_open_company_hours');
// Shortcode for home filter 
add_shortcode('home_filter', 'get_home_filter');
// Shortcode for sold cars 
add_shortcode('sold_occasions', 'sold_cars');
// Shortcodes are activated


// Permalinks for detail page START


function wpse26388_rewrites_init(){
    $page_slug = get_option("at_url_page_adverts");
    add_rewrite_rule(
        ''.$page_slug.'/([^/]+)/?',
        'index.php?pagename='.$page_slug.'&car_slug=$matches[1]',
        'top' );
}
add_action( 'init', 'wpse26388_rewrites_init' );



function wpse26388_query_vars( $query_vars ){
    $query_vars[] = 'car_slug';
    return $query_vars;
}
add_filter( 'query_vars', 'wpse26388_query_vars' );
// Permalinks for detail page END


// Ajax init
function test_ajax_scripts() {


wp_localize_script( 'mainAuto_js', 'ajax', array(
    'url' => admin_url( 'admin-ajax.php' )
) );

}
add_action( 'wp_enqueue_scripts', 'test_ajax_scripts' );

function add_ajax_head() {
    ?>
<script type="text/javascript">
    var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
    <?php
}

add_action('wp_head', 'add_ajax_head');
require_once ('frontend/core/aside_filter_functions.php');
require_once('admin/core/ajax_requests_at.php');

add_action('wp_ajax_models_ajax_action','get_ajax_models');
add_action('wp_ajax_nopriv_models_ajax_action','get_ajax_models');

add_action('wp_ajax_test_response','attr_ajax_check_uncheck_all');
add_action('wp_ajax_test_response_sel_des','selectDeselectAll');
add_action('wp_ajax_filter_attributes','attr_filter');



session_start();


