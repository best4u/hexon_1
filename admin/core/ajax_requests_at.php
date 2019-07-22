<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/16/2017
 * Time: 4:15 PM
 */

 if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
    
function attr_ajax_check_uncheck_all()
    {
        global $wpdb;
        $id = $_POST["id"];
        $name = $_POST["name"];
        $val_point = $_POST["val_point"];
  
        if ( isset( $_POST["id"] ) && isset( $_POST["name"] ) && isset( $_POST["val_point"] ) ) {
            $id = explode("+",$id);
               foreach ($id as $key => $i) {
                    $result = $wpdb->update('wp_at_attributes',array($name => $val_point),array('id' => $i));
                }
        }
       
    }

    function selectDeselectAll(){
        global $wpdb;
        $id = $_POST["id_s"];
        $name = $_POST["name"];
        $val_point = $_POST["val_point"];

        $id = explode("+",$id);
        foreach ($id as $i) {
            $result = $wpdb->update('wp_at_attributes',array($name => $val_point),array('id' => $i));
        }  
      
    }

    function attr_filter(){
        global $wpdb;
        $category = $_POST["category"];
        $attr_name = $_POST["attr_name"];
        $home_page = $_POST["home_page"];
        $overview = $_POST["overview"];
        $summary_detail = $_POST["summary_detail"];
        $details_total = $_POST["details_total"];


        $sql="SELECT * FROM wp_at_attributes WHERE category!=''";
        if($category != "")
        {
            $sql .= " AND category LIKE '%".$category."%'";
        }

        if($attr_name != "")
        {
            $sql .= " AND attribute LIKE '%".$attr_name."%'";
        }

        if($home_page != "")
        {
            $sql .= " AND home_page='".$home_page."'";
        }

        if($overview != "")
        {
            $sql .= " AND overview='".$overview."'";
        }

        if($summary_detail != "")
        {
            $sql .= " AND summary_detail='".$summary_detail."'";
        }

        if($details_total != "")
        {
            $sql .= " AND details_total='".$details_total."'";
        }

        $result = $wpdb->get_results($sql, ARRAY_A);

        if ($result) {
            // output data of each row
            foreach ($result as $key => $row) {
               if($row['home_page'] == '1'){ $home_page_ch="checked"; }else{ $home_page_ch=""; }
                if($row['overview'] == '1'){ $overview_ch="checked"; }else{ $overview_ch=""; }
                if($row['summary_detail'] == '1'){ $summary_detail_ch="checked"; }else{ $summary_detail_ch=""; }
                if($row['details_total'] == '1'){ $details_total_ch="checked"; }else{ $details_total_ch=""; }
                echo "<tr>
                    <td class='category'>".$row['category']."</td>
                    <td class='atribute'>".$row['attribute']."</td>
                    <td>
                        <input type='checkbox' class='checkField home_page' name='home_page' ".$home_page_ch." data-id='".$row['id']."'>
                    </td>
                    <td>
                        <input type='checkbox' class='checkField overview' name='overview' ".$overview_ch." data-id='".$row['id']."'>
                    </td>
                    <td>
                        <input type='checkbox' class='checkField summary_detail' name='summary_detail' ".$summary_detail_ch." data-id='".$row['id']."'>
                    </td>
                    <td>
                        <input type='checkbox' class='checkField details_total' name='details_total' ".$details_total_ch." data-id='".$row['id']."'>
                    </td>
                </tr>";
            }
           
        }else {
            echo " <tr>
            <td colspan='6' style='text-align: center'>Er zijn geen resultaten gevonden.</td>
        </tr>";
        }
       
    }

    


