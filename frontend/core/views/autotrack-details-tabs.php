<?php
$price_color = get_option("at_price_color");
?>
<style>

.subprice{
    display: block;
    float: left;
    clear: both;
    margin-top: 10px;
}
.price_color{
    color: <?php echo $price_color; ?> !important;
}

</style>

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="overview_gridWrapp">
    <div class="leftAndRightWrapp singleItemWrapp">
        <div class="centerDiv">
            <div class="leftContent_at" id="printContent">

                <?php if($car): ?>
                            <div class="detailPage">
                    <h1 class="carTitleTop header_color">
                         <?=$car->data->advertise->title?>
                    </h1>
                    <?php
                    $at_go_back_status = get_option('at_go_back_status');
                    $at_go_back_text = get_option('at_go_back_text');
                    if($at_go_back_status == '1'): ?>
                    <a href="#" class="atGoBackButton atGoBackButtonTop"><?=$at_go_back_text?></a>
                    <?php endif; ?>
                    <div class="b4uPrintButton" title="Print Pagina">
                        <i class="fa fa-print"></i>
                    </div>

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

                        <div class="rightDescBlock">
                            <div class="priceandLogo">
                                <div class="priceCarItem price_color">
                                    <?php if ($car->data->advertise->total_price == '0'): ?>
                                        Prijs op aanvraag
                                    <?php else: ?>
                                         <?php echo $car->data->advertise->total_price; ?>
                                         
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

                                    <?php if ($car->data->guarantees->guarantee_bovag  && $car->data->guarantees->guarantee_bovag == 'Ja'): ?>
                                        <img src="<?php echo plugins_url("img/Logo-BOVAG-Garantie.jpg", __FILE__) ?>" alt="">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Desc -->
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

                                <!-- End Desc -->
                        </div>
                    </div>
                </div>

                <div class="tabsSingleItem">
                    <div class="tabs">
                        <ul class="tab-links">
                            <li class="active">
                               <a href="#tab1">Overzicht</a>
                            </li>
                            <li>
                                <a href="#tab2">Extra gegevens</a>
                            </li>
                            <?php if(count($car->data->videos) > 0): ?>
                                <li>
                                <a href="#video">Video</a>
                            </li>
                            <?php endif; ?>
                            <?php if(count($car->data->guarantees->items) > 0): ?>
                                <li>
                                    <a href="#tab5">Garanties</a>
                                </li>
                            <?php endif; ?>

                            <?php $at_iframe = get_option('at_iframe'); ?>
                            <?php if($at_iframe != ""): ?>
                                <li><a href="#tab4">Financial lease</a></li>
                            <?php endif; ?>
                        </ul>

                        <div class="tab-content">

                            <div id="tab1" class="tab active">
                                <div class="omschriving">
                                    <div class="titleOptieAcc commTitleBlue">Algemeen</div>

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

                                            <div class="titleOms commTitle26">Omschrijving</div>
                                             <div class="descOms commDesc text_color">
                                                <?=@$car->data->advertise->description?>
                                              </div>
                                         <?php if(count($car->data->options) > 0 && isset($car->data->options->general)  &&  count($car->data->options->general) > 0): ?>
                                             <h2>Meer opties</h2>
                                            <ul>
                                               
                                                    <?php foreach($car->data->options->general as $option): ?>
                                                        <li><?=$option->name?></li>
                                                    <?php endforeach; ?>
                                                
                                            </ul> 
                                        <?php endif; ?> 
                                </div>
                            </div>

                            <div id="tab2" class="tab">
                                <div class="optionsAccesories">
                            <?php if((count($car->data->options) > 0 && isset($car->data->options->lightning) &&  count($car->data->options->lightning) > 0) || (count($car->data->options) > 0 && isset($car->data->options->exterior) && count($car->data->options->exterior) > 0) || (count($car->data->options) > 0 && isset($car->data->options->safety_technology) && count($car->data->options->safety_technology) > 0) || (count($car->data->options) > 0 && isset($car->data->options->audio_telephony) &&  count($car->data->options->audio_telephony) > 0) || (count($car->data->options) > 0 && isset($car->data->options->interior_comfort)  && count($car->data->options->interior_comfort) > 0)): ?>
                                <h3 class="optAccTitle commTitle26">    
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
                                            <h4 class="titleOptieAcc commTitleBlue">Verlichting</h4>
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
                                            <h4 class="titleOptieAcc commTitleBlue">Exterieur</h4>
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
                                            <h4 class="titleOptieAcc commTitleBlue">Veiligheid en Techniek</h4>
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
                                            <h4 class="titleOptieAcc commTitleBlue">Audio / Telefonie</h4>
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
                                            <h4 class="titleOptieAcc commTitleBlue">Interieur en Comfort</h4>
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
                            <?php if(count($carsService->getDetailsTotalAttr('aflevering')) > 0): ?>

                                   <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Aflevering</div>

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

                                <?php endif; ?>    

                                    <!-- End block -->
                                <?php if(count($carsService->getDetailsTotalAttr('geschiedenis')) > 0): ?>
                                    <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Geschiedenis van deze auto</div>
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
                                <?php endif; ?>

                                    <!-- end block -->
                                <?php if(count($carsService->getDetailsTotalAttr('matenEnGewichten')) > 0): ?>
                                    <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Maten En Gewichten</div>

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
                                <?php endif; ?>

                               <!-- End block  -->
                                <?php if(count($carsService->getDetailsTotalAttr('milieu')) > 0): ?>
                                    <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Milieu</div>

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
                                <?php endif; ?>

                                    <!-- End block -->
                                <?php if(count($carsService->getDetailsTotalAttr('motor')) > 0): ?>
                                     <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Motor</div>

                                            
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
                                <?php endif; ?>
                                    <!-- End block -->

                                 <?php if(count($carsService->getDetailsTotalAttr('prestaties')) > 0): ?>    

                                    <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Prestaties</div>
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

                                <?php endif; ?>

                                    <!-- End block -->
                                <?php if(count($carsService->getDetailsTotalAttr('onderstel')) > 0): ?>
                                    <div class="optionWrapper">       
                                        <hr class="lineAll">
                                        <div class="titleOptieAcc commTitleBlue">Onderstel</div>
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

                                <?php endif; ?>    

                                    <!-- End block -->

                                </div>
                            </div>
                        <?php if(count($car->data->videos) > 0): ?>
                            <div id="video" class="tab">
                                <?php include('parts/video_part.php') ?>
                            </div>
                        <?php endif; ?>

                            <?php $at_iframe = get_option('at_iframe'); ?>
                            <?php if($at_iframe != ""): ?>
                                <?php
                                $at_iframe = str_replace('{prijs}',$car->data->advertise->total_price, $at_iframe);
                                $at_iframe = str_replace('{bouwjaar}',$car->data->construction_year, $at_iframe);
                                $at_iframe = str_replace('{voertuig}',substr($car->data->advertise->title, 0, 1), $at_iframe);
                                ?>
                                <div id="tab4" class="tab">
                                    <div class="iframeWraper">
                                    <div class="iframe_title">Financiering</div>
                                        <?=$at_iframe?>
                                    </div>
                                </div>
                            <?php endif; ?>
                              <!-- Garanties -->
                              <?php if(count($car->data->guarantees->items) > 0): ?>
                                <div id="tab5" class="tab">
                                    <div class="optieAccItem">
                                    
                                        <div class="titleOptieAcc commTitleBlue">
                                            Garanties en zekerheden
                                        </div>
                                        <ul class="commList commDesc text_color">

                                        <?php foreach($car->data->guarantees->items as $item): ?>
                                            <li><?=$item->title?> <p><?=$item->text?></p></li>
                                            
                                        <?php endforeach; ?>
                                                      
                                        </ul>
                                    

                                        </div>
                                </div>
                              <?php endif; ?>  
                        </div>
                    </div>
                    <?php
                            $at_go_back_status = get_option('at_go_back_status');
                            $at_go_back_text = get_option('at_go_back_text');
                            if($at_go_back_status == '1'): ?>
                                <a href="#" class="atGoBackButton atGoBackButtonBottom"><?=$at_go_back_text?></a>
                            <?php endif; ?>
                </div>
            </div>

<!-- tabs section -->

<!-- end -->
            <?php else: ?>
                    <p style="text-align: center;">Er is geen occasion gevonden.</p>
                        </div>
            <?php endif; ?>

                

<!-- sidebar -->
    <?php include('parts/detail_sidebar.php') ?>
<!-- end sidebar -->
</div>

</div>
</div>
</div>


