<?php
/**
 * Created by PhpStorm.
 * User: sandu
 * Date: 1/11/2017
 * Time: 4:21 PM
 */

function setting_fields_setup() {
//    register our settings
    register_setting( 'autotrack-settings-fields', 'at_username' );
    register_setting( 'autotrack-settings-fields', 'at_password');
    register_setting( 'autotrack-settings-fields', 'at_consumer_id' );
    register_setting( 'autotrack-settings-fields', 'at_dealer_id' );
    register_setting( 'autotrack-settings-fields', 'at_url_page_adverts' );
    register_setting( 'autotrack-settings-fields', 'at_period_after_sell' );
//    themes
    register_setting( 'autotrack-settings-fields', 'at_theme' );
//    colors
    register_setting( 'autotrack-settings-fields', 'at_font_color' );
    register_setting( 'autotrack-settings-fields', 'at_attribute_label' );
    register_setting( 'autotrack-settings-fields', 'at_attribute_value' );
    register_setting( 'autotrack-settings-fields', 'at_header_color' );
    register_setting( 'autotrack-settings-fields', 'at_button_color' );
    register_setting( 'autotrack-settings-fields', 'at_price_color' );
//    Home page cars
    register_setting( 'autotrack-settings-fields', 'at_home_cars' );
//    Ocasions sort by
    register_setting( 'autotrack-settings-fields', 'at_sort_by' );
//    Ascending/Descending ()
    register_setting( 'autotrack-settings-fields', 'at_sort_by_orientation' );
//    Layout mode list/table
    register_setting( 'autotrack-settings-fields', 'at_overview_layoutmode' );
//    Details mode list/tabs
    register_setting( 'autotrack-settings-fields', 'at_details_view_mode' );
//    Detail page / sortable sidebar blocks
    register_setting( 'autotrack-settings-fields', 'at_sidebar_blocks' );

}


// hide the password after it has been saved
function myplugin_update_at_password( $new_value, $old_value ) {
    if($new_value != ""){
        return $new_value;
    }else{
        return $old_value;
    }
}

function myplugin_init() {
    add_filter( 'pre_update_option_at_password', 'myplugin_update_at_password', 10, 2 );
}

add_action( 'init', 'myplugin_init' );

function object_to_array($data)
{
    if (is_array($data) || is_object($data))
    {
        $result = array();
        foreach ($data as $key => $value)
        {
            $result[$key] = object_to_array($value);
        }
        return $result;
    }
    return $data;
}