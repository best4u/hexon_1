
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<div class="overview_gridWrapp">
    <div class="breadCrumbWrapp">
        <div class="centerDiv">
            <div class="breadContent">
                <a href="#"><span>Home</span></a> <span class="arrowBread"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <a href="#"><span class="activeBread">Occasions</span></a> <span class="rightBCSpan">Terug naar het overzicht • <a href="#">Print deze pagina</a></span>
            </div>
        </div>
    </div>

    <div class="leftAndRightWrapp singleItemWrapp">
        <div class="centerDiv">
            <div class="leftContent_at">
                <div class="detailPage">
                    <div class="carTitleTop">
                        <?php echo $ocassions_obj->get_car_name($ocassion); ?>
                    </div>

                    <div class="sliderAndDesc">
                        <div class="leftSlideBlock">
                            <div class="fotorama"  data-nav="thumbs" data-allowfullscreen="true">
                                <?php
                                foreach($ocassions_obj->get_all_images($ocassion) as $foto){
                                    ?>
                                    <a href="<?php echo $foto?>"><img src="<?php echo $foto?>" width="75" height="75"></a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                        <div class="rightDescBlock">
                            <div class="priceandLogo">
                                <div class="priceCarItem">€ <?php echo $ocassions_obj->get_car_price($ocassion); ?></div>
                                <div class="logoCarItem">
                                    <img src="<?php echo plugins_url("img/NAP_Logo.jpg",__FILE__) ?>" alt="">
                                </div>
                            </div>

                            <div class="detailDesc">
                                <div class="leftDetailDesc">
                                    <?php

                                    foreach($ocassions_obj->get_sumary_detail_attr($ocassion) as $key => $option)
                                    {
                                        foreach($option as $type =>  $car_option)
                                        {
                                            ?>
                                            <p><span class="leftType"><?php echo $type; ?>: </span> <span class="rightOption"><?php echo $car_option; ?></span></p>
                                            <?php
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
                            foreach($ocassions_obj->get_details_total_attr($ocassion) as $key => $options){
                                foreach($options as $key => $option){
                                    if($key != $category){
                                        $category = $key;
                                        ?>
                                        <li><a href="#tab<?php echo $tab_counter; ?>">
                                                <?php
                                                $spited_title = preg_split('/(?<=\\w)(?=[A-Z])/', $category);
                                                $count = 0;
                                                foreach($spited_title as $title){
                                                    if($count == 0){
                                                        if($title == "geschiedenis"){
                                                            echo "Geschiedenis van deze auto";
                                                        }else{
                                                            echo ucfirst($title)." ";
                                                        }
                                                    }else{
                                                        echo strtolower($title)." ";
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

                        </ul>


                        <div class="tab-content">

                            <div id="tab1" class="tab active">
                                <div class="omschriving">
                                    <div class="titleOms commTitle26">
                                        Omschrijving
                                    </div>
                                    <div class="descOms commDesc">
                                        <p>
                                            <?php
                                            echo str_replace(".",".<br>",$ocassion->mededelingen);
                                            $description = explode(".",$ocassion->mededelingen);
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div id="tab2" class="tab">
                                <div class="optionsAccesories">
                                    <div class="optAccTitle commTitle26">
                                        Opties en Accessoires
                                    </div>

                                    <div class="descOptAcc">

                                        <!--    Veiligheid category-->
                                        <?php
                                        $options_accessories = $ocassions_obj->get_car_safety_attr("188c3d8d-cbb6-4916-ab1b-32796e618c5c",$ocassion);
                                        if(count($options_accessories) > 0){
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Veiligheid
                                                </div>
                                                <ul class="commList commDesc">
                                                    <?php
                                                    foreach($options_accessories as $option){
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
                                        <?php
                                        $options_accessories = $ocassions_obj->get_car_safety_attr("4121e7b2-af4c-432b-97de-9bec8b97e31a",$ocassion);
                                        if(count($options_accessories) > 0){
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Exterieur
                                                </div>
                                                <ul class="commList commDesc">
                                                    <?php
                                                    foreach($options_accessories as $option){
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
                                        $options_accessories = $ocassions_obj->get_car_safety_attr("f9eb02f8-8f59-4272-99d4-eeacb98e1d92",$ocassion);
                                        if(count($options_accessories) > 0){
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Veiligheid en Techniek
                                                </div>
                                                <ul class="commList commDesc">
                                                    <?php
                                                    foreach($options_accessories as $option){
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
                                        $options_accessories = $ocassions_obj->get_car_safety_attr("a826980c-9064-4e33-800a-7ace75e182ae",$ocassion);
                                        if(count($options_accessories) > 0){
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Audio / Telefonie
                                                </div>
                                                <ul class="commList commDesc">
                                                    <?php
                                                    foreach($options_accessories as $option){
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
                                        $options_accessories = $ocassions_obj->get_car_safety_attr("de6c3b5f-4abf-4c70-afb1-1642953fa2e6",$ocassion);
                                        if(count($options_accessories) > 0){
                                            ?>
                                            <div class="optieAccItem">
                                                <div class="titleOptieAcc commTitleBlue">
                                                    Interieur en Comfort
                                                </div>
                                                <ul class="commList commDesc">
                                                    <?php
                                                    foreach($options_accessories as $option){
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

                            <div id="tab1000000000" class="tab active">
                                <div class="omschriving">
                                    <div class="titleOms commTitle26">

                                    </div>
                                    <div class="descOms commDesc">
                                        <p>

                                        </p>


                            <?php
                            $category = "";
                            $tab_counter = 3;
                            foreach($ocassions_obj->get_details_total_attr($ocassion) as $key => $options){
                                foreach($options as $key => $option){

                                    if($key != $category){
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
                                                       foreach($spited_title as $title){
                                                           if($count == 0){
                                                               if($title == "geschiedenis"){
                                                                   echo "Geschiedenis van deze auto";
                                                               }else{
                                                                   echo ucfirst($title)." ";
                                                               }
                                                           }else{
                                                               echo strtolower($title)." ";
                                                           }

                                                           $count++;
                                                       }

                                                       ?>
                                                    </div>
                                                    <div class="descOms commDesc">
                                                        <ul class="commList commDesc">
                                        <?php
                                        $tab_counter++;

                                    }
                                    foreach($option as $type =>  $car_option)
                                    {
                                        ?>
                                        <li> <span class="leftDescSpan"><?php echo $type; ?>: </span> <span class="rightDescSpan"><?php echo $car_option; ?></span></li>
                                        <?php
                                    }
                                        ?>

                                       <?php
                                }
                            }
                            ?>

                        </div>
                        </div>
                </div>
            </div>
                        </div>
                    </div>
                    </div>



            <!-- tabs section -->

            <!-- end -->




            <!-- sidebar -->
            <div class="sidebarContent">
                <div class="titleSidebarDetail">
                    Neem contact met ons op
                </div>

                <div class="sidebarFilters">
                    <form action="" class="sidebarForm">
                        <p>
                            <label for="">Uw naam</label>
                        </p>
                        <p>
                            <input type="text" placeholder="John Doe">
                        </p>

                        <p>
                            <label for="">E-mailadres</label>
                        </p>
                        <p>
                            <input type="email" placeholder="johndoe@gmail.com">
                        </p>

                        <p>

                        <p>
                            <label for="">Telefoonnummer </label><span class="optionel">(optioneel)</span>
                        </p>
                        <p>
                            <input type="tel" placeholder="+31 0000 000 000">
                        </p>

                        <p>
                            <label for="km">Bericht</label>
                        </p>
                        <p>
									<textarea rows="14"  placeholder="Geef een korte beschrijving van de staat van de auto">Goedendag,
										Ik ben geïnteresseerd in uw
										VOLVO V40 R-Design T2 122pk

										Wilt u contact met mij opnemen?

										Met vriendelijke groet,
									</textarea>
                        </p>

                        <p>
                            <label for="">Proefrit?</label>
                        </p>
                        <p>
                            <input type="checkbox" name="u" value="u" class="checkboxInput">Ja ik wil graag een proefrit maken<br>
                        </p>

                        <p class="labelMargTop">
                            <label for="" >Wanneer wilt u de proefrit maken?</label>
                        </p>
                        <p>
                            <input type="text" placeholder="Kies een datum" class="dateInput">
                        </p>

                        <hr class="lineAll">

                        <p>
                            <label for="" class="bigLabel">Deel deze tweedehands auto</label>
                        </p>

                        <p>
                            <span class="socialIcons"><a href="#"><i class="icon-facebook"></i></a></span>
                            <span class="socialIcons"><a href="#"><i class="icon-twitter"></i></a></span>
                            <span class="socialIcons"><a href="#"><i class="icon-google-plus"></i></a></span>
                            <span class="socialIcons"><a href="#"><i class="icon-linkedin"></i></a></span>
                            <span class="socialIcons"><a href="#"><i class="icon-pinterest"></i></a></span>
                            <span class="socialIcons"><a href="#"><i class="icon-email"></i></a></span>
                        </p>

                        <hr class="lineAll">

                        <a href="#" class="button_at1">
                            verzenden
                        </a>

                        <hr class="lineAll">

                        <p>
                            <label for="" class="bigLabel">Contactinformatie</label>
                        </p>
                        <p class="commDesc">
                            Zaadmarkt 95 <br>
                            7201 DD Zutphen<br><br>
                            0575-512 125<br>
                            <a href="#" class="blueLink">verkoop@best4u.nl</a>
                        </p>


                    </form>
                </div>
            </div>
            <!-- end sidebar -->
        </div>
    </div>



</div>

