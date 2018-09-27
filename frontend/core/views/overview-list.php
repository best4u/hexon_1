<?php
$price_color = get_option("at_price_color");
?>
<style>

    .price_color {
        color: <?php echo $price_color; ?> !important;
    }
</style>

<form action="" method="GET" id="sortFilter">
    <div class="overview_gridWrapp listMode">
        <div class="leftAndRightWrapp">
            <div class="centerDiv">
                <div class="leftContent_at">
                    <div class="titleAndSelect">
                        <div class="titleLeftPart">
                            <?php if (isset($occassions_total)): ?>
                                <h1>Occasions <span class="count"><?= $cars->total ?></span></h1>
                            <?php else: ?>
                                <h1>Occasions <span class="count"><?= $cars->total ?></span></h1>
                            <?php endif; ?>
                            <span class="urlAjaxFilter"
                                  style="display: none"><?php echo plugins_url('aside_filter_functions.php',
                                    dirname(__FILE__)); ?></span>

                        </div>

                        <div class="selectorB4uAuto">

                            <select name="orderBy" id="sortSelect" class="selectCustom">
                                <option value>Sorteren op...</option>

                                <option
                                    value="catalog_price" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'catalog_price' ? 'selected' : '' ?>>
                                    Prijs, laag naar hoog
                                </option>
                                <option
                                    value="catalog_price_desc" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'catalog_price_desc' ? 'selected' : '' ?>>
                                    Prijs, hoog naar laag
                                </option>
                                <option
                                    value="brand" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'brand' ? 'selected' : '' ?>>
                                    Merk, Model, Uitvoering
                                </option>
                                <option
                                    value="mileage" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'mileage' ? 'selected' : '' ?>>
                                    Kilometerstand
                                </option>
                                <option
                                    value="date_posted" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'date_posted' ? 'selected' : '' ?>>
                                    Publicatiedatum
                                </option>
                                <option
                                    value="construction_year" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'construction_year' ? 'selected' : '' ?>>
                                    Bouwjaar
                                </option>

                            </select>
                        </div>
                    </div>
                    <div class="carsContentLeft fghdgfhdgfhdgfh">
                        <?php the_content(); ?>
                        <div class="carsContentLeft listType">

                            <?php
                            if ($cars->data) {
                                ?>

                                <?php
                                foreach ($cars->data as $car) {
                                    ?>
                                        <div class="caritemB4uList">
                                           
                                        <a href="/<?= get_option('at_url_page_adverts') ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>/">
                                            <div class="imgBlock">
                                                <div class="imgTable">

                                                    <div class="imgTableCell">
                                                        <img src="<?php if ($car->images->{'image-1'}->thumbs->{'320_240'} != '') {
                                                            echo $car->images->{'image-1'}->thumbs->{'320_240'};
                                                        } else {
                                                            echo "https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png";
                                                        } ?>" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="carTxtBlock">
                                                <div class="titlecarItem header_color">
                                                    <?php echo $car->advertise->title; ?>
                                                </div>
                                                <div class="descCarItem">
                                                    <div class="priceCarItem price_color">
                                                        <?php if ($car->advertise->total_price == '0'): ?>
                                                            Prijs op aanvraag
                                                        <?php else: ?>
                                                            <?php echo $car->advertise->total_price; ?>
                                                        <?php if(get_option('show_btw') == '1'): ?>
                                                            <span class="btw_val">
                                                                <?php if($car->advertise->incl_vat == '1'): ?>
                                                                    ( Inc. Btw )
                                                                <?php else: ?> 
                                                                   (  Ex. Btw )
                                                                <?php endif; ?>  
                                                            </span>
                                                        <?php endif; ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="carOverallDetails">
                                                        <div class="leftPartDetail">

                                                            <?php foreach($carsService->getOverviewAttr() as $attr): ?>
                                                                <?php $value = '<?php echo @$car->'.$attr->type.'?>';?>
                                                                <?php $compare = '<?php return @$car->'.$attr->type.'?>';?>
                                                                <p>
                                                                    <span class="leftType atribute_label_color"><?=$attr->attribute?>:</span>
                                                                    <span class="rightOption atribute_value_color">

                                                                    <?php if(eval("?> $compare <?php ")): ?>
                                                                       <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                                                    <?php else: ?>
                                                                        -
                                                                    <?php endif; ?>
                                                                       
                                                                    </span>
                                                                </p>    

                                                            <?php endforeach; ?>    
                                                           
                                                        </div>

                                                    </div>

                                                    <div class="rightButtonandLogo">
                                                    <div class="logoCarItem">
                                                      
                                                        <?php if ($car->guarantees->guarantee_auto_trust && $car->guarantees->guarantee_auto_trust == 'Ja'): ?>
                                                          <img src="<?php echo plugins_url("img/auto-tr.png", __FILE__) ?>" alt="">
                                                        <?php endif; ?>

                                                        <?php if ($car->guarantees->guarantee_nap  && $car->guarantees->guarantee_nap == 'Ja'): ?>
                                                             <img src="<?php echo plugins_url("img/NAP_Logo.jpg",
                                                                __FILE__) ?>" alt="">
                                                        <?php endif; ?>
                                                    </div> 

                                                        <a href="/<?= get_option('at_url_page_adverts') ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>/"
                                                           class="button carButton">
                                                            Bekijk deze auto
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <?php
                                }


                            }

                            ?>

               
                            <!-- Start pargination -->
                            <div class="bottomNPaginationWrapp">
                                <div class="centerDiv">

                                  

                                    <?php if($cars->total > 6 && $cars->total != 0): ?>

                                    <ul class="ulPagination">

                                        <?php
                                        if(count($pagination) > 1){
                                            if(isset($_GET['pagina']) && $_GET['pagina'] > 1){
                                                ?>
                                                <li class="prevPage"><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] - 1); ?>"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                                                <?php
                                            }elseif(isset($_GET['pagina']) && $_GET['pagina'] != 1){

                                                ?>
                                                <li class="prevPage"><a href="#"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                                                <?php
                                            }

                                            if(isset($_GET['pagina']) && $_GET['pagina'] >= "4"){
                                                ?>
                                                <li><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] - 3); ?>">...</a></li>
                                                <?php
                                            }

                                        foreach($pagination as $page){
                                        ?>
                                        <li <?php if( isset($_GET['pagina']) && $_GET['pagina'] == $page){  echo 'class="activePage"'; }elseif(!isset($_GET['pagina']) && $page == '1'){ echo 'class="activePage"'; } ?>><a href="<?php echo $filterService->get_query_filter_pagination($page); ?>"><?php echo $page; ?></a></li>
                                        <?php
                                        }


                                            if(isset($_GET['pagina']) && $_GET['pagina'] < ceil($number_of_page) / 6){

                                                ?>
                                                <li><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] + 3); ?>">...</a></li>
                                                <li class="nextPage"><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] + 1); ?>">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>

                                                <?php
                                            }elseif(!isset($_GET['pagina'])){
                                                ?>
                                                <li><a href="?pagina=<?php echo '2'; ?>">...</a></li>
                                                <li class="nextPage"><a href="<?php echo $filterService->get_query_filter_pagination(2); ?>"">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>
                                                <?php
                                            }
                                        }

                                        ?>

                                    </ul>
                                <?php endif; ?>
                                </div>
                            </div>
                       
                        <!-- End pargination -->
                        </div>

                    </div>
                </div>
                <!-- end pagination -->
                <?php include_once('sidebar_filter.php'); ?>

            </div>
        </div>
    </div>


