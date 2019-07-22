<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */
require_once (plugin_dir_path(__FILE__)."CarsService.php");
require_once (plugin_dir_path(__FILE__)."FilterService.php");
require_once (plugin_dir_path(__FILE__)."multicurl.php");

$first_time = true;
$GLOBALS['global_url_param'] = [];
$GLOBALS['car'] = null;
$GLOBALS['carsService'] = null;

/**
 * @return array|mixed
 */
function url_param()
{
    $url_param = $_SERVER['REQUEST_URI'];
    $url_param = explode('/',$url_param);
    $GLOBALS['global_url_param'] = [
        'id' => isset($url_param[3]) && is_numeric($url_param[3]) ? (int)$url_param[3] : null,
        'url_slug' => $url_param[2],
    ];

    return $GLOBALS['global_url_param'];
}

/**
 * Here we add all meta values what we need
 */
function addGraph()
{
    $url_param = url_param();

    if($url_param['id']) {
        $carsService = $GLOBALS['carsService'] = new CarsService();
        $car = $GLOBALS['car'] = $carsService->getCarDetails($url_param['id']);
        $site_url = get_site_url();
        $page_slug = get_option("at_url_page_adverts");
        $site_title = get_bloginfo( 'name' );
        $images = '';
        $img_src = '#';
        ?>
        <title><?php echo $car->data->advertise->title; ?></title>
        <meta property="name" content="<?php echo $car->data->brand->title." ".$car->data->model->title." ".$car->data->advertise->title; ?>"/>
        <meta property="image" content="<?php echo $img_src; ?>"/>
        <meta property="description" content="<?php echo $car->advertise->short_description; ?>"/>

        <meta property="og:title" content="<?php echo $car->data->brand->title." ".$car->data->model->title." ".$car->data->advertise->title; ?>"/>
        <meta property="og:image" content="<?php echo $img_src; ?>"/>
        <meta property="og:description" content="<?php $car->mededelingen; ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:url" content="<?php echo $site_url; ?>/<?=$page_slug?>/<?=$url_param[2]?>"/>
        <meta property="og:site_name" content="<?=$site_title?>"/>


        <meta property="twitter:title" content="<?php  echo $car->data->brand->title." ".$car->data->model->title." ".$car->data->advertise->title; ?>"/>
        <meta property="twitter:image" content="<?php echo $img_src; ?>"/>
        <meta property="twitter:description" content="<?php echo $car->advertise->short_description;  ?>"/>

        <?php
    }
}

/**
 * @param array $atts
 */
function occasions_list_overview($atts = array())
{
    global $first_time;

    if($first_time) {
        $first_time = false;
        $carsService = new CarsService();

        $url_param = $GLOBALS['global_url_param'];

        if ($url_param['id']) {
            $template = get_option("at_details_view_mode");
            $car = $GLOBALS['car'];

            if ($template == "at_details_view_list") {
                require_once(plugin_dir_path(__FILE__) . "views/autotrack-details-onepage.php");
            } else {
                require_once(plugin_dir_path(__FILE__) . "views/autotrack-details-tabs.php");
            }
        } else {
            $filterService = new FilterService();
            $layout_mode = get_option("at_overview_layoutmode");
            shortcode_atts(array(
                'carrosserievorm' => 'bedrijfswagen',

            ), $atts);

            if (isset($_GET['pagina'])) {
                $page = $_GET['pagina'];
            } else {
                $page = 1;
            }

            if (isset($atts['count'])) {
                $count = $atts['count'];
            } else {
                $count = '6';
            }

            $filter = null;

            if (isset($atts['carrosserievorm']) && $atts['carrosserievorm'] == 'bedrijfswagen') {
                $filter = '&company=1';
            }

            $result = multicurl($carsService->getOverviewUrls($filter, $count));
            $cars = $result['cars'];
            $brands = $result['brands'];
            $fuels =$result['fuels'];
            $bodyStyles = $result['body-styles'];
            $transmissions = $result['transmissions'];
            $pricesMaxMin = $result['price'];
            $yearsMaxMin = $result['years'];
            $mileagesMaxMin = $result['mileages'];


            if (isset($atts['count'])) {
                $number_of_page = $cars->total;
            } else {
                $number_of_page = $cars->total;
            }

            $pagination = $filterService->paginator($cars->total, $count, $page, '5');


            if (isset($_GET['brand']) && $_GET['brand'] != '') {
                $models = $carsService->getModels($_GET['brand']);
            }

            if ($layout_mode == "at_layout_overview_table") {
                require_once(plugin_dir_path(__FILE__) . "views/overview-grid.php");
            } else {
                require_once(plugin_dir_path(__FILE__) . "views/overview-list.php");
            }
        }
    }
}

/**
 * Here we get the cars which we should display with shortcode [get_home_filter]
 */
function get_home_occasions()
{
    $carsService = new CarsService();

    $settings = get_option("at_home_cars");
    $at_number_of_occasions_on_home = get_option("at_number_of_occasions_on_home");
    if($at_number_of_occasions_on_home == ""){
        $at_number_of_occasions_on_home = 10;
    }

    $filter = '&limit='.$at_number_of_occasions_on_home;

    if($settings == "at_expensive_cars"){
        $filter .= "&orderBy=catalog_price&direction=DESC";
    }elseif($settings == "at_newest_cars"){
        $filter .= "&orderBy=date_posted&direction=DESC";
    }elseif($settings == "at_last_cars"){
        $filter .= "&orderBy=date_posted&direction=ASC";
    }

    $cars = $carsService->getHomeCars($filter);

    require_once (plugin_dir_path(__FILE__)."views/home_template.php");
}

/**
 * Get template for company hours
 */
function get_open_company_hours()
{
    require_once (plugin_dir_path(__FILE__)."views/open_hours_template.php");
}

/**
 * This function is not used anywhere now, insert url for ajax requests
 */
function instert_ajax_link_in_footer()
{
    echo '<span class="urlAjaxFilter" style="display: none">'.plugins_url('core/aside_filter_functions.php',dirname(__FILE__)).'</span>';
}

/**
 * This function generate home filter - this function is used by shortcode [home_filter]
 * @return string
 */
function get_home_filter()
{
    $filterService = new FilterService();
    $dealerId = get_option("at_dealer_id");
    $dealerId = explode(',',$dealerId);
    $carsService = new CarsService();

   $brands = $carsService->getBrands();


    $ocassions_page_slug = get_option("at_url_page_adverts");
    $server_name = $_SERVER['SERVER_NAME'];
    $protocol = 'http://';
    if(isset($_SERVER['HTTPS'])){
        $protocol = 'https://';
    }

    $html = '';
    $html .= '<form action="'.$protocol.''.$server_name.'/'.$ocassions_page_slug.'" method="GET" id="merkFilter">
            <p>
            <label for="a">Merk</label>
            </p>
            <select name="brand" id="marks" class="selectCustom">
            <option value>Alle merken</option>';

            foreach ($brands->data as $key => $brand) {
               $html .= '<option value="'.$brand->id.'" class="markOption">'.$brand->title.'</option>';
            }

    $html .= '</select>
                <p>
            <label for="b">Model</label>
            </p>
            <select name="model" id="models" class="selectCustom">
            <option value>Selecteer eerst een merk</option>
            </select>
            <button type="submit" class="button">Toon auto s</button>
            </form>';

   return $html;
}
