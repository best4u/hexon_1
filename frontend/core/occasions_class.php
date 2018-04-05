<?php
/**
 * Created by PhpStorm.c
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 5:03 PM
 */


class Ocassions
{

    // Connection to AT API

    
    function connection_to_api($type, $filter)
    {
        $username = get_option("at_username");
        $password = get_option("at_password");
        if($username !== "" && $password !== ""){
        
                    $ch = curl_init("https://www.autotrack.nl/api/" . $type . "" . $filter . "");
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_POST, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                    curl_setopt($ch, CURLOPT_USERPWD, "" . $username . ":" . $password . "");
                    $output = curl_exec($ch);
            
                    return json_decode($output);
                    curl_close($ch);
            
        }
        
    }

    // Connection to wordpress DB

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

    function get_apkBijAflevering($occasion){

        if(isset($occasion->aflevering->afleveringskosten)){
            return "€ ".$occasion->aflevering->afleveringskosten;
        }else{
            return "-";
        }

    }

    // Here we format in the correct way the kenketen value

    function kenteken_format($occasion){
        $value = $occasion->kenteken;
        $car_year = $occasion->geschiedenis->bouwjaar;

        $formated_val = '';

        if($car_year <= '2008'){
            $formated_val = substr($value,0,2).'-';
            $formated_val .= substr($value,2,2).'-';
            $formated_val .= substr($value,4,4);
            $formated_val = strtoupper($formated_val);
        }else{
            preg_match_all('/([0-9]+|[a-zA-Z]+)/',$value,$matches);
      
        foreach ($matches[0] as $key => $val) {
            if($key == 0 || $key == 1){
                $formated_val .= $val.'-';
            }else{
                $formated_val .= $val;
            }
        }
        }
    
        return $formated_val;
    }

    function test_func(){
        $value = $occasion->kenteken;
        $car_year = $occasion->geschiedenis->bouwjaar;

        $formated_val = '';
        if($car_year >= '2000' && $car_year <= '2007'){

            $formated_val = substr($value,0,2).'-';
            $formated_val .= substr($value,2,2).'-';
            $formated_val .= substr($value,4,4);
            $formated_val = strtoupper($formated_val);

        }elseif($car_year >= '2008' && $car_year <= '2013'){

            $formated_val = substr($value,0,2).'-';
            $formated_val .= substr($value,2,3).'-';
            $formated_val .= substr($value,5,1);
            $formated_val = strtoupper($formated_val);

        }elseif($car_year >= '2014' && $car_year <= '2015'){
            $formated_val = substr($value,0,1).'-';
            $formated_val .= substr($value,2,3).'-';
            $formated_val .= substr($value,4,5);
            $formated_val = strtoupper($formated_val);
        }else{
            $formated_val = substr($value,0,3).'-';
            $formated_val .= substr($value,3,2).'-';
            $formated_val .= substr($value,5,1);
            $formated_val = strtoupper($formated_val);
        }
        
        return $formated_val;
    }

// Here we store all address information and make html structure

    function get_addres_info($occasion){

        $html_structure = '<p style="text-align: left;"><label class="bigLabel">Contactinformatie</label></p>';
        $html_structure .= '<p style="text-align: left;">'.$occasion->aanbieder->straatnaam.' '.$occasion->aanbieder->huisnummer.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$occasion->aanbieder->postcode.' '.$occasion->aanbieder->plaatsnaam.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$occasion->aanbieder->telefoonnummer.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$occasion->aanbieder->emailadres.'</p>';
        return $html_structure;
    }

    // Here we have function which check if the value is date

    function isDate($value)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value))
        {
            return true;
        }else{
            return false;
        }
    }
// Here we have the function which check in the user is on overview page
    function check_overview($show_id=null){
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_str = explode("/",$url);
        if($show_id == null){
            return isset($url_str[4]);
        }else{
            return $url_str[4];
        }

    }

    // Here we make the full car name from merkNaam modelNaam and uitvoering these are datas comes from API

    function get_car_name($occasion)
    {

        return $occasion->algemeen->merkNaam . " " . $occasion->algemeen->modelNaam . " " . $occasion->algemeen->uitvoering;
    }

    function getAutoTrustGarantie($occasion)
    {
        /** 233 is Autotrust Garantie ID **/
        
            if(in_array(233, $occasion->garanties->garantieIds)){
                return true;
            }else{
                return false;
            }
    }

    // Here we get correct slug to show car detail

    function get_car_slug($occasion)
    {
     
        $uitvoering  = str_replace('"','',$occasion->algemeen->uitvoering);
        $uitvoering  = str_replace('/','-',$uitvoering);
        $slug = trim(strtolower($occasion->algemeen->merkNaam)) . "-" . trim(strtolower($occasion->algemeen->modelNaam)). "-" .str_replace(" ","-",strtolower($uitvoering));
        $slug = str_replace("%","", $slug);
        return $slug;
    }

    // Here we get correct car price

    function get_car_price($occasion)
    {
        $price_total = $occasion->prijs->totaal;
        return number_format($price_total, 0, ",", ".");
    }
    // Here we get btw value
    function get_btw($occasion){
        $text = '';
        if($occasion->prijs->inclusiefBtw === true){
            
        }else{
            $text = "( Ex. BTW )";
        }
        return $text;
    }

    // Check if car have NapLogo
    function get_nap_logo($occasion){
     
         if(isset($occasion->geschiedenis->kilometerstandCorrect) && $occasion->geschiedenis->kilometerstandCorrect === true){
            return true;
        }else{
            return false;
        }
       

    }

    // HEre we get image link for slider on detail page slider and on oveview page

    function get_image_link($occasion)
    {
        
        return $occasion->algemeen->fotos[0]->alternatieven[1]->url;
    }

    // Here we get images for slider on detail page

    function get_all_images($occasion)
    {

        return $occasion->algemeen->fotoUrls;
    }

    // Here we get thumbnails of images

    function get_small_images($occasion){
        $images = [];
        foreach($occasion->algemeen->fotos as $foto){
           $images[$foto->alternatieven[0]->url] = $foto->url;
        }
        return $images;
    }

    // Here we get overview attributes which are checked in admin settings

    function get_overview_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE overview='1' AND attr_type='0' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {
            ${"object"} = $item->category;
             ${"selector"} = $item->type;
            if(${"object"} == "garanties"){

                foreach($occasion->${"object"}->garantieIds as $id){
                    $garanties_item = $this->connection_to_api("garanties/", $id);
                    $options[] = [$item->category => ['' => $garanties_item->naam]];
                }
            }elseif(${"object"} == "geschiedenis" && $item->attribute == "DATUMEERSTETOELATINGNAT"){

            }elseif(${"object"} == "aflevering"){

                if($item->type == "apkBijAflevering"){
                   if($occasion->aflevering->apkBijAflevering === true){
                        $options[] = [$item->category => ["Apk bij aflevering" => 'APK bij aflevering  <a href="https://www.mijnautocoach.nl/aankoopkeuring/auto">Aankoopkeuring aanvragen</a>']];
                    }else{
                        $options[] = [$item->category => ["Apk bij aflevering" => '-']];
                    }
                }else{
                    $options[] = [$item->category => [$item->type => $occasion->${"object"}->${"selector"} != "" ? $occasion->${"object"}->${"selector"} : "-"]];
                }

            }elseif($item->type == "btwVerrekenbaar"){

                 if ($occasion->${"object"}->btwVerrekenbaar === true){
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Ja"]];
                 }else{
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Nee"]];
                 }
            
                    
            }elseif($item->type == "merkId") {
                $options[] = [$item->category => [$item->name => $occasion->algemeen->merkNaam]];
            } elseif ($item->type == "modelId") {
               
                $options[] = [$item->category => [$item->name => $occasion->algemeen->modelNaam]];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}->standaard]];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $this->kenteken_format($occasion)]];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [
                    $item->category => [
                        $item->name => '€ '.number_format($occasion->${"selector"}->totaal, 2, ",", ".")
                    ]
                ];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                    if ($occasion->${"object"}->${"selector"} === true) {
                        
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Ja"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Ja"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Ja"]];
                        }
                        
                    }elseif ($occasion->${"object"}->${"selector"} === false) {
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Nee"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Nee"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Nee"]];
                        }
                        
                    }else {

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => ["Kilometerstand" => number_format($occasion->${"object"}->${"selector"}, 0, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){  if($item->name == "VervaldatumApk"){
                                $options[] = [$item->category => ["Vervaldatum apk" => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }else{
                                $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel"){

                            $options[] = [$item->category => [$item->name => substr_replace(substr_replace($occasion->${"object"}->${"selector"}, ',',1,0)," ", -1)." m"]];

                        }elseif($item->name == "Actieradius"){

                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km"]];

                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Verbruik stad" || $item->name == "VerbruikStad"){
                            $options[] = [$item->category => ["Verbruik stad" => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Vermogen Kw"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Kw"]];
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

    // Here we get home overview attributes which are checked in admin settings

    function get_home_overview_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE home_page='1' AND attr_type='0' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {
            ${"object"} = $item->category;
             ${"selector"} = $item->type;
            if(${"object"} == "garanties"){

                foreach($occasion->${"object"}->garantieIds as $id){
                    $garanties_item = $this->connection_to_api("garanties/", $id);
                    $options[] = [$item->category => ['' => $garanties_item->naam]];
                }
            }elseif(${"object"} == "geschiedenis" && $item->attribute == "DATUMEERSTETOELATINGNAT"){

            }elseif(${"object"} == "aflevering"){

                if($item->type == "apkBijAflevering"){
                    if($occasion->aflevering->apkBijAflevering === true){
                        $options[] = [$item->category => ["Apk bij aflevering" => 'APK bij aflevering  <a href="https://www.mijnautocoach.nl/aankoopkeuring/auto">Aankoopkeuring aanvragen</a>']];
                    }else{
                        $options[] = [$item->category => ["Apk bij aflevering" => '-']];
                    }
                }else{
                    $options[] = [$item->category => [$item->type => $occasion->${"object"}->${"selector"} != "" ? $occasion->${"object"}->${"selector"} : "-"]];
                }

            }elseif($item->type == "btwVerrekenbaar"){

                 if ($occasion->${"object"}->btwVerrekenbaar === true){
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Ja"]];
                 }else{
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Nee"]];
                 }
            
                    
            }elseif($item->type == "merkId") {
              
                $options[] = [$item->category => [$item->name => $occasion->algemeen->merkNaam]];
            } elseif ($item->type == "modelId") {
                $options[] = [$item->category => [$item->name => $occasion->algemeen->modelNaam]];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}->standaard]];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $this->kenteken_format($occasion)]];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [
                    $item->category => [
                        $item->name => '€ '.number_format($occasion->${"selector"}->totaal, 2, ",", ".")
                    ]
                ];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                   if ($occasion->${"object"}->${"selector"} === true) {
                        
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Ja"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Ja"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Ja"]];
                        }
                        
                    }elseif ($occasion->${"object"}->${"selector"} === false) {
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Nee"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Nee"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Nee"]];
                        }
                        
                    }else {

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => ["Kilometerstand" => number_format($occasion->${"object"}->${"selector"}, 0, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){  if($item->name == "VervaldatumApk"){
                                $options[] = [$item->category => ["Vervaldatum apk" => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }else{
                                $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel"){

                            $options[] = [$item->category => [$item->name => substr_replace(substr_replace($occasion->${"object"}->${"selector"}, ',',1,0)," ", -1)." m"]];

                        }elseif($item->name == "Actieradius"){

                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km"]];

                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Verbruik stad" || $item->name == "VerbruikStad"){
                            $options[] = [$item->category => ["Verbruik stad" => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Vermogen Kw"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Kw"]];
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

// Here we get home sumary details attributes which are checked in admin settings

    function get_sumary_detail_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE summary_detail='1' AND attr_type='0' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        foreach ($results as $item) {
            ${"object"} = $item->category;
             ${"selector"} = $item->type;
            if(${"object"} == "garanties"){
                foreach($occasion->${"object"}->garantieIds as $id){
                    $garanties_item = $this->connection_to_api("garanties/", $id);
                    $options[] = [$item->category => ['' => $garanties_item->naam]];
                }
            }elseif(${"object"} == "geschiedenis" && $item->attribute == "DATUMEERSTETOELATINGNAT"){

            }elseif(${"object"} == "aflevering"){

                     if($item->type == "apkBijAflevering"){
                    if($occasion->aflevering->apkBijAflevering === true){
                        $options[] = [$item->category => ["Apk bij aflevering" => 'APK bij aflevering  <a href="https://www.mijnautocoach.nl/aankoopkeuring/auto">Aankoopkeuring aanvragen</a>']];
                    }else{
                        $options[] = [$item->category => ["Apk bij aflevering" => '-']];
                    }
                }else{
                    $options[] = [$item->category => [$item->type => $occasion->${"object"}->${"selector"} != "" ? $occasion->${"object"}->${"selector"} : "-"]];
                }

            }elseif($item->type == "btwVerrekenbaar"){

                 if ($occasion->${"object"}->btwVerrekenbaar === true){
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Ja"]];
                 }else{
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Nee"]];
                 }
            
                    
            }elseif($item->type == "merkId") {
                $options[] = [$item->category => [$item->name => $occasion->algemeen->merkNaam]];
            } elseif ($item->type == "modelId") {
               
                $options[] = [$item->category => [$item->name => $occasion->algemeen->modelNaam]];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}->standaard]];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $this->kenteken_format($occasion)]];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [
                    $item->category => [
                        $item->name => '€ '.number_format($occasion->${"selector"}->totaal, 2, ",", ".")
                    ]
                ];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {
                   if ($occasion->${"object"}->${"selector"} === true) {
                        
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Ja"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Ja"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Ja"]];
                        }
                        
                    }elseif ($occasion->${"object"}->${"selector"} === false) {
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Nee"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Nee"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Nee"]];
                        }
                        
                    }else {

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => ["Kilometerstand" => number_format($occasion->${"object"}->${"selector"}, 0, ",", ".")." km"]];
                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){
                             if($item->name == "VervaldatumApk"){
                                $options[] = [$item->category => ["Vervaldatum apk" => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }else{
                                $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }
                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel"){

                            $options[] = [$item->category => [$item->name => substr_replace(substr_replace($occasion->${"object"}->${"selector"}, ',',1,0)," ", -1)." m"]];

                        }elseif($item->name == "Actieradius"){

                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km"]];

                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                            || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Verbruik stad" || $item->name == "VerbruikStad"){
                            $options[] = [$item->category => ["Verbruik stad" => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Vermogen Kw"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Kw"]];
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

    // Here we get details total attributes which are checked in admin settings

    function get_details_total_attr($occasion)
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE details_total='1' AND attr_type='0'";
        $results = $wpdb->get_results($query, OBJECT);
      

        foreach ($results as $item) {

            ${"object"} = $item->category;
             ${"selector"} = $item->type;

            if(${"object"} == "garanties"){

                foreach($occasion->${"object"}->garantieIds as $id){
                    $garanties_item = $this->connection_to_api("garanties/", $id);
                    $options[] = [$item->category => ['' => $garanties_item->naam]];
                }
            }elseif(${"object"} == "geschiedenis" && $item->attribute == "DATUMEERSTETOELATINGNAT"){

            }elseif(${"object"} == "aflevering"){

                if($item->type == "apkBijAflevering"){

                    if($occasion->aflevering->apkBijAflevering === true){
                        $options[] = [$item->category => ["Apk bij aflevering" => 'APK bij aflevering  <a href="https://www.mijnautocoach.nl/aankoopkeuring/auto">Aankoopkeuring aanvragen</a>']];
                    }else{
                        $options[] = [$item->category => ["Apk bij aflevering" => '-']];
                    }

                   
                }else{
                    if(isset($occasion->${"object"}->${"selector"}))
                    $options[] = [$item->category => [$item->type => $occasion->${"object"}->${"selector"} != "" ? $occasion->${"object"}->${"selector"} : "-"]];
                }
            }elseif($item->type == "btwVerrekenbaar"){

                 if ($occasion->${"object"}->btwVerrekenbaar === true){
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Ja"]];
                 }else{
                    $options[] = [$item->category => ["Btw verrekenbaar" => "Nee"]];
                 }
            
                    
            }elseif($item->type == "merkId") {
                $options[] = [$item->category => [$item->name => $occasion->algemeen->merkNaam]];
            } elseif ($item->type == "modelId") {
               
                $options[] = [$item->category => [$item->name => $occasion->algemeen->modelNaam]];
            } elseif ($item->type == "kleur") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}->standaard]];
            } elseif ($item->type == "kenteken") {
                ${"selector"} = $item->type;
                $options[] = [$item->category => [$item->name => $this->kenteken_format($occasion)]];
            } elseif ($item->type == "prijs") {
                ${"selector"} = $item->type;
                $options[] = [
                    $item->category => [
                        $item->name => '€ '.number_format($occasion->${"selector"}->totaal, 2, ",", ".")
                    ]
                ];
            } else {
                ${"selector"} = $item->type;
                if (property_exists($occasion->${"object"}, ${"selector"})) {

                    if ($occasion->${"object"}->${"selector"} === true) {
                        
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Ja"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Ja"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Ja"]];
                        }
                        
                    }elseif ($occasion->${"object"}->${"selector"} === false) {
                        if($item->name == "Kilometers stand correct"){
                            $options[] = [$item->category => ["Kilometerstand correct" => "Nee"]];
                        }elseif($item->name == "Geimporteerd"){
                            $options[] = [$item->category => ['Geïmporteerd' => "Nee"]];
                        }else{
                            $options[] = [$item->category => [$item->name => "Nee"]];
                        }

                    } else {

                        if($item->name == "Catalogus prijs" || $item->name == "Minimale wegenbelasting" || $item->name == "Maximale wegenbelasting"){
                            $options[] = [$item->category => [$item->name => "€ ".number_format($occasion->${"object"}->${"selector"}, 2, ",", ".")]];
                        }elseif($item->name == "Kilometers stand"){
                            $options[] = [$item->category => ['Kilometerstand' => number_format($occasion->${"object"}->${"selector"}, 0, ",", ".")." km"]];

                        }elseif($this->isDate($occasion->${"object"}->${"selector"})){


                            if($item->name == "VervaldatumApk"){
                                $options[] = [$item->category => ["Vervaldatum apk" => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }else{
                                $options[] = [$item->category => [$item->name => date("d/m/Y",strtotime($occasion->${"object"}->${"selector"}))]];
                            }  

                        }elseif($item->name == "Lengte" || $item->name == "Breedte" || $item->name == "Hoogte" || $item->name == "Draaicirkel"){

                            $options[] = [$item->category => [$item->name => substr_replace(substr_replace($occasion->${"object"}->${"selector"}, ',',1,0)," ", -1)." m"]];

                        }elseif($item->name == "Actieradius"){

                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km"]];

                        }elseif($item->name == "Tankinhoud" || $item->name == "Minimuminhoud kofferbak" || $item->name == "Maximuminhoud kofferbak"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." liter"]];
                        }elseif($item->name == "Ledig gewicht" || $item->name == "Rijklaar gewicht" || $item->name == "Toelaatbaar gewicht"
                                || $item->name == "Trekgewicht geremde aanhanger" || $item->name == "Trekgewicht ongeremde aanhanger"){
                            $options[] = [$item->category => [$item->name => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." kg"]];
                        }elseif($item->name == "Verbruik buitenweg" || $item->name == "Verbruik gecombineerd"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Verbruik stad" || $item->name == "VerbruikStad"){
                            $options[] = [$item->category => ["Verbruik stad" => $occasion->${"object"}->${"selector"}." km per liter"]];
                        }elseif($item->name == "Uitstoot"){
                            $options[] = [$item->category => ['Co2 uitstoot' => $occasion->${"object"}->${"selector"}." g/km"]];
                        }elseif($item->name == "Cilinderinhoud"){
                            $options[] = [$item->category => ['Motorinhoud' => number_format($occasion->${"object"}->${"selector"}, 0, ".", ".")." cc"]];
                        }elseif($item->name == "Vermogen Pk"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." pk"]];
                        }elseif($item->name == "Vermogen Kw"){
                            $options[] = [$item->category => [$item->name => $occasion->${"object"}->${"selector"}." Kw"]];
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


// Here we get car safety attributes which are checked in admin settings

    function get_car_safety_attr($category_id,$occasion){
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        // mysql_real_escape_string($category_id);
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

    function getExcerpt($str, $startPos=0, $maxLength=100) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength-3);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= '...';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }


    function get_garanties($occasion){
        $garanties_ids = $occasion->garanties->garantieIds;
        $garanties_names = [];
        foreach ($garanties_ids as $key => $value) {

           $garanties_item = $this->connection_to_api("garanties/", $value);

              $garanties_names[$garanties_item->naam] = $garanties_item->omschrijving;
         
        }
        
        return $garanties_names;
    }

}


