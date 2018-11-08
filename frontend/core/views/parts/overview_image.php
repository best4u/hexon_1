<div class="imgBlock">
    <div class="imgTable">
        <div class="imgTableCell">
            <img src="<?php if ($car->images->{'image-1'}->thumbs->{'320_'} != '') {
                echo $car->images->{'image-1'}->thumbs->{'320_'};
            } else {
                echo "https://www.autotrack.nl/vassets/images/ae72c25fe141159ebb00884804e7f9c8-geen-afbeelding-320x240.png";
            } ?>" alt="">
        </div>
    </div>
</div>