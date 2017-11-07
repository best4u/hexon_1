<?php

$price_color = get_option("at_price_color");
?>
<style>

    .price_color{
        color: <?php echo $price_color; ?> !important;
    }
</style>
<div class="overview_gridWrapp gridMode">
            <div class="leftAndRightWrapp">
                <div class="centerDiv">             
                    <div class="leftContent_at">
                        <div class="titleAndSelect">
                            <div class="titleLeftPart">
                                <?php if(isset($occassions_total)): ?>
                                <h1>Occasions <span class="count"><?=$occassions_total?></span></h1>
                                <?php else: ?>
                                <h1>Occasions <span class="count"><?=$all_occasions->total?></span></h1>
                                <?php endif; ?>
                                <span class="urlAjaxFilter" style="display: none"><?php echo plugins_url('aside_filter_functions.php',dirname(__FILE__)); ?></span>
                            </div>                          
                            
                            <div class="selectorB4uAuto">
                                <form action="" method="GET" id="sortFilter">
                                    <select name="sort" id="sortSelect" class="selectCustom">
                                        <option value>Sorteren op...</option>
                                         <option value="prijs_laag_naar_hoog" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'prijs_laag_naar_hoog' ? 'selected' : '' ?>>Prijs, laag naar hoog</option>
                                        <option value="prijs_hoog_naar_laag" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'prijs_hoog_naar_laag' ? 'selected' : '' ?>>Prijs, hoog naar laag</option>
                                        <option value="merkModelUitvoering" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'merkModelUitvoering' ? 'selected' : '' ?>>Merk, Model, Uitvoering.</option>
                                        <option value="kilometerstand" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'kilometerstand' ? 'selected' : '' ?>>Kilometerstand.</option>
                                        <option value="datumGeplaatst" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'datumGeplaatst' ? 'selected' : '' ?>>Publicatiedatum.</option>
                                        <option value="bouwjaar" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'at_sort_by' ? 'selected' : '' ?>>Bouwjaar.</option>

                                    </select>
                             
                                
                            </div>  
                        </div>   
                        <div class="carsContentLeft fghdgfhdgfhdgfh">
                             <?php the_content(); ?>
                        <?php
                        if($all_occasions){
                        ?>
                            <?php
                            foreach($all_occasions->items as $occasion){
                                ?>

                                <div class="caritemB4u">
                                    <a href="/<?=get_option('at_url_page_adverts')?>/<?php echo $ocassions_obj->get_car_slug($occasion); ?>/<?php echo $occasion->advertentieId ?>/">
                                        <div class="imgBlock">
                                            <div class="imgTable">
                                                <div class="imgTableCell">
                                                    <img src="<?php if($ocassions_obj->get_image_link($occasion)){ echo $ocassions_obj->get_image_link($occasion); }else{ echo "https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png"; }   ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carTxtBlock">
                                            <div class="titlecarItem header_color">
                                                <?php echo $ocassions_obj->getExcerpt($ocassions_obj->get_car_name($occasion),0,60); ?>
                                            </div>
                                            <div class="descCarItem">
                                                <div class="priceandLogo">
                                                    <span class="priceCarItem price_color">
                                                       <?php if($ocassions_obj->get_car_price($occasion) == '0'): ?>
                                                Prijs op aanvraag
                                            <?php else: ?>
                                                € <?php echo $ocassions_obj->get_car_price($occasion); ?>
                                                 <span class="btw_val">
                                                    <?php echo $ocassions_obj->get_btw($occasion); ?>
                                                </span>
                                            <?php endif; ?>
  
                                                </span>
                                                <span class="logoCarItem">
                                                    <?php if($ocassions_obj->get_nap_logo($occasion)): ?>
                                         <img src="<?php echo plugins_url("img/auto-tr.png", __FILE__) ?>" alt="">
                                         <img src="<?php echo plugins_url("img/NAP_Logo.jpg", __FILE__) ?>" alt="">
                                    <?php endif ;?>
                                                </span>
                                                </div>

                                                <div class="carOverallDetails">
                                                    <div class="leftPartDetail">
                                                        <?php
                                                        foreach($ocassions_obj->get_overview_attr($occasion) as $key => $options)
                                                        {
                                                            foreach($options as $key => $option){
                                                                foreach($option as $type =>  $car_option)
                                                                {
                                                                    ?>
                                                                    <p><span class="leftType atribute_label_color"><?php echo $type; ?>:</span> <span class="rightOption atribute_value_color"><?php echo $car_option; ?></span></p>
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- ?overview= -->
                                                <a href="/<?=get_option('at_url_page_adverts')?>/<?php echo $ocassions_obj->get_car_slug($occasion); ?>/<?php echo $occasion->advertentieId ?>/ " class="button_at1 button_color button">
                                                    Bekijk deze auto
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }
                            }
                            ?>
                        </div>
                <?php if(count($all_occasions->items) > 0){

                ?>
                <?php if($all_occasions->total > $all_occasions->pageSize): ?>
                <!-- Start pargination -->
                <div class="bottomNPaginationWrapp">
                    <div class="centerDiv">

                        <ul class="ulPagination">

                            <?php
                            if(count($pagination) > 1){
                                if(isset($_GET['pagina']) && $_GET['pagina'] > 1){
                                    ?>
                                    <li class="prevPage"><a href="<?php echo $filertObj->get_query_filter_pagination($_GET['pagina'] - 1); ?>"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                                    <?php
                                }elseif(isset($_GET['pagina']) && $_GET['pagina'] != 1){

                                    ?>
                                    <li class="prevPage"><a href="#"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                                    <?php
                                }

                                if(isset($_GET['pagina']) && $_GET['pagina'] >= "4"){
                                    ?>
                                    <li><a href="<?php echo $filertObj->get_query_filter_pagination($_GET['pagina'] - 3); ?>">...</a></li>
                                    <?php
                                }

                            foreach($pagination as $page){
                            ?>
                            <li <?php if( isset($_GET['pagina']) && $_GET['pagina'] == $page){  echo 'class="activePage"'; }elseif(!isset($_GET['pagina']) && $page == '1'){ echo 'class="activePage"'; } ?>><a href="<?php echo $filertObj->get_query_filter_pagination($page); ?>"><?php echo $page; ?></a></li>
                            <?php
                            }

                                if(isset($_GET['pagina']) && $_GET['pagina'] < ceil($number_of_page) / 6){

                                    ?>
                                    <li><a href="<?php echo $filertObj->get_query_filter_pagination($_GET['pagina'] + 3); ?>">...</a></li>
                                    <li class="nextPage"><a href="<?php echo $filertObj->get_query_filter_pagination($_GET['pagina'] + 1); ?>">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>

                                    <?php
                                }elseif(!isset($_GET['pagina'])){
                                    ?>
                                    <li><a href="?pagina=<?php echo '2'; ?>">...</a></li>
                                    <li class="nextPage"><a href="<?php echo $filertObj->get_query_filter_pagination(2); ?>">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>
                                    <?php
                                }
                            }

                            ?>

                        </ul>
                    </div>
                </div>
            <?php endif; ?>

                <?php }elseif($all_occasions->total == $all_occasions->pageSize){

                }else{
                    ?>
                        <p style="text-align: center;" class="no_cars">Er zijn geen zoekresultaten gevonden.</p>
                    <?php
                } ?>

                    </div>
                    <!-- end pagination -->
                    
                   <?php include_once('sidebar_filter.php'); ?>
                </div>
            </div>
        </div>
