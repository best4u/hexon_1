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
    register_setting( 'autotrack-settings-fields', 'at_form_short_code' );
    register_setting( 'autotrack-settings-fields', 'at_number_of_occasions_on_home' );
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
//    Emails to receive the message
    register_setting( 'autotrack-settings-fields', 'receiver_emails' );
//    Social media
    register_setting( 'autotrack-settings-fields', 'at_social_icons' );
//    Shedule
    register_setting( 'autotrack-settings-fields', 'at_shedule' );
//    contact information
    register_setting( 'autotrack-settings-fields', 'at_contact_info' );
//    thankyou text
    register_setting( 'autotrack-settings-fields', 'at_thank_you_text' );

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

function insert_data_settings(){

//  theme colors
    add_option( 'at_font_color', '#444444' );
    add_option( 'at_attribute_label', '#777777' );
    add_option( 'at_attribute_value', '#444444');
    add_option( 'at_header_color', '#5021ff' );
    add_option( 'at_button_color', '#f7a404' );
    add_option( 'at_price_color', '#ff0000' );
//    home cars
    add_option( 'at_home_cars', 'at_newest_cars' );
//    sort by
    add_option( 'at_sort_by', 'prijs' );
//    sort orientation
    add_option( 'at_sort_by_orientation', 'asc' );
//    layout mode list / table
    add_option( 'at_overview_layoutmode', 'at_layout_overview_list' );
//    details mode : list / tabs
    add_option( 'at_details_view_mode', 'at_details_view_tabs' );
//    sidebar blocks
    add_option( 'at_sidebar_blocks', '[{"name":"Contactformulier","state":"1"},{"name":"Contactinformatie","state":"1"},{"name":"Openingstijden","state":"1"},{"name":"Social Media Informatie","state":"0"}]' );
    //    shedule
    add_option('at_shedule', '[{"day":"Maandag"},{"day":"Dinsdag"},{"day":"Woensdag"},{"day":"Donderdag"},{"day":"Vrijdag"},{"day":"Zaterdag"},{"day":"Zondag"}]');
//    social media icons
    add_option( 'at_social_icons', '[{"name":"Mail","url":"wordpress@best4u.nl"},{"name":"Facebook","url":"http://facebook.com"},{"name":"Linkedin","url":"http://linkedin.com"},{"name":"Twitter","url":"http://twitter.com"},{"name":"Google Plus","url":"http://plus.google.com"},{"name":"Pinterest","url":"http://pinterest.com"},{"name":"Instagram","url":"http://instagram.com"}]' );

}