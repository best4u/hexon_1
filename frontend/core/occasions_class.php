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

    function isDate($value)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value))
        {
            return true;
        }else{
            return false;
        }
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

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){
                            $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel" || $item->name == "Actieradius"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ",", ",")." m"]];
                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "VerbruikStad" || $item->name == "Verbruik stad" || $item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Kw" || $item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Koppel Nm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Nm"]];
                        }elseif($item->name == "Koppel Tpm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Tpm"]];
                        }elseif($item->name == "Topsnelheid"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km/u"]];
                        }elseif($item->name == "Acceleratie Naar 100"){
                            $options[] = [$item->category => ["Acceleratie" => $occasion->${"object"}->${"selector"}." sec"]];
                        }else{
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}]];
                        }

                    }
                } else {
                    $options[] = [$item->category => [$item->name => "-"]];
                }

            }

        }

        return $options;
    }


    function get_home_overview_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = $wpdb->prefix . "at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE home_page='1' AND attr_type='0'";
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

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){
                            $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel" || $item->name == "Actieradius"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ",", ",")." m"]];
                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "VerbruikStad" || $item->name == "Verbruik stad" || $item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Kw" || $item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Koppel Nm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Nm"]];
                        }elseif($item->name == "Koppel Tpm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Tpm"]];
                        }elseif($item->name == "Topsnelheid"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km/u"]];
                        }elseif($item->name == "Acceleratie Naar 100"){
                            $options[] = [$item->category => ["Acceleratie" => $occasion->${"object"}->${"selector"}." sec"]];
                        }else{
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}]];
                        }

                    }
                } else {
                    $options[] = [$item->category => [$item->name => "-"]];
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

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){
                            $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel" || $item->name == "Actieradius"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ",", ",")." m"]];
                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "VerbruikStad" || $item->name == "Verbruik stad" || $item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Kw" || $item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Koppel Nm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Nm"]];
                        }elseif($item->name == "Koppel Tpm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Tpm"]];
                        }elseif($item->name == "Topsnelheid"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km/u"]];
                        }elseif($item->name == "Acceleratie Naar 100"){
                            $options[] = [$item->category => ["Acceleratie" => $occasion->${"object"}->${"selector"}." sec"]];
                        }else{
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}]];
                        }

                    }
                } else {
                    $options[] = [$item->category => [$item->name => "-"]];
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

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){
                            $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel" || $item->name == "Actieradius"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ",", ",")." m"]];
                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                                || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "VerbruikStad" || $item->name == "Verbruik stad" || $item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Kw" || $item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Koppel Nm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Nm"]];
                        }elseif($item->name == "Koppel Tpm"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Tpm"]];
                        }elseif($item->name == "Topsnelheid"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km/u"]];
                        }elseif($item->name == "Acceleratie Naar 100"){
                            $options[] = [$item->category => ["Acceleratie" => $occasion->${"object"}->${"selector"}." sec"]];
                        }else{
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}]];
                        }

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



// Temporaly function

    function generate_xml(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $all_occasions = $filertObj->get_occasions($dealerId,$ocassions_obj,'1','1000000000');

        return $all_occasions;
    }


}


