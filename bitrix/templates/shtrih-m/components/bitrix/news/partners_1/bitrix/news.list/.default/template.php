<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
<div style="display:none;"><?echo '<pre>';print_r($arResult["ITEMS"][0]);echo '</pre>';?></div>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="partners_block">
			<table>
				<tr>
					<td class="image_block">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						</a>						
					</td>
					<td class="info_block">						
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><h3><?=$arItem["NAME"]?></h3></a>
						<p><?=strlen($arItem["PREVIEW_TEXT"]) > 200 ? substr($arItem["PREVIEW_TEXT"], 0, 200)."..." : $arItem["PREVIEW_TEXT"];?></p>
						<p class="addintional_info">
							<?if(!empty($arItem["STATUS"])):?>
							<span>Статус: <?foreach($arItem["STATUS"] as $status):?><?if(!empty($status["PREVIEW_PICTURE"]["src"])):?><img class="img_status" src="<?=$status["PREVIEW_PICTURE"]["src"]?>" width="<?=$status["PREVIEW_PICTURE"]["width"]?>" height="<?=$status["PREVIEW_PICTURE"]["height"]?>" title="<?=$status["NAME"]?>" alt="<?=$status["NAME"]?>" /><?else:?><?=$status["NAME"]?><?endif;?>; 
								<?/*
$ELEMENT_ID = $arItem["ID"]; 
$PROPERTY_CODE = "RATING";  
$PROPERTY_VALUE = $status["NAME"];  
CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
*/?>
<?endforeach?></span><br />
							<?endif;?>
							<?if(!empty($arItem["MAIN_OFFICE"])):?>
								<span>Главный офис: <?=$arItem["MAIN_OFFICE"]?></span>
							<?endif;?>					
						</p>	
						<a class="inpBtn" href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">Подробнее</a>
					</td>
				</tr>
			</table>
			<div class="clear"></div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<?ShowError("Партнеров, соответствующих параметрам поиска не найдено! Повторите поиск по другим регионам.")?>
<?endif;?>
