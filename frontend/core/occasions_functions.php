<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */
require_once (plugin_dir_path(__FILE__)."occasions_class.php");
require_once (plugin_dir_path(__FILE__)."filter.php");

    function occasions_list_overview(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");

        if(isset($_GET['overview'])){
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$_GET['overview']);
            require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
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

if(isset($_POST['mark_id'])){
    echo $_POST['mark_id'];
}

