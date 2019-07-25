<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/20/2017
 * Time: 6:46 PM
 */

/**
 * Class FilterService
 */
class FilterService{

    /**
     * Pagination function
     * @param $data
     * @param null $limit
     * @param null $current
     * @param null $adjacents
     * @return array
     */
    public function paginator($data, $limit = null, $current = null, $adjacents = null)
    {
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

    /**
     * Get all get variables from url for next page
     * @param $page
     * @return string
     */
    public function get_query_filter_pagination($page)
    {
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
}
