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
              measurement varchar(255) DEFAULT NULL,
            
              PRIMARY KEY (id)
            ) ";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}

function insert_data_attr()
{
    $arr = [
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Merk','5', '0', '0', '1', '1', 'brand->title','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Model','5', '0', '0', '1', '1', 'model->title','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Kenteken','5', '0', '0', '1', '1', 'licence_plate', '')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Prijs','5', '0', '0', '0', '1', 'advertise->total_price', '')",

         "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'BTW/marge','5', '0', '0', '0', '0','marge','')",
        
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Uitvoering','5', '0', '0', '0', '1', 'advertise->title', '')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Carrosserievorm','5', '0', '0', '1', '1', 'body_style->title','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Transmissie','1', '1', '1', '1', '1', 'transmission->title','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Aantal versnellingen','5', '0', '0', '0', '1', 'gears_number','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Aantal deuren','5', '0', '0', '1', '1', 'door_number','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Brandstof','2', '1', '1', '1', '1', 'fuel->title','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Voertuig soort','5', '0', '0', '1', '1', 'company','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Aantal zitplaatsen','5', '0', '0', '1', '1', 'seats_number','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('algemeen', 'Kleur','5', '0', '0', '1', '1', 'color','')",

        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('aflevering', 'Apk bij aflevering','5', '0', '0', '0', '1', 'mot_delivery','')",

        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Catalogus prijs','5', '0', '0', '0', '1','catalog_price','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Kilometerstand','3', '1', '1', '1', '1','mileage->mileage','km')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Kilometerstand correct','5', '0', '0', '0', '1','mileage->mileage_correct','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Eerste eigenaar','5', '0', '0', '0', '1','first_owner','')",

        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Datum eerste toelating nat','5', '0', '0', '0', '1','first_admission_date','')",

        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Geïmporteerd','5', '0', '0', '0', '1','imported','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Vervaldatum apk','5', '0', '0', '0', '1','expiry_date_apk','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('geschiedenis', 'Bouwjaar','4', '1', '1', '1', '1','construction_year','')",
 
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Lengte','5', '0', '0', '0', '1','metrics->length','m')",

        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Breedte','5', '0', '0', '0', '1','metrics->width','m')",


        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Hoogte','5', '0', '0', '0', '1','metrics->height','m')",
       
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Tankinhoud','5', '0', '0', '0', '1','metrics->tank_capacity','liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Ledig gewicht','5', '0', '0', '0', '1','metrics->empty_weight','kg')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Rijklaar gewicht','5', '0', '0', '0', '1','metrics->curb_weight','kg')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Minimale wegenbelasting','5', '0', '0', '0', '1','metrics->min_road_tax','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Maximale wegenbelasting','5', '0', '0', '0', '1','metrics->max_road_tax','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Toelaatbaar gewicht','5', '0', '0', '0', '1','metrics->permissible_weight','kg')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Minimuminhoud kofferbak','5', '0', '0', '0', '1','metrics->min_content_trunk','liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Maximuminhoud kofferbak','5', '0', '0', '0', '1','metrics->max_content_trunk','liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Actieradius','5', '0', '0', '0', '1','metrics->range','km')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('matenEnGewichten', 'Laadvermogen','5', '0', '0', '0', '1','metrics->load_capacity','kg')",



        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('milieu', 'Verbruik stad','5', '0', '0', '0', '1','environment->consumption_city','km per liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('milieu', 'Verbruik buitenweg','5', '0', '0', '0', '1','environment->consumption_outside','km per liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('milieu', 'Verbruik gecombineerd','5', '0', '0', '0', '1','environment->consumption_combined','km per liter')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('milieu', 'Co2 uitstoot','5', '0', '0', '0', '1','environment->emissions','g/km')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('milieu', 'Energielabel','5', '0', '0', '0', '1','environment->energy_label','')",


        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('motor', 'Motorinhoud','5', '0', '0', '0', '1','motor->cylinder_capacity','cc')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('motor', 'Aantal cilinders','5', '0', '0', '0', '1','motor->cylinder_count','')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('motor', 'Vermogen kw','5', '0', '0', '0', '1','motor->valve_count','kw')",
       
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('motor', 'Vermogen pk','5', '0', '0', '0', '1','motor->power_pk','pk')",


        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('prestaties', 'Topsnelheid','5', '0', '0', '0', '1','performance->top_speed','km/u')",
        "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('prestaties', 'Acceleratie','5', '0', '0', '0', '1','performance->acceleration_100','sec')",



         "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('onderstel', 'Aandrijving','5', '0', '0', '0', '1','chassis->drive','')",
        
         "INSERT INTO `wp_at_attributes` (category, attribute, attr_order, home_page, overview, summary_detail, details_total, type, measurement) VALUES ('onderstel', 'Remmen achter','5', '0', '0', '0', '1','chassis->back_brakes','')",


        

  

    ];

 
    global $wpdb;

    foreach($arr as $row)
    {
        $sql = $row;
        $result = $wpdb->query($sql);

    }


}
