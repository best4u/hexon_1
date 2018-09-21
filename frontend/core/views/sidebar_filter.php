
<div class="sidebarContent">
    <div class="titleSidebar">
        Occasion zoeken
    </div>

    <div class="sidebarFilters">

        <p>
            <label for="a">Merk</label>
        </p>
       
        <select name="brand" id="marks" class="selectCustom">
            <option value>Alle merken</option>
            <?php foreach($brands->data as $brand): ?>
                <option value="<?=$brand->id?>" <?php if (isset($_GET['brand']) && $_GET['brand'] == $brand->id) { echo "selected";} ?> ><?=$brand->title?></option>
             <?php endforeach; ?>   
        </select>

        <p>
            <label for="b">Model</label>
        </p>

        <select name="model" id="models" class="selectCustom">
            <option value>Selecteer eerst een merk</option>
            <?php if($models): ?>
                <?php foreach($models->data as $model): ?>
                    <option value="<?php echo $model->id; ?>" <?php if (isset($_GET['model']) && $_GET['model'] == $model->id) { echo "selected"; } ?> class="modelOption"><?php echo $model->title; ?></option>
                <?php endforeach; ?>    
            <?php endif; ?>    
        </select>

        <button type="submit" class="button allCarsButton allCarsButton1">Toon auto's</button>

        <p>
            <label for="a">Prijs</label>
        </p>
   
        <p class="priceP">
            <span class="priceFrom">€ <?php if (isset($_GET['price_min'])) {
                    echo number_format($pricesMaxMin->data->min, 2, ",", ".");
                } else {
                    echo '';
                } ?></span>
            <span class="priceTo">€ <?php if (isset($_GET['price_max'])) {
                    echo number_format($_GET['price_max'], 2, ",", ".");
                } else {
                    echo number_format($pricesMaxMin->data->max, 2, ",", ".");
                } ?></span>

            <span class="priceHiddenFrom" style="display: none"><?php echo $pricesMaxMin->data->min; ?></span>
            <span class="priceHiddenTo" style="display: none"><?php echo $pricesMaxMin->data->max; ?></span>

            <span class="priceFromMin" style="display: none"><?php if (isset($_GET['price_min'])) {
                    echo $_GET['price_min'];
                } else {
                    echo '';
                } ?></span>
            <span class="priceFromMax" style="display: none"><?php if (isset($_GET['price_max'])) {
                    echo $_GET['price_max'];
                } else {
                    echo $pricesMaxMin->data->max;
                } ?></span>

        </p>
        <div class="priceSliderCont commSlideCont">
            <div id="slider2" class=""></div>
        </div>
        <div class="pricesInputs" style="display: none;">
            <span class="comLeftTitle">van: </span> 
            <span class="commInputs">
                <input type="text" value name="price_min" class="priceFrom priceFromField form-control">
             </span>
            <span class="comLeftTitle">tot: </span> 
            <span class="commInputs">
                <input type="text" name="price_max" class="priceTo form-control">
            </span>
        </div>

        <p>
            <label for="a">Bouwjaar</label>
        </p>

        <p class="yearsP">
            <span class="yearsFrom"><?php echo $yearsMaxMin->data->min; ?></span>
            <span class="yearsTo"><?php echo $yearsMaxMin->data->max; ?></span>
        </p>

        <span class="yearFromMin" style="display: none"><?php if (isset($_GET['year_min'])) {
                echo $_GET['year_min'];
            } else {
                echo $yearsMaxMin->data->min;
            } ?></span>
        <span class="yearFromMax" style="display: none"><?php if (isset($_GET['year_max'])) {
                echo $_GET['year_max'];
            } else {
                echo $yearsMaxMin->data->max;
            } ?></span>

        <div class="yearSliderCont commSlideCont">
            <div id="slider3" class="bouwjaarSlider"></div>
        </div>
        <div class="yearsInputs" style="display: none">
            <span class="comLeftTitle">van: </span> <span class="commInputs">
                <input type="text" name="year_min" class="yearsFrom ">
            </span>
            <span class="comLeftTitle"> tot: </span> <span class="commInputs">
                <input type="text" name="year_max" class="yearsTo">
            </span>
        </div>

        <p>
            <label for="b">Brandstof</label>
        </p>
     
        <select name="fuel" id="fuel" class="selectCustom">
            <option value>Selecteer brandstof</option>
            <?php if($fuels): ?>
                <?php foreach($fuels->data as $fuel): ?>
                     <option value="<?php echo $fuel->id; ?>"
                    class='fuelOption' <?php if (isset($_GET['fuel']) && $_GET['fuel'] == $fuel->id) { echo "selected";} ?>><?php echo $fuel->title; ?></option>
                <?php endforeach; ?>    
            <?php endif; ?>
        </select>

        <p>
            <label for="b">Carrosserie</label>
        </p>

        <select name="body_style" id="caroserie" class="selectCustom">
            <option value>Selecteer carrosserie</option>
            <?php if($bodyStyles): ?>
                <?php foreach($bodyStyles->data as $body): ?>
                     <option value="<?php echo $body->id; ?>"
                    class='caroserieOption' <?php if (isset($_GET['body_style']) && $_GET['body_style'] == $body->id) { echo "selected";} ?>><?php echo $body->title; ?></option>
                <?php endforeach; ?>    
            <?php endif; ?>
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
                <span class="kmFrom kmFromLabel"><?php echo $mileagesMaxMin->data->min; ?></span>
                <span class="kmTo kmToLabel"><?php echo $mileagesMaxMin->data->max; ?></span>

                <span class="kmFromMin" style="display: none"><?php if (isset($_GET['mileage_min'])) {
                        echo $_GET['mileage_min'];
                    } else {
                        echo $mileagesMaxMin->data->min;
                    } ?></span>
                <span class="kmFromMax" style="display: none"><?php if (isset($_GET['mileage_max'])) {
                        echo $_GET['mileage_max'];
                    } else {
                        echo $mileagesMaxMin->data->max;

                    } ?></span>
            </p>
            <div class="priceSliderCont commSlideCont">
                <div id="sliderA" class="bouwjaarSlider"></div>
            </div>
            <div class="kmInputs" style="display: none;">
                <span class="comLeftTitle">van: </span> 
                <span class="commInputs">
                    <input type="text" name="mileage_min" class="kmFrom ">
                </span>
                <span class="comLeftTitle"> tot: </span> <span class="commInputs">
                    <input type="text" name="mileage_max"  class="kmTo">
                </span>
            </div>

            <p>
                <label for="b">Transmissie</label>
            </p>
            <select name="transmission" id="power" class="selectCustom">
                <option value>Alle transmissies</option>
                <?php if($transmissions): ?>
                    <?php foreach($transmissions->data as $data): ?>
                         <option value="<?php echo $data->id; ?>"
                        class='caroserieOption' <?php if (isset($_GET['body_style']) && $_GET['body_style'] == $data->id) { echo "selected";} ?>><?php echo $data->title; ?></option>
                        <?php endforeach; ?>    
                <?php endif; ?>
            </select>
            <p>
                <label for="b">Aantal deuren</label>
            </p>
            <select name="door_number" id="power" class="selectCustom">
                <option value>Selecteer aantal deuren</option>
                <option value="2" <?php if (isset($_GET['door_number']) && $_GET['door_number'] == '2') { echo "selected";} ?>>2</option>
                <option value="3" <?php if (isset($_GET['door_number']) && $_GET['door_number'] == '3') { echo "selected";} ?>>3</option>
                <option value="4" <?php if (isset($_GET['door_number']) && $_GET['door_number'] == '4') { echo "selected";} ?>>4</option>
                <option value="5" <?php if (isset($_GET['door_number']) && $_GET['door_number'] == '5') { echo "selected";} ?>>5</option>
            </select>
        </div>
        <button type="submit" class="button allCarsButton">Toon auto's</button>

        </form>
    </div>
    <?php
    if (is_active_sidebar('at_sidebar_2')) {
        dynamic_sidebar('at_sidebar_2');
    }
    ?>
</div>

            