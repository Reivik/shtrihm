<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult['ITEMS']) > 0):?>
	<?foreach ($arResult['ITEMS'] as $key => $arElement):
		$bHasPicture = is_array($arElement['PREVIEW_IMG']);
		$sticker = "";
		if (array_key_exists("PROPERTIES", $arElement) && is_array($arElement["PROPERTIES"]))
		{
			foreach (Array("SPECIALOFFER", "NEWPRODUCT", "SALELEADER") as $propertyCode)
				if (array_key_exists($propertyCode, $arElement["PROPERTIES"]) && intval($arElement["PROPERTIES"][$propertyCode]["PROPERTY_VALUE_ID"]) > 0)
					$sticker .= "&nbsp;<span class=\"sticker\">".$arElement["PROPERTIES"][$propertyCode]["NAME"]."</span>";
		}?>
		<div class="item_list_catalog">
			<div class="photo">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>">
					<?if(!empty($arElement["PREVIEW_IMG"]["SRC"])):?>
						<img src="<?=$arElement["PREVIEW_IMG"]["SRC"]?>" width="<?=$arElement["PREVIEW_IMG"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_IMG"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
					<?else:?>
						<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
					<?endif;?>
				</a>
			</div>
			<div class="text">
				<h2><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h2>
				<p><?=$arElement['PREVIEW_TEXT']?></p>
				<p class="additional_properties">
					<?
					$i=0; 
					foreach($arElement["PROPERTIES"] as $key => $pr) {
					if($i == 3) break;
					if($pr["VALUE"] && $pr["PROPERTY_TYPE"] != "F" && $key != 'MORE_PHOTO' && $key != 'other_product' && $key != 'dop_chars' && $key != 'type') {
					$i++;?>
						<span><?=$pr["NAME"]?>: <?= (is_array($pr["VALUE"]) ? implode(", ", $pr["VALUE"]) : $pr["VALUE"])?></span><br />
					<?}
					}?>
				</p>
			</div>
			<div class="show">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
				<div class="compare">
					<label class="label_check" for="checkbox2-<?=$arElement['ID']?>">
						<input name="sample-checkbox2_<?=$arElement['ID']?>" id="checkbox2-<?=$arElement['ID']?>" value="<?=$arElement['ID']?>" type="checkbox">
						<span class="compareLink">Сравнить</span>
					</label>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	<?endforeach?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"];?>
	<?endif;?>
<?else:?>
	<p>В настоящий момент в этом разделе нет продуктов.</p>
<?endif;?>