
    <?php
    $occasions_page_url = get_option("at_url_page_adverts");
    $button_name = get_option("at_name_of_button_on_home");

    ?>

    <?php foreach($cars->data as $car): ?>

        <div class="caritemB4u">
            <a href="/<?php echo $occasions_page_url; ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>">
                <div class="imgBlock">
                    <div class="imgTable">
                        <div class="imgTableCell">
                          <img src="<?php if ($car->images->{'image-1'}->thumbs->{'320_'} != '') {
                                    echo $car->images->{'image-1'}->thumbs->{'320_'};
                                    } else {
                                    echo "https://www.autotrack.nl//vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png";
                                    } ?>" 
                            alt="">
                        </div>
                    </div>
                </div>
                <div class="carTxtBlock">
                    <div class="titlecarItem header_color">
                      
                      <?=$car->advertise->title?>
                    </div>
                    <div class="descCarItem">
                        <div class="priceandLogo">

                        </div>

                        <div class="carOverallDetails">
                            <div class="leftPartDetail">
                        <?php foreach($carsService->getHomeOverviewAttr() as $attr): ?>
                                <?php $value = '<?php echo @$car->'.$attr->type.'?>';?>
                                <?php $compare = '<?php return @$car->'.$attr->type.'?>';?>
                                <p>
                                <span class="leftType atribute_label_color"><?=$attr->attribute?>:</span>
                                <span class="rightOption atribute_value_color">

                                    <?php if(eval("?> $compare <?php ")): ?>
                                         <?php eval("?> $value <?php ") ?> <?=$attr->measurement?>
                                    <?php else: ?>
                                         -
                                    <?php endif; ?>
                                                                       
                                </span>
                                </p>

                                <?php endforeach; ?>


                        </div>

                        <a href="/<?php echo $occasions_page_url; ?>/<?php echo $carsService->get_car_slug($car); ?>/<?php echo $car->id ?>" class="button_at1 button_color button">
                            <?php if($button_name != ""){ echo $button_name; }else{ echo "Bekijk deze auto"; } ?>
                        </a>
                    </div>
                </div>
            </a>
        </div>
        </div>

     <?php endforeach; ?>   

