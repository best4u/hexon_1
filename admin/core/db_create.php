<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 9:15 AM
 */
ini_set('max_execution_time', 30000);

function drop_tables()
{
    global $wpdb;
    $sql = "DROP TABLE IF EXISTS wp_at_attributes";
    $wpdb->query($sql);
}

function db_install() {
    global $wpdb;
    $sql = "CREATE TABLE wp_at_attributes (
              id int(11) NOT NULL AUTO_INCREMENT,
              category varchar(255) NOT NULL,
              attribute varchar(255) NOT NULL,
              attr_order varchar(255) NOT NULL,
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

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

function insert_data_attr()
{
    $arr = [
        "INSERT INTO `wp_at_attributes` VALUES ('1', 'algemeen', 'MERKID','5', '0', '0', '1', '1', 'merkId','Merk','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('2', 'algemeen', 'MODELID','5', '0', '0', '1', '1', 'modelId','Model','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('3', 'algemeen', 'KENTEKEN','5', '0', '0', '1', '1', 'kenteken','Kenteken','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('4', 'algemeen', 'prijs','5', '0', '0', '0', '1', 'prijs','Prijs','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('5', 'algemeen', 'UITVOERING','5', '0', '0', '0', '1', 'uitvoering','Uitvoering','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('6', 'algemeen', 'CARROSSERIEVORM','5', '0', '0', '1', '1', 'carrosserievorm','Carrosserievorm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('7', 'algemeen', 'TRANSMISSIE','1', '1', '1', '1', '1', 'transmissie','Transmissie','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('8', 'algemeen', 'AANTALVERSNELLINGEN','5', '0', '0', '0', '1', 'aantalVersnellingen','Aantal versnellingen','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('9', 'algemeen', 'AANTALDEUREN','5', '0', '0', '1', '1', 'aantalDeuren','Aantal deuren','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('10', 'algemeen', 'BRANDSTOF','2', '1', '1', '1', '1', 'brandstof','Brandstof','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('11', 'algemeen', 'BRANDSTOFSECUNDAIR','5', '0', '0', '0', '1', 'brandstofSecundair','BRANDSTOFSECUNDAIR','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('12', 'algemeen', 'VOERTUIGSOORT','5', '0', '0', '1', '1', 'voertuigsoort','Voertuig Soort','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('13', 'algemeen', 'AANTALZITPLAATSEN','5', '0', '0', '0', '1', 'aantalZitplaatsen','Aantal zitplaatsen','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('14', 'algemeen', 'KLEUR','5', '0', '0', '1', '1', 'kleur','Kleur','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('15', 'aflevering', 'AFLEVERINGKOSTEN','5', '0', '0', '0', '1', 'afleveringskosten','Aflevering kosten','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('16', 'aflevering', 'APKBIJAFLEVERING','5', '0', '0', '0', '1', 'apkBijAflevering','APKBIJAFLEVERING','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('17', 'geschiedenis', 'CATALOGUSPRIJS','5', '0', '0', '0', '1', 'catalogusprijs','Catalogus prijs','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('18', 'geschiedenis', 'KILOMETERSTAND','3', '1', '1', '1', '1', 'kilometerstand','Kilometers stand','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('19', 'geschiedenis', 'KILOMETERSTANDCORRECT','5', '0', '0', '0', '1', 'kilometerstandCorrect','Kilometers stand correct','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('20', 'geschiedenis', 'EERSTEEIGENAAR','5', '0', '0', '0', '1', 'eersteEigenaar','Eerste eigenaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('21', 'geschiedenis', 'DATUMEERSTETOELATINGNAT','5', '0', '0', '0', '1', 'datumEersteToelatingNationaal','Datum eerste toelating nat','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('22', 'geschiedenis', 'DATUMEERSTETOELATINGINT', '5','0', '0', '0', '1', 'datumEersteToelatingInternationaal','Datum eerste toelating nat','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('23', 'geschiedenis', 'BTWVERREKENBAAR','5', '0', '0', '0', '1', 'btwVerrekenbaar','Btw veerekenbaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('24', 'geschiedenis', 'GEIMPORTEERD','5', '0', '0', '0', '1', 'geimporteerd','Geimporteerd','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('25', 'geschiedenis', 'vervaldatumApk','5', '0', '0', '0', '1', 'vervaldatumApk','VervaldatumApk','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('26', 'geschiedenis', 'bouwjaar','4', '1', '1', '1', '1', 'bouwjaar','Bouwjaar','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('27', 'matenEnGewichten', 'lengte','5', '0', '0', '0', '1', 'lengte','Lengte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('28', 'matenEnGewichten', 'breedte','5', '0', '0', '0', '1', 'breedte','Breedte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('29', 'matenEnGewichten', 'hoogte','5', '0', '0', '0', '1', 'hoogte','Hoogte','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('30', 'matenEnGewichten', 'draaicirkel','5', '0', '0', '0', '1', 'draaicirkel','Draaicirkel','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('31', 'matenEnGewichten', 'tankinhoud','5', '0', '0', '0', '1', 'tankinhoud','Tankinhoud','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('32', 'matenEnGewichten', 'ledigGewicht','5', '0', '0', '0', '1', 'ledigGewicht','Ledig gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('33', 'matenEnGewichten', 'rijklaarGewicht','5', '0', '0', '0', '1', 'rijklaarGewicht','Rijklaar gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('34', 'matenEnGewichten', 'minimaleWegenbelasting','5', '0', '0', '0', '1', 'minimaleWegenbelasting','Minimale wegenbelasting','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('35', 'matenEnGewichten', 'maximaleWegenbelasting','5', '0', '0', '0', '1', 'maximaleWegenbelasting','Maximale wegenbelasting','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('36', 'matenEnGewichten', 'toelaatbaarGewicht','5', '0', '0', '0', '1', 'toelaatbaarGewicht','Toelaatbaar gewicht','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('37', 'matenEnGewichten', 'minimuminhoudKofferbak','5', '0', '0', '0', '1', 'minimuminhoudKofferbak','Minimuminhoud kofferbak','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('38', 'matenEnGewichten', 'maximuminhoudKofferbak','5', '0', '0', '0', '1', 'maximuminhoudKofferbak','Maximuminhoud kofferbak','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('39', 'matenEnGewichten', 'trekgewichtGeremdeAanhanger','5', '0', '0', '0', '1', 'trekgewichtGeremdeAanhanger','Trekgewicht geremde aanhanger','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('40', 'matenEnGewichten', 'trekgewichtOngeremdeAanhanger','5', '0', '0', '0', '1', 'trekgewichtOngeremdeAanhanger','Trekgewicht ongeremde aanhanger','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('41', 'matenEnGewichten', 'actieradius','5', '0', '0', '0', '1', 'actieradius','Actieradius','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('42', 'milieu', 'verbruikStad','5', '0', '0', '0', '1', 'verbruikStad','VerbruikStad','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('43', 'milieu', 'verbruikBuitenweg','5', '0', '0', '0', '1', 'verbruikBuitenweg','Verbruik buitenweg','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('44', 'milieu', 'verbruikGecombineerd','5', '0', '0', '0', '1', 'verbruikGecombineerd','Verbruik gecombineerd','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('45', 'milieu', 'uitstoot','5', '0', '0', '0', '1', 'uitstoot','Uitstoot','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('46', 'milieu', 'energielabel','5', '0', '0', '0', '1', 'energielabel','Energielabel','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('47', 'motor', 'cilinderinhoud','5', '0', '0', '0', '1', 'cilinderinhoud','Cilinderinhoud','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('48', 'motor', 'aantalCilinders','5', '0', '0', '0', '1', 'aantalCilinders','Aantal cilinders','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('49', 'motor', 'vermogenKw','5', '0', '0', '0', '1', 'vermogenKw','Vermogen Kw','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('50', 'motor', 'koppelNm','5', '0', '0', '0', '1', 'koppelNm','Koppel Nm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('51', 'motor', 'koppelNm','5', '0', '0', '0', '1', 'koppelTpm','Koppel Tpm','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('52', 'motor', 'turbo','5', '0', '0', '0', '1', 'turbo','Turbo','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('53', 'motor', 'vermogenPk','5', '0', '0', '0', '1', 'vermogenPk','Vermogen Pk','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('54', 'prestaties', 'topsnelheid','5', '0', '0', '0', '1', 'topsnelheid','Topsnelheid','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('55', 'prestaties', 'acceleratieNaar100','5', '0', '0', '0', '1', 'acceleratieNaar100','Acceleratie Naar 100','0','','')",

        "INSERT INTO `wp_at_attributes` VALUES ('56', 'onderstel', 'aandrijving','5', '0', '0', '0', '1', 'aandrijving','Aandrijving','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('57', 'onderstel', 'remmenVoor','5', '0', '0', '0', '1', 'remmenVoor','Remmen voor','0','','')",
        "INSERT INTO `wp_at_attributes` VALUES ('58', 'onderstel', 'remmenAchter','5', '0', '0', '0', '1', 'remmenAchter','Remmen achter','0','','')",

    ];

    $ocassions_obj = new Ocassions();
    $options = $ocassions_obj->connection_to_api('opties',"?pageNumber=1&pageSize=500");
    global $wpdb;

    foreach($arr as $row)
    {
        $sql = $row;
        $wpdb->query($sql);
    }

    foreach($options->items as $option){

    $categories = $ocassions_obj->connection_to_api('optiecategorieen',"");

        foreach($categories as $cat){
            if(isset($option->optiecategorieId)){
                if($option->optiecategorieId == $cat->optiecategorieId){
                    $category_name = $cat->naam;
                }
            }
        }

        $sql = "INSERT INTO `wp_at_attributes` VALUES ('', '".$category_name."', '".$option->naam."','5', '0', '0', '0', '1', '','','1','".$option->optieId."','".$option->optiecategorieId."')";
        $wpdb->query($sql);
    }

}
