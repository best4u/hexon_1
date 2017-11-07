<div class="sidebarContent">
                <div class="titleSidebar">
                    Occasion zoeken
                </div>

                <div class="sidebarFilters">
                   <form action="" method="GET" id="rightSearchFilter">
                        <p>
                            <label for="a">Merk</label>
                        </p>
                        <select name="merkId" id="marks" class="selectCustom">
                            <option value>Alle merken</option>
                            <?php
                            foreach($_SESSION['all_marks'] as $key => $mark){
                                ?>
                                <option value="<?php echo $key; ?>" <?php if(isset($_GET['merkId']) && $_GET['merkId'] == $key){ echo "selected"; } ?> class="markOption"><?php echo $mark; ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <p>
                            <label for="b">Model</label>
                        </p>
                        <select name="modelId" id="models" class="selectCustom">
                            <option value>Selecteer eerst een merk</option>
                            <?php
                            if(isset($_SESSION['models'])){
                                foreach($_SESSION['models'] as $key => $model){
                                    ?>
                                    <option value="<?php echo $key; ?>"  <?php if(isset($_GET['modelId']) && $_GET['modelId'] == $key){ echo "selected"; } ?> class="modelOption"><?php echo $model; ?></option>
                                    <?php

                                }
                            }
                            unset($_SESSION['models']);
                            ?>
                        </select>

                        <button type="submit" class="button allCarsButton allCarsButton1">Toon auto's</button>

                        <p>
                            <label for="a">Prijs</label>
                        </p>
                        

                        <p class="priceP">
                            <span class="priceFrom">€ <?php if(isset($_GET['prijs_min'])){ echo number_format($_GET['prijs_min'], 2, ",", "."); }else{ echo ''; } ?></span>
                            <span class="priceTo">€ <?php if(isset($_GET['prijs_max'])){ echo number_format($_GET['prijs_max'], 2, ",", "."); }else{ echo number_format($_SESSION['max_price'], 2, ",", "."); } ?></span>

                            <span class="priceHiddenFrom" style="display: none"><?php echo $_SESSION['min_price']; ?></span>
                            <span class="priceHiddenTo" style="display: none"><?php echo $_SESSION['max_price']; ?></span>

                            <span class="priceFromMin" style="display: none"><?php if(isset($_GET['prijs_min'])){ echo $_GET['prijs_min']; }else{ echo ''; } ?></span>
                            <span class="priceFromMax" style="display: none"><?php if(isset($_GET['prijs_max'])){ echo $_GET['prijs_max']; }else{ echo $_SESSION['max_price']; } ?></span>

                        </p>
                        <div class="priceSliderCont commSlideCont">
                            <div id="slider2" class=""></div>
                        </div>
                        <div class="pricesInputs" style="display: none">
                            <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="prijs_min" class="priceFrom form-control"></span>
                            <span class="comLeftTitle">tot: </span> <span class="commInputs"><input type="text" name="prijs_max" class="priceTo form-control"></span>
                        </div>

                        <p>
                            <label for="a">Bouwjaar</label>
                        </p>
                        <p class="yearsP">
                            <span class="yearsFrom"><?php echo $_SESSION['min_year']; ?></span>
                            <span class="yearsTo"><?php echo $_SESSION['max_year']; ?></span>
                        </p>

                        <span class="yearFromMin" style="display: none"><?php if(isset($_GET['bouwjaar_min'])){ echo $_GET['bouwjaar_min']; }else{ echo $_SESSION['min_year']; } ?></span>
                        <span class="yearFromMax" style="display: none"><?php if(isset($_GET['bouwjaar_max'])){ echo $_GET['bouwjaar_max']; }else{ echo $_SESSION['max_year']; } ?></span>

                        <div class="yearSliderCont commSlideCont">
                            <div id="slider3" class="bouwjaarSlider"></div>
                        </div>
                        <div class="yearsInputs" style="display: none">
                            <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="bouwjaar_min" class="yearsFrom "></span>
                            <span class="comLeftTitle"> tot: </span> <span class="commInputs"><input type="text" name="bouwjaar_max" class="yearsTo"></span>
                        </div>

                        <p>
                            <label for="b">Brandstof</label>
                        </p>
                        <select name="brandstofsoort" id="fuel" class="selectCustom">
                            <option value>Selecteer brandstof</option>
                            <?php
                            foreach($_SESSION['fuel'] as $fuel){
                                ?>
                                <option value="<?php echo $fuel; ?>" class='fuelOption' <?php if(isset($_GET['brandstofsoort']) && $_GET['brandstofsoort'] == $fuel){ echo "selected"; } ?>><?php echo ucfirst(strtolower($fuel)); ?></option>
                                <?php

                            }
                            ?>

                        </select>

                        <p>
                            <label for="b">Carrosserie</label>
                        </p>
                        <select name="carrosserievorm" id="caroserie" class="selectCustom">
                            <option value>Selecteer carrosserie</option>
                            <?php
                            foreach($_SESSION['caroserie'] as $caroserie){
                                if($caroserie != ""){
                                    ?>
                                    <option value="<?php echo $caroserie; ?>" class="caroserieOption" <?php if(isset($_GET['carrosserievorm']) && $_GET['carrosserievorm'] == $caroserie){ echo "selected"; } ?>><?php echo ucfirst(strtolower($caroserie)); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                        <div id="moreOptions">
                            <a href="#" class="button_atAlt button button-alt buttonMoreOptions">
                                Meer zoekopties
                            </a>
                        </div>

                        <div id="hiddenOptions">
                            <p>
                                <label for="a">Kilometerstand</label>
                            </p>


                            <p class="kmP">
                                <span class="kmFrom kmFromLabel"><?php echo $_SESSION['km_min']; ?></span>
                                <span class="kmTo kmToLabel"><?php echo $_SESSION['km_max']; ?></span>

                                <span class="kmFromMin" style="display: none"><?php if(isset($_GET['kilometerstand_min'])){ echo $_GET['kilometerstand_min']; }else{ echo $_SESSION['km_min']; } ?></span>
                                <span class="kmFromMax" style="display: none"><?php if(isset($_GET['kilometerstand_max'])){ echo $_GET['kilometerstand_max']; }else{ echo $_SESSION['km_max']; } ?></span>
                            </p>
                            <div class="priceSliderCont commSlideCont">
                                <div id="sliderA" class="bouwjaarSlider"></div>
                            </div>
                            <div class="kmInputs" style="display: none;">
                                <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="kilometerstand_min" class="kmFrom "></span>
                                <span
                                    class="comLeftTitle"> tot: </span> <span class="commInputs"><input type="text" name="kilometerstand_max" class="kmTo"></span>
                            </div>

                            <p>
                                <label for="b">Transmissie</label>
                            </p>
                            <select name="transmissie" id="power" class="selectCustom">
                                <option value>Alle transmissies</option>
                                <?php
                                    if(isset($_SESSION['transmisie'])){
                                        foreach($_SESSION['transmisie'] as $type){
                                            ?>
                                            <option value="<?php echo $type; ?>" <?php if(isset($_GET['transmissie']) && $_GET['transmissie'] == $type){ echo "selected"; } ?>><?php echo ucfirst(strtolower($type)); ?></option>
                                            <?php
                                        }

                                    }
                                ?>
                            </select>


                            <p>
                                <label for="b">Aantal deuren</label>
                            </p>
                            <select name="aantalDeuren" id="power" class="selectCustom">
                                <option value>Selecteer aantal deuren</option>
                                <?php
                                    foreach($_SESSION['dors'] as $type){
                                        if($type != ""){
                                            ?>
                                            <option value="<?php echo $type; ?>" <?php if(isset($_GET['aantalDeuren']) && $_GET['aantalDeuren'] == $type){ echo "selected"; } ?>><?php echo ucfirst(strtolower($type)); ?></option>
                                            <?php
                                        }
                                    }

                                ?>
                            </select>
                        </div>
                        <button type="submit" class="button allCarsButton">Toon auto's</button>

                    </form>
                </div>
                                        <?php
if (  is_active_sidebar( 'at_sidebar_2' ) ) {
    dynamic_sidebar( 'at_sidebar_2' );
}
?>
            </div>

            