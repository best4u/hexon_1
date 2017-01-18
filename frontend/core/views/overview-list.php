<?php
//
//echo "<pre>";
//var_dump($all_occasions);
//echo "</pre>";
//?>
<div class="overview_gridWrapp">
    <div class="breadCrumbWrapp">
        <div class="centerDiv">
            <div class="breadContent">
                <a href="#"><span>Home</span></a> <span class="arrowBread"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <a href="#"><span class="activeBread">Occasions</span></a>
            </div>
        </div>
    </div>

    <div class="leftAndRightWrapp">
        <div class="centerDiv">
            <div class="leftContent_at">
                <div class="titleAndSelect">
                    <div class="titleLeftPart">
                        <h1>Occasions</h1>
                    </div>

                    <div class="selectorB4uAuto">
                        <form action="">
                            <select name="name" id="#" class="selectCustom">
                                <option value="volvo">Sorteren op...</option>
                                <option value="saab">Saab</option>
                                <option value="mercedes">Mercedes</option>
                                <option value="audi">Audi</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="carsContentLeft listType">
                    <?php
                        foreach($all_occasions->items as $occasion){
                           ?>

                            <div class="caritemB4uList">
                                <a href="#">
                                    <div class="imgBlock">
                                        <div class="imgTable">
                                            <div class="imgTableCell">
                                                <img src="<?php echo $ocassions_obj->get_image_link($occasion); ?>" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="carTxtBlock">
                                        <div class="titlecarItem">
                                            <?php echo $ocassions_obj->get_car_name($occasion); ?>
                                        </div>
                                        <div class="descCarItem">
                                            <div class="priceCarItem">
                                                € <?php echo $ocassions_obj->get_car_price($occasion); ?>
                                            </div>

                                            <div class="carOverallDetails">
                                                <div class="leftPartDetail">
                                                    <?php
                                                    foreach($ocassions_obj->get_home_attr($occasion) as $key => $option)
                                                    {
                                                        foreach($option as $type =>  $car_option)
                                                        {
                                                            ?>
                                                            <p><?php echo $type; ?>:</p>
                                                            <?php
                                                        }

                                                    }
                                                    ?>
                                                </div>
                                                <div class="rightPartDetail">
                                                    <?php
                                                    foreach($ocassions_obj->get_home_attr($occasion) as $key => $option)
                                                    {
                                                        foreach($option as $type =>  $car_option)
                                                        {
                                                            $timestamp = strtotime($car_option);
                                                            if($timestamp){
                                                                ?>
                                                                <p><?php echo date('d/m/Y',strtotime($car_option)); ?></p>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <p><?php echo $car_option ?></p>
                                                                <?php
                                                            }
                                                        }

                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="rightButtonandLogo">
                                                <div class="logoCarItem">
                                                    <img src="<?php echo plugins_url("img/NAP_Logo.jpg",__FILE__) ?>" alt="">
                                                </div>

                                                <a href="?overview=<?php echo $occasion->advertentieId ?>" class="button_at1">
                                                    bekijk deze auto
                                                </a>
                                            </div>


                                        </div>
                                    </div>
                                </a>
                            </div>

                            <?php
                        }
                    ?>


                </div>

                <!-- Start pargination -->
                <div class="bottomNPaginationWrapp">
                    <div class="centerDiv">
                        <ul class="ulPagination">
                            <li class="prevPage"><a href="#"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                            <li class="activePage"><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li class="nextPage"><a href="#">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- end pagination -->


            </div>


            <div class="sidebarContent">
                <div class="titleSidebar h2">
                    Occasion zoeken
                </div>

                <div class="sidebarFilters">
                    <form action="">
                        <p>
                            <label for="a">Merk</label>
                        </p>
                        <select name="name" id="2" class="selectCustom">
                            <option value="volvo">Alle merken</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <p>
                            <label for="b">Model</label>
                        </p>
                        <select name="name" id="2" class="selectCustom">
                            <option value="volvo">Selecteer eerst een merk</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <a href="#" class="button_at1">
                            toon auto's
                        </a>





                        <p>
                            <label for="a">Prijs</label>
                        </p>

                        <p class="priceP">
                            <span class="priceFrom">€ 0,00</span>
                            <span class="priceTo">€ 10.000,00</span>
                        </p>
                        <div class="priceSliderCont commSlideCont">
                            <div id="slider2" class="bouwjaarSlider"></div>
                        </div>






                        <p>
                            <label for="a">Bouwjaar</label>
                        </p>
                        <p class="yearsP">
                            <span class="yearsFrom">2000</span>
                            <span class="yearsTo">2017</span>
                        </p>
                        <div class="yearSliderCont commSlideCont">
                            <div id="slider" class="bouwjaarSlider"></div>
                        </div>





                        <p>
                            <label for="b">Brandstof</label>
                        </p>
                        <select name="name" id="2" class="selectCustom">
                            <option value="volvo">Alle brandstof</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <p>
                            <label for="b">Carrosserie</label>
                        </p>
                        <select name="name" id="2" class="selectCustom">
                            <option value="volvo">Alle brandstof</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <p>
                            <label for="b">Motorinhoud</label>
                        </p>
                        <select name="name" id="2" class="selectCustom">
                            <option value="volvo">Alle brandstof</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>

                        <a href="#" class="button_atAlt">
                            meer zoekopties
                        </a>

                        <a href="#" class="button_at1">
                            toon auto's
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>


