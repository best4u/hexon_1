<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */
require_once (plugin_dir_path(__FILE__)."occasions_class.php");
require_once (plugin_dir_path(__FILE__)."filter.php");

    function addGraph(){
        if(isset($_GET['overview'])){
            $ocassions_obj = new Ocassions();
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$_GET['overview']);
            $site_url = get_site_url();
            $page_slug = get_option("at_url_page_adverts");
            $site_title = get_bloginfo( 'name' );
            $images = $ocassions_obj->get_all_images($ocassion);
            $img_src = $images[0];
            ?>
            <meta property="og:title" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="og:image" content="<?php echo $img_src; ?>"/>
            <meta property="og:description" content="<?php $ocassion->mededelingen; ?>"/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$_GET['overview']?>"/>
            <meta property="og:site_name" content="<?=$site_title?>"/>

            <meta property="twitter:title" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="twitter:image" content="<?php echo $img_src; ?>"/>
            <meta property="twitter:description" content="<?php $ocassion->mededelingen; ?>"/>


            <meta property="name" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="image" content="<?php echo $img_src; ?>"/>
            <meta property="description" content="<?php $ocassion->mededelingen; ?>"/>




            <?php
        }
    }

    function occasions_list_overview(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");

        if(isset($_GET['overview'])){
            $template = get_option("at_details_view_mode");
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$_GET['overview']);
            if($template == "at_details_view_list"){
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-tabs.php");
            }

        }else{

            if(isset($_GET['pagina'])){
                $page = $_GET['pagina'];
            }else{
                $page = 1;
            }

            $all_occasions = $filertObj->get_occasions($dealerId,$ocassions_obj,$page,'6');
            $number_of_page = $all_occasions->total;
            $pagination = $filertObj->paginator($number_of_page,'6',$page,'5');

            if($layout_mode == "at_layout_overview_table"){
                require_once (plugin_dir_path(__FILE__)."views/overview-grid.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
            }

        }

    }

function get_home_occasions(){
    $ocassions_obj = new Ocassions();
    $dealerId = get_option("at_dealer_id");
    $filertObj = new Filter();
    $filter = get_option("at_home_cars");
    $at_number_of_occasions_on_home = get_option("at_number_of_occasions_on_home");
    if($at_number_of_occasions_on_home == ""){
        $at_number_of_occasions_on_home = 10;
    }
    $sort_query = "";

    if($filter == "at_newest_cars"){
        $sort_query .= "&sort%5Bprijs%5D=desc";
    }elseif($filter == "at_newest_cars"){
        $sort_query .= "&sort%5BdatumGeplaatst%5D=desc";
    }elseif($filter == "at_last_cars"){
        $sort_query .= "&sort%5BdatumGeplaatst%5D=asc";
    }

    if(isset($_GET['carrosserievorm']) && $_GET['carrosserievorm'] != ""){
        $sort_query .= "&filter%5Bcarrosserievorm%5D=".$_GET['carrosserievorm']."";
    }
    $all_occasions = $ocassions_obj->connection_to_api('advertenties','?pageNumber=1&pageSize='.$at_number_of_occasions_on_home.'&filter%5BdealerId%5D='.$dealerId.''.$sort_query.'');
    require_once (plugin_dir_path(__FILE__)."views/home_template.php");
}

// Temporaly function

function generate_xml(){

    $ocassions_obj = new Ocassions();
    $dealerId = get_option("at_dealer_id");
    $filertObj = new Filter();
    $all_occasions = $filertObj->get_occasions($dealerId,$ocassions_obj,'1','1000000000');

    if($all_occasions){

        $domen = "http://".$_SERVER['SERVER_NAME'];
        $page = get_option("at_url_page_adverts");

        $domtree = new DOMDocument('1.0', 'UTF-8');


        $xmlRoot = $domtree->createElement("xml");

        $xmlRoot = $domtree->appendChild($xmlRoot);

        $currentTrack = $domtree->createElement("occasion");
        $currentTrack = $xmlRoot->appendChild($currentTrack);


        foreach($all_occasions->items as $item){

            $currentTrack->appendChild($domtree->createElement('name',$ocassions_obj->get_car_name($item)));
            $currentTrack->appendChild($domtree->createElement('url',''.$domen.'/'.$page."/?overview=".$item->advertentieId.""));
        }

        $domtree->save('xml_car_sitemap.xml');

    }

}

