<?php
$text_color = get_option("at_font_color");
$atribute_label_color = get_option("at_attribute_label");
$atribute_value_color = get_option("at_attribute_value");
$header_color = get_option("at_header_color");
$button_color = get_option("at_button_color");
$price_color = get_option("at_price_color");
?>
<style>
    .text_color {
        color: <?php echo $text_color; ?> !important;
    }

    .atribute_label_color {
        color: <?php echo $atribute_label_color; ?> !important;
    }

    .atribute_value_color {
        color: <?php echo $atribute_value_color; ?> !important;
    }

    .header_color {
        color: <?php echo $header_color; ?> !important;
    }

    .button_color {
        background-color: <?php echo $button_color; ?> !important;
    }

    .price_color {
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
            <div class="leftContent_at">
                <div class="detailPage">
                    <div class="carTitleTop header_color">
                        <?php echo $ocassions_obj->get_car_name($ocassion); ?>
                    </div>

                    <div class="sliderAndDesc">
                        <div class="leftSlideBlock">
                            <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true">
                                <?php
                                $images = $ocassions_obj->get_all_images($ocassion);
                                foreach ($images as $foto) {
                                    ?>
                                    <a href="<?php echo $foto ?>"><img src="<?php echo $foto ?>" width="75" height="75"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="rightDescBlock">
                            <div class="priceandLogo">
                                <div class="priceCarItem price_color">
                                    € <?php echo $ocassions_obj->get_car_price($ocassion); ?></div>
                                <div class="logoCarItem">
                                    <img src="<?php echo plugins_url("img/NAP_Logo.jpg", __FILE__) ?>" alt="">
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
                                                <p><span class="leftType atribute_label_color"><?php echo ucfirst(strtolower($type)); ?>:</span> <span class="rightOption atribute_value_color"><?php echo ucfirst(strtolower($car_option)); ?></span></p>
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
                            <?php
                            $category = "";
                            $tab_counter = 3;
                            foreach ($ocassions_obj->get_details_total_attr($ocassion) as $key => $options) {
                                foreach ($options as $key => $option) {
                                    if ($key != $category) {
                                        $category = $key;
                                        ?>
                                        <li><a href="#tab<?php echo $tab_counter; ?>">
                                                <?php
                                                $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                                $count = 0;
                                                foreach ($spited_title as $title) {
                                                    if ($count == 0) {
                                                        if ($title == "geschiedenis") {
                                                            echo "Geschiedenis van deze auto";
                                                        } else {
                                                            echo ucfirst($title) . " ";
                                                        }
                                                    } else {
                                                        echo strtolower($title) . " ";
                                                    }

                                                    $count++;
                                                }

                                                ?>
                                            </a></li>
                                        <?php
                                        $tab_counter++;
                                    }
                                }
                            }
                            ?>
                            <?php
                            if (count($ocassion->algemeen->videoUrls) > 0) {
                                ?>
                                <li><a href="#tab123456789">Video</a></li>
                                <?php
                            }

                            ?>

                        </ul>

                        <div class="tab-content">

                            <div id="tab1" class="tab active">
                                <div class="omschriving">
                                    <div class="titleOms commTitle26">
                                        Omschrijving
                                    </div>
                                    <div class="descOms commDesc text_color">
                                        <p>
                                            <?php
//                                            echo str_replace(".", ".<br>", $ocassion->mededelingen);
                                            $description = explode("\.", $ocassion->mededelingen);
                                            foreach($description as $line){
                                            $line_explode = explode("*",$line);
                                            if($line_explode > 1){
                                                ?>
                                                    <p><?php echo $line_explode[0] ?></p>
                                                    <ul>
                                                <?php
                                                for($i=1;$i < count($line_explode);$i++){
                                                    ?>
                                                        <li><?php echo $line_explode[$i]; ?></li>
                                                    <?php
                                                }
                                                ?>
                                                    </ul>
                                               <?php
                                            }else{
                                                   ?>
                                                   <p><?php echo $line; ?></p>
                                                   <?php

                                               }


                                            }

                                            ?>
                                            <pre>
                                            <?php

                                            ?>
                                        </pre>
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
                                                    Veiligheid
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

                                    </div>
                                </div>

                            </div>

                            <div id="tab1000000000" class="tab">
                                <div class="omschriving">
                                    <div class="titleOms commTitle26">

                                    </div>
                                    <div class="descOms commDesc text_color">
                                        <p>

                                        </p>

                                        <?php
                                        $category = "";
                                        $tab_counter = 3;
                                        foreach ($ocassions_obj->get_details_total_attr($ocassion) as $key => $options){
                                        foreach ($options as $key => $option){

                                        if ($key != $category){
                                        $category = $key;
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="tab<?php echo $tab_counter; ?>" class="tab">
                                <div class="garantiePart">
                                    <div class="titleOms commTitle26">
                                        <?php
                                        $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                        $count = 0;
                                        foreach ($spited_title as $title) {
                                            if ($count == 0) {
                                                if ($title == "geschiedenis") {
                                                    echo "Geschiedenis van deze auto";
                                                } else {
                                                    echo ucfirst(strtolower($title)) . " ";
                                                }
                                            } else {
                                                echo ucfirst(strtolower($title)) . " ";
                                            }

                                            $count++;
                                        }

                                        ?>
                                    </div>
                                    <div class="descOms commDesc text_color">
                                        <ul class="commList commDesc text_color">
                                            <?php
                                            $tab_counter++;

                                            }
                                            foreach ($option as $type => $car_option) {
                                                ?>
                                                <li><span class="leftDescSpan"><?php echo $type; ?>: </span> <span
                                                            class="rightDescSpan"><?php echo $car_option; ?></span></li>
                                                <?php
                                            }
                                            ?>

                                            <?php
                                            }
                                            }
                                            ?>
                                            <?php
                                            if (count($ocassion->algemeen->videoUrls) > 0){
                                            ?>
                                            </ul>
                                            </div>
                                            </div>
                                            </div>
                                        <div id="tab123456789" class="tab">
                                            <div class="omschriving">
                                                <div class="titleOms commTitle26">

                                                </div>
                                                <div class="descOms commDesc text_color">
                                                    <iframe width="560" height="315"
                                                            src="<?php echo $ocassion->algemeen->videoUrls[0] ?>" frameborder="0"
                                                            allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>

                            <?php
                            }else{
                                ?>
                        </div>
                    </div>
                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

<!-- tabs section -->

<!-- end -->


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
    $sidebar_blocks = object_to_array($sidebar_blocks);
    ?>

    <?php foreach ($sidebar_blocks as $block): ?>
        <?php
        if ($block['name'] == "Contactformulier" && $block['state'] == "1") {
            $at_form_short_code = get_option('at_form_short_code');
            ?>

            <!--======================== Contact form  block =========================-->
            <div class="titleSidebarDetail">
                Neem contact met ons op
            </div>
            <?php echo do_shortcode($at_form_short_code); ?>
            <!--======================== End contact form block =========================-->


            <?php
        } elseif ($block['name'] == "Social Media Informatie" && $block['state'] == "1") {
            ?>

            <!--======================== Social media  block =========================-->
            <hr class="lineAll">

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
                            $occasion_id = $_GET['overview'];
                            ?>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Linkedin"){
                            ?>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>&title=<?php echo $ocassions_obj->get_car_name($ocassion); ?>&summary=&source=<?php echo $site_url; ?>" target="_blank">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Twitter"){
                            ?>
                            <a href="https://twitter.com/home?status=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Google Plus"){
                            ?>
                            <a href="https://plus.google.com/share?url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>" target="_blank">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }elseif($item->name == "Pinterest"){
                            ?>
                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $site_url; ?>/<?=$page_slug?>/?overview=<?=$occasion_id?>&media=<?php echo $images[0]; ?>&description=<?php $ocassion->mededelingen ?>" target="_blank">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }else{
                            ?>
                            <a href="#">
                                <img src="<?=$item->icon_url ?>" alt="<?=$item->alt ?>">
                            </a>
                            <?php
                        }
                        ?>

                        <?php
                    }
                endforeach;
                ?>
            </p>

            <!--======================== End social media  block =========================-->

            <?php
        } elseif ($block['name'] == "Contactinformatie" && $block['state'] == "1") {
            ?>
            <!--======================== Contact info block =========================-->

            <div class="contactInfo">
                <hr class="lineAll">
                <?php
                $contact_info = get_option('at_contact_info');
                echo $contact_info;
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
                    <tr>
                        <td><strong><?=$day->day ?></strong></td>
                        <td><?=$day->time1->from ?> – <?=$day->time1->to ?></td>
                    </tr>
                    <?php
                    if(isset($day->time2)){
                        ?>
                        <tr>
                            <td><strong></strong></td>
                            <td><?php echo $day->time2->from." - ".$day->time2->to; ?></td>
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

</div>

</div>
<!-- end sidebar -->
</div>
</div>


</div>

