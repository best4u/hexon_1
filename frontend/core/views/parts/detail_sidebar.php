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