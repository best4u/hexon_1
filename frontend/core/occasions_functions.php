<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */
require_once (plugin_dir_path(__FILE__)."occasions_class.php");

    function occasions_list_overview(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        if(isset($_GET['overview'])){
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$_GET['overview']);
            require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
        }else{
            $all_occasions = $ocassions_obj->connection_to_api('advertenties','?pageNumber=1&pageSize=6&filter%5BdealerId%5D='.$dealerId.'');
            require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
        }


    }
