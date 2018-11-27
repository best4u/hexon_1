<select name="orderBy" id="sortSelect" class="selectCustom">
<option value>Sorteren op...</option>
<option value="catalog_price" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'catalog_price' ? 'selected' : '' ?>> Prijs, laag naar hoog</option>
<option value="catalog_price_desc" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'catalog_price_desc' ? 'selected' : '' ?>> Prijs, hoog naar laag</option>
<option value="title" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'title' ? 'selected' : '' ?>>Merk, Model, Uitvoering</option>
<option value="mileage" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'mileage' ? 'selected' : '' ?>>Kilometerstand</option>
<option value="date_posted" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'date_posted' ? 'selected' : '' ?>>Publicatiedatum</option>
<option value="construction_year" <?php echo isset($_GET['orderBy']) && $_GET['orderBy'] == 'construction_year' ? 'selected' : '' ?>>Bouwjaar</option>

</select>