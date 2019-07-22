<?php

$price_color = get_option("at_price_color");
?>

<style>
.price_color {
    color: <?php echo $price_color; ?> !important;
}

.subprice {
    display: block;
    float: left;
    clear: both;
    margin-top: 10px;
}
</style>
<div class="overview_gridWrapp">
    <div class="leftAndRightWrapp singleItemWrapp">
        <div class="centerDiv">
            <div class="leftContent_at" id="printContent">

                <?php if ($car): ?>

                    <div class="detailPage">
                        <div class="detailPageTop">
                            <h1 class="carTitleTop header_color">
                                <?=$car->data->advertise->title?>
                            </h1>
                            <?php
                            $at_go_back_status = get_option('at_go_back_status');
                            $at_go_back_text = get_option('at_go_back_text');
                            ?>

                            <?php if ($at_go_back_status == '1'): ?>
                                <a href="#" class="atGoBackButton atGoBackButtonTop"><?=$at_go_back_text?></a>
                            <?php endif; ?>

                            <div class="b4uPrintButton" title="Print Pagina">
                                <i class="fa fa-print"></i>
                            </div>
                        </div>

                        
                        <!-- /.detailPageTop -->

                        <div class="sliderAndDesc">
                            <div class="leftSlideBlock">
                                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="452" data-height="301">
                                    <?php if ($car->data->images) : ?>
                                        <?php foreach ($car->data->images as $key => $image) : ?>
                                            <a href="<?=$image->url?>">
                                                <img src="<?=$image->thumbs->{'320_'}?>">
                                            </a>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <a href="https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png">
                                            <img src="https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png"
                                            width="75" height="75">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.leftSlideBlock -->

                            <div class="rightDescBlock">
                                <div class="priceandLogo">
                                    <div class="priceCarItem price_color">
                                        <?php if ($car->data->advertise->total_price == '0'): ?>
                                            Prijs op aanvraag
                                        <?php else: ?>
                                            <?php echo $car->data->advertise->total_price; ?>

                                       <!--  <?php var_dump($car->data->advertise->taxable); ?> -->

                                                <span class="btw_val">
                                                <?php if(get_option('show_btw') == '1'): ?>
                                                    <?php if($car->data->advertise->incl_vat == 'Ja'): ?>
                                                        ( Inc. Btw )
                                                    <?php else: ?> 
                                                        ( Ex. Btw )
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if(get_option('taxable') == '1' && $car->data->advertise->taxable == 'Nee'): ?>
                                                    ( Marge )
                                                <?php endif; ?>
                                            </span>
                                        
                                    <?php endif; ?>

                                </div>

                                <div class="subprice">
                                    <?php if($car->data->advertise->government_costs): ?>
                                        Rijklaarmaakkosten - € <?=$car->data->advertise->government_costs?>
                                    <?php endif; ?>
                                </div>

                                <div class="logoCarItem">
                                    <?php if ($car->data->guarantees->guarantee_auto_trust && $car->data->guarantees->guarantee_auto_trust == 'Ja'): ?>
                                        <img src="<?php echo plugins_url("img/auto-tr.png", __FILE__) ?>" alt="">
                                    <?php endif; ?>

                                    <?php if ($car->data->guarantees->guarantee_nap  && $car->data->guarantees->guarantee_nap == 'Ja'): ?>
                                        <img src="<?php echo plugins_url("img/NAP_Logo.jpg", __FILE__) ?>" alt="">
                                    <?php endif; ?>

                                    <?php if ($car->data->guarantees && $car->data->guarantees->guarantee_bovag  && $car->data->guarantees->guarantee_bovag == 'Ja'): ?>
                                        <img src="<?php echo plugins_url("img/Logo-BOVAG-Garantie.jpg", __FILE__) ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- /.priceandLogo -->

                            <div class="detailDesc">
                                <div class="leftDetailDesc">
                                    <span class="optionsWrap">

                                        <?php foreach($carsService->getSumaryDetailAttr() as $attr): ?>
                                            <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                                            <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                                            <span class="leftType atribute_label_color">
                                                <?=$attr->attribute?>:
                                            </span>
                                            <span class="rightOption atribute_value_color">
                                                <?php if(eval("?> $compare <?php ")): ?>
                                                    <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>

                                            </span>

                                        <?php endforeach; ?>

                                    </span>
                                </div>
                            </div>
                            <!-- /.detailDesc -->
                        </div>
                    </div>
                    <!-- /.sliderAndDesc -->

                    <div class="omschriving">
                        <?php if(count($car->data->videos) > 0): ?>
                            <?php include('parts/video_part.php') ?>
                        <?php endif; ?>

                        <div class="titleOms commTitle26">Omschrijving</div>
                        <div class="descOms commDesc text_color">
                            <?=$car->data->advertise->description?>
                        </div>
                        <?php if(count($car->data->options) > 0 && isset($car->data->options->general)  &&  count($car->data->options->general) > 0): ?>
                            <h2>Meer opties</h2>                          
                            <ul>
                                <?php foreach($car->data->options->general as $option): ?>
                                    <li><?=$option->name?></li>
                                <?php endforeach; ?>

                            </ul>
                        <?php endif; ?>  
                        <!-- /.descOms.commDesc -->
                    </div>
                    <!-- /.omschriving -->


                  

                    <div class="optionsAccesories">
                        <?php if((count($car->data->options) > 0 && isset($car->data->options->lightning) &&  count($car->data->options->lightning) > 0) || (count($car->data->options) > 0 && isset($car->data->options->exterior) && count($car->data->options->exterior) > 0) || (count($car->data->options) > 0 && isset($car->data->options->safety_technology) && count($car->data->options->safety_technology) > 0) || (count($car->data->options) > 0 && isset($car->data->options->audio_telephony) &&  count($car->data->options->audio_telephony) > 0) || (count($car->data->options) > 0 && isset($car->data->options->interior_comfort)  && count($car->data->options->interior_comfort) > 0)): ?>
                            <hr class="lineAll">
                            <h3 class="carDetailTitle optAccTitle">
                                Opties en Accessoires
                            </h3>
                        <?php endif; ?>

                                <?php //endif; # ???
                                ?>
                                <div class="descOptAcc">
                                    <?php #Veiligheid category
                                    ?>
                                    <?php if (count($car->data->options) > 0 && isset($car->data->options->lightning) &&  count($car->data->options->lightning) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Verlichting</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach($car->data->options->lightning as $option): ?>
                                                    <li><?=$option->name?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories) > 0)
                                    ?>

                                    <?php #Exterieur category
                                    ?>
                                    <?php if (count($car->data->options) > 0 && isset($car->data->options->exterior) && count($car->data->options->exterior) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Exterieur</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach($car->data->options->exterior as $option): ?>
                                                    <li><?=$option->name?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories_ext) > 0)
                                    ?>

                                    <?php # Veiligheid en Techniek category
                                    ?>
                                    <?php if (count($car->data->options) > 0 && isset($car->data->options->safety_technology) && count($car->data->options->safety_technology) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Veiligheid en Techniek</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach($car->data->options->safety_technology as $option): ?>
                                                    <li><?=$option->name?></li>
                                                <?php endforeach; ?>                                            
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories_vT) > 0)
                                    ?>

                                    <?php # Audio / Telefonie category
                                    ?>
                                    <?php if (count($car->data->options) > 0 && isset($car->data->options->audio_telephony) &&  count($car->data->options->audio_telephony) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Audio / Telefonie</h4>
                                            <ul class="commList commDesc text_color">
                                               <?php foreach($car->data->options->audio_telephony as $option): ?>
                                                <li><?=$option->name?></li>
                                            <?php endforeach; ?>   
                                        </ul>
                                    </div>
                                    <?php endif; // (count($options_accessories_aT) > 0)
                                    ?>

                                    <?php #Interieur en Comfort
                                    ?>
                                    <?php if (count($car->data->options) > 0 && isset($car->data->options->interior_comfort)  && count($car->data->options->interior_comfort) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Interieur en Comfort</h4>
                                            <ul class="commList commDesc text_color">
                                             <?php foreach($car->data->options->interior_comfort as $option): ?>
                                                <li><?=$option->name?></li>
                                            <?php endforeach; ?>   
                                        </ul>
                                    </div>
                                    <?php endif; // (count($options_accessories_iC) > 0)
                                    ?>
                                </div>
                                <!-- /.descOptAcc -->
                            </div>
                            <!-- /.optionsAccesories -->
                        <?php endif; ?>

                        <hr class="lineAll">
                        <div class="specificatiesBlock">
                            <h3 class="carDetailTitle titleSpecificaties">Specificaties</h3>
                            <div class="descSpecificaties">
                                <div class="carDetailSubtitle"></div>

                                <div class="descAlgemen commDesc text_color">
                                    <div class="commLeftSpecific">

                                    </div>
                                </div>

                                <hr class="lineAll">
                            </div>
                            <!-- /.descSpecificaties -->
                            <?php if(count($carsService->getDetailsTotalAttr('algemeen')) > 0): ?>
                                <div class="descSpecificaties">
                                    <h4 class="carDetailSubtitle">
                                        Algemeen
                                    </h4>

                                    <div class="descAlgemen commDesc text_color">
                                        <div class="commLeftSpecific between">

                                            <?php foreach($carsService->getDetailsTotalAttr('algemeen') as $attr): ?>
                                                <?php if($attr->type == 'marge'): ?>

                                                    <span class="optionsWrap">
                                                        <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                                                        <span class="rightDescSpan">
                                                    
                                                            <?php if(get_option('taxable') == '1'  && $car->data->advertise->taxable == 'Ja'): ?>
                                                               BTW verrekenbaar
                                                            <?php else: ?>
                                                               BTW niet verrekenbaar (margeregeling)
                                                            <?php endif; ?>

                                                    </span>
                                                </span>  

                                            <?php else: ?>

                                                <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                                                <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                                                <span class="optionsWrap">
                                                    <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                                                    <span class="rightDescSpan">

                                                        <?php if(eval("?> $compare <?php ")): ?>
                                                           <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                                       <?php else: ?>
                                                        -
                                                    <?php endif; ?>

                                                </span>
                                            </span>  

                                        <?php endif; ?>  

                                    <?php endforeach; ?> 

                                </div>
                            <?php endif; ?>
                            <!-- /.commLeftSpecific -->
                            <?php if(count($carsService->getDetailsTotalAttr('aflevering')) > 0): ?>
                               <hr class="lineAll">

                               <h4 class="carDetailSubtitle">
                                AFLEVERING
                            </h4>

                            <div class="descAlgemen commDesc text_color">
                                <div class="commLeftSpecific between">

                                    <?php foreach($carsService->getDetailsTotalAttr('aflevering') as $attr): ?>
                                        <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                                        <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                                        <span class="optionsWrap">
                                            <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                                            <span class="rightDescSpan">

                                                <?php if(eval("?> $compare <?php ")): ?>
                                                   <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                                <?php else: ?>
                                                    -
                                                <?php endif; ?>

                                        </span>
                                    </span>  

                                <?php endforeach; ?> 

                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if(count($carsService->getDetailsTotalAttr('geschiedenis')) > 0): ?>
                        <hr class="lineAll">
                        <h4 class="carDetailSubtitle">
                            GESCHIEDENIS VAN DEZE AUTO
                        </h4>

                        <div class="descAlgemen commDesc text_color">
                            <div class="commLeftSpecific between">

                                <?php foreach($carsService->getDetailsTotalAttr('geschiedenis') as $attr): ?>
                                   <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                                   <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                                   <span class="optionsWrap">
                                    <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                                    <span class="rightDescSpan">

                                        <?php if(eval("?> $compare <?php ")): ?>
                                           <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>

                                </span>
                            </span>  

                        <?php endforeach; ?> 

                    </div>
                </div>

            <?php endif; ?>

            
            <?php if(count($carsService->getDetailsTotalAttr('matenEnGewichten')) > 0): ?>
                <hr class="lineAll">
                <h4 class="carDetailSubtitle">
                    MATEN EN GEWICHTEN
                </h4>

                <div class="descAlgemen commDesc text_color">
                    <div class="commLeftSpecific between">

                        <?php foreach($carsService->getDetailsTotalAttr('matenEnGewichten') as $attr): ?>
                            <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                            <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                            <span class="optionsWrap">
                                <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                                <span class="rightDescSpan">

                                    <?php if(eval("?> $compare <?php ")): ?>
                                       <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>

                            </span>
                        </span>    

                    <?php endforeach; ?> 



                </div>
            </div>
        <?php endif; ?>

        <?php if(count($carsService->getDetailsTotalAttr('milieu')) > 0): ?>
           <hr class="lineAll">

           <h4 class="carDetailSubtitle">
            MILIEU
        </h4>

        <div class="descAlgemen commDesc text_color">
            <div class="commLeftSpecific between">

                <?php foreach($carsService->getDetailsTotalAttr('milieu') as $attr): ?>
                    <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                    <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                    <span class="optionsWrap">
                        <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                        <span class="rightDescSpan">

                            <?php if(eval("?> $compare <?php ")): ?>
                               <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                            <?php else: ?>
                                -
                            <?php endif; ?>

                    </span>
                </span>    

            <?php endforeach; ?> 

        </div>
    </div>
<?php endif; ?>

<?php if(count($carsService->getDetailsTotalAttr('motor')) > 0): ?>
    <hr class="lineAll">

    <h4 class="carDetailSubtitle">
        MOTOR
    </h4>

    <div class="descAlgemen commDesc text_color">
        <div class="commLeftSpecific between">

            <?php foreach($carsService->getDetailsTotalAttr('motor') as $attr): ?>
                <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
                <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

                <span class="optionsWrap">
                    <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                    <span class="rightDescSpan">

                        <?php if(eval("?> $compare <?php ")): ?>
                           <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                        <?php else: ?>
                            -
                        <?php endif; ?>

                </span>
            </span>    

        <?php endforeach; ?> 

    </div>
</div>

<?php endif; ?>
<?php if(count($carsService->getDetailsTotalAttr('prestaties')) > 0): ?>

<hr class="lineAll">

<h4 class="carDetailSubtitle">
    PRESTATIES
</h4>

<div class="descAlgemen commDesc text_color">
    <div class="commLeftSpecific between">

        <?php foreach($carsService->getDetailsTotalAttr('prestaties') as $attr): ?>
            <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
            <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

            <span class="optionsWrap">
                <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                <span class="rightDescSpan">

                    <?php if(eval("?> $compare <?php ")): ?>
                       <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                    <?php else: ?>
                        -
                    <?php endif; ?>

            </span>
        </span>    

    <?php endforeach; ?> 

</div>
</div>

<?php endif; ?>

<?php if(count($carsService->getDetailsTotalAttr('onderstel')) > 0): ?>

   <hr class="lineAll">

   <h4 class="carDetailSubtitle">
    ONDERSTEL
</h4>


<div class="descAlgemen commDesc text_color">
    <div class="commLeftSpecific between">

        <?php foreach($carsService->getDetailsTotalAttr('onderstel') as $attr): ?>
            <?php $value = '<?php echo @$car->data->'.$attr->type.'?>';?>
            <?php $compare = '<?php return @$car->data->'.$attr->type.'?>';?>

            <span class="optionsWrap">
                <span class="leftDescSpan"><?=$attr->attribute?> :</span>
                <span class="rightDescSpan">

                    <?php if(eval("?> $compare <?php ")): ?>
                       <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                    <?php else: ?>
                       -
                    <?php endif; ?>

            </span>
        </span>    

    <?php endforeach; ?> 



</div>
</div>

<?php endif; ?>

<?php if(count($car->data->guarantees->items) > 0): ?>

   <hr class="lineAll">

   <h4 class="carDetailSubtitle">
    Garanties en zekerheden
</h4>

<div class="descAlgemen commDesc text_color">
    <div class="commLeftSpecific between">
        <ul class="commList commDesc text_color">
            <?php foreach($car->data->guarantees->items as $item): ?>
                <li><?=$item->title?> <p><?=$item->text?></p></li>
                
            <?php endforeach; ?>                                  
        </ul>
    </div>
</div>

<?php endif; ?>

</div>
<!-- /.descAlgemen -->
</div>
<!-- /.descSpecificaties -->

<?php
$at_go_back_status = get_option('at_go_back_status');
$at_go_back_text = get_option('at_go_back_text');
?>

<!-- Iframe start -->
<?php $at_iframe = get_option('at_iframe'); ?>
<?php if($at_iframe != ""): ?>
    <div class="iframeWraper">
        <div class="iframe_title">Financiering</div>

        <?php



        $price = str_replace('€','', $car->data->advertise->total_price);
        $price = str_replace('.','', $price);
        $price = str_replace(',','', $price);


        $at_iframe = str_replace('{prijs}',(float)$price, $at_iframe);
        $at_iframe = str_replace('{bouwjaar}',$car->data->construction_year, $at_iframe);
        $at_iframe = str_replace('{voertuig}',substr($car->data->advertise->title, 0, 1), $at_iframe);


        ?>
        <?=$at_iframe?>
    </div>
<?php endif; ?>
<!-- Iframe end -->

<?php if ($at_go_back_status == '1'): ?>
    <a href="#" class="atGoBackButton atGoBackButtonBottom"><?= $at_go_back_text ?></a>
<?php endif; ?>
</div>
<!-- /.specificatiesBlock -->
</div>
</div>

<?php # sidebar ?>
<?php include('parts/detail_sidebar.php') ?>
<?php #end sidebar ?>

</div>
<?php # end .centerDiv ?>
</div>
</div>

