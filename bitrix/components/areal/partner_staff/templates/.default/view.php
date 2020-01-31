<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="field">
	<label class="field_label count_staff"><?=GetMessage("COMPANY_COUNT_STAFF")?></label>
	<div class="inputContainer count_staff inputContainerText"><span><?=count($arResult["COMPANY"]["PEOPLE"])?></span></div>
	<div class="clear"></div>
</div>
<h3><?=GetMessage("LIST_MAIN_STAFF")?></h3>
<div class="about">
	<?if(count($arResult["COMPANY"]["PEOPLE"]) > 0):?>
		<table>
			<tr>
				<th><?=GetMessage("STAFF_DATA");?></th>
				<th colspan="<?=count($arResult["COMPANY"]["LEVELS"])?>"><?=GetMessage("PARTNER_LEVEL")?></th>					
			</tr>
			<?if(count($arResult["COMPANY"]["LEVELS"]) > 0):?>
				<tr>
					<th></th>
					<?foreach($arResult["COMPANY"]["LEVELS"] as $level):?>
						<th class="partner_level"><?=$level["NAME"]?></th>
					<?endforeach;?>
				</tr>
			<?endif;?>
			<?if(count($arResult["COMPANY"]["PEOPLE"]) > 0):?>
				<?foreach($arResult["COMPANY"]["PEOPLE"] as $key => $people):?>
					<tr class="peoples">
						<td class="people_info">
							<div class="people">
								<div class="checkBlock">
									<label class="label_check" for="people_contacts">
										<input disabled="disabled" name="COMPANY[PEOPLE][<?=$key?>][contacts_person]" id="people_contacts" <?if($people["CONTACT_PERSON"]):?> checked="checked" <?endif;?> type="checkbox" />
										<?=GetMessage("CONTACT_PERSON")?>
									</label>
								</div>
								<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
								<div class="inputContainerText"><span><?=$people["POSITION"]?></span></div>
								
								<label class="field_label"><?=GetMessage("FULL_NAME")?></label>
								<div class="inputContainerText"><span><?=$people["NAME"]?></span></div>
								
								<div class="email_phone">
									<div class="field">
										<label class="field_label"><?=GetMessage("CONTACT_EMAIL")?></label>
										<div class="inputContainerText"><span><?=$people["EMAIL"]?></span></div>											
									</div>
									<div class="field last">
										<label class="field_label"><?=GetMessage("CONTACT_PHONE")?></label>
										<div class="inputContainerText"><span><?=$people["PHONE"]?></span></div>
									</div>
									<div class="clear"></div>
								</div>								
							</div>
						</td>
						<?if(count($arResult["COMPANY"]["LEVELS"]) > 0):?>
							<?foreach($arResult["COMPANY"]["LEVELS"] as $l => $level):?>
								<td class="people_col">
									<label class="label_check" for="id_<?=$people["ID"]?>_people_access_<?=$level["GROUP_ID"]?>">
										<input disabled="disabled" name="COMPANY[PEOPLE][<?=$key?>][GROUP][<?=$l?>]" value="<?=$level["GROUP_ID"]?>" type="checkbox" <?if(isset($people["GROUP"]) && in_array($level["GROUP_ID"], $people["GROUP"])):?> checked <?endif;?> />
									</label>
								</td>
							<?endforeach;?>
						<?endif;?>
					</tr>
				<?endforeach;?>
			<?endif;?>
		</table>
	<?endif;?>
</div>
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