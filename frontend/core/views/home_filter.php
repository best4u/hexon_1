<?php

    $ocassions_page_slug = get_option("at_url_page_adverts");
    $server_name = $_SERVER['SERVER_NAME'];
   $protocol = 'http://';
    if(isset($_SERVER['HTTPS'])){
        $protocol = 'https://';
    }
?>
<form action="<?=$protocol?><?=$server_name?>/<?=$ocassions_page_slug?>" method="GET" id="merkFilter">
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

    <button type="submit" class="button">Toon auto's</button>
</form>