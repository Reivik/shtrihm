<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/people_template.php");?>
<a name="change_staff"></a>
<form class="protection lk" method="post" action="<?=POST_FORM_ACTION_URI?>#change_staff" name="change_staff" enctype="multipart/form-data">	
	<?=bitrix_sessid_post()?>
	<div class="field">
		<label class="field_label count_staff"><?=GetMessage("COMPANY_COUNT_STAFF")?></label>
		<div class="inputContainer count_staff">
			<input type="text" readonly name="COMPANY_COUNT_STAFF" value="<?=count($arResult["COMPANY"]["PEOPLE"])?>" />
		</div>
		<div class="clear"></div>
	</div>
	<h3><?=GetMessage("LIST_MAIN_STAFF")?></h3>
	<div class="about">				
		<?/*if(!empty($_REQUEST["COMPANY"]["PEOPLE"])) $peoples_req = $_REQUEST["COMPANY"]["PEOPLE"];
		else */$peoples_req = $arResult["COMPANY"]["PEOPLE"];?>
		<?if(count($peoples_req) > 0):?>
			<table>
				<tr>
					<th><?=GetMessage("STAFF_DATA");?></th>
					<th colspan="<?=count($arResult["COMPANY"]["LEVELS"])+1?>"><?=GetMessage("PARTNER_LEVEL")?></th>					
				</tr>
				<?if(count($arResult["COMPANY"]["LEVELS"]) > 0):?>
					<tr>
						<th></th>
						<?foreach($arResult["COMPANY"]["LEVELS"] as $level):?>
							<th class="partner_level"><?=$level["NAME"]?></th>
						<?endforeach;?>
						<th></th>
					</tr>
				<?endif;?>
				<?if(count($peoples_req) > 0):?>
					<?foreach($peoples_req as $key => $people):?>
						<tr class="peoples">
							<td class="people_info">
								<div class="people">
									<div class="checkBlock">
										<label class="label_check" for="people_contacts">
											<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> disabled="disabled" <?endif;?> name="COMPANY[PEOPLE][<?=$key?>][contacts_person]" id="people_contacts" <?if($people["CONTACT_PERSON"]):?> checked="checked" <?endif;?> type="checkbox" />
											<?=GetMessage("CONTACT_PERSON")?>
										</label>
									</div>
									<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
									<div class="inputContainer">
										<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="text" class="people_input" name="COMPANY[PEOPLE][<?=$key?>][POSITION]" value="<?=$people["POSITION"]?>" />
									</div>
									<label class="field_label"><?=GetMessage("FULL_NAME")?></label>
									<div class="inputContainer">
										<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="text" class="people_input" name="COMPANY[PEOPLE][<?=$key?>][NAME]" value="<?=$people["NAME"]?>" />
									</div>
									<div class="email_phone">
										<div class="field">
											<label class="field_label"><?=GetMessage("CONTACT_EMAIL")?></label>
											<div class="inputContainer">
												<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="text" class="people_input" name="COMPANY[PEOPLE][<?=$key?>][EMAIL]" value="<?=$people["EMAIL"]?>" />
											</div>
										</div>
										<div class="field last">
											<label class="field_label"><?=GetMessage("CONTACT_PHONE")?></label>
											<div class="inputContainer">
												<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="text" class="people_input phone" name="COMPANY[PEOPLE][<?=$key?>][PHONE]" value="<?=$people["PHONE"]?>" />
											</div>
										</div>
										<div class="clear"></div>
									</div>								
								</div>
							</td>
							<?if(count($arResult["COMPANY"]["LEVELS"]) > 0):?>
								<?foreach($arResult["COMPANY"]["LEVELS"] as $l => $level):?>
									<td class="people_col">
										<label class="label_check" for="id_<?=$people["ID"]?>_people_access_<?=$level["GROUP_ID"]?>">
											<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> disabled="disabled" <?endif;?> name="COMPANY[PEOPLE][<?=$key?>][GROUP][<?=$l?>]" value="<?=$level["GROUP_ID"]?>" type="checkbox" <?if(isset($people["GROUP"]) && in_array($level["GROUP_ID"], $people["GROUP"])):?> checked <?endif;?> />
										</label>
									</td>
								<?endforeach;?>
							<?endif;?>
							<td class="delete_button people_col">
								<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="hidden" class="people_id" name="COMPANY[PEOPLE][<?=$key?>][ID]" value="<?=$people["ID"]?>" />
								<button id="rem_p" class="del_people" type="button">
									<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_STAFF")?>" width="13" height="13" />
								</button>	
							</td>
						</tr>
					<?endforeach;?>
				<?endif;?>
			</table>
		<?else:?>
			<table>
				<tr>
					<th><?=GetMessage("STAFF_DATA");?></th>
					<th colspan="<?=count($arResult["COMPANY"]["LEVELS"])+1?>"><?=GetMessage("PARTNER_LEVEL")?></th>					
				</tr>
				<?if(count($arResult["COMPANY"]["LEVELS"]) > 0):?>
					<tr>
						<th></th>
						<?foreach($arResult["COMPANY"]["LEVELS"] as $level):?>
							<th class="partner_level"><?=$level["NAME"]?></th>
						<?endforeach;?>
						<th></th>
					</tr>
				<?endif;?>						
			</table>
		<?endif;?>
		
	</div>
	<button id="add_peoples_personal" class="add_filial" type="button"><?=GetMessage("ADD_PEOPLE")?></button>
	<?if(!empty($arResult["COMPANY"]["SPECIALISTS"])):?>
		<h3><?=GetMessage("CERTIFIED_SPECIALITIES")?></h3>
		<table>
			<tr>
				<th><?=GetMessage("NAME_STAFF")?></th>
				<th><?=GetMessage("COURSE")?></th>
				<th><?=GetMessage("DATE_START")?></th>
				<th><?=GetMessage("DATE_END")?></th>
			</tr>
			<?foreach($arResult["COMPANY"]["SPECIALISTS"] as $specialist):?>
				<tr>
					<td><?=$specialist["NAME"]?></td>						
					<td><?=$specialist["COURSE"]?></td>						
					<td><?=$specialist["DATE_START"]?></td>						
					<td><?=GetMessage("TO")?><?=$specialist["DATE_END"]?></td>						
				</tr>
			<?endforeach;?>
		</table>
	<?endif;?>
	<?if($arResult["PARTNER_ADMIN"] == "Y"):?>
		<button type="submit" name="changeCompany"><?=GetMessage("SAVE");?></button>
	<?endif;?>
</form>	