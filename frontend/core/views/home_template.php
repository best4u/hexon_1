
    <?php
    $occasions_page_url = get_option("at_url_page_adverts");
    $button_name = get_option("at_name_of_button_on_home");
    foreach($all_occasions->items as $occasion){
        ?>

        <div class="caritemB4u">
            <a href="/<?php echo $occasions_page_url; ?>/<?php echo $ocassions_obj->get_car_slug($occasion); ?>/<?php echo $occasion->advertentieId ?>">
                <div class="imgBlock">
                    <div class="imgTable">
                        <div class="imgTableCell">
                             <img src="<?php if($ocassions_obj->get_image_link($occasion)){ echo $ocassions_obj->get_image_link($occasion); }else{ echo "https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png"; }   ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="carTxtBlock">
                    <div class="titlecarItem header_color">
                        <?php echo $ocassions_obj->get_car_name($occasion); ?>
                    </div>
                    <div class="descCarItem">
                        <div class="priceandLogo">

                        </div>

                        <div class="carOverallDetails">
                            <div class="leftPartDetail">
                                <?php
                                foreach($ocassions_obj->get_home_overview_attr($occasion) as $key => $options)
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

                        <a href="/<?php echo $occasions_page_url; ?>/<?php echo $ocassions_obj->get_car_slug($occasion); ?>/<?php echo $occasion->advertentieId ?>" class="button_at1 button_color button">
                            <?php if($button_name != ""){ echo $button_name; }else{ echo "Bekijk deze auto"; } ?>
                        </a>
                    </div>
                </div>
            </a>
        </div>

        <?php
    }
    ?>

