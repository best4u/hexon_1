<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 9:15 AM
 */


function drop_tables()
{
    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "DROP TABLE IF EXISTS wp_at_attributes";
    $conn->query($sql);
}

function db_install() {

    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "CREATE TABLE wp_at_attributes (
              id int(11) NOT NULL AUTO_INCREMENT,
              category varchar(255) NOT NULL,
              attribute varchar(255) NOT NULL,
              home_page int(11) NOT NULL,
              overview int(11) NOT NULL,
              summary_detail int(11) NOT NULL,
              details_total int(11) NOT NULL,
              type varchar(255) DEFAULT NULL,
              PRIMARY KEY (id)
            ) ";
    $conn->query($sql);
}

function insert_data_attr()
{
    $arr = [
        "INSERT INTO `wp_at_attributes` VALUES ('1', 'ALGEMEEN', 'MERKID', '0', '0', '0', '0', 'brand_id')",
        "INSERT INTO `wp_at_attributes` VALUES ('2', 'ALGEMEEN', 'MODELID', '0', '0', '0', '0', 'model_id')",
        "INSERT INTO `wp_at_attributes` VALUES ('3', 'ALGEMEEN', 'UITVOERING', '0', '0', '0', '0', 'performance')",
        "INSERT INTO `wp_at_attributes` VALUES ('4', 'ALGEMEEN', 'CARROSSERIEVORM', '0', '0', '0', '0', 'car_body')",
        "INSERT INTO `wp_at_attributes` VALUES ('5', 'ALGEMEEN', 'TRANSMISSIE', '0', '0', '0', '0', 'transmision')",
        "INSERT INTO `wp_at_attributes` VALUES ('6', 'ALGEMEEN', 'AANTALVERSNELLINGEN', '0', '0', '0', '0', 'numbers_of_gears')",
        "INSERT INTO `wp_at_attributes` VALUES ('7', 'ALGEMEEN', 'AANTALDEUREN', '0', '0', '0', '0', 'numbers_of_doors')",
        "INSERT INTO `wp_at_attributes` VALUES ('8', 'ALGEMEEN', 'BRANDSTOF', '0', '0', '0', '0', 'fuel')",
        "INSERT INTO `wp_at_attributes` VALUES ('9', 'ALGEMEEN', 'BRANDSTOFSECUNDAIR', '0', '0', '0', '0', 'sec_fuel')",
        "INSERT INTO `wp_at_attributes` VALUES ('10', 'ALGEMEEN', 'VOERTUIGSOORT', '0', '0', '0', '0', 'vehicle_type')",
        "INSERT INTO `wp_at_attributes` VALUES ('11', 'ALGEMEEN', 'AANTALZITPLAATSEN', '0', '0', '0', '0', 'number_of_seats')",
        "INSERT INTO `wp_at_attributes` VALUES ('12', 'ALGEMEEN', 'KLEUR', '0', '0', '0', '0', 'color')",
        "INSERT INTO `wp_at_attributes` VALUES ('13', 'AFLEVERING', 'AFLEVERINGKOSTEN', '0', '0', '0', '0', 'delivery_costs')",
        "INSERT INTO `wp_at_attributes` VALUES ('14', 'AFLEVERING', 'APKBIJAFLEVERING', '0', '0', '0', '0', 'mot_at_delivery')",
        "INSERT INTO `wp_at_attributes` VALUES ('15', 'GESCHIEDENIS', 'CATALOGUSPRIJS', '0', '0', '0', '0', 'price_list')",
        "INSERT INTO `wp_at_attributes` VALUES ('16', 'GESCHIEDENIS', 'KILOMETERSTAND', '0', '0', '0', '0', 'km')",
        "INSERT INTO `wp_at_attributes` VALUES ('17', 'GESCHIEDENIS', 'KILOMETERSTANDCORRECT', '0', '0', '0', '0', 'km_correct')",
        "INSERT INTO `wp_at_attributes` VALUES ('18', 'GESCHIEDENIS', 'EERSTEEIGENAAR', '0', '0', '0', '0', 'first_owner')",
        "INSERT INTO `wp_at_attributes` VALUES ('19', 'GESCHIEDENIS', 'DATUMEERSTETOELATINGNAT', '0', '0', '0', '0', 'date_of_first_admission_nat')",
        "INSERT INTO `wp_at_attributes` VALUES ('20', 'GESCHIEDENIS', 'DATUMEERSTETOELATINGINT', '0', '0', '0', '0', 'date_of_first_admission_int')",
        "INSERT INTO `wp_at_attributes` VALUES ('21', 'GESCHIEDENIS', 'BTWVERREKENBAAR', '0', '0', '0', '0', 'deductible_tax')",
        "INSERT INTO `wp_at_attributes` VALUES ('22', 'GESCHIEDENIS', 'GEIMPORTEERD', '0', '0', '0', '0', 'imported')",
    ];
    $host = DB_HOST;
    $dbname = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    foreach($arr as $row)
    {
        $sql = $row;
        $conn->query($sql);
    }

}
