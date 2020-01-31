<div class="regions_quantity clone" style="display: none;"> 
	<div class="field">
		<select name="RESULT[REGIONS_OF_ACTIVITY][][REGION]" title="REGION__" class="region">
			<option value="0"><?=GetMessage("REGION")?></option>
			<?foreach($arResult["REGIONS"] as $key => $region):?>
				<option value="<?=$key?>"><?=$region?></option>
			<?endforeach;?>
		</select>
	</div>
	<div class="field">
		<select name="RESULT[REGIONS_OF_ACTIVITY][][TOWN]" id="REGION__" class="town">
			<option value="0"><?=GetMessage("TOWN")?></option>
			<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
				<option value="<?=$k?>"><?=$town?></option>
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
			<input type="text" name="RESULT[REGIONS_OF_ACTIVITY][][QUANTITY]" class="number" value="" />
		</div>
	</div>
	<div class="clear"></div>
</div>