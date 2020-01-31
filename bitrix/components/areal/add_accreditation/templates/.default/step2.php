<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("STEP_2")?></h2>
<h3><?=GetMessage("HEAD")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("HEAD_NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[HEAD_NAME]" value="<?=$_REQUEST["PROPERTY"]["HEAD_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_NAME"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("HEAD_POSITION")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[HEAD_POSITION]" value="<?=$_REQUEST["PROPERTY"]["HEAD_POSITION"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_POSITION"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_POSITION"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("HEAD_DOCUMENT")?></label>
		<div class="inputContainer">
			<input type="text" name="PROPERTY[HEAD_DOCUMENT]" value="<?=$_REQUEST["PROPERTY"]["HEAD_DOCUMENT"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_DOCUMENT"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_DOCUMENT"])?>" />
		</div>
	</div>
</div>
<h3><?=GetMessage("LEGAL_ADDRESS")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("REGION")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["LEGAL_ADDRESS_REGION"]))
				$select_region = $_REQUEST["PROPERTY"]["LEGAL_ADDRESS_REGION"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_REGION"]))
				$select_region = $_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_REGION"];
			else
				$select_region = $arResult["SELECTED_REGION"];
			?>
			<select name="PROPERTY[LEGAL_ADDRESS_REGION]" title="REGIONLEGAL__" class="region">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"] as $key => $region):?>
					<option value="<?=$key?>" <?if($key == $select_region):?> selected="selected" <?endif;?>><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field last">	
			<label class="field_label"><?=GetMessage("TOWN")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["LEGAL_ADDRESS_TOWN"]))
				$select_town = $_REQUEST["PROPERTY"]["LEGAL_ADDRESS_TOWN"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_TOWN"]))
				$select_town = $_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_TOWN"];
			else
				$select_town = $arResult["SELECTED_TOWN"];
			?>
			<select name="PROPERTY[LEGAL_ADDRESS_TOWN]" id="REGIONLEGAL__" class="town">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$select_region] as $k => $town):?>
					<option value="<?=$k?>" <?if($k == $select_town):?> selected="selected" <?endif;?>><?=$town?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("INDEX")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[LEGAL_ADDRESS_INDEX]" value="<?=$_REQUEST["PROPERTY"]["LEGAL_ADDRESS_INDEX"] ? htmlspecialchars($_REQUEST["PROPERTY"]["LEGAL_ADDRESS_INDEX"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_INDEX"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("ADDRESS")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[LEGAL_ADDRESS_ADDRESS]" value="<?=$_REQUEST["PROPERTY"]["LEGAL_ADDRESS_ADDRESS"] ? htmlspecialchars($_REQUEST["PROPERTY"]["LEGAL_ADDRESS_ADDRESS"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["LEGAL_ADDRESS_ADDRESS"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<h3><?=GetMessage("POSTAL_ADDRESS")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("REGION")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["POSTAL_ADDRESS_REGION"]))
				$select_region = $_REQUEST["PROPERTY"]["POSTAL_ADDRESS_REGION"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_REGION"]))
				$select_region = $_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_REGION"];
			else
				$select_region = $arResult["SELECTED_REGION"];
			?>
			<select name="PROPERTY[POSTAL_ADDRESS_REGION]" title="REGIONPOSTAL__" class="region">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"] as $key => $region):?>
					<option value="<?=$key?>" <?if($key == $select_region):?> selected="selected" <?endif;?>><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field last">	
			<label class="field_label"><?=GetMessage("TOWN")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["POSTAL_ADDRESS_TOWN"]))
				$select_town = $_REQUEST["PROPERTY"]["POSTAL_ADDRESS_TOWN"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_TOWN"]))
				$select_town = $_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_TOWN"];
			else
				$select_town = $arResult["SELECTED_TOWN"];
			?>
			<select name="PROPERTY[POSTAL_ADDRESS_TOWN]" id="REGIONPOSTAL__" class="town">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$select_region] as $k => $town):?>
					<option value="<?=$k?>" <?if($k == $select_town):?> selected="selected" <?endif;?>><?=$town?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("INDEX")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[POSTAL_ADDRESS_INDEX]" value="<?=$_REQUEST["PROPERTY"]["POSTAL_ADDRESS_INDEX"] ? htmlspecialchars($_REQUEST["PROPERTY"]["POSTAL_ADDRESS_INDEX"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_INDEX"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("ADDRESS")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[POSTAL_ADDRESS_ADDRESS]" value="<?=$_REQUEST["PROPERTY"]["POSTAL_ADDRESS_ADDRESS"] ? htmlspecialchars($_REQUEST["PROPERTY"]["POSTAL_ADDRESS_ADDRESS"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["POSTAL_ADDRESS_ADDRESS"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<h3><?=GetMessage("ACTUAL_ADDRESS")?></h3>
<div class="default_forms">
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("REGION")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_REGION"]))
				$select_region = $_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_REGION"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_REGION"]))
				$select_region = $_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_REGION"];
			else
				$select_region = $arResult["SELECTED_REGION"];
			?>
			<select name="PROPERTY[ACTUAL_ADDRESS_REGION]" title="REGIONACTUAL__" class="region">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"] as $key => $region):?>
					<option value="<?=$key?>" <?if($key == $select_region):?> selected="selected" <?endif;?>><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field last">	
			<label class="field_label"><?=GetMessage("TOWN")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_TOWN"]))
				$select_town = $_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_TOWN"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_TOWN"]))
				$select_town = $_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_TOWN"];
			else
				$select_town = $arResult["SELECTED_TOWN"];
			?>
			<select name="PROPERTY[ACTUAL_ADDRESS_TOWN]" id="REGIONACTUAL__" class="town">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$select_region] as $k => $town):?>
					<option value="<?=$k?>" <?if($k == $select_town):?> selected="selected" <?endif;?>><?=$town?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("INDEX")?></label>
			<div class="inputContainer">
				<input type="text" class="number" name="PROPERTY[ACTUAL_ADDRESS_INDEX]" value="<?=$_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_INDEX"] ? htmlspecialchars($_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_INDEX"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_INDEX"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("ADDRESS")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[ACTUAL_ADDRESS_ADDRESS]" value="<?=$_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_ADDRESS"] ? htmlspecialchars($_REQUEST["PROPERTY"]["ACTUAL_ADDRESS_ADDRESS"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["ACTUAL_ADDRESS_ADDRESS"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<input type="hidden" name="next_step" value="3" />
<input type="hidden" name="prev_step" value="1" />
<button type="submit" name="directions" class="orange_submit" value="prev"><?=mb_strtoupper(GetMessage("BACK"))?></button>
<button type="submit" name="directions" class="orange_submit" value="next"><?=mb_strtoupper(GetMessage("CONTINUE"))?></button>