<div class="clone filials" style="display: none;">
	<div class="small_input_three country-region-town">
		<div class="field">
			<select class="country" name="COMPANY[FILIALS][][country]" title="COUNTRY__">
				<option value="0"><?="Все страны"?></option>
				<?foreach($arResult["COUNTRIES"] as $key => $country):?>
					<option value="<?=$key?>"><?=$country?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field">
			<select class="region" name="COMPANY[FILIALS][][region]" title="REGION__" id="COUNTRY__">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"][$arResult["SELECTED_REGION"]] as $key => $region):?>
					<option value="<?=$key?>"><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field last">
			<select class="town" id="REGION__" name="COMPANY[FILIALS][][town]">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
					<option value="<?=$k?>"><?=$town?></option>
				<?endforeach;?>
			</select>
		</div>				
		<div class="clear"></div>
	</div>
	<div class="field last">
		<div class="inputContainer">
			<input type="text" name="COMPANY[FILIALS][][address]" value="" placeholder="<?=GetMessage("ADDRESS")?>" />
		</div>			
	</div>	
	<b><?=GetMessage("STATUS")?></b>
	<div class="small_input_three">
		<?$n = 0;?>
		<?foreach($arResult["STATUS"] as $key => $status):?>
			<div class="field <?if(($n+1)%3 == 0):?> last <?endif;?>">
				<label class="label_check" for="c_status_<?=$key?>">
					<input name="COMPANY[FILIALS][][status][]" id="c_status_<?=$key?>" type="checkbox" value="<?=$key?>" />
					<?=$status?>
				</label>
			</div>
			<?$n++;?>
		<?endforeach;?>
		<div class="clear"></div>
	</div>
	<div class="small_input_three">
		<div class="field">
			<select class="select_remake" name="COMPANY[FILIALS][][office_VALUE]">
				<?foreach($arResult["OFFICE"] as $of):?>
					<option value="<?=$of["ID"]?>"><?=$of["NAME"]?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field">
			<div class="inputContainer">
				<input type="text" name="COMPANY[FILIALS][][phone]" class="phone" value="" placeholder="<?=GetMessage("PHONE")?>" />
			</div>	
		</div>	
		<div class="field last">
			<div class="inputContainer">
				<input type="text" name="COMPANY[FILIALS][][email]" value="" placeholder="<?=GetMessage("EMAIL")?>" />
			</div>			
		</div>			
		<div class="clear"></div>
	</div>
	<button id="rem_f" class="del_filial" type="button">
		<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" alt="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
	</button>
</div>