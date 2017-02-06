<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/20/2017
 * Time: 6:46 PM
 */

class Filter{

    function paginator($data, $limit = null, $current = null, $adjacents = null){

        $result = array();

        if (isset($data, $limit) === true)
        {
            $result = range(1, ceil($data / $limit));

            if (isset($current, $adjacents) === true)
            {
                if (($adjacents = floor($adjacents / 2) * 2 + 1) >= 1)
                {
                    $result = array_slice($result, max(0, min(count($result) - $adjacents, intval($current) - ceil($adjacents / 2))), $adjacents);
                }
            }
        }

        return $result;
    }

    function get_query_filter_pagination($page){

        if(preg_match('/pagina/',$_SERVER['QUERY_STRING'])){
            $query_string = $_SERVER['QUERY_STRING'];
            $query_string = explode("&",$query_string);
            unset($query_string[0]);
            $query_string = implode("&",$query_string);
        }else{
            $query_string = $_SERVER['QUERY_STRING'];
        }

        $query = "?pagina=".$page."&".$query_string;

        return $query;

    }

    function orderBy(){
        $sort_query = "";
        $sort_by = get_option("at_sort_by");
        $order = get_option("at_sort_by_orientation");
        if(isset($_GET['sort'])){
            if($_GET['sort'] == "merkModelUitvoering"){
                $sort_query = "&sort%5B".$sort_by."%5D=asc";
            }else{
                $sort_query = "&sort%5B".$_GET['sort']."%5D=".$order."";
            }

        }else{
            $sort_query = "&sort%5B".$sort_by."%5D=".$order."";
        }
        return $sort_query;
    }

    function sidebarFilter($connection,$dealerId){
        $filterQuery = "";
        if(isset($_GET['merkId']) && !$_GET['merkId'] == ""){
            $filterQuery .= "&filter%5BmerkId%5D=".$_GET['merkId']."";

            $all_models_api = $connection->connection_to_api('merken','/'.$_GET['merkId'].'/modellen');
            $all_dealers_models_api = $connection->connection_to_api('advertenties',"?pageNumber=1&pageSize=1000000&filter%5BdealerId%5D=".$dealerId."&filter%5BmerkId%5D=".$_GET['merkId']."");

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
            $_SESSION['models'] = $dealer_models;

        }
        if(isset($_GET['modelId']) && $_GET['modelId'] != ""){
            $filterQuery .= "&filter%5BmodelId%5D=".$_GET['modelId']."";
        }

        if(isset($_GET['prijs_min']) && $_GET['prijs_min'] != ""){
            $filterQuery .= "&filter%5Bprijs.min%5D=".$_GET['prijs_min']."";
            $filterQuery .= "&filter%5Bprijs.max%5D=".$_GET['prijs_max']."";
        }

        if(isset($_GET['bouwjaar_min']) && $_GET['bouwjaar_min'] != ""){
            $filterQuery .= "&filter%5Bbouwjaar.min%5D=".$_GET['bouwjaar_min']."";
            $filterQuery .= "&filter%5Bbouwjaar.max%5D=".$_GET['bouwjaar_max']."";
        }

        if(isset($_GET['brandstofsoort']) && $_GET['brandstofsoort'] != ""){
            $filterQuery .= "&filter%5Bbrandstofsoort%5D=".$_GET['brandstofsoort']."";
        }
        if(isset($_GET['carrosserievorm']) && $_GET['carrosserievorm'] != ""){
            $filterQuery .= "&filter%5Bcarrosserievorm%5D=".$_GET['carrosserievorm']."";
        }
        if(isset($_GET['transmissie']) && $_GET['transmissie'] != ""){
            $filterQuery .= "&filter%5Btransmissietype%5D=".$_GET['transmissie']."";
        }

        if(isset($_GET['kilometerstand_min']) && $_GET['kilometerstand_min'] != ""){
            $filterQuery .= "&filter%5Bkilometerstand.min%5D=".$_GET['kilometerstand_min']."";
            $filterQuery .= "&filter%5Bkilometerstand.maz%5D=".$_GET['kilometerstand_max']."";
        }
        if(isset($_GET['aantalDeuren']) && $_GET['aantalDeuren'] != ""){
            $filterQuery .= "&filter%5BaantalDeuren%5D=".$_GET['aantalDeuren']."";
        }


        return $filterQuery;
    }

    function store_arg($connection,$dealerId){

//        if(!isset($_SESSION['all_marks']) && count($_SESSION['all_marks']) <= 0){

            $all_marks_json = $connection->connection_to_api('merken','?pageNumber=1&pageSize=500&sort%5Bnaam%5D=asc');
            $dealer_marks_json = $connection->connection_to_api('advertenties','?pageNumber=1&pageSize=100000&filter%5BdealerId%5D='.$dealerId.'');
            $marks = [];
            $dealer_marks = [];
            $all_cars_prices = [];
            $all_years = [];
            $fuel = [];
            $caroserie = [];
            $power = [];
            $km = [];
            $transmisie = [];
            $dors = [];

            foreach($dealer_marks_json->items as $mark){
                $marks[$mark->algemeen->merkId] = $mark->algemeen->modelId;
                $all_cars_prices[] = $mark->prijs->totaal;
                $all_years[] = $mark->geschiedenis->bouwjaar;
                $fuel[] = $mark->algemeen->brandstof;
                $caroserie[] = $mark->algemeen->carrosserievorm;
                $power[] = $mark->motor->cilinderinhoud;
                $km[] = $mark->geschiedenis->kilometerstand;
                $transmisie[] = $mark->algemeen->transmissie;
                $dors[] = $mark->algemeen->aantalDeuren;
            }
            foreach($all_marks_json->items as $mark){
                if(array_key_exists($mark->merkId,$marks)){
                    $marks[$mark->merkId] = $mark->naam;
                }
            }

            asort($marks);
            asort($fuel);
            asort($caroserie);
            asort($transmisie);
            asort($dors);

            session_start();
            $_SESSION['all_marks'] = $marks;
            $_SESSION['at_username'] = get_option("at_username");
            $_SESSION['at_password'] = get_option("at_password");
            $_SESSION['at_dealer_id'] = get_option("at_dealer_id");

            $_SESSION['max_price'] = max($all_cars_prices);
            $_SESSION['min_price'] = min($all_cars_prices);

            $_SESSION['max_year'] = max($all_years);
            $_SESSION['min_year'] = min($all_years);

            $_SESSION['km_min'] = min($km);
            $_SESSION['km_max'] = max($km);

            $_SESSION['fuel'] = array_unique($fuel);

            $_SESSION['caroserie'] = array_unique($caroserie);
            $_SESSION['power'] = array_unique($power);

            $_SESSION['transmisie'] = array_unique($transmisie);
            $_SESSION['dors'] = array_unique($dors);


//        }
    }

    function get_occasions($dealerId,$connection,$page,$perPage){

//        Store mark's
        $this->store_arg($connection,$dealerId);
//-----------------------------------------------
//        Sidebar Filter
        $filter_query = $this->sidebarFilter($connection,$dealerId);


        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber='.$page.'&pageSize='.$perPage.'&filter%5BdealerId%5D='.$dealerId.''.$sort_query.''.$filter_query.'');
        return $all_occasions;
    }

    function get_occasions_for_xml_sitemap($dealerId,$connection){


        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber=1&pageSize=1000000&filter%5BdealerId%5D='.$dealerId.'');
        return $all_occasions;
    }
}