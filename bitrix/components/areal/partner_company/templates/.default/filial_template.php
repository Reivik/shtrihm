<table class="clone filials" style="display: none;">
	<tr class="filials">
		<td class="filial_description">			
			<label class="field_label"><?=GetMessage("STATUS")?></label>
			<div class="clear"></div>									
			<?$n = 0;?>
			<?foreach($arResult["STATUS"] as $key => $status):?>
				<div class="field <?if(($n+1)%2 == 0):?> last <?endif;?>">
					<label class="label_check" for="c_status_<?=$key?>">
						<input name="COMPANY[FILIALS][][status][]" id="c_status_<?=$key?>" type="checkbox" value="<?=$key?>" />
						<?=$status?>
					</label>
				</div>
				<?$n++;?>
			<?endforeach;?>
			<div class="clear"></div>
			
			<div class="regions_towns">
				<div class="field">
					<label class="field_label"><?=GetMessage("REGION")?></label>
					<select class="select_remake region" name="COMPANY[FILIALS][][region]" title="REGION__">
						<option value="0"><?=GetMessage("REGION")?></option>
						<?foreach($arResult["REGIONS"] as $r => $region):?>
							<option value="<?=intVal($r)?>"><?=$region?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="field last">
					<label class="field_label"><?=GetMessage("TOWN")?></label>
					<select class="select_remake town" name="COMPANY[FILIALS][][town]" id="REGION__">
						<option value="0"><?=GetMessage("TOWN")?></option>
						<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $t => $town):?>
							<option value="<?=$t?>"><?=$town?></option>
						<?endforeach;?>
					</select>
				</div>
				<div class="clear"></div>
			</div>
			
			
			<div class="field">
				<label class="field_label"><?=GetMessage("ADDRESS")?></label>
				<div class="inputContainer">
					<input type="text" name="COMPANY[FILIALS][][address]" value="" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("OFFICE")?></label>
				<select class="select_remake" name="COMPANY[FILIALS][][office]">
					<?foreach($arResult["OFFICE"] as $of):?>
						<option value="<?=$of?>"><?=$of?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="clear"></div>
				
			<div class="field">
				<label class="field_label"><?=GetMessage("PHONE")?></label>
				<div class="inputContainer">
					<input type="text" class="phone" name="COMPANY[FILIALS][][phone]" value="" />
				</div>
			</div>
			<div class="field last">
				<label class="field_label"><?=GetMessage("EMAIL")?></label>
				<div class="inputContainer">
					<input type="text" name="COMPANY[FILIALS][][email]" value="" />
				</div>
			</div>
			<div class="clear"></div>
		</td>
		<td class="delete_button">
			<button id="rem_f" class="del_filial" type="button">
				<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
			</button>	
		</td>
	</tr>
</table>