<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/23/2017
 * Time: 6:06 PM
 */


if(isset($_POST['mark_id'])){
    session_start();

    $username = $_SESSION['at_username'];
    $password = $_SESSION['at_password'];
    $dealer_id = $_SESSION['at_dealer_id'];
    $dealer_id = explode(',',$dealer_id);
    $dealerIds = '';
    if(is_array($dealer_id)){
        foreach($dealer_id as $id){
            $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
        }
    }else{
        $dealerIds .= '&filter%5BdealerId%5D='.$dealer_id.'';
    }


    $ch = curl_init("https://www.autotrack.nl/api/merken/".$_POST['mark_id']."/modellen");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "" . $username . ":" . $password . "");
    $output = curl_exec($ch);
    $all_models_api = json_decode($output);

// Get dealer models types
    $ch = curl_init("https://www.autotrack.nl/api/advertenties?pageNumber=1&pageSize=1000000".$dealerIds."&filter%5BmerkId%5D=".$_POST['mark_id']."");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
    curl_setopt($ch, CURLOPT_USERPWD, "" . $username . ":" . $password . "");
    $output = curl_exec($ch);
    $all_dealers_models_api = json_decode($output);

//    Get dealer models
        $all_models = "";
        $dealer_models = [];
        foreach($all_dealers_models_api->items as $model){
            $dealer_models[$model->algemeen->modelId] = $model->algemeen->merkId;
        }

        foreach($all_models_api as $model){
            if(array_key_exists($model->modelId,$dealer_models)){
                $dealer_models[$model->modelId] = $model->naam;
            }
        }

        asort($dealer_models);

        foreach($dealer_models as $key => $model){

            $all_models .= "<option value='$key' class='modelOption'>".$model."</option>";

        }

        echo $all_models;


}