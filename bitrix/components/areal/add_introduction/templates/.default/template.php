<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["success"] == "Y" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?else:?>
	<?if(!empty($arResult["ERROR"])):?>
		<?ShowError(implode("<br />", $arResult["ERROR"]));?>
	<?endif;?>
	<div class="input file clone" style="display: none;">
		<div class="input-files">
			<input type="text" placeholder="<?=GetMessage("COMPANY_PHOTO")?>" />
			<a href="#"><?=GetMessage("DOWNLOAD")?></a>
			<input type="file" name="INTRODUCTION_PHOTO__" />
		</div>
	</div>
	<div class="add_field clone" style="display: none;">
		<div class="two_input_container">
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][DOP_CHARS][][DESC]" value="" placeholder="<?=GetMessage("NAME_FIELD")?>" />
				</div>
			</div>		
			<div class="field last">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][DOP_CHARS][][VALUE]" value="" placeholder="<?=GetMessage("VALUE_FIELD")?>" />
				</div>	
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<a name="filter"></a>
	<form name="add_introduction" method="post" class="protection" action="<?=POST_FORM_ACTION_URI?>#filter" enctype="multipart/form-data">
		<?=bitrix_sessid_post()?>
		<h2><?=GetMessage("INTRODUCTION")?></h2>
		<div class="default_forms">
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[NAME]" value="<?=htmlspecialchars($_REQUEST["INTRODUCTION"]["NAME"])?>" placeholder="<?=GetMessage("INTRODUCTION_NAME")?>" />
				</div>
			</div>
			<h3><?=GetMessage("ADD_PHOTO")?></h3>
			<div class="photo_block">
				<div class="input file">
					<div class="input-files">
						<input type="text" placeholder="<?=GetMessage("COMPANY_PHOTO")?>" />
						<a href="#"><?=GetMessage("DOWNLOAD")?></a>
						<input type="file" name="PREVIEW_PHOTO" />
					</div>
				</div>
				<div class="input file">
					<div class="input-files">
						<input type="text" placeholder="<?=GetMessage("COMPANY_PHOTO")?>" />
						<a href="#"><?=GetMessage("DOWNLOAD")?></a>
						<input type="file" name="INTRODUCTION_PHOTO_1" value="" />
					</div>
				</div>
			</div>
			<button name="add_file" class="add"><?=GetMessage("ADD_FILE");?></button>
			<?if(!empty($arResult["TYPE_ACTIVITY"])):?>
				<div class="field">
					<select name="INTRODUCTION[PROPERTY][TYPE_ACTIVITY][VALUE]">
						<option value="0"><?=GetMessage("TYPE_OF_ACTIVITY")?></option>
						<?foreach($arResult["TYPE_ACTIVITY"] as $type_activity):?>
							<option value="<?=$type_activity["ID"]?>" <?if($type_activity["ID"] == $_REQUEST["INTRODUCTION"]["PROPERTY"]["TYPE_ACTIVITY"]["VALUE"]):?> selected="selected" <?endif;?> ><?=$type_activity["NAME"]?></option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
			<h3><?=GetMessage("OPEN_DATE")?></h3>
			<div class="date_field">		
				<div class="day field">
					<select name="day_from">
						<option value="0"><?=GetMessage("DAY")?></option>
						<?for($i = 1; $i < 32; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["day_from"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="month field">
					<select name="month_from">
						<option value="0"><?=GetMessage("MONTH")?></option>
						<?foreach($arResult["MONTH"] as $key => $month):?>
							<option value="<?=$key?>" <?if($_REQUEST["month_from"] == $key):?>selected="selected"<?endif;?>><?=$month?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="year field">
					<select name="year_from">
						<option value="0"><?=GetMessage("YEAR")?></option>
						<?for($i = 2002; $i < 2051; $i++) {?>
							<option value="<?=$i?>" <?if($_REQUEST["year_from"] == $i):?> selected="selected" <?endif;?> ><?=$i?></option>
						<?}?>
					</select>
				</div>
				<div class="clear"></div>
			</div>		
			<h3><?=GetMessage("ADDRESS_OBJ")?></h3>
			<div class="country-region-town">
				<div class="field">
					<?if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["COUNTRY"]))
						$sel_country = $_REQUEST["INTRODUCTION"]["PROPERTY"]["COUNTRY"];
					else $sel_country = $arResult["SELECTED_COUNTRY"];?>
					<select name="INTRODUCTION[PROPERTY][COUNTRY]" class="country" title="country_partner">
						<option value="0">Страна</option>
						<?foreach($arResult["COUNTRIES"] as $key => $country):?>
							<option value="<?=$key?>" <?if($sel_country == $key):?> selected="selected" <?endif;?> ><?=$country?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="two_input_container">
					<div class="field">
						<?if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["COUNTRY"]))
							$regions = $arResult["REGIONS"][$_REQUEST["INTRODUCTION"]["PROPERTY"]["COUNTRY"]];
						else $regions = $arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]];
						if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["REGION"]))
							$sel_region = $_REQUEST["INTRODUCTION"]["PROPERTY"]["REGION"];
						else $sel_region = $arResult["SELECTED_REGION"];?>
						<select name="INTRODUCTION[PROPERTY][REGION]" class="region" id="country_partner" title="region_intro">
							<option value="0">Регион</option>
							<?foreach($regions as $k => $region):?>
								<option value="<?=$k?>" <?if($sel_region == $k):?> selected="selected" <?endif;?> ><?=$region?></option>
							<?endforeach;?>
						</select>	
					</div>
					<div class="field last">
						<?if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["REGION"]))
							$towns = $arResult["TOWNS"][$_REQUEST["INTRODUCTION"]["PROPERTY"]["REGION"]];
						else $towns = $arResult["TOWNS"][$arResult["SELECTED_REGION"]];
						if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["CITY"]))
							$sel_town = $_REQUEST["INTRODUCTION"]["PROPERTY"]["CITY"];
						else $sel_town = $arResult["SELECTED_TOWN"];?>
						<select name="INTRODUCTION[PROPERTY][CITY]" class="town" id="region_intro">
							<option value="0">Город</option>
							<?foreach($towns as $k => $town):?>
								<option value="<?=$k?>" <?if($sel_town == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
							<?endforeach;?>
						</select>	
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][ADDRESS]" value="<?=htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["ADDRESS"])?>" placeholder="<?=GetMessage("ADDRESS")?>" />
				</div>
			</div>
			<?if(!empty($arResult["LOCATION"])):?>
				<div class="field">
					<select name="INTRODUCTION[PROPERTY][LOCATION][VALUE]">
						<option value="0"><?=GetMessage("LOCATION")?></option>
						<?foreach($arResult["LOCATION"] as $location):?>
							<option value="<?=$location["ID"]?>" <?if($location["ID"] == $_REQUEST["INTRODUCTION"]["PROPERTY"]["LOCATION"]["VALUE"]):?> selected="selected" <?endif;?> ><?=$location["NAME"]?></option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
			<?if(!empty($arResult["TYPE_INTRO"])):?>
				<div class="field">
					<select name="INTRODUCTION[PROPERTY][TYPE][VALUE]">
						<option value="0"><?=GetMessage("TYPE")?></option>
						<?foreach($arResult["TYPE_INTRO"] as $type_intro):?>
							<option value="<?=$type_intro["ID"]?>" <?if($type_intro["ID"] == $_REQUEST["INTRODUCTION"]["PROPERTY"]["TYPE"]["VALUE"]):?> selected="selected" <?endif;?> ><?=$type_intro["NAME"]?></option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
			<?if(!empty($arResult["CLIENTS"])):?>
				<div class="field">
					<select name="INTRODUCTION[PROPERTY][CLIENT]">
						<option value="0"><?=GetMessage("CLIENTS")?></option>
						<?foreach($arResult["CLIENTS"] as $client):?>
							<option value="<?=$client["ID"]?>" <?if($client["ID"] == $_REQUEST["INTRODUCTION"]["PROPERTY"]["CLIENT"]):?> selected="selected" <?endif;?> ><?=$client["NAME"]?></option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
			<?if(!empty($arResult["SOLUTIONS"])):?>
				<div class="field">
					<select name="INTRODUCTION[PROPERTY][SOLUTION]">
						<option value="0"><?=GetMessage("SOLUTIONS")?></option>
						<?foreach($arResult["SOLUTIONS"] as $solution):?>
							<option value="<?=$solution["ID"]?>" <?if($solution["ID"] == $_REQUEST["INTRODUCTION"]["PROPERTY"]["SOLUTION"]):?> selected="selected" <?endif;?> ><?=$solution["NAME"]?></option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
			<div class="two_input_container">
				<div class="field">
					<div class="inputContainer">
						<input type="text" name="INTRODUCTION[PROPERTY][NUMBER_OF_CHECKS]" value="<?=htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["NUMBER_OF_CHECKS"])?>" placeholder="<?=GetMessage("QUANTITY_PEOPLE")?>" />
					</div>
				</div>		
				<div class="field last">
					<div class="inputContainer">
						<input type="text" name="INTRODUCTION[PROPERTY][SQUARE]" value="<?=htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["SQUARE"])?>" placeholder="<?=GetMessage("SQUARE")?>" />
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<h3><?=GetMessage("DOP_CHARS")?></h3>
			<div class="field">
				<div class="user_fields">
					<?if(!empty($_REQUEST["INTRODUCTION"]["PROPERTY"]["DOP_CHARS"])):?>
						<?foreach($_REQUEST["INTRODUCTION"]["PROPERTY"]["DOP_CHARS"] as $key => $dop_chars):?>
							<div class="two_input_container">
								<div class="field">
									<div class="inputContainer">
										<input type="text" name="INTRODUCTION[PROPERTY][DOP_CHARS][<?=$key?>][DESC]" value="<?=htmlspecialchars($dop_chars["DESC"])?>" placeholder="<?=GetMessage("NAME_FIELD")?>" />
									</div>
								</div>		
								<div class="field last">
									<div class="inputContainer">
										<input type="text" name="INTRODUCTION[PROPERTY][DOP_CHARS][<?=$key?>][VALUE]" value="<?=htmlspecialchars($dop_chars["VALUE"])?>" placeholder="<?=GetMessage("VALUE_FIELD")?>" />
									</div>	
								</div>
								<div class="clear"></div>
							</div>
						<?endforeach;?>
					<?endif;?>
				</div>
				<button name="add_field" class="add"><?=GetMessage("ADD_FIELDS");?></button>
			</div>
			<div class="field">
				<div class="textareaContainer">
					<textarea name="INTRODUCTION[PREVIEW_TEXT]" maxlength="200" placeholder="<?=GetMessage("PREVIEW_TEXT")?>"><?=$_REQUEST["INTRODUCTION"]["PREVIEW_TEXT"]?></textarea>
				</div>
			</div>
			<div class="field">
				<div class="textareaContainer">
					<textarea name="INTRODUCTION[DETAIL_TEXT]" placeholder="<?=GetMessage("DETAIL_TEXT")?>"><?=$_REQUEST["INTRODUCTION"]["DETAIL_TEXT"]?></textarea>
				</div>
			</div>
			<?$n = 0;?>
			<div class="two_input_container product_introduction">
				<?foreach($arResult["PRODUCTS"] as $t => $type):?>
					<?$n++;?>
					<div class="field <?if($n == 2):?> last <?endif;?>">
						<h3><?=$arResult["TYPES"][$t]?></h3>
						<div class="products">
							<?foreach($type as $products):?>
								<label class="label_check" alt="sections" for="sections_<?=$products["ID"]?>">
									<input name="SECTIONS[<?=$products["ID"]?>]" id="sections_<?=$products["ID"]?>" value="1" type="checkbox" <?if($_REQUEST["SECTIONS"][$products["ID"]] == 1):?> checked="checked" <?endif;?>>
									<?=$products["NAME"]?>
								</label>				
								<?if(!empty($products["SECTIONS"])):?>
									<div class="prods sections_<?=$products["ID"]?>" <?if($_REQUEST["SECTIONS"][$products["ID"]] == 1):?> style="display: block;" <?endif;?>>
										<?foreach($products["SECTIONS"] as $sect):?>
											<label class="label_check" alt="items" for="products_<?=$sect["ID"]?>">
												<input name="PRODUCTS[<?=$sect["ID"]?>]" id="products_<?=$sect["ID"]?>" <?if($_REQUEST["PRODUCTS"][$sect["ID"]] == 1):?> checked="checked" <?endif;?> value="1" type="checkbox">
												<?=$sect["NAME"]?>
											</label>
											<?if(!empty($sect["ITEMS"])):?>
												<div class="item products_<?=$sect["ID"]?>" <?if($_REQUEST["PRODUCTS"][$sect["ID"]] == 1):?> style="display: block;" <?endif;?>>
													<?foreach($sect["ITEMS"] as $item):?>
														<label class="label_check" for="item_<?=$item["ID"]?>"><input name="INTRODUCTION[PROPERTY][<?=$t?>][<?=$item["ID"]?>]" id="item_<?=$item["ID"]?>" value="<?=$item["ID"]?>" type="checkbox" <?if(in_array($item["ID"], $_REQUEST["INTRODUCTION"]["PROPERTY"][$t])):?> checked="checked" <?endif;?>><?=$item["NAME"]?></label>
													<?endforeach;?>
												</div>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?endif;?>
							<?endforeach;?>
						</div>
					</div>
				<?endforeach;?>
				<div class="clear"></div>
			</div>
			<div class="field">
				<div class="textareaContainer">
					<textarea name="INTRODUCTION[PROPERTY][SERVICES]" placeholder="<?=GetMessage("SERVICE")?>"><?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["SERVICES"]?></textarea>
				</div>
			</div>
		</div>
		<input type="hidden" name="INTRODUCTION[PROPERTY][PARTNER]" value="<?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["PARTNER"] ? $_REQUEST["INTRODUCTION"]["PROPERTY"]["PARTNER"] : $arResult["PARTNER"]?>" />
		<?if(!isset($arResult["COMPANY_PARTNER"]) || !$arResult["COMPANY_PARTNER"]):?>
			<?/*<button id="add_intro_partner" class="add"><?=GetMessage("ADD_PARTNER")?></button>*/?>
			<h3><?=GetMessage("ADD_PARTNER")?></h3>
			<div class="partner_form">
				<div class="descr"><?=GetMessage("ADD_PARTNER")?></div>
				<div class="search">
					<div class="inputContainer">
						<input type="text" name="search_partner_name" placeholder="Поиск" value="<?=htmlspecialchars($_REQUEST["search"])?>" />
					</div>
					<button type="submit" name="search_partner" class="btn"><i></i> Найти</button>
				</div>
				<div class="clear"></div>
				<?if(!empty($arResult["PARTNERS"])):?>
					<div id="partners_list">
						<?foreach($arResult["PARTNERS"] as $key => $partner):?>
							<div class="partner <?if(($key+1)%3 == 0):?> last <?endif;?>">
								<input type="hidden" name="partner_id" value="<?=$partner["ID"]?>" />
								<table>
									<tr>
										<td class="img">
											<?if(!empty($partner["PREVIEW_PICTURE"])):?>
												<img src="<?=$partner["PREVIEW_PICTURE"]["src"]?>" width="<?=$partner["PREVIEW_PICTURE"]["width"]?>" height="<?=$partner["PREVIEW_PICTURE"]["height"]?>" title="<?=$partner["NAME"]?>" alt="<?=$partner["NAME"]?>" />
											<?else:?>
												<img src="/design/images/no-photo/pic58x58.png" alt="<?=$partner["NAME"]?>" title="<?=$partner["NAME"]?>" width="58" height="58" />
											<?endif;?>
										</td>
										<td>
											<span><?=$partner["NAME"]?></span>
										</td>
									</tr>
								</table>
							</div>
						<?endforeach;?>
						<div class="clear"></div>
					</div>
				<?endif;?>
			</div>
		<?endif;?>
		<h2><?=GetMessage("CONTACT_PERSON")?></h2>
		<div class="default_forms">
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][CONTACT_FIO]" value="<?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_FIO"] ? htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_FIO"]) : htmlspecialchars($arResult["COMPANY_PARTNER"]["NAME"])?>" placeholder="<?=GetMessage("CONTACT_PERSON_NAME")?>" />
				</div>	
			</div>
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][CONTACT_POSITION]" value="<?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_POSITION"] ? htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_POSITION"]) : htmlspecialchars($arResult["COMPANY_PARTNER"]["POSITION"])?>" placeholder="<?=GetMessage("CONTACT_PERSON_POSITION")?>" />
				</div>	
			</div>
			<div class="field">
				<div class="inputContainer">
					<input type="text" class="phone" name="INTRODUCTION[PROPERTY][CONTACT_PHONE]" value="<?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_PHONE"] ? htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_PHONE"]) : htmlspecialchars($arResult["COMPANY_PARTNER"]["PHONE"])?>" placeholder="<?=GetMessage("CONTACT_PERSON_PHONE")?>" />
				</div>	
			</div>
			<div class="field">
				<div class="inputContainer">
					<input type="text" name="INTRODUCTION[PROPERTY][CONTACT_EMAIL]" value="<?=$_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_EMAIL"] ? htmlspecialchars($_REQUEST["INTRODUCTION"]["PROPERTY"]["CONTACT_EMAIL"]) : htmlspecialchars($arResult["COMPANY_PARTNER"]["EMAIL"])?>" placeholder="<?=GetMessage("CONTACT_PERSON_EMAIL")?>" />
				</div>	
			</div>
		</div>
		<input type="submit" name="submit" class="orange_submit" value="<?=mb_strtoupper(GetMessage("SUBMIT"))?>" />
	</form>
<?endif;?>