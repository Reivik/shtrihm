<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h2><?=GetMessage("STEP_1")?></h2>
<div class="default_forms">
	<div class="field">
		<label class="field_label"><?=GetMessage("DOGOVOR")?></label>
		<div class="inputContainer">
			<input type="text" name="PROPERTY[DOGOVOR]" value="<?=$_REQUEST["PROPERTY"]["DOGOVOR"] ? htmlspecialchars($_REQUEST["PROPERTY"]["DOGOVOR"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["DOGOVOR"])?>" />
		</div>
	</div>
	<h3>Данные о центре технического обслуживания</h3>
	<div class="field">
		<label class="field_label">Название</label>
		<div class="inputContainer">
			<input type="text" name="PROPERTY[SERVICE_CENTER_NAME]" value="<?=$_REQUEST["PROPERTY"]["SERVICE_CENTER_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["SERVICE_CENTER_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_NAME"])?>" />
		</div>
	</div>
	<div class="field">
		<label class="field_label">ИНН</label>
		<div class="inputContainer">
			<input type="text" class="inn_asc" name="PROPERTY[SERVICE_CENTER_INN]" value="<?=$_REQUEST["PROPERTY"]["SERVICE_CENTER_INN"] ? htmlspecialchars($_REQUEST["PROPERTY"]["SERVICE_CENTER_INN"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_INN"])?>" />
		</div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("REGION")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["SERVICE_CENTER_REGION"]))
				$select_region = $_REQUEST["PROPERTY"]["SERVICE_CENTER_REGION"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_REGION"]))
				$select_region = $_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_REGION"];
			else
				$select_region = $arResult["SELECTED_REGION"];
			?>
			<select name="PROPERTY[SERVICE_CENTER_REGION]" title="REGION_CTO" class="region">
				<option value="0"><?=GetMessage("REGION")?></option>
				<?foreach($arResult["REGIONS"] as $key => $region):?>
					<option value="<?=$key?>" <?if($key == $select_region):?> selected="selected" <?endif;?>><?=$region?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="field last">	
			<label class="field_label"><?=GetMessage("TOWN")?></label>
			<?if(!empty($_REQUEST["PROPERTY"]["SERVICE_CENTER_TOWN"]))
				$select_town = $_REQUEST["PROPERTY"]["SERVICE_CENTER_TOWN"];
			elseif(!empty($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_TOWN"]))
				$select_town = $_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_TOWN"];
			else
				$select_town = $arResult["SELECTED_TOWN"];
			?>
			<select name="PROPERTY[SERVICE_CENTER_TOWN]" id="REGION_CTO" class="town">
				<option value="0"><?=GetMessage("TOWN")?></option>
				<?foreach($arResult["TOWNS"][$select_region] as $k => $town):?>
					<option value="<?=$k?>" <?if($k == $select_town):?> selected="selected" <?endif;?>><?=$town?></option>
				<?endforeach;?>
			</select>
		</div>
		<div class="clear"></div>
	</div>
	<div class="field">
		<label class="field_label"><?=GetMessage("ADDRESS")?></label>
		<div class="inputContainer">
			<input type="text" name="PROPERTY[SERVICE_CENTER_ADDRESS]" value="<?=$_REQUEST["PROPERTY"]["SERVICE_CENTER_ADDRESS"] ? htmlspecialchars($_REQUEST["PROPERTY"]["SERVICE_CENTER_ADDRESS"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_ADDRESS"])?>" />
		</div>
	</div>
	<div class="two_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[SERVICE_CENTER_PHONE]" value="<?=$_REQUEST["PROPERTY"]["SERVICE_CENTER_PHONE"] ? htmlspecialchars($_REQUEST["PROPERTY"]["SERVICE_CENTER_PHONE"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_PHONE"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[SERVICE_CENTER_EMAIL]" value="<?=$_REQUEST["PROPERTY"]["SERVICE_CENTER_EMAIL"] ? htmlspecialchars($_REQUEST["PROPERTY"]["SERVICE_CENTER_EMAIL"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["SERVICE_CENTER_EMAIL"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<h3><?=GetMessage("HEAD_CONTACTS")?></h3>
	<h4><?=GetMessage("GENERAL_DIRECTOR")?></h4>
	<div class="tree_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[GENERAL_DIRECTOR_NAME]" value="<?=$_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["GENERAL_DIRECTOR_NAME"])?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[GENERAL_DIRECTOR_PHONE]" value="<?=$_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_PHONE"] ? htmlspecialchars($_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_PHONE"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["GENERAL_DIRECTOR_PHONE"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[GENERAL_DIRECTOR_EMAIL]" value="<?=$_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_EMAIL"] ? htmlspecialchars($_REQUEST["PROPERTY"]["GENERAL_DIRECTOR_EMAIL"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["GENERAL_DIRECTOR_EMAIL"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<h4><?=GetMessage("TECHNICAL_DIRECTOR")?></h4>
	<div class="tree_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[TECHNICAL_DIRECTOR_NAME]" value="<?=$_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["TECHNICAL_DIRECTOR_NAME"])?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[TECHNICAL_DIRECTOR_PHONE]" value="<?=$_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_PHONE"] ? htmlspecialchars($_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_PHONE"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["TECHNICAL_DIRECTOR_PHONE"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[TECHNICAL_DIRECTOR_EMAIL]" value="<?=$_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_EMAIL"] ? htmlspecialchars($_REQUEST["PROPERTY"]["TECHNICAL_DIRECTOR_EMAIL"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["TECHNICAL_DIRECTOR_EMAIL"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<h4><?=GetMessage("HEAD_INTRODUCTION")?></h4>
	<div class="tree_input_container">
		<div class="field">
			<label class="field_label"><?=GetMessage("NAME")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[HEAD_INTRODUCTION_NAME]" value="<?=$_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_NAME"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_NAME"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_INTRODUCTION_NAME"])?>" />
			</div>
		</div>
		<div class="field">
			<label class="field_label"><?=GetMessage("PHONE")?></label>
			<div class="inputContainer">
				<input type="text" class="phone_asc" name="PROPERTY[HEAD_INTRODUCTION_PHONE]" value="<?=$_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_PHONE"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_PHONE"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_INTRODUCTION_PHONE"])?>" />
			</div>
		</div>
		<div class="field last">
			<label class="field_label"><?=GetMessage("EMAIL")?></label>
			<div class="inputContainer">
				<input type="text" name="PROPERTY[HEAD_INTRODUCTION_EMAIL]" value="<?=$_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_EMAIL"] ? htmlspecialchars($_REQUEST["PROPERTY"]["HEAD_INTRODUCTION_EMAIL"]) : htmlspecialchars($_SESSION["FORM"]["PROPERTY"]["HEAD_INTRODUCTION_EMAIL"])?>" />
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<h3><?=GetMessage("DIRECTIONS")?></h3>
	<?$arFields = array("Розничная торговля", "Оптовая торговля", "Установка и внедрение", "Обслуживание", "Ремонт");
	$sferi = array("Автономные ККМ", "Фискальные регистраторы", "POS-системы", "Программное обеспечение", "Комплексы этикетирования", "Информационные киоски", "Платежные терминалы", "Банковские терминалы");?>
	<table>
		<tr>
			<th class="FIELD_OF_ACTIVITY"></th>
			<?foreach($arFields as $napr):?>
				<th class="FIELD_OF_ACTIVITY"><?=$napr?></th>
			<?endforeach;?>
		</tr>
		<?foreach($sferi as $key => $sfera):?>
			<tr>
				<td><?=$sfera?></td>
				<?foreach($arFields as $napr):?>
					<td>
						<label class="label_check" for="people_contacts">
							<input name="PROPERTY[FIELD_OF_ACTIVITY][<?=$sfera?>][<?=$napr?>]" type="checkbox" value="<?=$napr?>" <?if($_REQUEST["PROPERTY"]["FIELD_OF_ACTIVITY"][$sfera][$napr] == $napr || $_SESSION["FORM"]["PROPERTY"]["FIELD_OF_ACTIVITY"][$sfera][$napr] == $napr):?> checked="checked" <?endif;?> />&nbsp;
						</label>
					</td>
				<?endforeach;?>
			</tr>
		<?endforeach;?>
	</table>
</div>
<input type="hidden" name="next_step" value="2" />
<button type="submit" name="directions" class="orange_submit" value="next"><?=mb_strtoupper(GetMessage("CONTINUE"))?></button>