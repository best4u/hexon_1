<?php
//$text_color = get_option("at_font_color");
//$atribute_label_color = get_option("at_attribute_label");
//$atribute_value_color = get_option("at_attribute_value");
//$header_color = get_option("at_header_color");
//$button_color = get_option("at_button_color");
$price_color = get_option("at_price_color");
?>
<style>
/*    .text_color{*/
/*        color: */<?php //echo $text_color; ?>/* !important;*/
/*    }*/
/**/
/**/
/*    .atribute_label_color{*/
/*        color: */<?php //echo $atribute_label_color; ?>/* !important;*/
/*    }*/
/*    .atribute_value_color{*/
/*        color: */<?php //echo $atribute_value_color; ?>/* !important;*/
/*    }*/
/**/
/**/
/*    .header_color{*/
/*        color: */<?php //echo $header_color; ?>/* !important;*/
/*    }*/
/**/
/**/
/*    .button_color{*/
/*        background-color: */<?php //echo $button_color; ?>/* !important;*/
/*    }*/


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
                                <h1>Occasions</h1>
                                <span class="urlAjaxFilter" style="display: none"><?php echo plugins_url('aside_filter_functions.php',dirname(__FILE__)); ?></span>
                            </div>                          
                            
                            <div class="selectorB4uAuto">
                                <form action="" method="GET" id="sortFilter">
                                    <select name="sort" id="sortSelect" class="selectCustom">
                                        <option value>Sorteren op...</option>
                                        <option value="prijs" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'prijs' ? 'selected' : '' ?>>Prijs.</option>
                                        <option value="merkModelUitvoering" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'merkModelUitvoering' ? 'selected' : '' ?>>Merk, Model, Uitvoering.</option>
                                        <option value="kilometerstand" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'kilometerstand' ? 'selected' : '' ?>>Kilometerstand.</option>
                                        <option value="datumGeplaatst" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'datumGeplaatst' ? 'selected' : '' ?>>Publicatiedatum.</option>
                                        <option value="bouwjaar" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'at_sort_by' ? 'selected' : '' ?>>Bouwjaar.</option>

                                    </select>
                                </form>
                            </div>  
                        </div>   

                        <div class="carsContentLeft fghdgfhdgfhdgfh">

                        <?php
                        if($all_occasions){
                        ?>

                            <?php
                            foreach($all_occasions->items as $occasion){
                                ?>

                                <div class="caritemB4u">
                                    <a href="<?php echo $occasion->advertentieId ?>">
                                        <div class="imgBlock">
                                            <div class="imgTable">
                                                <div class="imgTableCell">
                                                    <img src="<?php echo $ocassions_obj->get_image_link($occasion); ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carTxtBlock">
                                            <div class="titlecarItem header_color">
                                                <?php echo $ocassions_obj->get_car_name($occasion); ?>
                                            </div>
                                            <div class="descCarItem">
                                                <div class="priceandLogo">
                                                    <span class="priceCarItem price_color">€ <?php echo $ocassions_obj->get_car_price($occasion); ?></span>
                                                <span class="logoCarItem">
                                                    <img src="<?php echo plugins_url("img/NAP_Logo.jpg",__FILE__) ?>" alt="">
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
                                                <a href="<?php echo $occasion->advertentieId ?>" class="button_at1 button_color">
                                                    bekijk deze auto
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
                                                <li><a href="?pagina=<?php echo '6'; ?>">...</a></li>
                                                <li class="nextPage"><a href="?pagina=<?php echo '6'; ?>"">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>
                                                <?php
                                            }
                                        }

                                        ?>

                                    </ul>
                                </div>
                            </div>

                        <?php }else{
                            ?>
                            <p style="text-align: center;">Er zijn geen zoekresultaten gevonden.</p>
                            <?php
                        } ?>

                    </div>
                    <!-- end pagination -->

                    <div class="sidebarContent">
                    <div class="titleSidebar h2">
                        Occasion zoeken
                    </div>

                    <div class="sidebarFilters">
                        <form action="" method="GET">
                            <p>
                                <label for="a">Merk</label>
                            </p>
                            <select name="merkId" id="marks" class="selectCustom">
                                <option value>Alle merken</option>
                                <?php
                                foreach($_SESSION['all_marks'] as $key => $mark){
                                    ?>
                                    <option value="<?php echo $key; ?>" <?php if(isset($_GET['merkId']) && $_GET['merkId'] == $key){ echo "selected"; } ?> class="markOption"><?php echo $mark; ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <p>
                                <label for="b">Model</label>
                            </p>
                            <select name="modelId" id="models" class="selectCustom">
                                <option value>Selecteer eerst een merk</option>
                                <?php
                                if(isset($_SESSION['models'])){
                                    foreach($_SESSION['models'] as $key => $model){
                                        ?>
                                        <option value="<?php echo $key; ?>"  <?php if(isset($_GET['modelId']) && $_GET['modelId'] == $key){ echo "selected"; } ?> class="modelOption"><?php echo $model; ?></option>
                                        <?php

                                    }
                                }
                                unset($_SESSION['models']);
                                ?>
                            </select>

                            <button type="submit" class="button_at1 button_color">toon auto's</button>
                            <p>
                                <label for="a">Prijs</label>
                            </p>

                            <p class="priceP">
                                <span class="priceFrom">€ <?php echo number_format($_SESSION['min_price'], 2, ",", "."); ?></span>
                                <span class="priceTo">€ <?php echo number_format($_SESSION['max_price'], 2, ",", "."); ?></span>
                                <span class="priceHiddenFrom" style="display: none"><?php echo $_SESSION['min_price']; ?></span>
                                <span class="priceHiddenTo" style="display: none"><?php echo $_SESSION['max_price']; ?></span>

                                <span class="priceFromMin" style="display: none"><?php if(isset($_GET['prijs_min'])){ echo $_GET['prijs_min']; }else{ echo $_SESSION['min_price']; } ?></span>
                                <span class="priceFromMax" style="display: none"><?php if(isset($_GET['prijs_max'])){ echo $_GET['prijs_max']; }else{ echo $_SESSION['max_price']; } ?></span>

                            </p>
                            <div class="priceSliderCont commSlideCont">
                                <div id="slider2" class="bouwjaarSlider"></div>
                            </div>
                            <div class="pricesInputs" style="display: none">
                                <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="prijs_min" class="priceFrom form-control"></span>
                                <span class="comLeftTitle">tot: </span> <span class="commInputs"><input type="text" name="prijs_max" class="priceTo form-control"></span>
                            </div>






                            <p>
                                <label for="a">Bouwjaar</label>
                            </p>
                            <p class="yearsP">
                                <span class="yearsFrom"><?php echo $_SESSION['min_year']; ?></span>
                                <span class="yearsTo"><?php echo $_SESSION['max_year']; ?></span>
                            </p>

                            <span class="yearFromMin" style="display: none"><?php if(isset($_GET['bouwjaar_min'])){ echo $_GET['bouwjaar_min']; }else{ echo $_SESSION['min_year']; } ?></span>
                            <span class="yearFromMax" style="display: none"><?php if(isset($_GET['bouwjaar_max'])){ echo $_GET['bouwjaar_max']; }else{ echo $_SESSION['max_year']; } ?></span>

                            <div class="yearSliderCont commSlideCont">
                                <div id="slider" class="bouwjaarSlider"></div>
                            </div>
                            <div class="yearsInputs" style="display: none;">
                                <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="bouwjaar_min" class="yearsFrom "></span>
                                <span class="comLeftTitle"> tot: </span> <span class="commInputs"><input type="text" name="bouwjaar_max" class="yearsTo"></span>
                            </div>





                            <p>
                                <label for="b">Brandstof</label>
                            </p>
                            <select name="brandstofsoort" id="fuel" class="selectCustom">
                                <option value>Selecteer brandstof</option>
                                <?php
                                foreach($_SESSION['fuel'] as $fuel){
                                    ?>
                                    <option value="<?php echo $fuel; ?>" class='fuelOption' <?php if(isset($_GET['brandstofsoort']) && $_GET['brandstofsoort'] == $fuel){ echo "selected"; } ?>><?php echo ucfirst(strtolower($fuel)); ?></option>
                                    <?php

                                }
                                ?>

                            </select>

                            <p>
                                <label for="b">Carrosserie</label>
                            </p>
                            <select name="carrosserievorm" id="caroserie" class="selectCustom">
                                <option value>Selecteer carrosserie</option>
                                <?php
                                foreach($_SESSION['caroserie'] as $caroserie){
                                    if($caroserie != ""){
                                        ?>
                                        <option value="<?php echo $caroserie; ?>" class="caroserieOption" <?php if(isset($_GET['carrosserievorm']) && $_GET['carrosserievorm'] == $caroserie){ echo "selected"; } ?>><?php echo ucfirst(strtolower($caroserie)); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>

                            <!--                        <p>-->
                            <!--                            <label for="b">Motorinhoud</label>-->
                            <!--                        </p>-->
                            <!--                        <select name="cilinderinhoud" id="power" class="selectCustom">-->
                            <!--                            <option value="min">Minimaal</option>-->
                            <!--                            --><?php
                            //                            foreach($_SESSION['power'] as $power){
                            //                                if($power != ""){
                            //                                    echo "<option value='$power' class='powerOption'>".ucfirst(strtolower($power))."</option>";
                            //                                }
                            //                            }
                            //                            ?>
                            <!---->
                            <!--                        </select>-->




                            <div id="moreOptions">
                                <a href="#" class="button_atAlt">
                                    meer zoekopties
                                </a>
                            </div>

                            <div id="hiddenOptions">
                                <p>
                                    <label for="a">Kilometerstand</label>
                                </p>


                                <p class="kmP">
                                    <span class="kmFrom kmFromLabel"><?php echo $_SESSION['km_min']; ?></span>
                                    <span class="kmTo kmToLabel"><?php echo $_SESSION['km_max']; ?></span>

                                    <span class="kmFromMin" style="display: none"><?php if(isset($_GET['kilometerstand_min'])){ echo $_GET['kilometerstand_min']; }else{ echo $_SESSION['km_min']; } ?></span>
                                    <span class="kmFromMax" style="display: none"><?php if(isset($_GET['kilometerstand_max'])){ echo $_GET['kilometerstand_max']; }else{ echo $_SESSION['km_max']; } ?></span>
                                </p>
                                <div class="priceSliderCont commSlideCont">
                                    <div id="sliderA" class="bouwjaarSlider"></div>
                                </div>
                                <div class="kmInputs" style="display: none;">
                                    <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="kilometerstand_min" class="kmFrom "></span>
                                <span
                                        class="comLeftTitle"> tot: </span> <span class="commInputs"><input type="text" name="kilometerstand_max" class="kmTo"></span>
                                </div>

                                <p>
                                    <label for="b">Transmissie</label>
                                </p>
                                <select name="transmissie" id="power" class="selectCustom">
                                    <option value="min">Alle transmissies</option>
                                    <?php
                                    if(isset($_SESSION['transmisie'])){
                                        foreach($_SESSION['transmisie'] as $type){
                                            ?>
                                            <option value="<?php echo $type; ?>" <?php if(isset($_GET['transmissie']) && $_GET['transmissie'] == $type){ echo "selected"; } ?>><?php echo ucfirst(strtolower($type)); ?></option>
                                            <?php
                                        }

                                    }
                                    ?>
                                </select>


                                <p>
                                    <label for="b">Aantal deuren</label>
                                </p>
                                <select name="aantalDeuren" id="power" class="selectCustom">
                                    <option value>Selecteer aantal deuren</option>
                                    <?php
                                    foreach($_SESSION['dors'] as $type){
                                        if($type != ""){
                                            ?>
                                            <option value="<?php echo $type; ?>" <?php if(isset($_GET['aantalDeuren']) && $_GET['aantalDeuren'] == $type){ echo "selected"; } ?>><?php echo ucfirst(strtolower($type)); ?></option>
                                            <?php
                                        }
                                    }

                                    ?>
                                </select>
                            </div>
                            <button type="submit" class="button_at1 button_color">toon auto's</button>
                        </form>
                    </div>


                </div>
                </div>
            </div>
        </div>
