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

                <?php
                    if($car){
                            ?>
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
                                         <?php if(get_option('show_btw') == '1'): ?>
                                            <span class="btw_val">
                                                <?php if($car->data->advertise->incl_vat == '1'): ?>
                                                    ( Inc. Btw )
                                                <?php else: ?> 
                                                    ( Ex. Btw )
                                                <?php endif; ?>  
                                            </span>
                                        <?php endif; ?>  
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
                                        <img src="<?php echo plugins_url("img/NAP_Logo.jpg",__FILE__) ?>" alt="">
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

                                     
                                <h3 class="optAccTitle commTitle26">    
                                    Opties en Accessoires
                                </h3>

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

                                    <!-- End block -->

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

                                    <!-- end block -->

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

                                    <!-- End block  -->

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

                                    <!-- End block -->

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

                                    <!-- End block -->

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

                                    <!-- End block -->

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

                                    <!-- End block -->

                                </div>
                            </div>

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
                                            <li><?=$item->title?></li>
                                            <p><?=$item->text?></p>
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

                            <?php
                    }else{
                        ?>
                        <p style="text-align: center;">Er is geen occasion gevonden.</p>
                        </div>
                        <?php
                    }
                ?>
                

<!-- sidebar -->
<div class="sidebarContent">
                   <div class="concatFormText" style="display: none">Goedendag,
Ik ben geïnteresseerd in uw
<?php echo $car->data->advertise->title; ?>

Wilt u contact met mij opnemen?
Met vriendelijke groet,
</div>

                <?php
                $sidebar_blocks = get_option('at_sidebar_blocks');
                $sidebar_blocks = json_decode($sidebar_blocks);
                $sidebar_blocks = at_object_to_array($sidebar_blocks);
                ?>

                <?php foreach ($sidebar_blocks as $block): ?>
                    <?php if ($block['name'] == "Contactformulier" && $block['state'] == "1") : ?>
                        <?php $at_form_short_code = get_option('at_form_short_code'); ?>
                        <?php if (isset($_SESSION['thx_text'])) : ?>
                            <?php
                            $text = get_option("at_thank_you_text");
                            echo $text;
                            unset($_SESSION['thx_text']);
                            ?>
                        <?php else: ?>

                            <?php # ======================== Contact form  block ========================= ?>
                            <div class="titleSidebarDetail">Neem contact met ons op</div>
                            <?php if ($at_form_short_code != "") : ?>
                                <?php echo do_shortcode($at_form_short_code); ?>
                            <?php else: ?>
                                <?php include('contact_form.php'); ?>
                            <?php endif; // ($at_form_short_code != "") ?>
                            <?php #======================== End contact form block ========================= ?>

                        <?php endif; // (isset($_SESSION['thx_text'])) ?>

                    <?php elseif ($block['name'] == "Social Media Informatie" && $block['state'] == "1") : ?>

                        <?php #======================== Social media  block ========================= ?>
                        <hr class="lineAll">
                        <div class="socialMedia">
                            <p><label for="" class="bigLabel">Deel deze tweedehands auto</label></p>
                            <?php
                            $socials = get_option('at_social_icons');
                            $socials = json_decode($socials);
                            ?>

                            <p>
                                <?php
                                $site_url = get_site_url();
                                $page_slug = get_option("at_url_page_adverts");
                                $url_param = $_SERVER['REQUEST_URI'];
                                $url_param = explode('/', $url_param);
                                $occasion_id = (int)$url_param[3];
                                ?>
                                <?php foreach ($socials as $item): ?>
                                    <?php if ($item->active == "1") : ?>
                                        <?php if ($item->name == "Facebook") : ?>
                                            <?php # FACEBOOK ?>
                                            <?php $fbShareUrl = $site_url . '/' . $page_slug . '/?overview=' . $occasion_id; ?>
                                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $fbShareUrl ?>"
                                               target="_blank">
                                                <img src="<?php echo $item->icon_url ? $item->icon_url : plugins_url('img/fbIcon.png', __FILE__); ?>"
                                                     alt="<?= $item->alt ?>"/>
                                            </a>

                                        <?php elseif ($item->name == "Linkedin") : ?>
                                            <?php # LINKED-IN ?>
                                            <?php
                                            $inShareUrl = $site_url . '/' . $page_slug . '/?overview=' . $occasion_id .
                                                '&title=' . $car->data->brand->title." ".$car->data->model->title." ".$car->data->advertise->title .
                                                '&summary=&source=' . $site_url;
                                            ?>
                                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $inShareUrl ?>"
                                               target="_blank">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/linkedin.png', __FILE__); ?>"
                                                     alt="<?= $item->alt ?>">
                                            </a>

                                        <?php elseif ($item->name == "Twitter") : ?>
                                            <? # TWITTER ?>
                                            <a href="https://twitter.com/home?status=<?php echo $site_url; ?>/<?= $page_slug ?>/?overview=<?= $occasion_id ?>"
                                               target="_blank">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/twitter.png', __FILE__); ?>"
                                                     alt="<?= $item->alt ?>">
                                            </a>

                                        <?php elseif ($item->name == "Google Plus") : ?>
                                            <?php # GOOGLE PLUS ?>
                                            <a href="https://plus.google.com/share?url=<?php echo $site_url; ?>/<?= $page_slug ?>/?overview=<?= $occasion_id ?>"
                                               target="_blank">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/gplus.png', __FILE__) ?>"
                                                     alt="<?= $item->alt ?>">
                                            </a>

                                        <?php elseif ($item->name == "Pinterest") : ?>
                                            <?php # PINTEREST ?>
                                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $site_url; ?>/<?= $page_slug ?>/?overview=<?= $occasion_id ?>&media=<?php echo $images[0]; ?>&description=<?php $car->mededelingen ?>"
                                               target="_blank">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/pinterest.png', __FILE__); ?>"
                                                     alt="">
                                            </a>

                                        <?php elseif ($item->name == "Mail") : ?>
                                            <?php # MAIL ?>
                                            <a href="#">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/mail.png', __FILE__); ?>"
                                                     alt="<?= $item->alt ?>">
                                            </a>

                                        <?php elseif ($item->name == "Instagram") : ?>
                                            <?php # INSTAGRAM ?>
                                            <a href="#">
                                                <img src="<?php if ($item->icon_url) {
                                                    echo $item->icon_url;
                                                } else {
                                                    echo plugins_url('img/instagram-icon.png', __FILE__);
                                                } ?>" alt="">
                                            </a>

                                        <?php else: ?>
                                            <a href="#">
                                                <img src="<?php if ($item->icon_url) {
                                                    echo $item->icon_url;
                                                } else {
                                                    echo plugins_url('img/gplus.png', __FILE__);
                                                } ?>" alt="<?= $item->alt ?>">
                                            </a>
                                        <?php endif; ?>

                                    <?php endif; // ($item->active == "1") ?>
                                <?php endforeach; // ($socials as $item) ?>
                            </p>
                        </div>

                        <?php #======================== End social media  block ========================= ?>

                    <?php elseif ($block['name'] == "Contactinformatie" && $block['state'] == "1") : ?>
                        <?php $get_from = get_option("at_addres_info"); ?>
                        <?php #======================== Contact info block ========================= ?>
                        <div class="contactInfo">
                            <hr class="lineAll">
                             <?php echo ($get_from == "from_text_area") ? get_option('at_contact_info') : $carsService->get_addres_info($car); ?>
                        </div>
                        <?php #======================== End contact info block ========================= ?>
                    <?php elseif ($block['name'] == "Openingstijden" && $block['state'] == "1") : ?>
                        <div class="openingstijden">
                            <hr class="lineAll">
                            <p><label for="" class="bigLabel">Openingstijden</label></p>
                            <table cellspacing="1" cellpadding="1">
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td><strong></strong></td>
                                </tr>
                                <?php
                                $shedule = get_option('at_shedule');
                                $shedule_days = json_decode($shedule);
                                ?>
                                <?php foreach ($shedule_days as $day): ?>
                                    <?php if (isset($day->time1)) : ?>
                                        <tr>
                                            <td><strong><?= $day->day ?></strong></td>
                                            <td><?= $day->time1->from ?> – <?= $day->time1->to ?></td>
                                        </tr>
                                    <?php endif; ?>

                                    <?php if (isset($day->time2)) : ?>
                                        <tr>
                                            <td><strong></strong></td>
                                            <td><?= $day->time2->from ?> – <?= $day->time2->to ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.openingstijden -->
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (is_active_sidebar('at_sidebar')) dynamic_sidebar('at_sidebar'); ?>
            </div>

</div>
<!-- end sidebar -->
</div>
</div>
</div>


