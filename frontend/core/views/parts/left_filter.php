

<div class="sidebarFilters">
    <form action="/" method="GET">
        <p>
            <label for="a">Merk</label>
        </p>
        <select name="name" id="marks" class="selectCustom">
            <option value>Alle merken</option>
            <?php
            foreach($_SESSION['all_marks'] as $key => $mark){
                ?>
                <option value="<?php echo $key; ?>" class="markOption"><?php echo $mark; ?></option>
                <?php
            }
            ?>
        </select>

        <p>
            <label for="b">Model</label>
        </p>
        <select name="model" id="models" class="selectCustom">
            <option value>Selecteer eerst een merk</option>

        </select>

        <button type="submit" class="button_at1">toon auto's</button>

        <p>
            <label for="a">Prijs</label>
        </p>

        <p class="priceP">
            <span class="priceFrom">€ <?php echo number_format($_SESSION['min_price'], 2, ",", "."); ?></span>
            <span class="priceTo">€ <?php echo number_format($_SESSION['max_price'], 2, ",", "."); ?></span>
            <span class="priceHiddenFrom" style="display: none"><?php echo $_SESSION['min_price']; ?></span>
            <span class="priceHiddenTo" style="display: none"><?php echo $_SESSION['max_price']; ?></span>
        </p>
        <div class="priceSliderCont commSlideCont">
            <div id="slider2" class="bouwjaarSlider"></div>
        </div>
        <div class="pricesInputs">
            <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="priceFrom" class="priceFrom form-control"></span>
            <span class="comLeftTitle">tot: </span> <span class="commInputs"><input type="text" name="priceTo" class="priceTo form-control"></span>
        </div>

        <p>
            <label for="a">Bouwjaar</label>
        </p>
        <p class="yearsP">
            <span class="yearsFrom"><?php echo $_SESSION['min_year']; ?></span>
            <span class="yearsTo"><?php echo $_SESSION['max_year']; ?></span>
        </p>
        <div class="yearSliderCont commSlideCont">
            <div id="slider" class="bouwjaarSlider"></div>
        </div>
        <div class="yearsInputs">
            <span class="comLeftTitle">van: </span> <span class="commInputs"><input type="text" name="yearsFrom" class="yearsFrom "></span>
            <span class="comLeftTitle"> tot: </span> <span class="commInputs"><input type="text" name="yearsTo" class="yearsTo"></span>
        </div>

        <p>
            <label for="b">Brandstof</label>
        </p>
        <select name="fuel" id="fuel" class="selectCustom">
            <option value>Selecteer brandstof</option>
            <?php
            foreach($_SESSION['fuel'] as $fuel){
                echo "<option value='$fuel' class='fuelOption'>".ucfirst(strtolower($fuel))."</option>";
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
                    echo "<option value='$caroserie' class='caroserieOption'>".ucfirst(strtolower($caroserie))."</option>";
                }
            }
            ?>
        </select>

        <p>
            <label for="b">Motorinhoud</label>
        </p>
        <select name="cilinderinhoud" id="power" class="selectCustom">
            <option value="min">Minimaal</option>
            <?php
            foreach($_SESSION['power'] as $power){
                if($power != ""){
                    echo "<option value='$power' class='powerOption'>".ucfirst(strtolower($power))."</option>";
                }
            }
            ?>

        </select>

        <a href="#" class="button_atAlt">
            meer zoekopties
        </a>

        <button type="submit" class="button_at1">toon auto's</button>
    </form>
</div>

