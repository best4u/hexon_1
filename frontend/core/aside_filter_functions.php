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

function test_ajax_callback()
{
    $dealer_id = get_option('at_dealer_id');

   if(isset($_POST['mark_id'])){
    $mark_id = $_POST['mark_id'];
    // mysql_real_escape_string($mark_id);


    $dealer_id = explode(',',$dealer_id);
    $dealerIds = '';

    if(is_array($dealer_id)){
        foreach($dealer_id as $id){
            $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
        }
    }else{
        $dealerIds .= '&filter%5BdealerId%5D='.$dealer_id.'';
    }

    $at_username = get_option('at_username');
    $at_password = get_option('at_password');

    if($at_username !== "" && $at_password !== ""){
          
                    $ch_m = curl_init("https://www.autotrack.nl/api/merken/" .$mark_id . "/modellen");
                    curl_setopt($ch_m, CURLOPT_HEADER, 0);
                    curl_setopt($ch_m, CURLOPT_POST, 0);
                    curl_setopt($ch_m, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch_m, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch_m, CURLOPT_USERPWD, "" . $at_username . ":" . $at_password . "");
                    $output_m = curl_exec($ch_m);
            
                    $all_models_api = json_decode($output_m);
                    curl_close($ch_m);

                    $ch = curl_init("https://www.autotrack.nl/api/advertenties?pageNumber=1&pageSize=1000000".$dealerIds."&filter%5BmerkId%5D=".$mark_id."");
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, "" . $at_username . ":" . $at_password . "");
                    $output = curl_exec($ch);
            
                    $all_dealers_models_api = json_decode($output);
                    curl_close($ch);
            
        }

             
    $all_models = " ";
    $dealer_models = [];
    $models = [];
    foreach($all_dealers_models_api->items as $model){
        $dealer_models[$model->algemeen->modelId] = $model->algemeen->merkId;
    }

    foreach($all_models_api as $model){
        if(array_key_exists($model->modelId,$dealer_models)){
            $models[$model->modelId] = $model->naam;
        }
    }

    asort($models);

    foreach($models as $key => $model){

        $all_models .= "<option value='".$key."' class='modelOption'>".$model."</option>";

    }
                
    echo $all_models;
}
}



   
// Get model filter data based on mark id END
 
   

            

 


