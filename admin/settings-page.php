<div class="wrap at_page">
    <form method="post" action="options.php" id="settingsForm">
        <?php settings_fields( 'autotrack-settings-fields' ); ?>
        <?php do_settings_sections( 'autotrack-settings-fields' ); ?>
        <div class="fieldGroup">
            <div class="fieldGroupName">Informatie</div>
            <div class="row">
                <div class="col-sm-12">
                    <a href="#" class="showUserPassFields">Klik hier om de gebruikersnaam en / of wachtwoord aan te passen.</a>
                </div>
                <div class="col-sm-3">
                    <label for="at_username">Gebruikersnaam:</label>
                    <input class="form-control usernameApi" autocomplete="off" style="display: none" type="text" name="at_username" value="<?php echo esc_attr( get_option('at_username') ); ?>" />
                </div>
                <div class="col-sm-3">
                    <label for="at_password">Wachtwoord (wordt na het opslaan geleegd):</label>
                    <input class="form-control passwprdApi" autocomplete="off" style="display: none" type="text" name="at_password" value="" />
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <label for="at_dealer_id">Dealer ID: <br>(Geef meerdere IDs in door te scheiden met een komma.)</label>
                    <input class="form-control" type="text" name="at_dealer_id" value="" />
                    <?php //echo esc_attr( get_option('at_dealer_id') ); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="at_url_page_adverts">URL naar pagina occasions:</label>
                    <input class="form-control" type="text" name="at_url_page_adverts" value="<?php echo esc_attr( get_option('at_url_page_adverts') ); ?>" />
                </div>
                <div class="col-sm-3">
                    <?php $period = get_option('at_period_after_sell'); ?>
                    <label for="at_period_after_sell">Aantal dagen verkochte tonen (0 - 30):</label>
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
            <div class="row">

            </div>

            <p>Stel de gewenste kleur in voor de prijzen weergave.</p>
            <div class="row">
<!--                <div class="col-sm-2">-->
<!--                    <label for="at_font_color">Textkleur:</label>-->
<!--                    <input class="form-control" type="color" name="at_font_color" value="--><?php //echo esc_attr( get_option('at_font_color') ); ?><!--" />-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <label for="at_attribute_label">Attribuut-label kleur:</label>-->
<!--                    <input class="form-control" type="color" name="at_attribute_label" value="--><?php //echo esc_attr( get_option('at_attribute_label') ); ?><!--"/>-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <label for="at_attribute_value">Attribuut-warde kleur:</label>-->
<!--                    <input class="form-control" type="color" name="at_attribute_value" value="--><?php //echo esc_attr( get_option('at_attribute_value') ); ?><!--" />-->
<!--                </div>-->


            </div>
            <div class="row">
<!--                <div class="col-sm-2">-->
<!--                    <label for="at_header_color">Header kleur:</label>-->
<!--                    <input class="form-control" type="color" name="at_header_color" value="--><?php //echo esc_attr( get_option('at_header_color') ); ?><!--" />-->
<!--                </div>-->
<!--                <div class="col-sm-2">-->
<!--                    <label for="at_button_color">Knoppen kleur:</label>-->
<!--                    <input class="form-control" type="color" name="at_button_color" value="--><?php //echo esc_attr( get_option('at_button_color') ); ?><!--"/>-->
<!--                </div>-->
                <div class="col-sm-2">
                    <label for="at_price_color">Prijs kleur:</label>
                    <input class="form-control" type="color" name="at_price_color" value="<?php echo esc_attr( get_option('at_price_color') ); ?>"/>
                </div>

                

            </div>
            <br>
            <div class="row">
                <div class="col-sm-2">
                    <label for="show_btw">Excl btw:</label>
                </div>
            </div>

            <div class="row">
     
                    <?php $show_btw = get_option('show_btw'); ?>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="show_btw" value="1" <?php echo $show_btw == '1' ? 'checked="checked"' : '' ?>> Ja.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="show_btw" value="0" <?php echo $show_btw == '0' ? 'checked="checked"' : '' ?>> Nee.
                    </label>
                </div>
            
            </div>

        </div>


        <div class="fieldGroup">
            <div class="fieldGroupName">Homepagina</div>
            <p>Toon de volgende hoeveelheid occasions op de home-pagina:</p>

                <?php
                $at_number_of_occasions_on_home = get_option("at_number_of_occasions_on_home");
                $at_name_of_button_on_home = get_option("at_name_of_button_on_home");
                ?>
                <div class="col-md-3">
                    <div class="row">
                        <input type="number" class="form-control" name="at_number_of_occasions_on_home" value="<?php echo $at_number_of_occasions_on_home; ?>" style="height: 33px;">
                    </div>
                </div>
                <br>
                <p>Meer lezen knop label op homepagina:</p>

                 <div class="col-md-3">
                    <div class="row">
                        <input type="text" class="form-control" name="at_name_of_button_on_home" value="<?php echo $at_name_of_button_on_home; ?>" style="height: 33px;">
                    </div>
                </div>

            <br>
            <p>Welke advertenties dienen er op de homepagina getoond worden?</p>

            <br>
            <?php $at_home_cars = get_option('at_home_cars');

            ?>

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
            </div>


        <div class="fieldGroup">
            <div class="fieldGroupName">Occasions</div>
            <p>Hoe dienen de occasions standaard gesorteerd te zijn? Kies een waarde en vervolgens van hoog naar laag of laag naar hoog.</p>
            <?php $at_sort_by  = get_option('at_sort_by');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="total_price" <?php echo $at_sort_by == 'total_price' ? 'checked="checked"' : '' ?>> Prijs.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="brand" <?php echo $at_sort_by == 'brand' ? 'checked="checked"' : '' ?>> Merk, Model, Uitvoering.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="mileage" <?php echo $at_sort_by == 'mileage' ? 'checked="checked"' : '' ?>> Kilometerstand.
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="date_posted" <?php echo $at_sort_by == 'date_posted' ? 'checked="checked"' : '' ?>> Publicatiedatum.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_sort_by" value="construction_year" <?php echo $at_sort_by == 'construction_year' ? 'checked="checked"' : '' ?>> Bouwjaar.
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
            <p>Ga terug knop:</p>
            <?php
            $at_go_back_status = get_option('at_go_back_status');
            $at_go_back_text = get_option('at_go_back_text');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="checkbox" name="at_go_back_status" value="1" <?php echo $at_go_back_status == '1' ? 'checked="checked"' : '' ?>> Actief / Inactief.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="text" name="at_go_back_text" value="<?=$at_go_back_text?>" placeholder="Ga Terug" class="form-control">
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>
            <p>Hoe moet het overzicht weergegeven worden aan de bezoekers? Als een lijst of juist als tabel?</p>
            <div class="row">
                <?php $at_overview_layoutmode = get_option('at_overview_layoutmode');
                ?>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_overview_layoutmode" value="at_layout_overview_list" <?php echo $at_overview_layoutmode == 'at_layout_overview_list' ? 'checked="checked"' : '' ?>> Lijst.
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
            <p>Hoe wil je op de detailpagina de informatie van een occasion tonen?</p>
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
   
            <p>Hier kan de volgorde van de hieronder genoemde pagina's worden bepaald. Desgewenst zijn ze ook uit te schakelen.</p>
            <?php
            $sidebar_blocks = get_option('at_sidebar_blocks');
            $sidebar_blocks = json_decode($sidebar_blocks);
            $sidebar_blocks = at_object_to_array($sidebar_blocks);
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
                                    <div class="lbIcon"><img src="<?php echo plugins_url() ?>/<?php echo isset(explode('/', plugin_basename( __FILE__ ))[0]) ? explode('/', plugin_basename( __FILE__ ))[0] : 'autotrack'; ?>/images/move.png"></div>
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

            <div class="fieldGroupName">Contact formulier</div>
            <div class="row">
                <div class="col-md-6">
                <?php $at_form_short_code = get_option('at_form_short_code');?>
                    <input type='text' name='at_form_short_code' class='form-control' value='<?php echo $at_form_short_code; ?>' placeholder='Contact form shordcode ...'>
                </div>
            </div>
                  

            <div class="row">
                <div class="col-sm-7">
                    <div class="shortDelimeter"></div>
                </div>
            </div>

            <p>Geef hier de openingstijden in van uw bedrijf / locatie.</p>
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
                                    <img src="<?php echo plugins_url('/'.explode('/', plugin_basename( __FILE__ ))[0].'/images/add.png') ?>" alt="add">
                                </div>
                            </div>
                            <div class="gOrar2" <?php echo isset($day->time2) ? 'style="visibility: visible"' : '' ?> >
                                <input type="text" class="from" placeholder="Van.." value="<?=isset($day->time2)? $day->time2->from : '' ?>">
                                <input type="text" class="to" placeholder="Tot .." value="<?=isset($day->time2)? $day->time2->to : '' ?>">
                                <div class="gButton">
                                    <img src="<?php echo plugins_url('/'.explode('/', plugin_basename( __FILE__ ))[0].'/images/remove.png') ?>" alt="remove">
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
            <p>Hier kan per social media kanaal een logo naar wens worden ingesteld.<br>Daarnaast is het ook mogelijk om eventuele kanalen te verbergen.</p>
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
                                    <div class="socialSwither activeInput"><input type="checkbox"<?=$row->active == 1 ? ' checked':'' ?>></div>
                                    <input type="text" class="atSIinput form-control" value="<?=$row->active == 1 ? '1':'0' ?>" style="display: none">
                                </div>
                                <div class="smIcon">
                                <?php
                                    if(isset($row->icon_url)){
                                        ?>
                                        <div class="deleteWraper">
                                         <a href="#" class="delete_icon">
                                             <i class="fa fa-trash" aria-hidden="true"></i>
                                         </a>
                                        </div>
                                        <?php
                                    }
                                ?>
                                
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

            <p>Kies tussen een tekstgebied of informatie uit de API:</p>
            <?php $at_addres_info = get_option('at_addres_info');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_addres_info" value="from_text_area" <?php echo $at_addres_info == 'from_text_area' ? 'checked="checked"' : '' ?>> Tekstgebied.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="at_addres_info" value="from_api" <?php echo $at_addres_info == 'from_api' ? 'checked="checked"' : '' ?>> API.
                    </label>
                </div>
            </div>

            <p>In het gebied hieronder is de contactinformatie te beheren.</p>
            <div class="row">
                <div class="col-sm-6">
                    <?php $contact_info = get_option('at_contact_info') ?>
                    <?php wp_editor($contact_info, 'contcat_info', array(
                        'textarea_name' => 'at_contact_info',
                        'editor_height' => 150
                    )) ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">Toon na het invullen van het contactformulier een bedankpagina of bericht:</div>
                <?php $page_text = get_option('thx_mess');
                ?>
                <br>
                <br>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="thx_mess" class="thxPage" value="thx_page" <?php echo $page_text == 'thx_page' ? 'checked="checked"' : '' ?>> Bedankpagina.
                    </label>
                </div>
                <div class="col-sm-2">
                    <label class="radio-inline">
                        <input type="radio" name="thx_mess" class="thxPage" value="thx_text" <?php echo $page_text == 'thx_text' ? 'checked="checked"' : '' ?>> Bedankbericht.
                    </label>
                </div>
            
                <br>
                <br>
                <div class="col-md-12 at_link_to_thx_pageLabel"  style="<?php if($page_text == 'thx_page'){ echo "display:block;";  }else{  echo "display:none;"; } ?>">URL van de bedankpagina:</div>
                <br>
                <br>
                <div class="col-md-6 at_link_to_thx_page" style="<?php if($page_text == 'thx_page'){ echo "display:block;";  }else{  echo "display:none;"; } ?>">
                <?php $at_link_to_thx_page = get_option('at_link_to_thx_page'); ?>
                    <input type="text" name="at_link_to_thx_page" class="form-control" value="<?=$at_link_to_thx_page?>">
                </div>
                <br>
                <br>
                
                <div class="col-md-12 at_thank_you_textLabel" style="<?php if($page_text == 'thx_text'){ echo "display:block;";  }else{  echo "display:none;"; } ?>" >Geef hier de tekst op van het bedankbericht:</div>
                <br>
                <br>
                <div class="col-sm-6 at_thank_you_text" style="<?php if($page_text == 'thx_text'){ echo "display:block;";  }else{  echo "display:none;"; } ?>">
                    <?php $contact_info = get_option('at_thank_you_text') ?>
                    <?php wp_editor($contact_info, 'at_thank_you_text', array(
                            'textarea_name' => 'at_thank_you_text',
                            'editor_height' => 150
                    )) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <br>
                <br>
                 <h3>Financial Lease iFrame</h3>
                 <?php $at_iframe = get_option('at_iframe'); ?>
                <textarea name="at_iframe" class="form-control" style="height: 200px;">
                    <?=$at_iframe?>
                </textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <br>
                    <br>
                    <h3>Codes</h3>
                    <p>Toon alle occasions: <b>[occasions_list]</b></p>
                    <p>Toon alle bedrijfswagens: <b>[occasions_list  carrosserievorm="bedrijfswagen"]</b></p>
                    <p>Toon occasions op home-page: <b>[home_occasions]</b></p>
                    <p>Openingstijden: <b>[open_hours_company]</b></p>
                    <p>Home filter: <b>[home_filter]</b></p>
                </div>
            </div>
        </div>
        <!-- settingSubmitButton -->
            <input type="submit" name="submit" id="submit" class="button button-primary settingSubmitButton" value="Opslaan">
    </form>
</div>
