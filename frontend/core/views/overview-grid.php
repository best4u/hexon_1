<?php
$price_color = get_option("at_price_color");
?>
<style>

    .price_color {
        color: <?php echo $price_color; ?>   !important;
    }
</style>
<form action="" method="GET" id="sortFilter">
    <div class="overview_gridWrapp gridMode">
        <div class="leftAndRightWrapp">
            <div class="centerDiv">
                <div class="leftContent_at">
                    <div class="titleAndSelect">
                        <div class="titleLeftPart">
                           
                            <h1>Occasions <span class="count"><?= $cars->total ?></span></h1>
                        
                            <span class="urlAjaxFilter" style="display: none"><?php echo plugins_url('aside_filter_functions.php',dirname(__FILE__)); ?></span>
                        </div>

                        <div class="selectorB4uAuto">
                           <?php include_once('parts/order_by_select.php'); ?>
                        </div>
                    </div>
                    <div class="carsContentLeft fghdgfhdgfhdgfh">
                        <?php the_content(); ?>

                        <?php if ($cars->data): ?>
                            <?php foreach ($cars->data as $car): ?>
                                <div class="caritemB4u">
                                    <a href="/<?= get_option('at_url_page_adverts') ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>/">

                                        <?php include('parts/overview_image.php') ?>

                                        <div class="carTxtBlock">
                                            <div class="titlecarItem header_color">
                                                <?php echo $car->advertise->title; ?>
                                            </div>
                                            <div class="descCarItem">
                                                <div class="priceandLogo">
                                                    <?php if ($car->advertise->total_price == '0'): ?>
                                                        Prijs op aanvraag
                                                    <?php else: ?>
                                                    <span class="priceCarItem price_color">
                                                        <?php echo $car->advertise->total_price; ?>                                      
                                                    </span>
                                                         
                                                   
                                                        <span class="btw_val">
                                                            <?php if(get_option('show_btw') == '1'): ?>
                                                                <?php if($car->advertise->incl_vat == 'Ja'): ?>
                                                                    ( Inc. Btw )
                                                                <?php else: ?> 
                                                                    (  Ex. Btw )
                                                                <?php endif; ?>  
                                                            <?php endif; ?>

                                                            <?php if(get_option('taxable') == '1' && $car->advertise->taxable == 'Nee'): ?>
                                                                ( Marge )
                                                            <?php endif; ?>
                                                        </span>
                                                    
                                                    <?php endif; ?>
                                                    <span class="logoCarItem">
                                                        <?php include('parts/guarantee_logos.php') ?>
                                                    </span> 
                                                </div>

                                                <div class="carOverallDetails">
                                                    <div class="leftPartDetail">
                                                      <?php include('parts/overview_attributes.php') ?>
                                                    </div>
                                                </div>
                                                <!-- ?overview= -->
                                                <a href="/<?= get_option('at_url_page_adverts') ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>/"
                                                   class="button_at1 button_color button">
                                                    Bekijk deze auto
                                                </a>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <!-- Start pargination -->
                           <?php include('parts/pagination.php') ?>
                        <!-- End pargination -->
                    </div>
                </div>
                <!-- end pagination -->

                <?php include_once('sidebar_filter.php'); ?>
            </div>
        </div>
    </div>
