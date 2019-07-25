<hr class="lineAll">
<p>
    <label for="" class="bigLabel">Openingstijden</label>
</p>
<table cellspacing="1" cellpadding="1">
    <tbody>
    <tr>
        <td></td>
        <td><strong></strong></td>
    </tr>
    <?php
    $shedule = get_option('at_shedule');
    $shedule_days = json_decode($shedule);
    ?>
    <?php foreach($shedule_days as $day): ?>
        <tr>
            <td><strong><?=$day->day ?></strong></td>
            <td><?=$day->time1->from ?> – <?=$day->time1->to ?></td>
        </tr>
        <?php
        if(isset($day->time2)){
            ?>
            <tr>
                <td><strong></strong></td>
                <td><?=$day->time2->from ?> – <?=$day->time2->to ?></td>
            </tr>
            <?php
        }
        ?>
    <?php endforeach; ?>
    </tbody>
</table>

<?php