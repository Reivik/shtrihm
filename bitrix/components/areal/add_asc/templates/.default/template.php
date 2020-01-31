<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<?if($_REQUEST["success"] != "yes"):?>
<h2><?=GetMessage("ANKETA")?></h2>
<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/directions.php");?>
<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/head.php");?>
<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/quantity.php");?>
<form method="post" class="protection" action="<?=POST_FORM_ACTION_URI?>" name="change_staff" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<h3><?=GetMessage("THE_LIST_OF_REQUIRED_DOCUMENTS")?></h3>
	<div class="default_forms">
		<label class="label_check" for="contract_cto">
			<input name="contract_cto" id="contract_cto" <?if(!empty($_REQUEST["contract_cto"])):?> checked <?endif;?> type="checkbox" value="1" />
			<?=GetMessage("CONTRACT_CTO")?>
		</label>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("CONTRACT_NUMBER")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CTO_CONTRACT_NUMBER]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CTO_CONTRACT_NUMBER"])?>" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("CONTRACT_DATE")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CTO_CONTRACT_DATE]" class="date_asc" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CTO_CONTRACT_DATE"])?>" />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<label class="label_check" for="contract_head">
			<input name="contract_head" id="contract_head" type="checkbox" <?if(!empty($_REQUEST["contract_head"])):?> checked <?endif;?> value="1" />
			<?=GetMessage("CONTRACT_HEAD")?>
		</label>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("CONTRACT_NUMBER")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][PARTNER_CONTRACT_NUMBER]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["PARTNER_CONTRACT_NUMBER"])?>" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("CONTRACT_DATE")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][PARTNER_CONTRACT_DATE]" class="date_asc" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["PARTNER_CONTRACT_DATE"])?>" />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
	</div>
	<h3><?=GetMessage("ABOUT_COMPANY")?></h3>
	<div class="default_forms">
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_NAME]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_NAME"])?>" />
			</div>	
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("COMPANY_INN")?></label>
			<div class="inputContainer">
				<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_INN]" class="number" maxlength="12" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_INN"])?>" />
			</div>	
		</div>
		<div class="three_input_container">		
			<div class="field">
				<label class="field_label"><?=GetMessage("REGION")?></label>
				<select name="RESULT[PROPERTY_VALUES][COMPANY_REGION]" title="region_of_activity" class="region">
					<option value="0">Регион</option>
					<?foreach($arResult["REGIONS"][$arResult["SELECTED_COUNTRY"]] as $key => $region):?>
						<option value="<?=$key?>" <?if((isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"]) && ($key == $_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"])) || (!isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"]) && $arResult["SELECTED_REGION"] == $key)):?> selected="selected" <?endif;?> ><?=$region?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="field">
				<?
					if(isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"]) && isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_TOWN"]))
						$town = $arResult["TOWNS"][$_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_REGION"]];
					else 
						$town = $arResult["TOWNS"][$arResult["SELECTED_REGION"]];
				?>
				<label class="field_label"><?=GetMessage("TOWN")?></label>			
				<select name="RESULT[PROPERTY_VALUES][COMPANY_TOWN]" id="region_of_activity" class="town">
					<option value="0">Город</option>
					<?foreach($town as $k => $town):?>
						<option value="<?=$k?>" <?if((isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_TOWN"]) && $k == $_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_TOWN"]) || ($arResult["SELECTED_TOWN"] == $k)):?> selected="selected" <?endif;?> ><?=$town?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("ADDRESS")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_ADDRESS]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_ADDRESS"])?>" />
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("PHONE")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_PHONE]" class="phone_asc"  value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_PHONE"])?>" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("EMAIL")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_EMAIL]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_EMAIL"])?>" />
				</div>	
			</div>		
			<div class="clear"></div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("SITE")?></label>
			<div class="inputContainer">
				<input type="text" name="RESULT[PROPERTY_VALUES][COMPANY_SITE]" value="<?=htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["COMPANY_SITE"])?>" />
			</div>
		</div>
	</div>
	<h3><?=GetMessage("CONTACT_INFORMATION_HEAD_OF_THE")?></h3>
	<div class="default_forms">
		<div class="add_contacts_header">
			<div class="five_input_container">
				<div class="field">
					<label class="field_label"><?=GetMessage("POSITION")?></label>
				</div>
				<div class="field">
					<label class="field_label"><?=GetMessage("FIO")?></label>
				</div>
				<div class="field">
					<label class="field_label"><?=GetMessage("PHONE")?></label>
				</div>
				<div class="field">
					<label class="field_label"><?=GetMessage("EMAIL")?></label>
				</div>
				<div class="clear"></div>
			</div>
			<?if(!empty($_REQUEST["RESULT"]["CONTACTS"])):?>
				<?foreach($_REQUEST["RESULT"]["CONTACTS"] as $key => $contacts):?>
					<div class="five_input_container">
						<div class="field">				
							<div class="inputContainer">
								<input type="text" name="RESULT[CONTACTS][<?=$key?>][POSITION]" value="<?=htmlspecialchars($contacts["POSITION"])?>" />
							</div>
						</div>
						<div class="field">
							<div class="inputContainer">
								<input type="text" name="RESULT[CONTACTS][<?=$key?>][FIO]" value="<?=htmlspecialchars($contacts["FIO"])?>" />
							</div>	
						</div>
						<div class="field">
							<div class="inputContainer">
								<input type="text" name="RESULT[CONTACTS][<?=$key?>][PHONE]" class="phone_asc" value="<?=htmlspecialchars($contacts["PHONE"])?>" />
							</div>
						</div>
						<div class="field">
							<div class="inputContainer">
								<input type="text" name="RESULT[CONTACTS][<?=$key?>][EMAIL]" value="<?=htmlspecialchars($contacts["EMAIL"])?>" />
							</div>	
						</div>
						<div class="field button last">
							<button class="delete delete_contacts" type="button">
								<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
							</button>
						</div>
						<div class="clear"></div>
					</div>
				<?endforeach;?>
			<?else:?>
				<div class="five_input_container">
					<div class="field">				
						<div class="inputContainer">
							<input type="text" name="RESULT[CONTACTS][0][POSITION]" value="" />
						</div>
					</div>
					<div class="field">
						<div class="inputContainer">
							<input type="text" name="RESULT[CONTACTS][0][FIO]" value="" />
						</div>	
					</div>
					<div class="field">
						<div class="inputContainer">
							<input type="text" name="RESULT[CONTACTS][0][PHONE]" value="" class="phone_asc" />
						</div>
					</div>
					<div class="field">
						<div class="inputContainer">
							<input type="text" name="RESULT[CONTACTS][0][EMAIL]" value="" />
						</div>	
					</div>
					<div class="field button last">
						<button class="delete delete_contacts" type="button">
							<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
						</button>
					</div>
					<div class="clear"></div>
				</div>
			<?endif;?>
		</div>
		<button class="add" name="add_contacts"><?=GetMessage("ADD")?></button>
	</div>
	<h3><?=GetMessage("DIRECTION_OF_THE_ACTIVITY")?></h3>
	<div class="default_forms">
		<div class="activity_directions">
			<div class="field">
				<label class="field_label"><?=GetMessage("DIRECTIONS")?></label>			
			</div>
			<div class="field last quantity">
				<label class="field_label"><?=GetMessage("QUANTITY")?></label>
			</div>
			<?
				if(!empty($_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"]))
					$direction = $_REQUEST["RESULT"]["DIRECTIONS_OF_ACTIVITY"];
				else 
					$direction = $arResult["DIRECTIONS_ACTIVITY"];				
			?>
			<?foreach($direction as $key => $directions):?>
			<div class="directions">
				<div class="field">				
					<div class="inputContainer">
						<input type="text" readonly name="RESULT[DIRECTIONS_OF_ACTIVITY][<?=$key?>][DIRECTIONS]" value="<?=htmlspecialchars($directions["DIRECTIONS"])?>" />
					</div>
				</div>
				<div class="field button last">
					<button class="delete delete_directions" type="button">
						<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
					</button>
				</div>
				<div class="field quantity">
					<div class="inputContainer">
						<input type="text" name="RESULT[DIRECTIONS_OF_ACTIVITY][<?=$key?>][QUANTITY]" class="number" value="<?=htmlspecialchars($directions["QUANTITY"])?>" />
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?endforeach;?>
		</div>
		<button class="add" name="add_directions"><?=GetMessage("ADD")?></button>	
	</div>
	<h3><?=GetMessage("REGIONS_OF_ACTIVITY")?></h3>
	<div class="default_forms">
		<div class="regions_activities">
			<div class="regions_quantity">
				<div class="field">
					<label class="field_label"><?=GetMessage("REGION")?></label>			
				</div>
				<div class="field">
					<label class="field_label"><?=GetMessage("TOWN")?></label>
				</div>
				<div class="field last quantity">
					<label class="field_label"><?=GetMessage("QUANTITY")?></label>
				</div>
				<div class="clear"></div>
			</div>
			<?if(!empty($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"])):?>
				<?foreach($_REQUEST["RESULT"]["REGIONS_OF_ACTIVITY"] as $key => $regions):?>
					<div class="regions_quantity">
						<div class="field">
							<select name="RESULT[REGIONS_OF_ACTIVITY][<?=$key?>][REGION]" class="select_remake region" title="company_region">
								<option value="0"><?=GetMessage("REGION")?></option>
								<?foreach($arResult["REGIONS"] as $r => $region):?>
									<option value="<?=$r?>" <?if($regions["REGION"] == $r):?> selected="selected" <?endif;?> ><?=$region?></option>
								<?endforeach;?>
							</select>
						</div>
						<div class="field">
							<select name="RESULT[REGIONS_OF_ACTIVITY][<?=$key?>][TOWN]" id="company_region" class="select_remake town">
								<option value="0"><?=GetMessage("TOWN")?></option>
								<?foreach($arResult["TOWNS"][$regions["REGION"]] as $k => $town):?>
									<option value="<?=$k?>" <?if($regions["TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
								<?endforeach;?>
							</select>
						</div>
						<div class="field button last">
							<button class="delete delete_regions_quantity" type="button">
								<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
							</button>
						</div>
						<div class="field quantity">
							<div class="inputContainer">
								<input type="text" name="RESULT[REGIONS_OF_ACTIVITY][<?=$key?>][QUANTITY]" class="number" value="<?=htmlspecialchars($regions["QUANTITY"])?>" />
							</div>
						</div>
						<div class="clear"></div>
					</div>
				<?endforeach;?>
			<?else:?>
				<div class="regions_quantity">
					<div class="field">
						<select name="RESULT[REGIONS_OF_ACTIVITY][0][REGION]" class="select_remake region" title="company_region">
							<option value="0"><?=GetMessage("REGION")?></option>
							<?foreach($arResult["REGIONS"] as $key => $region):?>
								<option value="<?=$key?>" <?if($arResult["SELECTED_REGION"] == $key):?> selected="selected" <?endif;?> ><?=$region?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="field">
						<select name="RESULT[REGIONS_OF_ACTIVITY][0][TOWN]" id="company_region" class="select_remake town">
							<option value="0"><?=GetMessage("TOWN")?></option>
							<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
								<option value="<?=$k?>" <?if($arResult["SELECTED_TOWN"] == $k):?> selected="selected" <?endif;?> ><?=$town?></option>
							<?endforeach;?>
						</select>
					</div>
					<div class="field button last">
						<button class="delete delete_regions_quantity" type="button">
							<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
						</button>
					</div>
					<div class="field quantity">
						<div class="inputContainer">
							<input type="text" name="RESULT[REGIONS_OF_ACTIVITY][0][QUANTITY]" class="number" value="" />
						</div>
					</div>
					<div class="clear"></div>
				</div>
			<?endif;?>
		</div>
		<button class="add" name="add_regions"><?=GetMessage("ADD")?></button>	
	</div>
	<h3><?=GetMessage("CONTACTS_PERSON")?></h3>
	<div class="default_forms">
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("FIO")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CONTACT_NAME]" value="<?=isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_NAME"]) ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_NAME"]) : htmlspecialchars($arResult["CONTACT_PERSON"]["NAME"])?>" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("POSITION")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CONTACT_POSITION]" value="<?=isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_POSITION"]) ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_POSITION"]) : htmlspecialchars($arResult["CONTACT_PERSON"]["POSITION"])?>" />
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="two_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("PHONE")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CONTACT_PHONE]" class="phone_asc" value="<?=isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_PHONE"]) ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_PHONE"]) : htmlspecialchars($arResult["CONTACT_PERSON"]["PHONE"])?>" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("EMAIL")?></label>
				<div class="inputContainer">
					<input type="text" name="RESULT[PROPERTY_VALUES][CONTACT_EMAIL]" value="<?=isset($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"]) ? htmlspecialchars($_REQUEST["RESULT"]["PROPERTY_VALUES"]["CONTACT_EMAIL"]) : htmlspecialchars($arResult["CONTACT_PERSON"]["EMAIL"])?>" />
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<button class="orange_button" type="submit" name="send" value="1">Подать заявку</button>
</form>
<?endif?>