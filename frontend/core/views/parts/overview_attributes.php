<?php foreach($carsService->getOverviewAttr() as $attr): ?>
    <?php if($attr->type == 'marge'): ?>
        <p>
            <span class="leftType atribute_label_color"><?=$attr->attribute?>:</span>
            <span class="rightOption atribute_value_color">

            <?php if(get_option('taxable') == '1'  && $car->advertise->taxable == 'Ja'): ?>
                 BTW verrekenbaar
             <?php else: ?>
                 BTW niet verrekenbaar (margeregeling)
             <?php endif; ?>
                
            </span>
        </p> 
    <?php else: ?>
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
<?php endif; ?>   

<?php endforeach; ?> 