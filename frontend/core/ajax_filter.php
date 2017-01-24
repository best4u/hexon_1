<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/23/2017
 * Time: 6:06 PM
 */
require_once (plugin_dir_path(__FILE__)."occasions_class.php");
require_once (plugin_dir_path(__FILE__)."filter.php");

//if(isset($_POST['mark_id'])){

    $all_models = $connection->connection_to_api('merken','1a67a3d8-178b-43ee-9071-9ae7f19b316a/modellen');
    echo $_POST['mark_id'];
//}