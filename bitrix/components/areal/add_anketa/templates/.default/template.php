<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="specialities clone" style="display: none;">
	<div class="specialities">
		<div class="specialities_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("NAME")?></label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SPECIALITIES][][NAME]" value="" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("INN")?></label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SPECIALITIES][][INN]" class="inn_asc" value="" />
				</div>
			</div>
			<div class="field button last">
				<label class="field_label"></label>
				<button class="delete delete_speciality" type="button">
					<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
				</button>
			</div>
			<div class="clear"></div>	
		</div>
		<div class="specialities_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("DATE_LEARNING")?></label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SPECIALITIES][][DATE_LEARNING]" class="date_asc"  value="" />
				</div>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("PLACE_LEARNING")?></label>
				<div class="inputContainer">
					<input type="text" name="PROPERTY[SPECIALITIES][][PLACE_LEARNING]" value="" />
				</div>
			</div>
			<div class="clear"></div>	
		</div>
	</div>
</div>
<div class="postavschiki clone" style="display: none;">
	<div class="postavschiki">
		<div class="specialities_input_container">
			<div class="field">
				<label class="field_label"><?=GetMessage("REGION")?></label>
				<select class="region" name="PROPERTY[LEARNING][][REGION]" title="REGION__">
					<option value="0"><?=GetMessage("REGION")?></option>
					<?foreach($arResult["REGIONS"] as $key => $region):?>
						<option value="<?=$key?>"><?=$region?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="field">
				<label class="field_label"><?=GetMessage("TOWN")?></label>
				<select class="town" id="REGION__" name="PROPERTY[LEARNING][][TOWN]">
					<option value="0"><?=GetMessage("TOWN")?></option>
					<?foreach($arResult["TOWNS"][$arResult["SELECTED_REGION"]] as $k => $town):?>
						<option value="<?=$k?>"><?=$town?></option>
					<?endforeach;?>
				</select>
			</div>
			<div class="field button last">
				<label class="field_label"></label>
				<button class="delete delete_postavschiki" type="button">
					<img src="/design/images/close_cross.png" title="<?=GetMessage("DELETE_FILIAL")?>" width="13" height="13" />
				</button>
			</div>
			<div class="clear"></div>	
		</div>			
		<div class="field">
			<label class="field_label"><?=GetMessage("NAME_COMPANY")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[LEARNING][][NAME]" value="" />
			</div>
		</div>				
		<div class="clear"></div>
	</div>
</div>
<?if($_REQUEST["success"] == "yes" && empty($arResult["ERROR"])):?>
	<?ShowNote(GetMessage("SUCCESS_SAVE"));?>
	<?=GetMessage("NEW_APP");?>
<?endif;?>
<?if(!empty($arResult["ERROR"])):?>
	<?ShowError(implode("<br />", $arResult["ERROR"]));?>
<?endif;?>
<form method="post" class="protection" action="<?=POST_FORM_ACTION_URI?>" name="step_1" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if($arResult["STEP"] > 0) include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/step".$arResult["STEP"].".php");?>
</form>