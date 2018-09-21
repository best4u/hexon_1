<div class="wra at_page" id="attr_page">
    <h1>Attributen</h1>
    <?php
    include_once(plugin_dir_path(__FILE__).'/core/attributtes_functions.php');
    $setting = new Attributtes();
    ?>
    <span class="urlAjax" style="display: none"><?php echo plugins_url('core/ajax_requests_at.php',__FILE__); ?></span>
    <pre>
    </pre>
    <div class="table-responsive">
        <table class="table selectUnselect">
            <form action="/" method="GET">
            <thead>
            <tr>
                <th class="transparentColor">
                    <select name="category" id="categoryFilter" class="form-control">
                        <option value>Categorie..</option>
                        <?php foreach($setting->get_select_options() as $cat): ?>
                        <option value="<?=$cat->category?>"><?=strtoupper($cat->category) ?></option>
                        <?php endforeach; ?>
                    </select></th>
                <th class="transparentColor">
                    <input type="text" class="form-control attribute_name" placeholder="Attribuut..." name="attribute">
                </th>
                <th class="transparentColor">
                    <select name="home_page" id="home_page_filter" class="form-control">
                        <option value>Toon aan / uit ..</option>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </th>
                <th class="transparentColor">
                    <select name="overview" id="overview_filter" class="form-control">
                        <option value>Toon aan / uit ..</option>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </th>
                <th class="transparentColor">
                    <select name="summary_detail" id="summary_detail_filter" class="form-control">
                        <option value>Toon aan / uit ..</option>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </th>
                <th class="transparentColor">
                    <select name="details_total" id="details_total" class="form-control">
                        <option value>Toon aan / uit ..</option>
                        <option value="1">Ja</option>
                        <option value="0">Nee</option>
                    </select>
                </th>
            </tr>
            </thead>
                <input type="submit" class="hidden">
            </form>
            <tbody>
                <tr>
                    <td style="width: 200px;"></td>
                    <td>Selecteer / deselecteer alles:</td>
                    <td>
                        <input type="checkbox" class="selectUnselectField" name="home_page">
                    </td>
                    <td>
                        <input type="checkbox" class="selectUnselectField" name="overview" >
                    </td>
                    <td>
                        <input type="checkbox" class="selectUnselectField" name="summary_detail">
                    </td>
                    <td>
                        <input type="checkbox" class="selectUnselectField" name="details_total">
                    </td>
                </tr>

            </tbody>
        </table>
    <div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Categorie:</th>
            <th>Attribuut:</th>
            <th>Homepage:</th>
            <th>Overzicht:</th>
            <th>Samenvatting detail:</th>
            <th>Details totaal:</th>

        </tr>
        </thead>
        <tbody id="allAttr">
        <?php
        
            foreach($setting->get_attr() as $attr)
            {
                ?>
                <tr>
                    <td class="category"><?php echo $attr->category ?></td>
                    <td class="atribute"><?php echo $attr->attribute ?></td>
                    <td>
                        <input type="checkbox" class="checkField home_page" name="home_page" <?php if($attr->home_page == '1'){ echo "checked"; }  ?> data-id="<?php echo $attr->id; ?>">
                    </td>
                    <td>
                        <input type="checkbox" class="checkField overview" name="overview" <?php if($attr->overview == '1'){ echo "checked"; }  ?> data-id="<?php echo $attr->id; ?>">
                    </td>
                    <td>
                        <input type="checkbox" class="checkField summary_detail" name="summary_detail" <?php if($attr->summary_detail == '1'){ echo "checked"; }  ?> data-id="<?php echo $attr->id; ?>">
                    </td>
                    <td>
                        <input type="checkbox" class="checkField details_total" name="details_total" <?php if($attr->details_total == '1'){ echo "checked"; }  ?> data-id="<?php echo $attr->id; ?>">
                    </td>
                </tr>
                <?php
            }
        ?>
        </tbody>
    </table>
</div>
</div>
    <div class="loader">
        <img src="<?php echo plugins_url('/autotrack/images/default.gif') ?>" alt="add">
    </div>
