<table class="clone peoples" style="display: none;">
	<tr class="peoples">
		<td class="people_info">
			<div class="people">
				<div class="checkBlock">
					<label class="label_check" for="people_contacts">
						<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> disabled="disabled" <?endif;?> name="COMPANY[PEOPLE][][contacts_person]" id="people_contacts" type="checkbox" />
						<?=GetMessage("CONTACT_PERSON")?>
					</label>
				</div>
				<label class="field_label"><?=GetMessage("CONTACT_POSITION")?></label>
				<div class="inputContainer">
					<input type="text" <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> class="people_input" name="COMPANY[PEOPLE][][POSITION]" value="" />
				</div>
				<label class="field_label"><?=GetMessage("FULL_NAME")?></label>
				<div class="inputContainer">
					<input type="text" <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> class="people_input" name="COMPANY[PEOPLE][][NAME]" value="" />
				</div>
				<div class="email_phone">
					<div class="field">
						<label class="field_label"><?=GetMessage("CONTACT_EMAIL")?></label>
						<div class="inputContainer">
							<input type="text" <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> class="people_input" name="COMPANY[PEOPLE][][EMAIL]" value="" />
						</div>
					</div>
					<div class="field last">
						<label class="field_label"><?=GetMessage("CONTACT_PHONE")?></label>
						<div class="inputContainer">
							<input type="text" <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> class="people_input phone" name="COMPANY[PEOPLE][][PHONE]" value="" />
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
						<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> disabled="disabled" <?endif;?> name="COMPANY[PEOPLE][][GROUP][<?=$l?>]" type="checkbox" value="<?=$level["GROUP_ID"]?>" />
					</label>
				</td>
			<?endforeach;?>
		<?endif;?>
		<td class="delete_button people_col">
			<input <?if($arResult["PARTNER_ADMIN"] != "Y"):?> readonly <?endif;?> type="hidden" class="people_id" name="COMPANY[PEOPLE][][id]" value="" />
			<button id="rem_p" class="del_people" type="button">
				<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_STAFF")?>" width="13" height="13" />
			</button>	
		</td>					
	</tr>
</table>