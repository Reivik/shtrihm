<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if (count($arResult["ITEMS"]) < 1):?>
	<?/*<div class="messErr">В этом блоке нет новостей, удовлетворяющих параметрам фильтра</div>*/?>
	<?return;?>
<?endif;?>
<?$APPLICATION->IncludeComponent("bitrix:subscribe.form", "new_subscribe", Array(
	"USE_PERSONALIZATION" => "Y",	// Определять подписку текущего пользователя
	"PAGE" => "/subscribe/subscr_edit.php",	// Страница редактирования подписки (доступен макрос #SITE_DIR#)
	"SHOW_HIDDEN" => "N",	// Показать скрытые рубрики подписки
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"CACHE_NOTES" => ""
	),
	false
);?>
<?/*
<h2 class='archiveTitle'>Архив новостей</h2>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<div class="item_list_catalog">
		<div class="photo">
			<table class="photo">
				<tr>
					<td>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
							<?if(!empty($arItem["PREVIEW_PICTURE"]["src"])):?>
								<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?else:?>
								<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?endif;?>
						</a>
					</td>
				</tr>
			</table>
		</div>
		<div class="text">
			<h2><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h2>
			<?if(!empty($arItem["DISPLAY_ACTIVE_FROM"])):?>
				<span><?=$arItem["DISPLAY_ACTIVE_FROM"];?></span>
			<?endif;?>
			<?if($arItem["PREVIEW_TEXT_TYPE"] == "text"):?>
				<p><?=(strlen($arItem['PREVIEW_TEXT']) > 200 ? substr($arItem['PREVIEW_TEXT'], 0, 200)."..." : $arItem['PREVIEW_TEXT'])?></p>
			<?elseif($arItem["PREVIEW_TEXT_TYPE"] == "html"):?>
				<p><?=(strlen(strip_tags($arItem['PREVIEW_TEXT'])) > 200 ? substr(strip_tags($arItem['PREVIEW_TEXT']), 0, 200)."..." : strip_tags($arItem['PREVIEW_TEXT']))?></p>
			<?endif;?>
		</div>			
		<div class="show">				
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
		</div>
		<div class="clear"></div>
	</div>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>
*/?>