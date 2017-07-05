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

                <?php if ($ocassion): ?>

                    <div class="detailPage">
                        <div class="detailPageTop">
                            <h1 class="carTitleTop header_color">
                                <?php echo $ocassions_obj->get_car_name($ocassion); ?>
                            </h1>
                            <?php
                            $at_go_back_status = get_option('at_go_back_status');
                            $at_go_back_text = get_option('at_go_back_text');
                            ?>

                            <?php if ($at_go_back_status == '1'): ?>
                                <a href="#" class="atGoBackButton atGoBackButtonTop"><?= $at_go_back_text ?></a>
                            <?php endif; ?>

                            <div class="b4uPrintButton" title="Print Pagina">
                                <i class="fa fa-print"></i>
                            </div>
                        </div>
                        <!-- /.detailPageTop -->

                        <div class="sliderAndDesc">
                            <div class="leftSlideBlock">
                                <div class="fotorama" data-nav="thumbs" data-allowfullscreen="true" data-width="452" data-height="301">
                                    <?php $images = $ocassions_obj->get_small_images($ocassion); ?>
                                    <?php if ($images) : ?>
                                        <?php foreach ($images as $key => $foto) : ?>
                                            <a href="<?php echo $foto ?>">
                                                <img src="<?php echo $key ?>">
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
                                        € <?php echo $ocassions_obj->get_car_price($ocassion); ?>
                                        <span class="btw_val">
                                        <?php echo $ocassions_obj->get_btw($ocassion); ?>
                                    </span>
                                    </div>

                                    <div class="subprice">
                                        Rijklaarmaakkosten <?php echo $ocassions_obj->get_apkBijAflevering($ocassion); ?>
                                    </div>

                                    <div class="logoCarItem">
                                    <?php if($ocassions_obj->get_nap_logo($ocassion)): ?>
                                        <img src="<?php echo plugins_url("img/NAP_Logo.jpg", __FILE__) ?>" alt="">
                                    <?php endif ;?>
                                    </div>
                                </div>
                                <!-- /.priceandLogo -->

                                <div class="detailDesc">
                                    <div class="leftDetailDesc">
                                        <?php foreach ($ocassions_obj->get_sumary_detail_attr($ocassion) as $key => $options) :
                                            foreach ($options as $key => $option) :
                                                foreach ($option as $type => $car_option) : ?>
                                                    <span class="optionsWrap">
                                                    <span class="leftType atribute_label_color">
                                                        <?php echo ucfirst(strtolower($type)); ?>:
                                                    </span>
                                                    <span class="rightOption atribute_value_color">
                                                        <?php echo $car_option; ?>
                                                    </span>
                                                </span>
                                                <?php endforeach; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <!-- /.detailDesc -->
                            </div>
                        </div>
                        <!-- /.sliderAndDesc -->

                        <div class="omschriving">
                            <div class="titleOms commTitle26">Omschrijving</div>

                            <?php require_once('markdown_extended.php'); ?>
                            <?php $html = MarkdownExtended($description_text); ?>

                            <div class="descOms commDesc text_color">

                                <?php if (count($ocassion->algemeen->videoUrls) > 0) : ?>

                                    <?php
                                    $video_link = explode('/', $ocassion->algemeen->videoUrls[0]);
                                    $video_link = end($video_link);
                                    $video_link = explode('=', $video_link);
                                    $video_link = end($video_link);
                                    $full_link = str_replace('http', 'https', $ocassion->algemeen->videoUrls[0]);
                                    ?>

                                    <?php if (strpos($ocassion->algemeen->videoUrls[0], 'youtube') !== false) : ?>
                                        <div class="video-wrapper">
                                            <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/<?php echo $video_link; ?>"
                                                    frameborder="0"
                                                    allowfullscreen></iframe>
                                        </div>
                                    <?php else: ?>
                                        <div>
                                            <iframe width="560" height="315"
                                                    src="<?php echo $full_link; ?>" frameborder="0"
                                                    allowfullscreen></iframe>
                                        </div>
                                    <?php endif; // (strpos($ocassion->algemeen->videoUrls[0], 'youtube') !== false) ?>
                                <?php endif; // (count($ocassion->algemeen->videoUrls) > 0) ?>

                                <div class="extendedDescription"><?php echo $html ?></div>

                            </div>
                            <!-- /.descOms.commDesc -->
                        </div>
                        <!-- /.omschriving -->

                        <?php
                        $options_accessories = $ocassions_obj->get_car_safety_attr("188c3d8d-cbb6-4916-ab1b-32796e618c5c", $ocassion);
                        $options_accessories_ext = $ocassions_obj->get_car_safety_attr("4121e7b2-af4c-432b-97de-9bec8b97e31a", $ocassion);
                        $options_accessories_vT = $ocassions_obj->get_car_safety_attr("f9eb02f8-8f59-4272-99d4-eeacb98e1d92", $ocassion);
                        $options_accessories_aT = $ocassions_obj->get_car_safety_attr("a826980c-9064-4e33-800a-7ace75e182ae", $ocassion);
                        $options_accessories_iC = $ocassions_obj->get_car_safety_attr("de6c3b5f-4abf-4c70-afb1-1642953fa2e6", $ocassion);
                        ?>

                        <?php
                        if (count($options_accessories) != 0 || count($options_accessories_ext) != 0 ||
                            count($options_accessories_vT) != 0 || count($options_accessories_aT) != 0 ||
                            count($options_accessories_iC) != 0
                        ) :
                            ?>
                            <hr class="lineAll">

                            <div class="optionsAccesories">
                                <h3 class="carDetailTitle optAccTitle">
                                    Opties en Accessoires
                                </h3>

                                <?php //endif; # ???
                                ?>

                                <div class="descOptAcc">

                                    <?php #Veiligheid category
                                    ?>
                                    <?php if (count($options_accessories) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Verlichting</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach ($options_accessories as $option) : ?>
                                                    <li><?php echo $option; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories) > 0)
                                    ?>

                                    <?php #Exterieur category
                                    ?>
                                    <?php if (count($options_accessories_ext) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Exterieur</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach ($options_accessories_ext as $option) : ?>
                                                    <li><?php echo $option; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories_ext) > 0)
                                    ?>

                                    <?php # Veiligheid en Techniek category
                                    ?>
                                    <?php if (count($options_accessories_vT) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Veiligheid en Techniek</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach ($options_accessories_vT as $option) : ?>
                                                    <li><?php echo $option; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories_vT) > 0)
                                    ?>

                                    <?php # Audio / Telefonie category
                                    ?>
                                    <?php if (count($options_accessories_aT) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Audio / Telefonie</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach ($options_accessories_aT as $option) : ?>
                                                    <li><?php echo $option; ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; // (count($options_accessories_aT) > 0)
                                    ?>

                                    <?php #Interieur en Comfort
                                    ?>
                                    <?php if (count($options_accessories_iC) > 0) : ?>
                                        <div class="optieAccItem">
                                            <h4 class="carDetailSubtitle">Interieur en Comfort</h4>
                                            <ul class="commList commDesc text_color">
                                                <?php foreach ($options_accessories_iC as $option) : ?>
                                                    <li><?php echo $option; ?></li>
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
                                        <?php
                                        $category = "";
                                        foreach ($ocassions_obj->get_details_total_attr($ocassion) as $key => $options) :
                                            foreach ($options as $key => $option) :
                                                if ($key != $category) :
                                                $category = $key;
                                        ?>
                                    </div>
                                </div>

                                <hr class="lineAll">
                            </div>
                            <!-- /.descSpecificaties -->

                            <div class="descSpecificaties">
                                <h4 class="carDetailSubtitle">
                                    <?php
                                    $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                    $count = 0;
                                    ?>

                                    <?php foreach ($spited_title as $title) : ?>
                                        <?php if ($count == 0) : ?>
                                            <?php echo ($title == "geschiedenis") ? "Geschiedenis van deze auto" : (ucfirst(strtolower($title)) . " "); ?>
                                        <?php else: ?>
                                            <?php echo ucfirst(strtolower($title)) . " "; ?>
                                        <?php endif; ?>
                                        <?php $count++; endforeach; ?>
                                </h4>

                                <div class="descAlgemen commDesc text_color">
                                    <div class="commLeftSpecific between">

                                        <?php endif; ?>
                                        <?php foreach ($option as $type => $car_option) : ?>
                                            <?php if ($category == "garanties") : ?>
                                                <span class="optionsWrap">
                                                <span class="leftDescSpan">
                                                    <?php echo ucfirst(strtolower($car_option)); ?>
                                                </span>
                                            </span>
                                            <?php else: ?>
                                                <span class="optionsWrap">
                                                <span class="leftDescSpan"><?php echo ucfirst(strtolower($type)); ?>
                                                    :
                                                </span>
                                                <span class="rightDescSpan">
                                                    <?php echo ucfirst(strtolower($car_option)); ?>
                                                </span>
                                            </span>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- /.commLeftSpecific -->

                                    <hr class="lineAll">

                                </div>
                                <!-- /.descAlgemen -->
                            </div>
                            <!-- /.descSpecificaties -->

                            <?php $garanties = $ocassions_obj->get_garanties($ocassion); ?>
                            <?php if(!empty($garanties)): ?>
                              <!-- Garanties -->
                            <div class="descSpecificaties">
                                <h4 class="carDetailSubtitle">
                                    Garanties en zekerheden
                                </h4>

                                <div class="descAlgemen commDesc text_color">
                                    <div class="commLeftSpecific between">
                                    <?php foreach ($garanties as $key => $value):?>
                                            <span class="optionsWrap">
                                                <span class="leftDescSpan">
                                                    <b><?=$key?></b>
                                                    <p> - <?=$value?></p>
                                                </span>
                                                <span class="rightDescSpan">
                                                </span>
                                            </span>

                                    <?php endforeach; ?>
                                           
                                    </div>
                                    <!-- /.commLeftSpecific -->

                                    <hr class="lineAll">

                                </div>
                                <!-- /.descAlgemen -->
                            </div>
                            <!-- /.descSpecificaties -->

                            <?php endif; ?>

                            <?php
                            $at_go_back_status = get_option('at_go_back_status');
                            $at_go_back_text = get_option('at_go_back_text');
                            ?>
                            <?php if ($at_go_back_status == '1'): ?>
                                <a href="#" class="atGoBackButton atGoBackButtonBottom"><?= $at_go_back_text ?></a>
                            <?php endif; ?>
                            <!-- Iframe start -->
                            <?php $at_iframe = get_option('at_iframe'); ?>
                            <?php if($at_iframe != ""): ?>
                            <div class="iframeWraper">
                            <div class="iframe_title">Financiering</div>
                                <?=$at_iframe?>
                            </div>
                            <?php endif; ?>
                            <!-- Iframe end -->
                        </div>
                        <!-- /.specificatiesBlock -->
                    </div>

                <?php else: ?>
                    <p style="text-align: center;">Er is geen occasion gevonden.</p>
                <?php endif; ?>
            </div>

            <?php # sidebar ?>
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
                                                '&title=' . $ocassions_obj->get_car_name($ocassion) .
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
                                            <a href="https://pinterest.com/pin/create/button/?url=<?php echo $site_url; ?>/<?= $page_slug ?>/?overview=<?= $occasion_id ?>&media=<?php echo $images[0]; ?>&description=<?php $ocassion->mededelingen ?>"
                                               target="_blank">
                                                <img src="<?php echo ($item->icon_url) ? $item->icon_url : plugins_url('img/pinterest.png', __FILE__); ?>"
                                                     alt="<?= $item->alt ?>">
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
                                                } ?>" alt="<?= $item->alt ?>">
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
                            <?php echo ($get_from == "from_text_area") ? get_option('at_contact_info') : $ocassions_obj->get_addres_info($ocassion); ?>
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
            <?php #end sidebar ?>

        </div>
        <?php # end .centerDiv ?>
    </div>
</div>

