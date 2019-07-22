<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/23/2017
 * Time: 6:06 PM
 */

 if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    // GEt models by mark ID,
    //In this function we have a more complicated process, we took all the cars that has the client plus we take all the API models then compare them

    function get_ajax_models()
    {

         $dealerId = get_option("at_dealer_id");
         $dealers = explode(',', $dealerId);
        
        if(isset($_POST['brand_id'])){
         $brandId = $_POST['brand_id'];

         var_dump($brandId);
        
        $json = file_get_contents("http://auto.best4u.nl/" . $dealers[0] . "/brand/".$brandId."/models/?dealers=".$dealerId."");

        var_dump($json);

        var_dump("http://auto.best4u.nl/" . $dealers[0] . "/brand/".$brandId."/models/?dealers=".$dealerId."");

        $all_models = '';
        foreach (json_decode($json)->data as $key => $model) {
            $all_models .= "<option value='".$model->id."' class='modelOption'>".$model->title."</option>";
        }
                    
        echo $all_models;

    }
}


