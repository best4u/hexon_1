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
                    if($ocassion){
                            ?>
                            <div class="detailPage">
                    <h1 class="carTitleTop header_color">
                        <?php echo $ocassions_obj->get_car_name($ocassion); ?>
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

                                 <?php
                                        $images = $ocassions_obj->get_small_images($ocassion);
                                        if($images){
                                            foreach ($images as $key =>$foto) {
                                            ?>
                                            <a href="<?php echo $foto ?>">
                                                <img src="<?php echo $key ?>">
                                            </a>
                                            <?php
                                                }
                                        }else{
                                            ?>
                                             <a href="https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png">
                                                <img src="https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png" >
                                            </a>
                                            <?php
                                        }
                                        
                                        ?>
                            </div>
                        </div>

                        <div class="rightDescBlock">
                            <div class="priceandLogo">
                                <div class="priceCarItem price_color">
                                     <?php if($ocassions_obj->get_car_price($ocassion) == '0'): ?>
                                                Prijs op aanvraag
                                            <?php else: ?>
                                                € <?php echo $ocassions_obj->get_car_price($ocassion); ?>
                                                 <span class="btw_val">
                                                    <?php echo $ocassions_obj->get_btw($ocassion); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                <div class="subprice">Rijklaarmaakkosten <?php echo $ocassions_obj->get_apkBijAflevering($ocassion); ?></div>
                                <div class="logoCarItem">

                                    <?php if($ocassions_obj->getAutoTrustGarantie($ocassion)): ?>
                                      <img src="<?php echo plugins_url("img/auto-tr.png", __FILE__) ?>" alt="">
                                    <?php endif ;?>

                                    <?php if($ocassions_obj->get_nap_logo($ocassion)): ?>
                                         <img src="<?php echo plugins_url("img/NAP_Logo.jpg", __FILE__) ?>" alt="">
                                    <?php endif ;?>
                                </div>
                            </div>

                            <div class="detailDesc">
                                <div class="leftDetailDesc">
                                    <?php
                                    foreach($ocassions_obj->get_sumary_detail_attr($ocassion) as $key => $options)
                                    {
                                        foreach($options as $key => $option){
                                            foreach($option as $type =>  $car_option)
                                            {
                                                ?>
                                                <span class="optionsWrap"><span class="leftType atribute_label_color"><?php echo ucfirst(strtolower($type)); ?>:</span> <span class="rightOption atribute_value_color"><?php echo $car_option; ?></span></span>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tabsSingleItem">
                    <div class="tabs">
                        <ul class="tab-links">
                            <li class="active"><a href="#tab1">Overzicht</a></li>
                            <li><a href="#tab2">Extra gegevens</a></li>

                             <?php $garanties = $ocassions_obj->get_garanties($ocassion); ?>
                            <?php if(!empty($garanties)): ?>
                                <li><a href="#tab5">Garanties</a></li>
                            <?php endif; ?>

                            <?php
                            if (count($ocassion->algemeen->videoUrls) > 0) {
                                ?>
                                <li><a href="#tab3">Video</a></li>
                                <?php
                            }

                            ?>
                            <?php $at_iframe = get_option('at_iframe'); ?>
                            <?php if($at_iframe != ""): ?>
                                <li><a href="#tab4">Financial lease</a></li>
                            <?php endif; ?>


                        </ul>

                        <div class="tab-content">

                            <div id="tab1" class="tab active">
                                <div class="omschriving">

                                    <?php
                                    $category = "";
                                    foreach($ocassions_obj->get_details_total_attr($ocassion) as $key => $options){

                                        foreach($options as $key => $option)
                                        {
                                            if($key == "algemeen"){
                                                if($key != $category){
                                                    $category = $key;
                                                    ?>
                                                    <div class="titleOptieAcc commTitleBlue">
                                                        <?php
                                                        $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                                        $count = 0;
                                                        foreach($spited_title as $title){
                                                            if($count == 0){
                                                                if($title == "geschiedenis"){
                                                                    echo "Geschiedenis van deze auto";
                                                                }else{
                                                                    echo ucfirst(strtolower($title))." ";
                                                                }
                                                            }else{
                                                                echo ucfirst(strtolower($title))." ";
                                                            }

                                                            $count++;
                                                        }

                                                        ?>
                                                    </div>

                                                    <?php
                                                }
                                                foreach($option as $type =>  $car_option)
                                                {

                                                    if($category == "garanties"){
                                                        ?>
                                                         <span class="optionsWrap">  <span class="leftDescSpan"><?php echo ucfirst(strtolower($car_option)); ?> </span></span>
                                                        <?php
                                                    }else{
                                                        ?>
                                                         <span class="optionsWrap"> <span class="leftDescSpan"><?php echo ucfirst(strtolower($type)); ?>: </span> <span class="rightDescSpan"><?php echo ucfirst(strtolower($car_option)); ?></span></span>
                                                        <?php
                                                    }

                                                }
                                            }

                                        }
                                    }

                                    ?>
                                    <div class="titleOms commTitle26">
                                        Omschrijving
                                    </div>
                                    <div class="descOms commDesc text_color">
                                    <?php
                                        require_once('markdown_extended.php');
                                        $html = MarkdownExtended($description_text);
                                    ?>
                                        <p>
                                            <?=$html?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab2" class="tab">

                                <div class="optionsAccesories">
                                    <?php
                                    $options_accessories = $ocassions_obj->get_car_safety_attr("188c3d8d-cbb6-4916-ab1b-32796e618c5c",$ocassion);
                                    $options_accessories_ext = $ocassions_obj->get_car_safety_attr("4121e7b2-af4c-432b-97de-9bec8b97e31a",$ocassion);
                                    $options_accessories_vT = $ocassions_obj->get_car_safety_attr("f9eb02f8-8f59-4272-99d4-eeacb98e1d92",$ocassion);
                                    $options_accessories_aT = $ocassions_obj->get_car_safety_attr("a826980c-9064-4e33-800a-7ace75e182ae",$ocassion);
                                    $options_accessories_iC = $ocassions_obj->get_car_safety_attr("de6c3b5f-4abf-4c70-afb1-1642953fa2e6",$ocassion);

                                    if(count($options_accessories) != 0 || count($options_accessories_ext) != 0 || count($options_accessories_vT) != 0 || count($options_accessories_aT) != 0 || count($options_accessories_iC) != 0){
                                        ?>
                                        <div class="optAccTitle commTitle26">
                                            Opties en Accessoires
                                        </div>
                                        <?php
                                        }
                                        ?>

                                    <div class="descOptAcc">

                                        <!--    Veiligheid category-->
                                        <?php
                                        if (count($options_accessories) > 0) {
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Verlichting
                                                </div>
                                                <ul class="commList commDesc text_color">
                                                    <?php
                                                    foreach ($options_accessories as $option) {
                                                        ?>
                                                        <li><?php echo $option; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        <!--       Exterieur category      -->
                                        <?php ;
                                        if (count($options_accessories_ext) > 0) {
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Exterieur
                                                </div>
                                                <ul class="commList commDesc text_color">
                                                    <?php
                                                    foreach ($options_accessories_ext as $option) {
                                                        ?>
                                                        <li><?php echo $option; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        <!--       Veiligheid en Techniek category      -->
                                        <?php
                                        if (count($options_accessories_vT) > 0) {
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Veiligheid en Techniek
                                                </div>
                                                <ul class="commList commDesc text_color">
                                                    <?php
                                                    foreach ($options_accessories_vT as $option) {
                                                        ?>
                                                        <li><?php echo $option; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        <!--       Audio / Telefonie category      -->
                                        <?php
                                        if (count($options_accessories_aT) > 0) {
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Audio / Telefonie
                                                </div>
                                                <ul class="commList commDesc text_color">
                                                    <?php
                                                    foreach ($options_accessories_aT as $option) {
                                                        ?>
                                                        <li><?php echo $option; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        <!--       Interieur en Comfort      -->
                                        <?php
                                        if (count($options_accessories_iC) > 0) {
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Interieur en Comfort
                                                </div>
                                                <ul class="commList commDesc text_color">
                                                    <?php
                                                    foreach ($options_accessories_iC as $option) {
                                                        ?>
                                                        <li><?php echo $option; ?></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>

                                            <?php
                                        }
                                        ?>

                                        <?php
                                        $category = "";
                                        foreach($ocassions_obj->get_details_total_attr($ocassion) as $key => $options){

                                        foreach($options as $key => $option)
                                        {
                                            if($key != "algemeen"){
                                                if($key != $category){
                                                    $category = $key;
                                                    ?>

                                                    </div>
                                                        <div class="optionWrapper">       

                                                    <hr class="lineAll">

                                                    <div class="titleOptieAcc commTitleBlue">
                                                        <?php
                                                        $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                                        $count = 0;
                                                        foreach($spited_title as $title){
                                                            if($count == 0){
                                                                if($title == "geschiedenis"){
                                                                    echo "Geschiedenis van deze auto";
                                                                }else{
                                                                    echo ucfirst(strtolower($title))." ";
                                                                }
                                                            }else{
                                                                echo ucfirst(strtolower($title))." ";
                                                            }

                                                            $count++;
                                                        }

                                                        ?>
                                                    </div>


                                                    <?php
                                                }
                                                foreach($option as $type =>  $car_option)
                                                {

                                                    if($category == "garanties"){
                                                        ?>
                                                        <span class="optionsWrap"> <span class="leftDescSpan"><?php echo ucfirst(strtolower($car_option)); ?> </span></span>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <span class="optionsWrap"> <span class="leftDescSpan"><?php echo ucfirst(strtolower($type)); ?>: </span> <span class="rightDescSpan"><?php echo ucfirst(strtolower($car_option)); ?></span></span>
                                                        <?php
                                                    }

                                                }


                                            }


                                        }

                                        }

                                        ?>
                                </div>
                                </div>
                            </div>

                            <?php
                            if (count($ocassion->algemeen->videoUrls) > 0){
                                $video_link = explode('/',$ocassion->algemeen->videoUrls[0]);
                                $video_link = end($video_link);
                                $video_link = explode('=',$video_link);
                                $video_link = end($video_link);
                                if(strrpos($ocassion->algemeen->videoUrls[0], 'http')){
                                    $full_link = str_replace('http','https', $ocassion->algemeen->videoUrls[0]);
                                }else{
                                    $full_link = $ocassion->algemeen->videoUrls[0];
                                }
                                
                               

                                if(strpos($ocassion->algemeen->videoUrls[0], 'youtube') !== false){
                                        ?>
                                        <div id="tab3" class="tab">
                                            <iframe width="560" height="315"
                                            src="https://www.youtube.com/embed/<?php echo $video_link; ?>" frameborder="0"
                                            allowfullscreen></iframe>
                                            </div>
                                        <?php
                                }else{
                                        ?>
                                        <div id="tab3" class="tab">
                                            <iframe width="560" height="315"
                                            src="<?php echo $full_link; ?>" frameborder="0"
                                            allowfullscreen></iframe>
                                         </div>
                                        <?php
                                }

                              
                            }
                            ?>

                            <?php $at_iframe = get_option('at_iframe'); ?>
                            <?php if($at_iframe != ""): ?>
                                <?php
                                  $at_iframe = str_replace('{prijs}',$ocassion->prijs->totaal, $at_iframe);
                                $at_iframe = str_replace('{bouwjaar}',$ocassion->geschiedenis->bouwjaar, $at_iframe);
                                $at_iframe = str_replace('{voertuig}',substr($ocassion->algemeen->voertuigsoort, 0, 1), $at_iframe);
                                ?>
                                <div id="tab4" class="tab">
                                    <div class="iframeWraper">
                                    <div class="iframe_title">Financiering</div>
                                        <?=$at_iframe?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($garanties)): ?>
                              <!-- Garanties -->
                                <div id="tab5" class="tab">
                                    <div class="optieAccItem">
                                        <div class="titleOptieAcc commTitleBlue">
                                            Garanties en zekerheden
                                        </div>
                                        <ul class="commList commDesc text_color">
                                         <?php foreach ($garanties as $key => $value):?>
                                            <li><?=$key?></li>
                                            <p> - <?=$value?></p>
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
<?php echo $ocassions_obj->get_car_name($ocassion); ?> 

Wilt u contact met mij opnemen?
Met vriendelijke groet,
    </div>
    <?php
    $sidebar_blocks = get_option('at_sidebar_blocks');
    $sidebar_blocks = json_decode($sidebar_blocks);
    $sidebar_blocks = at_object_to_array($sidebar_blocks);
    ?>

    <?php foreach ($sidebar_blocks as $block): ?>
        <?php
        if ($block['name'] == "Contactformulier" && $block['state'] == "1") {
            $at_form_short_code = get_option('at_form_short_code');
            if(isset($_SESSION['thx_text'])){
                $text = get_option("at_thank_you_text");
                echo $text;
                unset($_SESSION['thx_text']);
            }else{
                ?>
                <!--======================== Contact form  block =========================-->
                <div class="titleSidebarDetail">
                    Neem contact met ons op
                </div>
               <?php  
                    if($at_form_short_code != ""){
                         echo do_shortcode($at_form_short_code);
                     }else{
                        include ('contact_form.php');
                    }
                                               
                 ?>
                <!--======================== End contact form block =========================-->
                <?php
            }
            ?>
            <?php
        } elseif ($block['name'] == "Social Media Informatie" && $block['state'] == "1") {
            ?>

            <!--======================== Social media  block =========================-->
            <hr class="lineAll">
            <div class="socialMedia">
            <p>
                <label for="" class="bigLabel">Deel deze tweedehands auto</label>
            </p>
            <?php
            $socials = get_option('at_social_icons');
            $socials = json_decode($socials);

            ?>
            
            <p>
                <?php
                foreach($socials as $item):
                    if($item->active == "1"){
                        if($item->name == "Facebook"){
                            $site_url = get_site_url();
                            $page_slug = get_option("at_url_page_adverts");
                            $url_param = $_SERVER['REQUEST_URI'];
                            $url_param = explode('/',$url_param);
                            $occasion_id = (int)$url_param[3];
                            ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/fbIcon.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Linkedin"){
                            ?>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>&title=<?php echo $ocassions_obj->get_car_name($ocassion); ?>&summary=&source=<?php echo $site_url; ?>" target="_blank">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/linkedin.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Twitter"){
                            ?>
                            <a href="https://twitter.com/home?status=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/twitter.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Google Plus"){
                            ?>
                            <a href="https://plus.google.com/share?url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/gplus.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Pinterest"){
                            ?>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>&media=<?php echo $images[0]; ?>&description=<?php $ocassion->mededelingen ?>" target="_blank">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/pinterest.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Mail"){
                            ?>
                            <a href="#">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/mail.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Instagram"){
                            ?>
                            <a href="#">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/instagram-icon.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="#">
                                <img src="<?php if($item->icon_url){ echo $item->icon_url; }else{ echo plugins_url('img/gplus.png',__FILE__); } ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }
                        ?>

                        <?php
                    }
                endforeach;
                ?>
            </p>
            </div>

            <!--======================== End social media  block =========================-->

            <?php
         }elseif($block['name'] == "Contactinformatie" && $block['state'] == "1"){
                                $get_from = get_option("at_addres_info");
                               
                                ?>
                                <!--======================== Contact info block =========================-->
                                        <div class="contactInfo">
                                            <hr class="lineAll">
                                            <?php
                                            if($get_from == "from_text_area"){
                                                $contact_info = get_option('at_contact_info');
                                                echo $contact_info;
                                            }else{
                                                echo $ocassions_obj->get_addres_info($ocassion);
                                            }

                                            ?>
                                        </div>

                                <!--======================== End contact info block =========================-->
                                <?php
        } elseif ($block['name'] == "Openingstijden" && $block['state'] == "1") {
            ?>
            <hr class="lineAll">
            <p>
                <label for="" class="bigLabel">Openingstijden</label>
            </p>
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
                <?php foreach($shedule_days as $day): ?>
                    <?php
                        if(isset($day->time1)){
                         ?>
                            <tr>
                                <td><strong><?=$day->day ?></strong></td>
                                <td><?=$day->time1->from ?> – <?=$day->time1->to ?></td>
                            </tr>
                        <?php
                        }
                    ?>

                    <?php
                    if(isset($day->time2)){
                        ?>
                        <tr>
                            <td><strong></strong></td>
                            <td><?=$day->time2->from ?> – <?=$day->time2->to ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php
        }
        ?>
    <?php endforeach; ?>
<?php
if (  is_active_sidebar( 'at_sidebar' ) ) {
    dynamic_sidebar( 'at_sidebar' );
}
?>
</div>

</div>
<!-- end sidebar -->
</div>
</div>


</div>


