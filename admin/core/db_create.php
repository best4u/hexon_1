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
              name varchar(255) DEFAULT NULL,
              PRIMARY KEY (id)
            ) ";
    $conn->query($sql);
}

function insert_data_attr()
{
    $arr = [
        "INSERT INTO `wp_at_attributes` VALUES ('1', 'ALGEMEEN', 'MERKID', '0', '0', '0', '0', 'merkId','Merk')",
        "INSERT INTO `wp_at_attributes` VALUES ('2', 'ALGEMEEN', 'MODELID', '0', '0', '0', '0', 'modelId','Model')",
        "INSERT INTO `wp_at_attributes` VALUES ('3', 'ALGEMEEN', 'UITVOERING', '0', '0', '0', '0', 'uitvoering','Uitvoering')",
        "INSERT INTO `wp_at_attributes` VALUES ('4', 'ALGEMEEN', 'CARROSSERIEVORM', '0', '0', '0', '0', 'carrosserievorm','Carrosserievorm')",
        "INSERT INTO `wp_at_attributes` VALUES ('5', 'ALGEMEEN', 'TRANSMISSIE', '0', '0', '0', '0', 'transmissie','Transmissie')",
        "INSERT INTO `wp_at_attributes` VALUES ('6', 'ALGEMEEN', 'AANTALVERSNELLINGEN', '0', '0', '0', '0', 'aantalVersnellingen','Aantal versnellingen')",
        "INSERT INTO `wp_at_attributes` VALUES ('7', 'ALGEMEEN', 'AANTALDEUREN', '0', '0', '0', '0', 'aantalDeuren','Aantal deuren')",
        "INSERT INTO `wp_at_attributes` VALUES ('8', 'ALGEMEEN', 'BRANDSTOF', '0', '0', '0', '0', 'brandstof','brandstof')",
        "INSERT INTO `wp_at_attributes` VALUES ('9', 'ALGEMEEN', 'BRANDSTOFSECUNDAIR', '0', '0', '0', '0', 'brandstofSecundair','BRANDSTOFSECUNDAIR')",
        "INSERT INTO `wp_at_attributes` VALUES ('10', 'ALGEMEEN', 'VOERTUIGSOORT', '0', '0', '0', '0', 'voertuigsoort','Voertuig Soort')",
        "INSERT INTO `wp_at_attributes` VALUES ('11', 'ALGEMEEN', 'AANTALZITPLAATSEN', '0', '0', '0', '0', 'aantalZitplaatsen','Aantal zitplaatsen')",
        "INSERT INTO `wp_at_attributes` VALUES ('12', 'ALGEMEEN', 'KLEUR', '0', '0', '0', '0', 'kleur','Kleur')",
        "INSERT INTO `wp_at_attributes` VALUES ('13', 'AFLEVERING', 'AFLEVERINGKOSTEN', '0', '0', '0', '0', 'afleveringskosten','Aflevering kosten')",
        "INSERT INTO `wp_at_attributes` VALUES ('14', 'AFLEVERING', 'APKBIJAFLEVERING', '0', '0', '0', '0', 'apkBijAflevering','APKBIJAFLEVERING')",
        "INSERT INTO `wp_at_attributes` VALUES ('15', 'GESCHIEDENIS', 'CATALOGUSPRIJS', '0', '0', '0', '0', 'catalogusprijs','Catalogus prijs')",
        "INSERT INTO `wp_at_attributes` VALUES ('16', 'GESCHIEDENIS', 'KILOMETERSTAND', '0', '0', '0', '0', 'kilometerstand','Kilometers stand')",
        "INSERT INTO `wp_at_attributes` VALUES ('17', 'GESCHIEDENIS', 'KILOMETERSTANDCORRECT', '0', '0', '0', '0', 'kilometerstandCorrect','Kilometers stand correct')",
        "INSERT INTO `wp_at_attributes` VALUES ('18', 'GESCHIEDENIS', 'EERSTEEIGENAAR', '0', '0', '0', '0', 'eersteEigenaar','Eerste eigenaar')",
        "INSERT INTO `wp_at_attributes` VALUES ('19', 'GESCHIEDENIS', 'DATUMEERSTETOELATINGNAT', '0', '0', '0', '0', 'datumEersteToelatingNationaal','Datum eerste toelating nat')",
        "INSERT INTO `wp_at_attributes` VALUES ('20', 'GESCHIEDENIS', 'DATUMEERSTETOELATINGINT', '0', '0', '0', '0', 'datumEersteToelatingInternationaal','Datum eerste toelating nat')",
        "INSERT INTO `wp_at_attributes` VALUES ('21', 'GESCHIEDENIS', 'BTWVERREKENBAAR', '0', '0', '0', '0', 'btwVerrekenbaar','Btw veerekenbaar')",
        "INSERT INTO `wp_at_attributes` VALUES ('22', 'GESCHIEDENIS', 'GEIMPORTEERD', '0', '0', '0', '0', 'geimporteerd','Geimporteerd')",
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
