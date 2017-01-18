<div class="wrap">


    <form method="post" action="options.php">


        <?php settings_fields( 'autotrack-settings-fields' ); ?>
        <?php do_settings_sections( 'autotrack-settings-fields' ); ?>
        <div class="fieldGroup">
            <div class="fieldGroupName">Informatie</div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="at_username">Gebruikersnaam:</label>
                    <input class="form-control" type="text" name="at_username" value="<?php echo esc_attr( get_option('at_username') ); ?>" />
                </div>
                <div class="col-sm-3">
                    <label for="at_password">Wachtwoord, dit veld wordt het opslaan geleegd:</label>
                    <input class="form-control" type="password" name="at_password" value="" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="at_consumer_id">Consumer ID:</label>
                    <input class="form-control" type="text" name="at_consumer_id" value="<?php echo esc_attr( get_option('at_consumer_id') ); ?>" />
                </div>
                <div class="col-sm-3">
                    <label for="at_dealer_id">Dealer ID:</label>
                    <input class="form-control" type="text" name="at_dealer_id" value="<?php echo esc_attr( get_option('at_dealer_id') ); ?>" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="at_url_page_adverts">URL naar pagina occasions:</label>
                    <input class="form-control" type="text" name="at_url_page_adverts" value="<?php echo esc_attr( get_option('at_url_page_adverts') ); ?>" />
                </div>
                <div class="col-sm-3">
                    <?php $period = get_option('at_period_after_sell'); ?>
                    <label for="at_period_after_sell">Antaal dagen verkochte tonen (0 - 30):</label>
                    <select class="form-control" type="text" name="at_period_after_sell" value="<?php echo esc_attr( get_option('at_period_after_sell') ); ?>" >
                        <option value="0" <?php echo $period == 0 ? 'selected' : ''?>>0</option>
                        <option value="3" <?php echo $period == 3 ? 'selected' : ''?>>3</option>
                        <option value="7" <?php echo $period == 7 ? 'selected' : ''?>>7</option>
                        <option value="14" <?php echo $period == 14 ? 'selected' : ''?>>14</option>
                        <option value="30" <?php echo $period == 30 ? 'selected' : ''?>>30</option>
                    </select>
                </div>
            </div>

        </div>


        <div class="fieldGroup">
            <div class="fieldGroupName">Opmaak</div>
            <p>Welk template dient gebruikt te worden?</p>

            <?php $theme = get_option('at_theme'); ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme1" class="disabled" disabled <?php echo $theme == 'theme1' ? 'checked="checked"' : '' ?>> Template naam 1.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme2" class="disabled" disabled <?php echo $theme == 'theme2' ? 'checked="checked"' : '' ?>> Template naam 2.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme3" class="disabled" disabled <?php echo $theme == 'theme3' ? 'checked="checked"' : '' ?>> Template naam 3.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">

                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme4" class="disabled" disabled <?php echo $theme == 'theme4' ? 'checked="checked"' : '' ?>> Template naam 4.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme5" class="disabled" disabled <?php echo $theme == 'theme5' ? 'checked="checked"' : '' ?>> Template naam 5.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme6" class="disabled" disabled <?php echo $theme == 'theme6' ? 'checked="checked"' : '' ?>> Template naam 6.
                    </label>
                </div>
            </div>



            <div class="row">
                <div class="col-sm-6">
                    <div class="shortDelimeter"></div>
                </div>
            </div>

            <p>Geef hier dient er gebruikt te worden?</p>
            <div class="row">
                <div class="col-sm-2">
                    <label for="at_font_color">Textkleur:</label>
                    <input class="form-control" type="color" name="at_font_color" value="<?php echo esc_attr( get_option('at_font_color') ); ?>" />
                </div>
                <div class="col-sm-2">
                    <label for="at_attribute_label">Attribuut-label kleur:</label>
                    <input class="form-control" type="color" name="at_attribute_label" value="<?php echo esc_attr( get_option('at_attribute_label') ); ?>"/>
                </div>
                <div class="col-sm-2">
                    <label for="at_attribute_value">Attribuut-warde kleur:</label>
                    <input class="form-control" type="color" name="at_attribute_value" value="<?php echo esc_attr( get_option('at_attribute_value') ); ?>" />
                </div>


            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label for="at_header_color">Header kleur:</label>
                    <input class="form-control" type="color" name="at_header_color" value="<?php echo esc_attr( get_option('at_header_color') ); ?>" />
                </div>
                <div class="col-sm-2">
                    <label for="at_button_color">Knoppen kleur:</label>
                    <input class="form-control" type="color" name="at_button_color" value="<?php echo esc_attr( get_option('at_button_color') ); ?>"/>
                </div>
                <div class="col-sm-2">
                    <label for="at_price_color">Prijs kleur:</label>
                    <input class="form-control" type="color" name="at_price_color" value="<?php echo esc_attr( get_option('at_price_color') ); ?>"/>
                </div>
            </div>

        </div>


        <div class="fieldGroup">
            <div class="fieldGroupName">Homepage</div>
            <p>Welke advertenties dienen er op de home-page getoond worden?</p>
            <?php $at_home_cars = get_option('at_home_cars'); ?>
            <div class="row">
                <div class="col-sm-2">

                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_newest_cars" <?php echo $at_home_cars == 'at_newest_cars' ? 'checked="checked"' : '' ?>> De nieuwste advertenties.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_expensive_cars" <?php echo $at_home_cars == 'at_expensive_cars' ? 'checked="checked"' : '' ?>> De duurste advertenties.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_last_cars" <?php echo $at_home_cars == 'at_last_cars' ? 'checked="checked"' : '' ?>> De laast geplaatste advertenties.
                    </label>
                </div>
            </div>
        </div>

        <div class="fieldGroup">
            <div class="fieldGroupName">Occasions</div>
            <p>Hoe dienen de occasions standaart gesorteerd te zijn? Kies een waarde en vervolgens van hoog naar laag of laag naar hoog.</p>
            <?php $at_sort_by  = get_option('at_sort_by');  ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="at_sort_price" <?php echo $at_sort_by == 'at_sort_price' ? 'checked="checked"' : '' ?>> Prijs.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="at_sort_brand" <?php echo $at_sort_by == 'at_sort_brand' ? 'checked="checked"' : '' ?>> Merk, Model, Uitvoering.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="at_sort_mileage" <?php echo $at_sort_by == 'at_sort_mileage' ? 'checked="checked"' : '' ?>> Kilometerstand.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="at_sort_publish" <?php echo $at_sort_by == 'at_sort_publish' ? 'checked="checked"' : '' ?>> Publicatiedatum.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="at_sort_year" <?php echo $at_sort_by == 'at_sort_year' ? 'checked="checked"' : '' ?>> Bouwjaar.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Van laag naar hoog of hoog naar laag:</p>
            <?php $at_sort_by_orientation = get_option('at_sort_by_orientation');  ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by_orientation" value="at_sort_asc" <?php echo $at_sort_by_orientation == 'at_sort_asc' ? 'checked="checked"' : '' ?>> Laag naar hoog.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by_orientation" value="at_sort_desc" <?php echo $at_sort_by_orientation == 'at_sort_desc' ? 'checked="checked"' : '' ?>> Hoog naar laag.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Hoe moet het overzicht weergegeven worden aan de bezoekers? Als eenlijst of juist als tabel?</p>
            <div class="row">
                <?php $at_overview_layoutmode = get_option('at_overview_layoutmode') ?>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_overview_layoutmode" value="at_layout_overview_list" <?php echo $at_overview_layoutmode == 'at_layout_overview_list' ? 'checked="checked"' : '' ?>> List.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_overview_layoutmode" value="at_layout_overview_table" <?php echo $at_overview_layoutmode == 'at_layout_overview_table' ? 'checked="checked"' : '' ?>> Tabel.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Geef aan hoe de volledige van de occasion getoond dienen te worden aan de bezoeker.</p>
            <div class="row">
                <?php $at_details_view_mode = get_option('at_details_view_mode') ?>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_details_view_mode" value="at_details_view_list" <?php echo $at_details_view_mode == 'at_details_view_list' ? 'checked="checked"' : '' ?>> Als een grote lijst; one-page.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_details_view_mode" value="at_details_view_tabs" <?php echo $at_details_view_mode == 'at_details_view_tabs' ? 'checked="checked"' : '' ?>> Verdeeld per tabblad.
                    </label>
                </div>
            </div>

        </div>

        <div class="fieldGroup">
            <div class="fieldGroupName">Detailpagina</div>
            <p>Beheer de volgorde van het contactformulier, de social media informatie en contactinformatie of schakel deze desgewenst uit.</p>
            <?php
            $sidebar_blocks = get_option('at_sidebar_blocks');
            if(!$sidebar_blocks){
                $sidebar_blocks = [
                    0=>[
                        'name'  => 'Contactformulier',
                        'state' => 1
                    ],
                    1=>[
                        'name'  => 'Social Media Informatie',
                        'state' => 1
                    ],
                    2=>[
                        'name'  => 'Contactinformatie',
                        'state' => 1
                    ],
                    3=>[
                        'name'  => 'Openingstijden',
                        'state' => 0
                    ]

                ];
                echo '<pre>';
                echo json_encode($sidebar_blocks);
                echo '</pre><div class="json"></div>';
            }else{
                $sidebar_blocks = json_decode($sidebar_blocks);
                $sidebar_blocks = object_to_array($sidebar_blocks);
            }
            ?>


            <input id="block_ordering" type="hidden" value='<?php echo json_encode($sidebar_blocks); ?>' name="at_sidebar_blocks">
            <div class="row">
                <div class="col-sm-6">
                    <ul id="sortable_details">
                        <?php
                        foreach ($sidebar_blocks as $key => $block): ?>
                            <li data-order="<?=$key ?>">
                                <div class="lBlock">
                                    <div class="lbText"><?=$block['name']; ?></div>
                                    <div class="lbIcon"><img src="<?php echo plugins_url() ?>/autotrack/images/move.png"></div>
                                    <div class="lbSwither"><input type="checkbox"<?=$block['state'] == 1 ? ' checked':'' ?>> </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Naar welk(e) e-mailadres(sen) dienen de ingevulde contactformulieren verstuurd te worden?</p>
        </div>


        <?php
        $ch = curl_init("https://www.autotrack.nl/api/advertenties?pageNumber=50&pageSize=1&sort%5Bprijs%5D=desc");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "best4u:VZipAyJKHfxe");
        $output = curl_exec($ch);
        if(curl_error($ch)){
            echo '<pre>';
            var_dump(curl_error($ch));
            echo '</pre>';
        }
        curl_close($ch);
        echo '<pre>';
        //                    var_dump(json_decode($output, true));
        echo '</pre>';
        //            echo $output;  ?>
        <?php submit_button('Opslaan'); ?>


    </form>
</div>
