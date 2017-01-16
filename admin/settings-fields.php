<?php
/**
 * Created by PhpStorm.
 * User: sandu
 * Date: 1/11/2017
 * Time: 4:21 PM
 */

function setting_fields_setup() {
//    register our settings
    register_setting( 'autotrack-settings-fields', 'new_option_name' );
    register_setting( 'autotrack-settings-fields', 'some_other_option' );
    register_setting( 'autotrack-settings-fields', 'option_etc' );
}