<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 5:03 PM
 */


class Ocassions{

    function connection_to_api($type,$filter)
    {
        $username = get_option("at_username");
        $password = get_option("at_password");
        $dealerId = get_option("at_dealer_id");
        $ch = curl_init("https://www.autotrack.nl/api/".$type."".$filter."");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "".$username.":".$password."");
        $output = curl_exec($ch);
        return json_decode($output);
        curl_close($ch);
    }

    function db_connect_sql($sql)
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $results = $conn->query($sql);
        if ($results) {
            return $results->fetch_assoc();
        } else {
            return "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

    function get_car_name($occasion)
    {
        $mark_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId);
        $model_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId."/modellen/".$occasion->algemeen->modelId);
        return $mark_object->naam." ".$model_object->naam." ".$occasion->algemeen->uitvoering;
    }

    function get_car_price($occasion)
    {
        $price_total = $occasion->prijs->totaal;
        return number_format($price_total,2,",",".");
    }

    function get_image_link($occasion)
    {
        return $occasion->algemeen->fotos[0]->url;
    }

    function get_all_images($occasion)
    {

        return $occasion->algemeen->fotoUrls;
    }

    function get_home_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix."at_attributes";
        $query = "SELECT * FROM ".$table." WHERE overview='1'";
        $results = $wpdb->get_results( $query, OBJECT );

        foreach($results as $item){
            if($item->category == "ALGEMEEN")
            {
                if($item->type == "merkId"){
                    $mark_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId);
                    $options[] = [$item->name => $mark_object->naam];
                }elseif($item->type == "modelId"){
                    $model_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId."/modellen/".$occasion->algemeen->modelId);
                    $options[] = [$item->name => $model_object->naam];
                }else{
                    ${"selector"} = $item->type;
                    $options[] = [$item->name => $occasion->algemeen->${"selector"}];
                }
            }elseif($item->category == "AFLEVERING"){
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->aflevering->${"selector"}];
            }elseif($item->category == "GESCHIEDENIS"){
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->geschiedenis->${"selector"}];
            }
        }

        return $options;
    }


    function get_sumary_detail_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix."at_attributes";
        $query = "SELECT * FROM ".$table." WHERE summary_detail='1'";
        $results = $wpdb->get_results( $query, OBJECT );

        foreach($results as $item){
            if($item->category == "ALGEMEEN")
            {
                if($item->type == "merkId"){
                    $mark_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId);
                    $options[] = [$item->name => $mark_object->naam];
                }elseif($item->type == "modelId"){
                    $model_object = $this->connection_to_api("merken/",$occasion->algemeen->merkId."/modellen/".$occasion->algemeen->modelId);
                    $options[] = [$item->name => $model_object->naam];
                }else{
                    ${"selector"} = $item->type;
                    $options[] = [$item->name => $occasion->algemeen->${"selector"}];
                }
            }elseif($item->category == "AFLEVERING"){
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->aflevering->${"selector"}];
            }elseif($item->category == "GESCHIEDENIS"){
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->geschiedenis->${"selector"}];
            }
        }

        return $options;
    }

}
