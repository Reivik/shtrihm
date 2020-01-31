<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/filial_template.php");?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<form class="protection lk" method="post" action="<?=POST_FORM_ACTION_URI?>" name="change_profile" enctype="multipart/form-data">	
	<?=bitrix_sessid_post()?>
	<div class="logo_company">
		<table>
			<tr>
				<td>
					<img src="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["src"]?>" title="<?=$arResult["COMPANY"]["NAME"]?>" alt="<?=$arResult["COMPANY"]["NAME"]?>" width="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["COMPANY"]["PREVIEW_PICTURE"]["height"]?>" />
				</td>
			</tr>
		</table>
	</div>
	<div class="description_fields">
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[NAME]" value="<?=isset($_REQUEST["COMPANY"]["NAME"]) ? htmlspecialchars($_REQUEST["COMPANY"]["NAME"]) : ($arResult["COMPANY"]["NAME"])?>" />
			</div>
		</div>
		<div class="field">
			<label 	class="field_label"><?=GetMessage("COMPANY_LOGO")?></label>
			<div class="input file">
				<div class="input-files">
					<input type="text" />
					<a href="#"><?=GetMessage("DOWNLOAD")?></a>
					<input type="file" name="COMPANY_LOGO" />
				</div>
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_SLOGAN")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][SLOGAN]" value="<?=isset($_REQUEST["COMPANY"]["SLOGAN"]) ? htmlspecialchars($_REQUEST["COMPANY"]["SLOGAN"]) : ($arResult["COMPANY"]["SLOGAN"])?>" />
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?//pr($arResult["COMPANY"]["DIRECTION"]);?>
	<div class="field profile">
		<div class='section_registration'>
			<div id='name_section_reg'>
				<?=GetMessage('COMPANY_DIRECTION')?>
				<img src='/design/images/selectR-new.png' title='Открыть' alt='Открыть' width='30' height='30' />
			</div>
			<div id='section_detail_reg'>
				<?$n = 0;?>
				<?foreach($arResult['SECTIONS'] as $key => $section):?>
					<?/*<div class='main_section'>
						<label class='label_check' for='checkbox_<?=$key?>'>
							<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$key?>' value='<?=$section['ID']?>' <?if(in_array($section['ID'], $_REQUEST['section']) || in_array($section['ID'], $arResult["COMPANY"]["DIRECTION"])):?> checked='checked' <?endif;?> type='checkbox'><?=$section['NAME']?>
						</label>
						<div class='clear'></div>
						<?foreach($section['ITEMS'] as $k => $item):?>
							<?if($k == 0 || ($k+1)%4 == 0):?>
								<div class='line'>
							<?endif;?>
								<div class='second_section <?if(($k+1)%3 == 0):?> last <?endif;?>'>
									<label class='label_check' for='checkbox_<?=$key?>'>
										<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$item['ID']?>' value='<?=$item['ID']?>' <?if(in_array($item['ID'], $_REQUEST['COMPANY']['PROPERTY_VALUES']['DIRECTION']) || in_array($item['ID'], $arResult["COMPANY"]["DIRECTION"])):?> checked='checked' <?endif;?> type='checkbox'><?=$item['NAME']?>
									</label>
									<div class='clear'></div>
								</div>
							<?if(!isset($section['ITEMS'][$k+1]) || ($k+1)%3 == 0):?>
								</div>
							<?endif;?>
						<?endforeach;?>
						<div class='clear'></div>
					</div>*/?>
					
					<div class='main_section'>
						<label class='label_check' for='checkbox_<?=$key?>'>
							<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$section['ID']?>' value='<?=$section['ID']?>' <?if(in_array($key, $_REQUEST['section']) || in_array($key, $arResult["COMPANY"]["DIRECTION"])):?> checked='checked' <?endif;?> type='checkbox'><?=$section['NAME']?>
						</label>
						<div class='clear'></div>
						<?foreach($section['ITEMS'] as $k => $item):?>
							<?if($k == 0 || ($k+1)%4 == 0):?>
								<div class='line'>
							<?endif;?>
								<div class='second_section <?if(($k+1)%3 == 0):?> last <?endif;?>'>
									<label class='label_check' for='checkbox_<?=$section['ID']?>'>
										<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$item['ID']?>' value='<?=$item['ID']?>' <?if(in_array($item['ID'], $_REQUEST['COMPANY']['PROPERTY_VALUES']['DIRECTION']) || in_array($item['ID'], $arResult["COMPANY"]["DIRECTION"])):?> checked='checked' <?endif;?> type='checkbox'><?=$item['NAME']?>
									</label>
									<div class='clear'></div>
									<?if(!empty($item["ITEMS"])):?>
										<div class="third_section">
											<?foreach($item['ITEMS'] as $k_2 => $item_2):?>
												<label class='label_check' for='checkbox_<?=$item["ID"]?>'>
													<input name='COMPANY[PROPERTY_VALUES][DIRECTION][]' id='checkbox_<?=$item_2['ID']?>' value='<?=$item_2['ID']?>' <?if(in_array($item_2['ID'], $_REQUEST['COMPANY']['PROPERTY_VALUES']['DIRECTION']) || in_array($item_2['ID'], $arResult["COMPANY"]["DIRECTION"])):?> checked='checked' <?endif;?> type='checkbox'><?=$item_2['NAME']?>
												</label>
											<?endforeach;?>
										</div>
									<?endif;?>
								</div>
							<?if(!isset($section['ITEMS'][$k+1]) || ($k+1)%3 == 0):?>
								</div>
							<?endif;?>
						<?endforeach;?>
						<div class='clear'></div>
					</div>
				<?endforeach;?>
				<div class='clear'></div>
			</div>
		</div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_PREVIEW_TEXT")?></label>
		<div class="textareaContainer">
			<textarea name="COMPANY[PREVIEW_TEXT]"><?=isset($_REQUEST["COMPANY"]["PREVIEW_TEXT"]) ? $_REQUEST["COMPANY"]["PREVIEW_TEXT"] : str_replace("<br />", "", $arResult["COMPANY"]["PREVIEW_TEXT"])?></textarea>
		</div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_DETAIL_TEXT")?></label>
		<div class="textareaContainer">
			<textarea name="COMPANY[DETAIL_TEXT]"><?=isset($_REQUEST["COMPANY"]["DETAIL_TEXT"]) ? $_REQUEST["COMPANY"]["DETAIL_TEXT"] : str_replace("<br />", "\n\r", $arResult["COMPANY"]["DETAIL_TEXT"])?></textarea>
		</div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_NUMBER_PERSON")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][NUMBER_OF_STAFF]" value="<?=isset($_REQUEST["COMPANY"]["NUMBER_OF_STAFF"]) ? htmlspecialchars($_REQUEST["COMPANY"]["NUMBER_OF_STAFF"]) : ($arResult["COMPANY"]["NUMBER_OF_STAFF"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("COMPANY_OBOROT")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][OBOROT]" value="<?=isset($_REQUEST["COMPANY"]["OBOROT"]) ? htmlspecialchars($_REQUEST["COMPANY"]["OBOROT"]) : ($arResult["COMPANY"]["OBOROT"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<h3><?=GetMessage("COMPANY_STATUS")?></h3>
	<?$n = 0;?>
	<?foreach($arResult["STATUS"] as $key => $status):?>
		<?if(($n+1)%4 == 0 || $n == 0 || !isset($arResult["STATUS"][$n+1])):?>
			<div class="three_input_container">
		<?endif;?>
			<div class="field <?if(($n+1)%3 == 0):?> last <?endif;?>">
				<label class="label_check" for="c_status_<?=$key?>">
					<input name="COMPANY[FILIALS][main][status][]" <?if((isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["status"]) && in_array($key, $_REQUEST["COMPANY"]["FILIALS"]["main"]["status"])) || (!isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["status"]) && in_array($key, $arResult["COMPANY"]["FILIALS"]["main"]["status"]))):?> checked="checked" <?endif;?> id="c_status_<?=$key?>" type="checkbox" value="<?=$key?>" />
					<?=$status?>
				</label>
			</div>
		<?if(($n+1)%3 == 0 || $n == count($arResult["STATUS"]) || !isset($arResult["STATUS"][$n+1])):?>
			</div>
		<?endif?>
		<?$n++;?>
	<?endforeach;?>			
	<div class="clear"></div>
	
	<h3><?=GetMessage("COMPANY_ADDRESS")?></h3>
	<div class="three_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("REGION")?></label>
			<select name="COMPANY[FILIALS][main][region]" class="region" title="main_filial">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
					<option value="<?=$key?>" <?if((isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]) && $key == $_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]) || (!isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]) && $key == $arResult["COMPANY"]["FILIALS"]["main"]["region"])):?> selected="selected" <?endif;?>>
						<?=$region?>
					</option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("TOWN")?></label>			
			<?if(isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]))
				$towns = $arResult["TOWNS"][$_REQUEST["COMPANY"]["FILIALS"]["main"]["region"]];
			else $towns = $arResult["TOWNS"][$arResult["COMPANY"]["FILIALS"]["main"]["region"]];?>
			<select name="COMPANY[FILIALS][main][town]" class="town" id="main_filial">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($towns as $k => $town):?>
					<option value="<?=$k?>" <?if((isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["town"]) && $k == $_REQUEST["COMPANY"]["FILIALS"]["main"]["town"]) || (!isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["town"]) && $k == $arResult["COMPANY"]["FILIALS"]["main"]["town"])):?> selected="selected" <?endif;?>><?=$town?></option>
				<?endforeach;?>
			</select>			
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("ADDRESS")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[FILIALS][main][address]" value="<?=isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["address"]) ? htmlspecialchars($_REQUEST["COMPANY"]["FILIALS"]["main"]["address"]) : ($arResult["COMPANY"]["FILIALS"]["main"]["address"])?>" />
			</div>
			<input type="hidden" name="COMPANY[FILIALS][main][office]" value="<?=$arResult["COMPANY"]["FILIALS"]["main"]["office"] ? $arResult["COMPANY"]["FILIALS"]["main"]["office"] : "Головной офис"?>" />
		</div>
	</div>
	<div class="clear"></div>
	
	
	<h3><?=GetMessage("COMPANY_CONACTS")?></h3>	
	<div class="three_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_emain" name="COMPANY[FILIALS][main][phone]" value="<?=isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["phone"]) ? htmlspecialchars($_REQUEST["COMPANY"]["FILIALS"]["main"]["phone"]) : ($arResult["COMPANY"]["FILIALS"]["main"]["phone"])?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_emain last" name="COMPANY[FILIALS][main][email]" value="<?=isset($_REQUEST["COMPANY"]["FILIALS"]["main"]["email"]) ? htmlspecialchars($_REQUEST["COMPANY"]["FILIALS"]["main"]["email"]) : ($arResult["COMPANY"]["FILIALS"]["main"]["email"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("COMPANY_WEBSITE")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][SITE]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["SITE"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["SITE"]) : ($arResult["COMPANY"]["SITE"])?>" />
			</div>	
		</div>
		<input type="hidden" name="COMPANY[FILIALS][main][id]" value="<?=$arResult["COMPANY"]["FILIALS"]["main"]["id"]?>" />		
		<div class="clear"></div>
	</div>
	<h3><?=GetMessage("COMPANY_DETAILS")?></h3>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_LEGAL_ADDRESS")?></label>
		<div class="inputContainer">
			<input type="text" name="COMPANY[PROPERTY_VALUES][LEGAL_ADDRESS]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["LEGAL_ADDRESS"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["LEGAL_ADDRESS"]) : $arResult["COMPANY"]["LEGAL_ADDRESS"]?>" />
		</div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][INN]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["INN"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["INN"]) : $arResult["COMPANY"]["INN"]?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("COMPANY_KPP")?></label>
			<div class="inputContainer">
				<input type="text" name="COMPANY[PROPERTY_VALUES][KPP]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["KPP"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["KPP"]) : $arResult["COMPANY"]["KPP"]?>" />
			</div>	
		</div>		
		<div class="clear"></div>
	</div>	
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_RASCH_SHCET")?></label>
		<div class="inputContainer">
			<input type="text" name="COMPANY[PROPERTY_VALUES][PAYMENT_ACCOUNT]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["PAYMENT_ACCOUNT"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["PAYMENT_ACCOUNT"]) : $arResult["COMPANY"]["PAYMENT_ACCOUNT"]?>" />
		</div>	
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_KORR_SCHET")?></label>
		<div class="inputContainer">
			<input type="text" name="COMPANY[PROPERTY_VALUES][CORR_ACCOUN]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["CORR_ACCOUN"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["CORR_ACCOUN"]) : $arResult["COMPANY"]["CORR_ACCOUN"]?>" />
		</div>	
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_BIK")?></label>
		<div class="inputContainer">
			<input type="text" name="COMPANY[PROPERTY_VALUES][BIK]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["BIK"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["BIK"]) : $arResult["COMPANY"]["BIK"]?>" />
		</div>	
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("COMPANY_BANK")?></label>
		<div class="inputContainer">
			<input type="text" name="COMPANY[PROPERTY_VALUES][BANK]" value="<?=isset($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["BANK"]) ? htmlspecialchars($_REQUEST["COMPANY"]["PROPERTY_VALUES"]["BANK"]) : $arResult["COMPANY"]["BANK"]?>" />
		</div>	
	</div>
	<div class="about filial_personal">
		<h3><?=GetMessage("COMPANY_FILIALS")?></h3>
		<?if($arResult["COMPANY"]["FILIALS"]):?>
			<table>
				<tr>
					<th><?=GetMessage("FILIALS_DATA")?></th>
					<th></th>
				</tr>
				<?if(!empty($_REQUEST["COMPANY"]["FILIALS"]))
					$filials_company = $_REQUEST["COMPANY"]["FILIALS"];
				elseif(!empty($arResult["COMPANY"]["FILIALS"]))
					$filials_company = $arResult["COMPANY"]["FILIALS"];
				//pr($filials_company);	
				?>
				<?foreach($filials_company as $key => $filial):?>
					<?if($key != "main"):?>
						<tr class="filials">
							<td class="filial_description">
								<label class="field_label"><?=GetMessage("STATUS")?></label>
								<div class="clear"></div>									
								<?$n = 0;?>
								<?foreach($arResult["STATUS"] as $key_stat => $status):?>
									<div class="field <?if(($n+1)%2 == 0):?> last <?endif;?>">
										<label class="label_check" for="c_status_<?=$key_stat?>">
											<input name="COMPANY[FILIALS][<?=$key?>][status][]"<?if(in_array($key_stat, $filial["status"])):?> checked="checked" <?endif;?> id="c_status_<?=$key_stat?>" type="checkbox" value="<?=$key_stat?>" />
											<?=$status?>
										</label>
									</div>
									<?$n++;?>
								<?endforeach;?>
								<div class="clear"></div>
								
								<div class="regions_towns">
									<div class="field">
										<label class="field_label"><?=GetMessage("REGION")?></label>
										<select class="select_remake region" name="COMPANY[FILIALS][<?=$key?>][region]" title="filial_region_<?=$key?>_">
											<?/*<option value="0"><?=GetMessage("REGION")?></option>*/?>
											<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $r => $region):?>
												<option value="<?=$r?>" <?if($r == $filial["region"]):?> selected="selected" <?endif;?> ><?=$region?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class="field last">
										<label class="field_label"><?=GetMessage("TOWN")?></label>
										<select class="select_remake town" name="COMPANY[FILIALS][<?=$key?>][town]" id="filial_region_<?=$key?>_">
											<?/*option value="0"><?=GetMessage("TOWN")?></option*/?>
											<?foreach($arResult["TOWNS"][$filial["region"]] as $t => $town):?>
												<option value="<?=$t?>" <?if($t == $filial["town"]):?> selected="selected" <?endif;?> ><?=$town?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class="clear"></div>
								</div>
								
								<div class="field">
									<label class="field_label"><?=GetMessage("ADDRESS")?></label>
									<div class="inputContainer">
										<input type="text" name="COMPANY[FILIALS][<?=$key?>][address]" value="<?=htmlspecialchars($filial["address"])?>" />
									</div>
								</div>
								<div class="field last">
									<label class="field_label"><?=GetMessage("OFFICE")?></label>
									<select class="select_remake" name="COMPANY[FILIALS][<?=$key?>][office]">
										<?foreach($arResult["OFFICE"] as $of):?>
											<option value="<?=$of?>" <?if($of == $filial["office"]):?> selected="selected" <?endif;?> ><?=$of?></option>
										<?endforeach;?>
									</select>
								</div>
								<div class="clear"></div>
								
								
								<div class="field">
									<label class="field_label"><?=GetMessage("PHONE")?></label>
									<div class="inputContainer">
										<input type="text" class="phone" name="COMPANY[FILIALS][<?=$key?>][phone]" value="<?=htmlspecialchars($filial["phone"])?>" />
									</div>
								</div>
								<div class="field last">
									<label class="field_label"><?=GetMessage("EMAIL")?></label>
									<div class="inputContainer">
										<input type="text" name="COMPANY[FILIALS][<?=$key?>][email]" value="<?=htmlspecialchars($filial["email"])?>" />
									</div>
								</div>
								<div class="clear"></div>
							</td>
							<td class="delete_button">
								<input type="hidden" class="filial_id" name="COMPANY[FILIALS][<?=$key?>][id]" value="<?=$filial["id"]?>" />
								<button id="rem_f" class="del_filial" type="button">
									<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
								</button>	
							</td>
						</tr>
						<div class="c_fillials"></div>
					<?endif;?>
				<?endforeach;?>	
			</table>
		<?endif;?>
		<button id="add_filial_personal" class="add_filial" type="button"><?=GetMessage("ADD_FILIAL")?></button>
	</div>
	<?if(!empty($arResult["COMPANY"]["PARTNERS_LEVELS"])):?>
		<div class="two_input_container levels">
			<div class="field">
				<h3><?=GetMessage("PARTNER_LEVEL");?></h3>
			</div>
			<div class="field last">
				<ul>
					<?foreach($arResult["COMPANY"]["PARTNERS_LEVELS"] as $key => $level):?>
						<input type="hidden" name="COMPANY[PROPERTY_VALUES][PARTNERS_LEVELS][]" value="<?=$key?>" />
						<li><?=$level?></li>
					<?endforeach;?>
				</ul>
			</div>		
			<div class="clear"></div>
		</div>
	<?endif;?>
	<button type="submit" name="changeCompany">Сохранить изменения</button>
</form>