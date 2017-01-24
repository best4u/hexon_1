<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 9:15 AM
 */
ini_set('max_execution_time', 300);

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
              attr_type int(11) DEFAULT NULL,
              option_id varchar(255) DEFAULT NULL,
              option_category_id varchar(255) DEFAULT NULL,
              PRIMARY KEY (id)
            ) ";
    $conn->query($sql);
}

function insert_data_attr()
{
    $arr = [
        "INSERT INTO `wp_at_attributes` VALUES ('1', 'algemeen', 'MERKID', '0', '0', '0', '0', 'merkId','Merk','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('2', 'algemeen', 'MODELID', '0', '0', '0', '0', 'modelId','Model','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('3', 'algemeen', 'KENTEKEN', '0', '0', '0', '0', 'kenteken','Kenteken','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('4', 'algemeen', 'prijs', '0', '0', '0', '0', 'prijs','Prijs','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('5', 'algemeen', 'UITVOERING', '0', '0', '0', '0', 'uitvoering','Uitvoering','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('6', 'algemeen', 'CARROSSERIEVORM', '0', '0', '0', '0', 'carrosserievorm','Carrosserievorm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('7', 'algemeen', 'TRANSMISSIE', '0', '0', '0', '0', 'transmissie','Transmissie','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('8', 'algemeen', 'AANTALVERSNELLINGEN', '0', '0', '0', '0', 'aantalVersnellingen','Aantal versnellingen','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('9', 'algemeen', 'AANTALDEUREN', '0', '0', '0', '0', 'aantalDeuren','Aantal deuren','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('10', 'algemeen', 'BRANDSTOF', '0', '0', '0', '0', 'brandstof','Brandstof','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('11', 'algemeen', 'BRANDSTOFSECUNDAIR', '0', '0', '0', '0', 'brandstofSecundair','BRANDSTOFSECUNDAIR','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('12', 'algemeen', 'VOERTUIGSOORT', '0', '0', '0', '0', 'voertuigsoort','Voertuig Soort','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('13', 'algemeen', 'AANTALZITPLAATSEN', '0', '0', '0', '0', 'aantalZitplaatsen','Aantal zitplaatsen','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('14', 'algemeen', 'KLEUR', '0', '0', '0', '0', 'kleur','Kleur','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('15', 'aflevering', 'AFLEVERINGKOSTEN', '0', '0', '0', '0', 'afleveringskosten','Aflevering kosten','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('16', 'aflevering', 'APKBIJAFLEVERING', '0', '0', '0', '0', 'apkBijAflevering','APKBIJAFLEVERING','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('17', 'geschiedenis', 'CATALOGUSPRIJS', '0', '0', '0', '0', 'catalogusprijs','Catalogus prijs','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('18', 'geschiedenis', 'KILOMETERSTAND', '0', '0', '0', '0', 'kilometerstand','Kilometers stand','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('19', 'geschiedenis', 'KILOMETERSTANDCORRECT', '0', '0', '0', '0', 'kilometerstandCorrect','Kilometers stand correct','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('20', 'geschiedenis', 'EERSTEEIGENAAR', '0', '0', '0', '0', 'eersteEigenaar','Eerste eigenaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('21', 'geschiedenis', 'DATUMEERSTETOELATINGNAT', '0', '0', '0', '0', 'datumEersteToelatingNationaal','Datum eerste toelating nat','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('22', 'geschiedenis', 'DATUMEERSTETOELATINGINT', '0', '0', '0', '0', 'datumEersteToelatingInternationaal','Datum eerste toelating nat','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('23', 'geschiedenis', 'BTWVERREKENBAAR', '0', '0', '0', '0', 'btwVerrekenbaar','Btw veerekenbaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('24', 'geschiedenis', 'GEIMPORTEERD', '0', '0', '0', '0', 'geimporteerd','Geimporteerd','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('25', 'geschiedenis', 'vervaldatumApk', '0', '0', '0', '0', 'vervaldatumApk','VervaldatumApk','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('26', 'geschiedenis', 'bouwjaar', '0', '0', '0', '0', 'bouwjaar','Bouwjaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('27', 'matenEnGewichten', 'lengte', '0', '0', '0', '0', 'lengte','Lengte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('28', 'matenEnGewichten', 'breedte', '0', '0', '0', '0', 'breedte','Breedte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('29', 'matenEnGewichten', 'hoogte', '0', '0', '0', '0', 'hoogte','Hoogte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('30', 'matenEnGewichten', 'draaicirkel', '0', '0', '0', '0', 'draaicirkel','Draaicirkel','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('31', 'matenEnGewichten', 'tankinhoud', '0', '0', '0', '0', 'tankinhoud','Tankinhoud','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('32', 'matenEnGewichten', 'ledigGewicht', '0', '0', '0', '0', 'ledigGewicht','Ledig gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('33', 'matenEnGewichten', 'rijklaarGewicht', '0', '0', '0', '0', 'rijklaarGewicht','Rijklaar gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('34', 'matenEnGewichten', 'minimaleWegenbelasting', '0', '0', '0', '0', 'minimaleWegenbelasting','Minimale wegenbelasting','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('35', 'matenEnGewichten', 'maximaleWegenbelasting', '0', '0', '0', '0', 'maximaleWegenbelasting','Maximale wegenbelasting','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('36', 'matenEnGewichten', 'toelaatbaarGewicht', '0', '0', '0', '0', 'toelaatbaarGewicht','Toelaatbaar gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('37', 'matenEnGewichten', 'minimuminhoudKofferbak', '0', '0', '0', '0', 'minimuminhoudKofferbak','Minimuminhoud kofferbak','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('38', 'matenEnGewichten', 'maximuminhoudKofferbak', '0', '0', '0', '0', 'maximuminhoudKofferbak','Maximuminhoud kofferbak','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('39', 'matenEnGewichten', 'trekgewichtGeremdeAanhanger', '0', '0', '0', '0', 'trekgewichtGeremdeAanhanger','Trekgewicht geremde aanhanger','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('40', 'matenEnGewichten', 'trekgewichtOngeremdeAanhanger', '0', '0', '0', '0', 'trekgewichtOngeremdeAanhanger','Trekgewicht ongeremde aanhanger','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('41', 'matenEnGewichten', 'actieradius', '0', '0', '0', '0', 'actieradius','Actieradius','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('42', 'milieu', 'verbruikStad', '0', '0', '0', '0', 'verbruikStad','VerbruikStad','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('43', 'milieu', 'verbruikBuitenweg', '0', '0', '0', '0', 'verbruikBuitenweg','Verbruik buitenweg','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('44', 'milieu', 'verbruikGecombineerd', '0', '0', '0', '0', 'verbruikGecombineerd','Verbruik gecombineerd','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('45', 'milieu', 'uitstoot', '0', '0', '0', '0', 'uitstoot','Uitstoot','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('46', 'milieu', 'energielabel', '0', '0', '0', '0', 'energielabel','Energielabel','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('47', 'motor', 'cilinderinhoud', '0', '0', '0', '0', 'cilinderinhoud','Cilinderinhoud','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('48', 'motor', 'aantalCilinders', '0', '0', '0', '0', 'aantalCilinders','Aantal cilinders','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('49', 'motor', 'vermogenKw', '0', '0', '0', '0', 'vermogenKw','Vermogen Kw','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('50', 'motor', 'koppelNm', '0', '0', '0', '0', 'koppelNm','Koppel Nm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('51', 'motor', 'koppelNm', '0', '0', '0', '0', 'koppelTpm','Koppel Tpm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('52', 'motor', 'turbo', '0', '0', '0', '0', 'turbo','Turbo','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('53', 'motor', 'vermogenPk', '0', '0', '0', '0', 'vermogenPk','Vermogen Pk','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('54', 'prestaties', 'topsnelheid', '0', '0', '0', '0', 'topsnelheid','Topsnelheid','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('55', 'prestaties', 'acceleratieNaar100', '0', '0', '0', '0', 'acceleratieNaar100','Acceleratie Naar 100','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('56', 'onderstel', 'aandrijving', '0', '0', '0', '0', 'aandrijving','Aandrijving','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('57', 'onderstel', 'remmenVoor', '0', '0', '0', '0', 'remmenVoor','Remmen voor','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('58', 'onderstel', 'remmenAchter', '0', '0', '0', '0', 'remmenAchter','Remmen achter','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('59', 'garanties', 'remmenAchter', '0', '0', '0', '0', 'remmenAchter','Remmen achter','0','','')",
    ];
    $ocassions_obj = new Ocassions();
    $options = $ocassions_obj->connection_to_api('opties',"?pageNumber=1&pageSize=500");



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

    foreach($options->items as $option){

    $categories = $ocassions_obj->connection_to_api('optiecategorieen',"");

        foreach($categories as $cat){
            if($option->optiecategorieId == $cat->optiecategorieId){
                $category_name = $cat->naam;
            }
        }

        $sql = "INSERT INTO `wp_at_attributes` VALUES ('', '".$category_name."', '".$option->naam."', '0', '0', '0', '0', '','','1','".$option->optieId."','".$option->optiecategorieId."')";
        $conn->query($sql);
    }

}
