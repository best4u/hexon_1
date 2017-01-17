<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/16/2017
 * Time: 4:15 PM
 */

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-config.php' );

class AjaxRequests{

    function attr_ajax_check_uncheck($id,$name,$val_point)
    {
        htmlspecialchars($id);
        htmlspecialchars($name);
        htmlspecialchars($val_point);
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if($val_point == "1")
        {
            $sql = "UPDATE wp_at_attributes SET ".$name."='1' WHERE id=".$id."";
        }else
        {
            $sql = "UPDATE wp_at_attributes SET ".$name."='0' WHERE id=".$id."";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();

    }

    function attr_filter($category,$attr_name,$home_page,$overview,$summary_detail,$details_total)
    {
        htmlspecialchars($category);
        htmlspecialchars($attr_name);
        htmlspecialchars($home_page);
        htmlspecialchars($overview);
        htmlspecialchars($summary_detail);
        htmlspecialchars($details_total);
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql="SELECT * FROM wp_at_attributes WHERE type!=''";
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

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
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
            <td colspan='6' style='text-align: center'>There aren't attributes </td>
        </tr>";
        }

        $conn->close();
    }

}

$object = new AjaxRequests();

if ( isset( $_POST["id"] ) && isset( $_POST["name"] ) && isset( $_POST["val_point"] ) ) {
    $object->attr_ajax_check_uncheck($_POST["id"],$_POST["name"],$_POST["val_point"]);

}

if ( isset( $_POST["category"] ) && isset( $_POST["attr_name"] ) && isset( $_POST["home_page"] ) && isset( $_POST["overview"] ) && isset( $_POST["summary_detail"] ) && isset( $_POST["details_total"] ) ) {
    $object->attr_filter($_POST["category"],$_POST["attr_name"],$_POST["home_page"],$_POST["overview"],$_POST["summary_detail"],$_POST["details_total"]);

}


