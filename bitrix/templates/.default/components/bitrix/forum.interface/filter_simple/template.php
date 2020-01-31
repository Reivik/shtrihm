<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeAJAX();
$GLOBALS['APPLICATION']->AddHeadScript("/bitrix/js/main/utils.js");
$GLOBALS['APPLICATION']->AddHeadScript("/bitrix/components/bitrix/forum.interface/templates/popup/script.js");
$arParams['FORM_METHOD_GET'] = (isset($arParams['FORM_METHOD_GET']) && ($arParams['FORM_METHOD_GET'] == 'Y')) ? 'Y' : 'N';
$iIndex = rand();
?>

<script>
if (phpVars == null || typeof(phpVars) != "object")
{
	var phpVars = {
		'ADMIN_THEME_ID': '.default',
		'titlePrefix': '<?=CUtil::JSEscape(COption::GetOptionString("main", "site_name", $_SERVER["SERVER_NAME"]))?> - '};
}
</script>
<?
$method = ($arParams['FORM_METHOD_GET'] == 'Y' ? 'get' : 'post');
$action = ($method === 'get' ? htmlspecialcharsbx($APPLICATION->GetCurPage()) : POST_FORM_ACTION_URI );
?>
	<form name="forum_form" id="forum_form_<?=$arResult["id"]?>" action="<?=$action?>" method="<?=$method?>" class="forum-form">
<?
	if ($arParams['FORM_METHOD_GET'] != 'Y') {
		echo bitrix_sessid_post();
	}
	foreach ($arResult["FIELDS"] as $key => $res):
		if ($res["TYPE"] == "HIDDEN"):
?>
	<input type="hidden" name="<?=$res["NAME"]?>" value="<?=$res["VALUE"]?>" />
<?
			unset($arResult["FIELDS"][$key]);
		endif;
	endforeach;

	$counter = 0;
	foreach ($arResult["FIELDS"] as $key => $res):
		$res["ID"] = (empty($res["ID"]) ? $res["NAME"]."_".$iIndex : $res["ID"]);
?>
	<div class="forum-filter-field <?=$res["CLASS"]?>">
		<label class="forum-filter-field-title" for="<?=$res["ID"]?>"><?=$res["TITLE"]?>:</label>
		<span class="forum-filter-field-item">
<?

		if ($res["TYPE"] == "SELECT"):
			if (!empty($_REQUEST["del_filter"]))
				$res["ACTIVE"] = "";
?>			<div class="actFilterSelect">
					<select name="<?=$res["NAME"]?>" class="<?=$res["CLASS"]?>" id="<?=$res["ID"]?>" <?//=($res["MULTIPLE"] == "Y" ? "multiple='multiple' size='5'" : "")?>>
		<?
					foreach ($res["VALUE"] as $key => $val)
					{
						if ($val["TYPE"] == "OPTGROUP"):
		?>
						<optgroup label="<?=str_replace(array(" ", "&amp;nbsp;") , "&nbsp;", $val["NAME"])?>" class="<?=$val["CLASS"]?>"></optgroup>
		<?
						else:
		?>
						<option value="<?=$key?>" <?=($res["ACTIVE"] == $key ? " selected='selected'" : "")?>><?=str_replace(
							array(" ", "&amp;nbsp;"), "&nbsp;", $val["NAME"])?></option>
		<?
						endif;
					}
		?>
					</select>
				</div>
<?			
		elseif ($res["TYPE"] == "PERIOD"):
			if (!empty($_REQUEST["del_filter"]))
			{
				$res["VALUE"] = "";
				$res["VALUE_TO"] = "";
			}
			?>
			<div class="ForumFilterDate">
				<?$APPLICATION->IncludeComponent("areal:forum.calendar", ".default",
					array(
						"SHOW_INPUT" => "Y",
						"INPUT_NAME" => $res["NAME"], 
						"INPUT_NAME_FINISH" => $res["NAME_TO"],
						"INPUT_VALUE" => (!isset($_GET[$res["NAME"]]))?"":$res["VALUE"], 
						"INPUT_VALUE_FINISH" => $res["VALUE_TO"],
						"FORM_NAME" => "forum_form"),
					false
				);?>
			</div>
			
			<?
		elseif ($res["TYPE"] == "CHECKBOX"):
?>
			<label class="label_check <?=($res["ACTIVE"] == $res["VALUE"] ? "c_on" : "c_off")?>"for="<?=$res["ID"]?>">
				<input name="<?=$res["NAME"]?>" id="<?=$res["ID"]?>" value="<?=$res["VALUE"]?>" type="checkbox" <?=($res["ACTIVE"] == $res["VALUE"] ? " checked='checked' " : "")?>>
				<?=$res["LABEL"]?>
			</label>
<?
		else:
			if (!empty($_REQUEST["del_filter"]))
			{
				$res["VALUE"] = "";
			}
?>
			<input type="text" name="<?=$res["NAME"]?>" id="<?=$res["ID"]?>" value="<?=$res["VALUE"]?>" class="inputText forumFilter <?=$res["CLASS"]?>" />
<?
		endif;
?>
		</span>
		<div class="forum-clear-float"></div>
	</div>
<?
	endforeach;
?>
	<div class="forum-filter-field forum-filter-footer">
<?
	if (empty($arResult["BUTTONS"])):
?>
		<div class="forum-filter-buttons">
			<input type="submit" name="set_filter" value="<?=GetMessage("FORUM_BUTTON_FILTER")?>" class="inputBtn ap_btn"  onclick="submit_forum_filter_form();"/>
			<input type="submit" name="del_filter" value="<?=GetMessage("FORUM_BUTTON_RESET")?>"  class="inputBtn ap_btn"  />
		</div>
<?
	else: 
		$counter = 0; 
		foreach ($arResult["BUTTONS"] as $res):
		
?>
		<span class="<?=($counter == 0 ? "forum-filter-first" : "")?>">
			<input type="submit" name="<?=$res["NAME"]?>" value="<?=$res["VALUE"]?>" class="inputBtn" />
		</span>
<?
		endforeach;
	endif;
?>
		<div class="forum-clear-float"></div>
	</div> 
</form><?
