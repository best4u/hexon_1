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

    function orderBy(){
        $sort_query = "";
        $sort_by = get_option("at_sort_by");
        $order = get_option("at_sort_by_orientation");
        if(isset($_GET['sort'])){
            $sort_query = "&sort%5B".$_GET['sort']."%5D=".$order."";
        }else{
            $sort_query = "&sort%5B".$sort_by."%5D=".$order."";
        }
        return $sort_query;
    }

    function get_occasions($dealerId,$connection,$page,$perPage){

        $sort_query = $this->orderBy();
        $all_occasions = $connection->connection_to_api('advertenties','?pageNumber='.$page.'&pageSize='.$perPage.'&filter%5BdealerId%5D='.$dealerId.''.$sort_query.'');
        return $all_occasions;
    }
}