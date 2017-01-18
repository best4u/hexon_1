<pre>
    <?php var_dump($ocassion); ?>
</pre>
        <div class="overview_gridWrapp">
			<div class="breadCrumbWrapp">
				<div class="centerDiv">
					<div class="breadContent">
						<a href="#"><span>Home</span></a> <span class="arrowBread"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span> <a href="#"><span class="activeBread">Occasions</span></a> <span class="rightBCSpan">Terug naar het overzicht • <a href="#">Print deze pagina</a></span>
					</div>					
				</div>
			</div>

			<div class="leftAndRightWrapp singleItemWrapp">
	        	<div class="centerDiv">				
	        		<div class="leftContent_at">
	        			<div class="detailPage">
		        			<div class="carTitleTop">
                                <?php echo $ocassions_obj->get_car_name($ocassion); ?>
		        			</div>	 
							
							<div class="sliderAndDesc">
								<div class="leftSlideBlock">
									<div class="fotorama"  data-nav="thumbs" data-allowfullscreen="true">
                                        <?php
                                        foreach($ocassions_obj->get_all_images($ocassion) as $foto){
                                            ?>
                                            <a href="<?php echo $foto?>"><img src="<?php echo $foto?>" width="75" height="75"></a>
                                            <?php
                                        }
                                        ?>
									</div>
								</div>

								<div class="rightDescBlock">
									<div class="priceandLogo">
        								<div class="priceCarItem">€ <?php echo $ocassions_obj->get_car_price($ocassion); ?></div>
        								<div class="logoCarItem">
                                            <img src="<?php echo plugins_url("img/NAP_Logo.jpg",__FILE__) ?>" alt="">
        								</div>
        							</div>

        							<div class="detailDesc">
        								<div class="leftDetailDesc">
                                            <?php
                                            foreach($ocassions_obj->get_sumary_detail_attr($ocassion) as $key => $option)
                                            {
                                                foreach($option as $type =>  $car_option)
                                                {
                                                    ?>
                                                    <p><?php echo $type; ?>:</p>
                                                    <?php
                                                }

                                            }
                                            ?>
        								</div>
        								<div class="rightDetailDesc">
                                            <?php
                                            foreach($ocassions_obj->get_sumary_detail_attr($ocassion) as $key => $option)
                                            {
                                                foreach($option as $type =>  $car_option)
                                                {
                                                    $timestamp = strtotime($car_option);
                                                    if($timestamp){
                                                        ?>
                                                        <p><?php echo date('d/m/Y',strtotime($car_option)); ?></p>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <p><?php echo $car_option ?></p>
                                                        <?php
                                                    }
                                                }

                                            }
                                            ?>
        								</div>
        							</div>
								</div>
							</div>


							<div class="omschriving">
								<div class="titleOms commTitle26">
									Omschrijving
								</div>
								<div class="descOms commDesc">
                                        <?php
                                        $description = explode(".",$ocassion->mededelingen);

                                       foreach($description as $text){
                                           ?>
                                               <p>
                                                    <?php
                                                    if(strpos($text,"##") > 0){
                                                        $options = explode("*",$text);
                                                        foreach($options as $option){
                                                            ?>
                                                                <p>
                                                                    * <?php echo $option; ?>
                                                                </p>
                                                            <?php
                                                        }

                                                    }else{
                                                        echo $text;
                                                    }

                                                    ?>.
                                                </p>
                                           <?php
                                       }
                                        ?>
								</div>
							</div>


							
							<hr class="lineAll">

							<div class="optionsAccesories">
								<div class="optAccTitle commTitle26">
									Opties en Accessoires
								</div>

								<div class="descOptAcc">
									<div class="optieAccItem">
										<div class="titleOptieAcc commTitleBlue">
											Veiligheid
										</div>

										<ul class="commList commDesc">
											<li>ABS</li>
											<li>Airbags</li>
											<li>Alarmsysteem</li>
											<li>Centrale deurvergrendeling</li>
											<li>Getint glas</li>
											<li>Startonderbreker</li>
											<li>Stuurbekrachtiging</li>
											<li>Toerenteller</li>
										</ul>

										<div class="titleOptieAcc commTitleBlue">
											Audio / Telefonie
										</div>

										<ul class="commList commDesc">
											<li>Audio installatie MP3</li>
											<li>Audio installatie radio CD</li>
											<li>Radio-voorbereiding</li>
										</ul>
									</div>

									<div class="optieAccItem">
										<div class="titleOptieAcc commTitleBlue">
											Exterieur
										</div>

										<ul class="commList commDesc">
											<li>ABS</li>
											<li>Airbags</li>
											<li>Alarmsysteem</li>
											<li>Centrale deurvergrendeling</li>
											<li>Getint glas</li>
											<li>Startonderbreker</li>
											<li>Stuurbekrachtiging</li>
											<li>Toerenteller</li>
										</ul>

										<div class="titleOptieAcc commTitleBlue">
											Verlichting
										</div>

										<ul class="commList commDesc">
											<li>Xenon Verlichting</li>
											<li>Derde remlicht</li>
											<li>Ledverlichting voor en achter</li>
										</ul>
									</div>

									<div class="optieAccItem">
										<div class="titleOptieAcc commTitleBlue">
											Veiligheid en Techniek
										</div>

										<ul class="commList commDesc">
											<li>Airbags Bestuurder en Passagier</li>
											<li>Airbags voor en side</li>
											<li>Alarmsysteem</li>
											<li>Alarmsysteem 1</li>
											<li>Antiblokkeersysteem (ABS)</li>
											<li>Centrale deurvergrendeling met afstandsbediening</li>
											<li>Getint glas</li>
											<li>Start / stop systeem</li>
											<li>Startblokkering</li>
											<li>Stuurbekrachting</li>
										</ul>

									</div>
								</div>
							</div>

							<hr class="lineAll">

							<div class="specificatiesBlock">
								<div class="titleSpecificaties commTitle26">
									Specificaties
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Algemeen
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
											<p>Transmissie</p>
											<p>Aantal versnellingen</p>
											<p>Aantal deuren</p>
											<p>Brandstof</p>
											<p>Soort voertuig</p>
											<p>Aantal zitplaatsen</p>
											<p>Exterieur kleur</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
											<p>Handmatig</p>
											<p>5</p>
											<p>5</p>
											<p>Bezine</p>
											<p>Personenauto</p>
											<p>4</p>
											<p>Metallic Ultra Blue</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Geschiedenis van deze auto
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
											<p>Transmissie</p>
											<p>Aantal versnellingen</p>
											<p>Aantal deuren</p>
											<p>Brandstof</p>
											<p>Soort voertuig</p>
											<p>Aantal zitplaatsen</p>
											<p>Exterieur kleur</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
											<p>Handmatig</p>
											<p>5</p>
											<p>5</p>
											<p>Bezine</p>
											<p>Personenauto</p>
											<p>4</p>
											<p>Metallic Ultra Blue</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Fabrieksgarantie
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Maten en gewichten
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
											<p>Transmissie</p>
											<p>Aantal versnellingen</p>
											<p>Aantal deuren</p>
											<p>Brandstof</p>
											<p>Soort voertuig</p>
											<p>Aantal zitplaatsen</p>
											<p>Exterieur kleur</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
											<p>Handmatig</p>
											<p>5</p>
											<p>5</p>
											<p>Bezine</p>
											<p>Personenauto</p>
											<p>4</p>
											<p>Metallic Ultra Blue</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Mileu
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Motor
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
											<p>Transmissie</p>
											<p>Aantal versnellingen</p>
											<p>Aantal deuren</p>
											<p>Brandstof</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
											<p>Handmatig</p>
											<p>5</p>
											<p>5</p>
											<p>Bezine</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Motor
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
										</div>
									</div>

									<hr class="lineAll">
								</div>

								<div class="descSpecificaties">
									<div class="algemenTitle commTitleBlue">
										Onderstel
									</div>

									<div class="descAlgemen commDesc">
										<div class="commLeftSpecific">
											<p>Kenteken</p>
											<p>Merk</p>
											<p>Model</p>
											<p>Uitvoering</p>
											<p>Carrosserievorm</p>
											<p>Transmissie</p>
											<p>Aantal versnellingen</p>
											<p>Aantal deuren</p>
										</div>

										<div class="commRightSpecific">
											<p>01-PVK-2</p>
											<p>Volvo</p>
											<p>R-Design</p>
											<p>122pk 6-speed handgeschakeld</p>
											<p>Hatchback</p>
											<p>Handmatig</p>
											<p>5</p>
											<p>5</p>
										</div>
									</div>
								</div>
							</div>


						<div class="garantiePart">
							<div class="titleOms commTitle26">
								Garanties
							</div>
							<div class="descOms commDesc">
								<ul class="commList commDesc">
									<li>AutoPass</li>
									<li>Onderhoudsboekjes</li>
								</ul>
							</div>
						</div>
						<hr class="lineAll"> 

						<div class="videoPart">
							<div class="titleVideo commTitle26">
								Video
							</div>
							<div class="desvVideo commDesc">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/nh0000VayrA" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
						<hr class="lineAll"> 


						<div class="contactFormBottom commForm">
							<div class="titleOms commTitle26">
								Je eigen auto inruilen
							</div>
							<div class="descFormBott commDesc">
								<div class="contactSubDesc">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sapien orci, blandit quis orci quis, dapibus semper lectus.
								</div>

								<form action="" class="bottomForm">
									<div class="plate">
										<img src="img/plate.png" alt="">
									</div>
									<p>
										<label for="km">Kilometerstand</label>
									</p>
									<p class="inputRel">
										<input type="text" placeholder="000.000">
									</p>
									<p>
										<label for="km">E-mailadres</label>
									</p>
									<p>
										<input type="email" placeholder="info@domeinnaam.nl">
									</p>
									<p>
										<label for="km">Telefoonnummer </label><span class="optionel">(optioneel)</span>
									</p>
									<p>
										<input type="tel" placeholder="+31 0000 000 000">
									</p>
									<p>
										<label for="km">Bericht</label>
									</p>
									<p>
										<textarea rows="10" cols="80" placeholder="Geef een korte beschrijving van de staat van de auto"></textarea>
									</p>
									<hr class="lineAll"> 

									<a href="#" class="button_at1">inruilvoorstel aanvragen</a>
								</form>
							</div>
						</div>
						

	        			</div>
	        		</div>








					<!-- sidebar -->
	        		<div class="sidebarContent">
	        			<div class="titleSidebarDetail">
	        				Neem contact met ons op
	        			</div>

	        			<div class="sidebarFilters">
	        				<form action="" class="sidebarForm">
	        					<p>
									<label for="">Uw naam</label>
								</p>
								<p>
									<input type="text" placeholder="John Doe">
								</p>

								<p>
									<label for="">E-mailadres</label>
								</p>
								<p>
									<input type="email" placeholder="johndoe@gmail.com">
								</p>

								<p>

								<p>
									<label for="">Telefoonnummer </label><span class="optionel">(optioneel)</span>
								</p>
								<p>
									<input type="tel" placeholder="+31 0000 000 000">
								</p>
								
								<p>
									<label for="km">Bericht</label>
								</p>
								<p>
									<textarea rows="14"  placeholder="Geef een korte beschrijving van de staat van de auto">Goedendag,
										Ik ben geïnteresseerd in uw 
										VOLVO V40 R-Design T2 122pk 

										Wilt u contact met mij opnemen?

										Met vriendelijke groet,
									</textarea>
								</p>
								
								<p>
									<label for="">Proefrit?</label>
								</p>
								<p>
									<input type="text" placeholder="John Doe">
								</p>

								<p>
									<label for="">Wanneer wilt u de proefrit maken??</label>
								</p>
								<p>
									<input type="text" placeholder="Kies een datum" class="dateInput">
								</p>



								<a href="#" class="button_at1">
									verzenden
								</a>


	        				</form>
	        			</div>
	        		</div>
	        		<!-- end sidebar -->
	        	</div>
        	</div>
        </div>
