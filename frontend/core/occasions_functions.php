<?php
/**
 * Created by PhpStorm.
 * User: Bunescu Ion
 * Date: 1/17/2017
 * Time: 4:18 PM
 */
require_once (plugin_dir_path(__FILE__)."occasions_class.php");
require_once (plugin_dir_path(__FILE__)."filter.php");

// HEre we add all meta values what we need
    function addGraph(){
        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);
        if(isset($url_param[3])){
             (int)$url_param[3];
        }
      
        if(isset($url_param[3]) && is_numeric($url_param[3]) && $url_param[3] != ""){
            $ocassions_obj = new Ocassions();
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$url_param[3]);
            $site_url = get_site_url();
            $page_slug = get_option("at_url_page_adverts");
            $site_title = get_bloginfo( 'name' );
            $images = $ocassions_obj->get_all_images($ocassion);
            $img_src = $images[0];
            ?>
            <title><?php echo $ocassions_obj->get_car_name($ocassion); ?></title>
            <meta property="name" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="image" content="<?php echo $img_src; ?>"/>
            <meta property="description" content="<?php $ocassion->mededelingen; ?>"/>
            
            <meta property="og:title" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="og:image" content="<?php echo $img_src; ?>"/>
            <meta property="og:description" content="<?php $ocassion->mededelingen; ?>"/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="<?php echo $site_url; ?>/<?=$page_slug?>/<?=$url_param[2]?>"/>
            <meta property="og:site_name" content="<?=$site_title?>"/>

            <meta property="twitter:title" content="<?php echo $ocassions_obj->get_car_name($ocassion); ?>"/>
            <meta property="twitter:image" content="<?php echo $img_src; ?>"/>
            <meta property="twitter:description" content="<?php $ocassion->mededelingen; ?>"/>

            <?php
        }
    }

    // In this function we get all cars for 1 page the count of cars per page is setted like attributes "count", and also we get detail page for specific car (by car id)

    function occasions_list_overview($atts = array()){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");

        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);
        if(isset($url_param[3])){
             (int)$url_param[3];
        }

        if(isset($url_param[3]) && is_numeric($url_param[3]) && $url_param[3] != ""){

            $template = get_option("at_details_view_mode");
            $dealerId = explode(',', $dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }
            
            $ocassion = $ocassions_obj->connection_to_api('advertenties','?pageNumber=1&pageSize=25&filter%5BadvertentieId%5D='.$url_param[3].''.$dealerIds);
            $ocassion = $ocassion->items[0];
            
            $description_text = $ocassion->mededelingen;

            if($template == "at_details_view_list"){
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-tabs.php");
            }

        }else{

            shortcode_atts(array(
                    'carrosserievorm' => 'bedrijfswagen',

            ), $atts);

            if(isset($_GET['pagina'])){
                $page = $_GET['pagina'];
            }else{
                $page = 1;
            }

            
            if(isset($atts['count'])){
                $count = $atts['count'];
                
            }else{
                $count = '6';
                
            }

            if (isset($atts['carrosserievorm'])){

                $all_occasions = $filertObj->get_all_company_ocassions_and_filter($dealerId,$ocassions_obj,$page,$count);

            }else{

                $all_occasions = $filertObj->get_occasions($dealerId,$ocassions_obj,$page,$count);
            }

            if(isset($atts['count'])){
                $number_of_page = $all_occasions->pageSize;
            }else{
                $number_of_page = $all_occasions->total;
                
            }


        
            $pagination = $filertObj->paginator($all_occasions->total,$count,$page,'5');

            if($layout_mode == "at_layout_overview_table"){
              
                require_once (plugin_dir_path(__FILE__)."views/overview-grid.php");
            }else{
            
                require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
            }

        }

    }

// This function is not used anywhere now, but this function works like occasions_list_overview but without pagination

    function occasions_list_overview_all($atts = array()){
       
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");

        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);
        (int)$url_param[3];

        if(isset($url_param[3]) && is_numeric($url_param[3]) && $url_param[3] != ""){

            $template = get_option("at_details_view_mode");
            $dealerId = explode(',', $dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }
        
            $ocassion = $ocassions_obj->connection_to_api('advertenties','?pageNumber=1&pageSize=25&filter%5BadvertentieId%5D='.$url_param[3].''.$dealerIds);
            $ocassion = $ocassion->items[0];
        
            $description_text = $ocassion->mededelingen;

            if($template == "at_details_view_list"){
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-tabs.php");
            }

        }else{

   
            if (!empty($atts)){

                $all_occasions = $filertObj->get_all_occasions($dealerId,$ocassions_obj,$atts['count']);
          
                $occassions_total = $all_occasions->pageSize;

            }else{

                $all_occasions = $filertObj->get_all_occasions($dealerId,$ocassions_obj,'100000000');
                $occassions_total = $all_occasions->total;
            }

            if($layout_mode == "at_layout_overview_table"){
              
                require_once (plugin_dir_path(__FILE__)."views/overview-grid.php");
            }else{
            
                require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
            }

        }

    }

    // This function is not used anywhere now, but this function works like occasions_list_overview but we get only sold cars

    function sold_cars(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");
        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);
        (int)$url_param[3];
        if(isset($url_param[3]) && is_numeric($url_param[3]) && $url_param[3] != ""){
            $template = get_option("at_details_view_mode");
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$url_param[3]);
            $description = $ocassions_obj->connection_to_api('advertenties/',$url_param[3].'/aanbieder');
            $description_text = $description->mededelingen;
            if($template == "at_details_view_list"){
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-tabs.php");
            }

        }else{

            if(isset($_GET['pagina'])){
                $page = $_GET['pagina'];
            }else{
                $page = 1;
            }

            $all_occasions = $filertObj->get_sold_cars_filter($dealerId,$ocassions_obj,$page,'6');
            $number_of_page = $all_occasions->total;
            $pagination = $filertObj->paginator($number_of_page,'6',$page,'5');

            if($layout_mode == "at_layout_overview_table"){
                require_once (plugin_dir_path(__FILE__)."views/overview-grid.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
            }

        }

    }

    // This function is not used anywhere now, but this function works like occasions_list_overview but we get only company cars

    function company_occasions_list(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $filertObj = new Filter();
        $layout_mode = get_option("at_overview_layoutmode");
        $url_param = $_SERVER['REQUEST_URI'];
        $url_param = explode('/',$url_param);
        (int)$url_param[3];
        if(isset($url_param[3]) && is_numeric($url_param[3]) && $url_param[3] != ""){
            $template = get_option("at_details_view_mode");
            $ocassion = $ocassions_obj->connection_to_api('advertenties/',$url_param[3]);
            $description = $ocassions_obj->connection_to_api('advertenties/',$url_param[3].'/aanbieder');
            $description_text = $description->mededelingen;
            if($template == "at_details_view_list"){
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-onepage.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/autotrack-details-tabs.php");
            }

        }else{

            if(isset($_GET['pagina'])){
                $page = $_GET['pagina'];
            }else{
                $page = 1;
            }

            $all_occasions = $filertObj->get_all_company_ocassions_and_filter($dealerId,$ocassions_obj,$page,'6');
            $number_of_page = $all_occasions->total;
            $pagination = $filertObj->paginator($number_of_page,'6',$page,'5');

            if($layout_mode == "at_layout_overview_table"){
                require_once (plugin_dir_path(__FILE__)."views/overview-grid.php");
            }else{
                require_once (plugin_dir_path(__FILE__)."views/overview-list.php");
            }

        }

    }

    // HEre we get the cars which we should display with shortcode [get_home_filter]

    function get_home_occasions(){
        $ocassions_obj = new Ocassions();
        $dealerId = get_option("at_dealer_id");
        $dealerId = explode(',',$dealerId);
        $dealerIds = '';
        if(is_array($dealerId)){
            foreach($dealerId as $id){
                $dealerIds .= '&filter%5BdealerId%5D='.$id.'';
            }
        }else{
            $dealerIds .= '&filter%5BdealerId%5D='.$dealerId.'';
        }
       
        $filertObj = new Filter();
        $filter = get_option("at_home_cars");
        $at_number_of_occasions_on_home = get_option("at_number_of_occasions_on_home");
        if($at_number_of_occasions_on_home == ""){
            $at_number_of_occasions_on_home = 10;
        }
        $sort_query = "";

        if($filter == "at_expensive_cars"){
            $sort_query .= "&sort%5Bprijs%5D=desc";
        }elseif($filter == "at_newest_cars"){
            $sort_query .= "&sort%5BdatumGeplaatst%5D=desc";
        }elseif($filter == "at_last_cars"){
            $sort_query .= "&sort%5BdatumGeplaatst%5D=asc";
        }

        if(isset($_GET['carrosserievorm']) && $_GET['carrosserievorm'] != ""){
            $sort_query .= "&filter%5Bcarrosserievorm%5D=".$_GET['carrosserievorm']."";
        }

        $all_occasions = $ocassions_obj->connection_to_api('advertenties','?pageNumber=1&pageSize='.$at_number_of_occasions_on_home.''.$dealerIds.''.$sort_query.'');
        require_once (plugin_dir_path(__FILE__)."views/home_template.php");
    }

    // Get template for company hours

    function get_open_company_hours(){
        require_once (plugin_dir_path(__FILE__)."views/open_hours_template.php");
    }

    // This function is not used anywhere now, insert url for ajax requests
    function instert_ajax_link_in_footer(){
        echo '<span class="urlAjaxFilter" style="display: none">'.plugins_url('core/aside_filter_functions.php',dirname(__FILE__)).'</span>';
    }

    // This function generate home filter - this unction is used by shortcode [home_filter]

    function get_home_filter(){
        $filertObj = new Filter();
        $dealerId = get_option("at_dealer_id");
        $dealerId = explode(',',$dealerId);
        $ocassions_obj = new Ocassions();
        $filertObj->store_arg($ocassions_obj,$dealerId);
     

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
                <select name="merkId" id="marks" class="selectCustom">
                <option value>Alle merken</option>';

                foreach ($_SESSION['all_marks'] as $key => $mark) {
                   $html .= '<option value="'.$key.'" class="markOption">'.$mark.'</option>';
                }

        $html .= '</select>
                    <p>
                <label for="b">Model</label>
                </p>
                <select name="modelId" id="models" class="selectCustom">
                <option value>Selecteer eerst een merk</option>
                </select>
                <button type="submit" class="button">Toon auto s</button>
                </form>';       

       return $html;
        
    }


