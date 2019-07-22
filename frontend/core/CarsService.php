<?php
/**
 * Created by PhpStorm.c
 * User: Bunescu Ion
 * Date: 1/18/2017
 * Time: 5:03 PM
 */

/**
 * Class CarsService
 */
class CarsService
{
    public $dealerId;

    public function __construct()
    {
        $this->dealerId = get_option("at_dealer_id");
    }

    /**
     * @param $type
     * @param null $filter
     * @return array|mixed|object
     */
    public function connection ($type, $filter = null)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->getUrl($type, $filter));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);

        return json_decode($data);
    }

    /**
     * @param $type
     * @param null $filter
     * @return string
     */
    public function getUrl($type, $filter = null)
    {
        $dealers = explode(',', $this->dealerId);
        $dealers_url = $type === 'cars' ? "/?dealers=" . $this->dealerId . "" . $filter : "?dealers=" . $this->dealerId;

        return "http://auto.best4u.nl/" . $dealers[0] . "/".$type.$dealers_url;
    }

    /**
     * @param $filter
     * @param $count
     * @return array
     */
    public function getOverviewUrls($filter, $count)
    {
        $filter .= $this->filterCars($count);

        return [
            "cars" => $this->getUrl('cars', $filter),
            "brands" => $this->getUrl('brands/', null),
            "fuels" => $this->getUrl('fuels/', null),
            "body-styles" => $this->getUrl('body-styles/', null),
            "transmissions" => $this->getUrl('transmissions/', null),
            "price" => $this->getUrl('limits/price/', null),
            "years" => $this->getUrl('limits/years/', null),
            "mileages" => $this->getUrl('limits/mileages/', null)
        ];
    }


    /**
     * @param $filter
     * @param $count
     * @return array|mixed|object
     */
    public function getAllCars($filter, $count)
    {
        $filter .= $this->filterCars($count);
        $allCars = $this->connection('cars', $filter);

        return $allCars;
    }

    /**
     * @param $count
     * @return string
     */
    public function filterCars($count)
    {
        $filter = '&limit=' . $count;

        if (isset($_GET['orderBy'])) {
            if ($_GET['orderBy'] == 'catalog_price') {
                $filter .= '&orderBy=total_price&direction=ASC';
            } elseif ($_GET['orderBy'] == 'catalog_price_desc') {
                $filter .= '&orderBy=total_price&direction=DESC';
            } else {
                $filter .= '&orderBy=' . $_GET['orderBy'] . '&direction=ASC';
            }
        }else{
            $filter .= '&orderBy='.get_option('at_sort_by').'&direction='.get_option('at_sort_by_orientation').'';
        }

        if (isset($_GET['pagina'])) {
            $filter .= '&page=' . $_GET['pagina'];
        }

        if (isset($_GET['mileage_min'])) {
            $_GET['mileage_min'] = str_replace('.', '', $_GET['mileage_min']);
        }

        if (isset($_GET['mileage_max'])) {
            $_GET['mileage_max'] = str_replace('.', '', $_GET['mileage_max']);
        }

        $getParams = $_GET;
        unset($getParams['orderBy']);
        unset($getParams['pagina']);

        if (!empty($getParams)) {
            foreach ($getParams as $key => $value) {
                if ($value && $value != '') {
                    $filter .= '&' . $key . '=' . $value;
                }
            }
        }
     
        return $filter;
    }


    /**
     * @param $carId
     * @return array|mixed|object
     */
    public function getCarDetails($carId)
    {
       $carDetail = $this->connection('car/'.$carId, null);
       return $carDetail;
    }

    /**
     * @param $position
     * @return bool|int
     */
    public function getUrlParam($position)
    {
        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);

        if(isset($url_param[$position])){
            return (int)$url_param[count($url_param) - 2];
        }else{
            return false;
        }
    }

    /**
     * @return array|mixed|object
     */
    public function getBrands()
    {

        $brands = $this->connection('brands/', null);
        return $brands;
    }

    /**
     * @param $brandId
     * @return array|mixed|object
     */
    public function getModels($brandId)
    {
         $models = $this->connection('brand/'.$brandId.'/models', null);
         return $models;
    }

    /**
     * @return array|mixed|object
     */
    public function getFuels()
    {
        $fuels = $this->connection('fuels/', null);
        return $fuels;
    }

    /**
     * @return array|mixed|object
     */
    public function getBodyStyles()
    {
        $fuels = $this->connection('body-styles/', null);
        return $fuels;
    }

    /**
     * @return array|mixed|object
     */
    public function getTransmissions()
    {
        $transmissions = $this->connection('transmissions/', null);
        return $transmissions;
    }

    /**
     * @param $limit
     * @return array|mixed|object
     */
    public function getLimits($limit)
    {
        $limits = $this->connection('limits/'.$limit.'/', null);
        return $limits;
    }

    /**
     * @param $filter
     * @return array|mixed|object
     */
    public function getHomeCars($filter)
    {
        $homeCars = $this->connection('cars', $filter);
        return $homeCars;
    }


    /**
     * Here we get overview attributes which are checked in admin settings
     * @return array|null|object
     */
    function getOverviewAttr()
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE overview='1' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        return $results;
    }

    /**
     * @return array|null|object
     */
    function getSumaryDetailAttr()
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE summary_detail='1' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        return $results;
    }

    /**
     * @return array|null|object
     */
    function getHomeOverviewAttr()
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE home_page='1' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        return $results;
    }

    /**
     * @param $category
     * @return array|null|object
     */
    function getDetailsTotalAttr($category)
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE details_total='1' AND category='".$category."' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        return $results;
    }

    /**
     * @return array|null|object
     */
    function getBtwMargeAttr()
    {
        global $wpdb;
        $options = [];
        $table = "wp_at_attributes";
        $query = "SELECT * FROM " . $table . " WHERE type='marge' ORDER BY attr_order ASC";
        $results = $wpdb->get_results($query, OBJECT);

        return $results;
    }

    /**
     * Connection to wordpress DB
     * @param $sql
     * @return array|string
     */
    function db_connect_sql($sql)
    {
        $host = DB_HOST;
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASSWORD;
        $conn = new mysqli($host, $user, $pass, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $results = $conn->query($sql);
        if ($results) {
            return $results->fetch_assoc();
        } else {
            return "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

    /**
     * Here we store all address information and make html structure
     * @param $car
     * @return string
     */
    function get_addres_info($car)
    {
        $html_structure = '<p style="text-align: left;"><label class="bigLabel">Contactinformatie</label></p>';
        $html_structure .= '<p style="text-align: left;">'.$car->data->advertise->street.' '.$car->data->advertise->house_number.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$car->data->advertise->postcode.' '.$car->data->advertise->place_name.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$car->data->advertise->phone.'</p>';
        $html_structure .= '<p style="text-align: left;">'.$car->data->advertise->email.'</p>';
        return $html_structure;
    }

    /**
     * Here we have function which check if the value is date
     * @param $value
     * @return bool
     */
    function isDate($value)
    {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value))
        {
            return true;
        }else{
            return false;
        }
    }

    /**
     * Here we have the function which check in the user is on overview page
     * @param null $show_id
     * @return bool
     */
    function check_overview($show_id=null)
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_str = explode("/",$url);
        if($show_id == null){
            return isset($url_str[4]);
        }else{
            return $url_str[4];
        }
    }

    /**
     * Here we get correct slug to show car detail
     * @param $occasion
     * @return mixed|string
     */
    function get_car_slug($occasion)
    {

        $slug = trim(strtolower($occasion->advertise->title));
        $slug = str_replace("%","-", $slug);
        $slug = str_replace(" ","-", $slug);
        $slug = str_replace("|","-", $slug);
        $slug = str_replace("/","-", $slug);
        $slug = str_replace('"',"", $slug);

        return $slug;
    }
}

