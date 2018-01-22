<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/20/2017
 * Time: 6:46 PM
 */

class Filter{

// Pagination function

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

    // Get all get variables from url for next page 

    function get_query_filter_pagination($page){

        if(preg_match('/pagina/',$_SERVER['QUERY_STRING'])){
            $query_string = $_SERVER['QUERY_STRING'];
            $query_string = explode("&",$query_string);
            unset($query_string[0]);
            $query_string = implode("&",$query_string);
        }else{
            $query_string = $_SERVER['QUERY_STRING'];
        }

        if($query_string != ""){
            $query = "?pagina=".$page."&".$query_string;
        }else{
            $query = "?pagina=".$page."";
        }


        return $query;

    }

    // Order By function  'Sorteren op ...'

    function orderBy(){

        $sort_query = "";
        $sort_by = get_option("at_sort_by");

        $order = get_option("at_sort_by_orientation");

        if(isset($_GET['sort'])){

            if($_GET['sort'] == "prijs_laag_naar_hoog"){
                 $sort_query = "&sort%5Bprijs%5D=asc";
            }elseif($_GET['sort'] == "prijs_hoog_naar_laag"){
                $sort_query = "&sort%5Bprijs%5D=desc";
            }else{
                $sort_query = "&sort%5B".$_GET['sort']."%5D=asc";
            }

        }elseif($sort_by == "merkModelUitvoering"){
                $sort_query = "&sort%5B".$sort_by."%5D=asc";

        }else{
            $sort_query = "&sort%5B".$sort_by."%5D=".$order."";
        }
        
        return $sort_query;
    }

    // Overview page we have right filter this is function for this filter

    function sidebarFilter($connection,$dealerId){
        $filterQuery = "";
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }


        if(isset($_GET['merkId']) && !$_GET['merkId'] == ""){
            $filterQuery .= "&filter%5BmerkId%5D=".$_GET['merkId']."";

            $all_models_api = $connection->connection_to_api('merken','/'.$_GET['merkId'].'/modellen');
            $all_dealers_models_api = $connection->connection_to_api('advertenties',"?pageNumber=1&pageSize=1000000".$dealerIds."&filter%5BmerkId%5D=".$_GET['merkId']."");

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
            $filterQuery .= "&filter%5Bkilometerstand.max%5D=".$_GET['kilometerstand_max']."";
        }
        if(isset($_GET['aantalDeuren']) && $_GET['aantalDeuren'] != ""){
            $filterQuery .= "&filter%5BaantalDeuren%5D=".$_GET['aantalDeuren']."";
        }

         if(isset($_GET['prijs_min']) && $_GET['prijs_min'] != ""){
              $filterQuery .= "&filter%5Bprijs.min%5D=".$_GET['prijs_min']."";
            
         }

        if(isset($_GET['prijs_max']) && $_GET['prijs_max'] != ''){
          $filterQuery .= "&filter%5Bprijs.max%5D=".$_GET['prijs_max']."";  
        }
        
        

        return $filterQuery;
    }

    // This we get data to fill all fields in right filter on overview page

    function set_filter_data($all_marks_json,$dealer_marks_json){
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
            if(isset($mark->prijs->totaal))
            $all_cars_prices[] = $mark->prijs->totaal;
        if(isset($mark->geschiedenis->bouwjaar))
            $all_years[] = $mark->geschiedenis->bouwjaar;
        if(isset($mark->algemeen->brandstof))
            $fuel[] = $mark->algemeen->brandstof;
        if(isset($mark->algemeen->carrosserievorm))
            $caroserie[] = $mark->algemeen->carrosserievorm;
        if(isset($mark->motor->cilinderinhoud))
            $power[] = $mark->motor->cilinderinhoud;
        if(isset($mark->geschiedenis->kilometerstand))
            $km[] = $mark->geschiedenis->kilometerstand;
        if(isset($mark->algemeen->transmissie))
            $transmisie[] = $mark->algemeen->transmissie;
        if(isset($mark->algemeen->aantalDeuren))
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
        $all_years = array_filter($all_years);
       
        $_SESSION['all_marks'] = $marks;
    

        $_SESSION['max_price'] = max($all_cars_prices);
        $_SESSION['min_price'] = min($all_cars_prices) - 500;

        $_SESSION['max_year'] = max($all_years);
        $_SESSION['min_year'] = min($all_years);

        $_SESSION['km_min'] = min($km);
        $_SESSION['km_max'] = max($km);

        $_SESSION['fuel'] = array_unique($fuel);

        $_SESSION['caroserie'] = array_unique($caroserie);
        $_SESSION['power'] = array_unique($power);

        $_SESSION['transmisie'] = array_unique($transmisie);
        $_SESSION['dors'] = array_unique($dors);

    }

// Here we store all filter data
    function store_arg($connection,$dealerId){
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }


        $all_marks_json = $connection->connection_to_api('merken','?pageNumber=1&pageSize=500&sort%5Bnaam%5D=asc');
        $dealer_marks_json = $connection->connection_to_api('advertenties','?pageNumber=1&pageSize=100000'.$dealerIds.'');
        $this->set_filter_data($all_marks_json,$dealer_marks_json);

    }
// HEre we store data for company cars
    function store_arg_copany_cars($connection,$dealerId){

        $dealerId = explode(',',$dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }

        $all_marks_json = $connection->connection_to_api('merken','?pageNumber=1&pageSize=500&sort%5Bnaam%5D=asc');
        $dealer_marks_json = $connection->connection_to_api('advertenties','?pageNumber=1&pageSize=100000'.$dealerIds.'&filter%5Bcarrosserievorm%5D=BEDRIJFSWAGEN');
        $this->set_filter_data($all_marks_json,$dealer_marks_json);

    }

// this function we use to display all cars on overview page (the shortcode [occasions_list] use this function)

    function get_occasions($dealerId,$connection,$page,$perPage){
        $dealerId = explode(',',$dealerId);
//        Store mark's
        $this->store_arg($connection,$dealerId);
//-----------------------------------------------
//        Sidebar Filter
        $filter_query = $this->sidebarFilter($connection,$dealerId);
    
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }

        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber='.$page.'&pageSize='.$perPage.''.$dealerIds.''.$sort_query.''.$filter_query.'');

        return $all_occasions;
    }

// this function we use to display all cars on overview page (the shortcode [occasions_list] use this function)

     function get_all_occasions($dealerId,$connection,$perPage){
        $dealerId = explode(',',$dealerId);
//        Store mark's
        $this->store_arg($connection,$dealerId);
//-----------------------------------------------
//        Sidebar Filter
        $filter_query = $this->sidebarFilter($connection,$dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }

        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties','?pageSize='.$perPage.''.$dealerIds.''.$sort_query.''.$filter_query.'');

        return $all_occasions;
    }
// Here we get all cars for xml file (SEO)
    function get_occassions_xml($dealerId,$connection){
                
        $dealerId = explode(',',$dealerId);

        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }
 
        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber=1'.$dealerIds.'');
        return $all_occasions;
    }

    // Here we get all company cars 

    function get_all_company_ocassions_and_filter($dealerId,$connection,$page,$perPage){
        die();
        //        Store mark's
        $this->store_arg_copany_cars($connection,$dealerId);
//-----------------------------------------------
//        Sidebar Filter
        $filter_query = $this->sidebarFilter($connection,$dealerId);
        

        $dealerId = explode(',',$dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }

        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber='.$page.'&pageSize='.$perPage.''.$dealerIds.''.$sort_query.''.$filter_query.'&filter%5Bcarrosserievorm%5D=BEDRIJFSWAGEN');

        return $all_occasions;
    }
// Here we get all sold cars
    function get_sold_cars_filter($dealerId,$connection,$page,$perPage){
        //        Store mark's
        $this->store_arg_copany_cars($connection,$dealerId);
//-----------------------------------------------
//        Sidebar Filter
        $filter_query = $this->sidebarFilter($connection,$dealerId);

        $dealerId = explode(',',$dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }

        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties/offline','?pageNumber='.$page.'&pageSize='.$perPage.''.$dealerIds.'');
        return $all_occasions;
    }


}