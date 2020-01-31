<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->AddHeadScript('\bitrix\templates\.default\components\bitrix\catalog.smart.filter\shtrih-m\script.js');?>
<?
$flag = 0;
foreach($arResult["ITEMS"] as $arItem) {
	if(!empty($arItem["VALUES"]))
		$flag = 1;
}?>
<?if($flag == 1):?>
	<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get" class="smartfilter">
		<input type="hidden" name="filter" value="Y" />
		<?foreach($arResult["HIDDEN"] as $arItem):?>
			<input
				type="hidden"
				name="<?echo $arItem["CONTROL_NAME"]?>"
				id="<?echo $arItem["CONTROL_ID"]?>"
				value="<?echo $arItem["HTML_VALUE"]?>"
			/>
		<?endforeach;?>
		<div class="filter">
			<div class="filterIn">
						<div class="title">
							Поиск
						</div>
						<div class="filterCont" <?if($_REQUEST["set_filter"]){?>style="display: block;"<?}?>>
							<div class="filterContIn">
							
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if($arItem["PROPERTY_TYPE"] == "N" || isset($arItem["PRICE"])):?>
				<dl id="ul_<?echo $arItem["ID"]?>">
					<dt><?=$arItem["NAME"]?></dt>
						<dd>	
							<label class="num"><?echo GetMessage("CT_BCSF_FILTER_FROM")?></label>
							<input class="inpText" type="text" name="<?echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MIN"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MIN"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)" />
							<label class="num"><?echo GetMessage("CT_BCSF_FILTER_TO")?></label>
							<input class="inpText" type="text" name="<?echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" id="<?echo $arItem["VALUES"]["MAX"]["CONTROL_ID"]?>" value="<?echo $arItem["VALUES"]["MAX"]["HTML_VALUE"]?>" size="5" onkeyup="smartFilter.keyup(this)"/>
							<div class="clear"></div>
						</dd>
				</dl>
				<?elseif(!empty($arItem["VALUES"])):;?>
					<dl id="ul_<?echo $arItem["ID"]?>">
					<dt><?=$arItem["NAME"]?></dt>

						<dd>

							<div class="bx-filter-select-text" data-role="currentOption">
								<?
								foreach ($arItem["VALUES"] as $val => $ar)
								{
									if ($ar["CHECKED"])
									{
										echo $ar["VALUE"];
										$checkedItemExist = true;
									}
								}
								if (!$checkedItemExist)
								{
									echo GetMessage("ВСЕ");
								}
								?>
							</div>

							<?foreach ($arItem["VALUES"] as $val => $ar):?>
								<input
									style="display: none"
									type="radio"
									name="<?=$ar["CONTROL_NAME_ALT"]?>"
									id="<?=$ar["CONTROL_ID"]?>"
									value="<? echo $ar["HTML_VALUE_ALT"] ?>"
									<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
								/>
							<?endforeach?>
						</dd>


					<?foreach($arItem["VALUES"] as $val => $ar):?>
					<!--<dd>
						<div class="checkBlock">
							<label class="label_check" for="<?echo $ar["CONTROL_ID"]?>"><input name="<?echo $ar["CONTROL_NAME"]?>" id="<?echo $ar["CONTROL_ID"]?>" value="<?echo $ar["HTML_VALUE"]?>" type="checkbox" onchange="smartFilter.click(this)" <?echo $ar["CHECKED"]? 'checked="checked"': ''?> <?echo $ar["DISABLED"]? ' disabled = "disabled"': ''?>><?echo $ar["VALUE"];?></label>
						</div>
					</dd>-->
					<?endforeach;?>

				</dl>
				<?endif;?>
			<?endforeach;?>
			<input type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>" class="inpBtn"/>
			<input type="submit" id="del_filter" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" class="inpBtn"/>
		</div>
		</div>
			<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?echo GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?echo $arResult["FILTER_URL"]?>" class="showchild"><?echo GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				<!--<span class="ecke"></span>-->
			</div>
		</div>
		</div>
	</form>
	<script>
		//var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($APPLICATION->GetCurPageParam())?>');
	</script>
<?endif;?>