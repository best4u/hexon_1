<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */

function occasions_list(){
    if(isset($_GET['overview']))
    {
        echo "<h1>Overview occasion</h1>";
    }else{
        echo "<h1>All occasions</h1>";
    }

}
