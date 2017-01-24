<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 5:03 PM
 */


class Ocassions
{

    function connection_to_api($type, $filter)
    {
        $username = get_option("at_username");
        $password = get_option("at_password");
        $dealerId = get_option("at_dealer_id");
        $ch = curl_init("https://www.autotrack.nl/api/" . $type . "" . $filter . "");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "" . $username . ":" . $password . "");
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

    function check_overview($show_id=null){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_str = explode("/",$url);
        if($show_id == null){
            return isset($url_str[4]);
        }else{
            return $url_str[4];
        }

    }

    function get_car_name($occasion)
    {
        $mark_object = $this->connection_to_api("merken/", $occasion->algemeen->merkId);
        $model_object = $this->connection_to_api("merken/",
            $occasion->algemeen->merkId . "/modellen/" . $occasion->algemeen->modelId);
        return $mark_object->naam . " " . $model_object->naam . " " . $occasion->algemeen->uitvoering;
    }

    function get_car_price($occasion)
    {
        $price_total = $occasion->prijs->totaal;
        return number_format($price_total, 2, ",", ".");
    }

    function get_image_link($occasion)
    {
        return $occasion->algemeen->fotos[0]->url;
    }

    function get_all_images($occasion)
    {

        return $occasion->algemeen->fotoUrls;
    }

    function get_overview_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix . "at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE overview='1' AND attr_type='0'";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {

            ${"object"} = $item->category;
            if ($item->type == "merkId") {
                $mark_object = $this->connection_to_api("merken/", $occasion->${"object"}->merkId);
                $options[] = [$item->name => $mark_object->naam];
            } elseif ($item->type == "modelId") {
                $model_object = $this->connection_to_api("merken/",
                    $occasion->${"object"}->merkId . "/modellen/" . $occasion->${"object"}->modelId);
                $options[] = [$item->name => $model_object->naam];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->${"object"}->${"selector"}->standaard];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->${"selector"}];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => number_format($occasion->${"selector"}->totaal, 2, ",", ".")];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                    if ($occasion->${"object"}->${"selector"} === true) {
                        $options[] = [$item->name => "Ja"];
                    } elseif ($occasion->${"object"}->${"selector"} === false) {
                        $options[] = [$item->name => "Nee"];
                    } else {
                        $options[] = [$item->name => $occasion->${"object"}->${"selector"}];
                    }
                } else {
                    $options[] = [$item->name => "-"];
                }

            }

        }

        return $options;
    }


    function get_sumary_detail_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix . "at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE summary_detail='1' AND attr_type='0'";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {

            ${"object"} = $item->category;
            if ($item->type == "merkId") {
                $mark_object = $this->connection_to_api("merken/", $occasion->${"object"}->merkId);
                $options[] = [$item->name => $mark_object->naam];
            } elseif ($item->type == "modelId") {
                $model_object = $this->connection_to_api("merken/",
                    $occasion->${"object"}->merkId . "/modellen/" . $occasion->${"object"}->modelId);
                $options[] = [$item->name => $model_object->naam];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->${"object"}->${"selector"}->standaard];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => $occasion->${"selector"}];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [$item->name => number_format($occasion->${"selector"}->totaal, 2, ",", ".")];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                    if ($occasion->${"object"}->${"selector"} === true) {
                        $options[] = [$item->name => "Ja"];
                    } elseif ($occasion->${"object"}->${"selector"} === false) {
                        $options[] = [$item->name => "Nee"];
                    } else {
                        $options[] = [$item->name => $occasion->${"object"}->${"selector"}];
                    }
                } else {
                    $options[] = [$item->name => "-"];
                }

            }

        }

        return $options;
    }


    function get_details_total_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix . "at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE details_total='1' AND attr_type='0'";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {

            ${"object"} = $item->category;
            if ($item->type == "merkId") {
                $mark_object = $this->connection_to_api("merken/", $occasion->${"object"}->merkId);
                $options[] = [$item->category => [$item->name => $mark_object->naam]];
            } elseif ($item->type == "modelId") {
                $model_object = $this->connection_to_api("merken/",
                    $occasion->${"object"}->merkId . "/modellen/" . $occasion->${"object"}->modelId);
                $options[] = [$item->category => [$item->name => $model_object->naam]];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}->standaard]];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"selector"}]];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [
                    $item->category => [
                        $item->name => number_format($occasion->${"selector"}->totaal, 2, ",", ".")
                    ]
                ];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                    if ($occasion->${"object"}->${"selector"} === true) {
                        $options[] = [$item->category => [$item->name => "Ja"]];
                    } elseif ($occasion->${"object"}->${"selector"} === false) {
                        $options[] = [$item->category => [$item->name => "Nee"]];
                    } else {
                        $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}]];
                    }
                } else {
                    $options[] = [$item->category => [$item->name => "-"]];
                }

            }

        }

        return $options;
    }

    function get_car_safety_attr($category_id,$occasion){
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix."at_attributes";
        $query = "SELECT * FROM ".$table." WHERE details_total='1' AND attr_type='1' AND option_category_id='".$category_id."' ";
        $results = $wpdb->get_results( $query, OBJECT );
        $all_options_id = [];
        $occasions_options_id = $occasion->algemeen->optieIds;
        foreach($results as $item){
            $all_options_id[] = $item->option_id;
        }
        $options_id = array_intersect($occasions_options_id,$all_options_id);
        if(count($options_id) > 0){
            foreach($options_id as $opt){
                $option = $this->connection_to_api("opties/",$opt);
                $options[] = $option->naam;
            }
        }

        return $options;
    }


}


