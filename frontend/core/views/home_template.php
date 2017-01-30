
<div class="carsContentLeft fghdgfhdgfhdgfh">

    <?php
    $occasions_page_url = get_option("at_url_page_adverts");
    foreach($all_occasions->items as $occasion){
        ?>

        <div class="caritemB4u">
            <a href="/<?php echo $occasions_page_url; ?>?overview=<?php echo $occasion->advertentieId ?>">
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
                                foreach($ocassions_obj->get_home_overview_attr($occasion) as $key => $option)
                                {
                                    foreach($option as $type =>  $car_option)
                                    {
                                        ?>
                                        <p> <span class="leftType atribute_label_color"><?php echo $type; ?>: </span> <span class="rightOption atribute_value_color"><?php echo $car_option; ?></span></p>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <a href="/<?php echo $occasions_page_url; ?>?overview=<?php echo $occasion->advertentieId ?>" class="button_at1 button_color">
                            bekijk deze auto
                        </a>
                    </div>
                </div>
            </a>
        </div>

        <?php
    }
    ?>

</div>
