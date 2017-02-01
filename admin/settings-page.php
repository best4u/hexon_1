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
<!--                <div class="col-sm-3">-->
<!--                    <label for="at_consumer_id">Consumer ID:</label>-->
<!--                    <input class="form-control" type="text" name="at_consumer_id" value="--><?php //echo esc_attr( get_option('at_consumer_id') ); ?><!--" />-->
<!--                </div>-->
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
                    <div class="col-md-8">
                        <br>
                        <br>
                        <h3>Codes</h3>
                        <p>Toon alle occasions: <b>[occasions_list]</b></p>
                        <p>Toon occasions op home-page: <b>[home_occasions]</b></p>
                    </div>

            </div>

        </div>


        <div class="fieldGroup">
            <div class="fieldGroupName">Opmaak</div>
            <p>Welk template dient gebruikt te worden?</p>

            <?php
            $theme = wp_get_theme();
            $theme = $theme->get('Name');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme1" class="disabled" disabled <?php echo $theme == 'Theme1' ? 'checked="checked"' : '' ?>> Pineview Drive.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme2" class="disabled" disabled <?php echo $theme == 'Theme2' ? 'checked="checked"' : '' ?>> Expedition off road.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme3" class="disabled" disabled <?php echo $theme == 'Theme3' ? 'checked="checked"' : '' ?>> Northern light.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">

                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme4" class="disabled" disabled <?php echo $theme == 'Theme4' ? 'checked="checked"' : '' ?>> Level up.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme5" class="disabled" disabled <?php echo $theme == 'Theme5' ? 'checked="checked"' : '' ?>> Beijing winters.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_theme" value="theme6" class="disabled" disabled <?php echo $theme == 'Theme6' ? 'checked="checked"' : '' ?>> Simple mpdern.
                    </label>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
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
            <p>Hoeveelheid occasions</p>
            <div class="row">
                <?php
                $at_number_of_occasions_on_home = get_option("at_number_of_occasions_on_home");
                ?>
                <div class="col-md-3">
                    <div class="row">
                        <input type="number" class="form-control" name="at_number_of_occasions_on_home" value="<?php echo $at_number_of_occasions_on_home; ?>">
                    </div>
                </div>
            </div>
            <br>
            <p>Welke advertenties dienen er op de home-page getoond worden?</p>

            <br>
            <?php $at_home_cars = get_option('at_home_cars');

            ?>
            <div class="row">
                <div class="row">
                <div class="col-sm-4">

                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_newest_cars" <?php echo $at_home_cars == 'at_newest_cars' ? 'checked="checked"' : '' ?>> De nieuwste advertenties.
                    </label>
                </div>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_expensive_cars" <?php echo $at_home_cars == 'at_expensive_cars' ? 'checked="checked"' : '' ?>> De duurste advertenties.
                    </label>
                </div>
                <div class="col-sm-4">
                    <label class="radio-inline">
                        <input type="radio" name="at_home_cars" value="at_last_cars" <?php echo $at_home_cars == 'at_last_cars' ? 'checked="checked"' : '' ?>> De laast geplaatste advertenties.
                    </label>
                </div>
            </div>
        </div>

        <div class="fieldGroup">
            <div class="fieldGroupName">Occasions</div>
            <p>Hoe dienen de occasions standaart gesorteerd te zijn? Kies een waarde en vervolgens van hoog naar laag of laag naar hoog.</p>
            <?php $at_sort_by  = get_option('at_sort_by');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="prijs" <?php echo $at_sort_by == 'prijs' ? 'checked="checked"' : '' ?>> Prijs.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="merkModelUitvoering" <?php echo $at_sort_by == 'merkModelUitvoering' ? 'checked="checked"' : '' ?>> Merk, Model, Uitvoering.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="kilometerstand" <?php echo $at_sort_by == 'kilometerstand' ? 'checked="checked"' : '' ?>> Kilometerstand.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="datumGeplaatst" <?php echo $at_sort_by == 'datumGeplaatst' ? 'checked="checked"' : '' ?>> Publicatiedatum.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="bouwjaar" <?php echo $at_sort_by == 'bouwjaar' ? 'checked="checked"' : '' ?>> Bouwjaar.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Van laag naar hoog of hoog naar laag:</p>
            <?php $at_sort_by_orientation = get_option('at_sort_by_orientation');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by_orientation" value="asc" <?php echo $at_sort_by_orientation == 'asc' ? 'checked="checked"' : '' ?>> Laag naar hoog.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by_orientation" value="desc" <?php echo $at_sort_by_orientation == 'desc' ? 'checked="checked"' : '' ?>> Hoog naar laag.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Hoe moet het overzicht weergegeven worden aan de bezoekers? Als eenlijst of juist als tabel?</p>
            <div class="row">
                <?php $at_overview_layoutmode = get_option('at_overview_layoutmode');
                ?>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_overview_layoutmode" value="at_layout_overview_list" <?php echo $at_overview_layoutmode == 'at_layout_overview_list' ? 'checked="checked"' : '' ?>> List.
                    </label>
                    <i class="fa fa-list-alt" style="font-size: 24px;margin-left: 10px;margin-top: 3px;" aria-hidden="true"></i>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_overview_layoutmode" value="at_layout_overview_table" <?php echo $at_overview_layoutmode == 'at_layout_overview_table' ? 'checked="checked"' : '' ?>> Tabel.
                    </label>
                    <i class="fa fa-table" style="font-size: 24px;margin-left: 10px;margin-top: 3px;" aria-hidden="true"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Geef aan hoe de volledige van de occasion getoond dienen te worden aan de bezoeker.</p>
            <div class="row">
                <?php $at_details_view_mode = get_option('at_details_view_mode');
                ?>
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
            $sidebar_blocks = json_decode($sidebar_blocks);
            $sidebar_blocks = object_to_array($sidebar_blocks);
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
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>

            <p>Contactformulier code </p>
            <div class="row">
                <div class="col-sm-6">
                    <?php $at_form_short_code = get_option('at_form_short_code'); ?>
                    <textarea id="" cols="30" rows="10" name="at_form_short_code" class="form-control"><?=$at_form_short_code ?></textarea>

                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>

<!---->
<!--            <p>Naar welk(e) e-mailadres(sen) dienen de ingevulde contactformulieren verstuurd te worden?</p>-->
<!--            --><?php //$receivers = get_option('receiver_emails'); ?>
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    <div class="eMailsRepeater">-->
<!--                        --><?php
//                        if (empty($receivers)): ?>
<!--                            <div class="eRow">-->
<!--                                <div class="erInput">-->
<!--                                    <input type="email" class="form-control" name="receiver_emails[]">-->
<!--                                </div>-->
<!--                                <div class="erButton"></div>-->
<!--                            </div>-->
<!--                            --><?php
//                        else:
//                            foreach ($receivers as $receiver): ?>
<!--                                <div class="eRow">-->
<!--                                    <div class="erInput">-->
<!--                                        <input type="email" class="form-control" name="receiver_emails[]"-->
<!--                                               value="--><?//= $receiver ?><!--">-->
<!--                                    </div>-->
<!--                                    <div class="erButton"></div>-->
<!--                                </div>-->
<!--                            --><?php //endforeach; endif; ?>
<!---->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!---->
<!--            <div class="row">-->
<!--                <div class="col-sm-7">-->
<!--                    <div class="shortDelimeter"></div>-->
<!--                </div>-->
<!--            </div>-->
            <p>Geef hier de openingstijden in van bedrijf / locatie.</p>
            <?php $shedule = get_option('at_shedule');
            ?>
            <input type="hidden" id="shedule" value='<?=$shedule ?>' name="at_shedule">
            <div class="row">
                <div class="col-sm-6">
                    <div class="geef">
                        <?php
                        $shedule_days = json_decode($shedule);
                        foreach($shedule_days as $day): ?>
                        <div class="gRow">
                            <div class="gDay"><?=$day->day ?></div>
                            <div class="gOrar1">
                                <input type="text" class="from" placeholder="Van.." value="<?=isset($day->time1)? $day->time1->from : '' ?>">
                                <input type="text" class="to" placeholder="Tot .." value="<?=isset($day->time1)? $day->time1->to : '' ?>">
                                <div class="gButton">
                                    <img src="<?php echo plugins_url('/autotrack/images/add.png') ?>" alt="add">
                                </div>
                            </div>
                            <div class="gOrar2" <?php echo isset($day->time2) ? 'style="visibility: visible"' : '' ?> >
                                <input type="text" class="from" placeholder="Van.." value="<?=isset($day->time2)? $day->time2->from : '' ?>">
                                <input type="text" class="to" placeholder="Tot .." value="<?=isset($day->time2)? $day->time2->to : '' ?>">
                                <div class="gButton">
                                    <img src="<?php echo plugins_url('/autotrack/images/remove.png') ?>" alt="remove">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Geef hieronder per social media de locatie op, indien deze niet getoond moet worden laat het veld dan leeg.</p>
            <?php $socials = get_option('at_social_icons');
            ?>
            <input type="hidden" name="at_social_icons" id="at_social_icons" value='<?=$socials ?>'>
            <div class="row">
                <div class="col-sm-8">
                    <div class="atSocialIcons">
                        <?php $social_rows = json_decode($socials);
                        foreach($social_rows as $row): ?>
                            <div class="atSIRow">
                                <div class="atSIName"><?=$row->name ?></div>
                                <div class="atSIurl">
                                    <input type="text" class="atSIinput form-control" value="<?=$row->url ?>">
                                </div>
                                <div class="smIcon">
                                    <div class="iconHolder"><?php if(isset($row->icon_url)) echo '<img src="'.$row->icon_url.'" alt="'.$row->name.'">' ?></div>
                                </div>
                                <div class="smButton">
                                    <button class="button uploadSocialIcon button-primary">Nieuwe afbeelding uploaden</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>In get gebied hieronder is de contactinformatie te beheren.</p>
            <div class="row">
                <div class="col-sm-6">
                    <?php $contact_info = get_option('at_contact_info') ?>
                    <?php wp_editor($contact_info, 'contcat_info', array(
                        'textarea_name' => 'at_contact_info',
                        'editor_height' => 150
                    )) ?>
                </div>
            </div>
<!--            <div class="row">-->
<!--                <div class="col-sm-7">-->
<!--                    <div class="shortDelimeter"></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <p>Geef hier de tekst op van de bedankpagina, de URL hiervan kan niet worden gewijzigd.</p>-->
<!--            <div class="row">-->
<!--                <div class="col-sm-6">-->
<!--                    --><?php //$thank_you_text = get_option('at_thank_you_text') ?>
<!--                    --><?php //wp_editor($thank_you_text, 'thank_you_text', array(
//                        'textarea_name' => 'at_thank_you_text',
//                        'editor_height' => 150
//                    )) ?>
<!--                </div>-->
<!--            </div>-->


        </div>

        <?php submit_button('Opslaan'); ?>


    </form>
</div>
