<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="partners_block">
			<table>
				<tr>
					<td class="image_block">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
							<?if(!empty($arItem["PREVIEW_PICTURE"]["src"])):?>
								<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?else:?>
								<img src="/design/images/no-photo/pic171x171.png" width="171" height="171" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
							<?endif;?>
						</a>						
					</td>
					<td class="info_block">						
						<h3><?=$arItem["NAME"]?></h3>
						<?if($arItem["PREVIEW_TEXT_TYPE"] == "text"):?>
							<p><?=(strlen($arItem['PREVIEW_TEXT']) > 200 ? substr($arItem['PREVIEW_TEXT'], 0, 200)."..." : $arItem['PREVIEW_TEXT'])?></p>
						<?elseif($arItem["PREVIEW_TEXT_TYPE"] == "html"):?>
							<p><?=(strlen(strip_tags($arItem['PREVIEW_TEXT'])) > 200 ? substr(strip_tags($arItem['PREVIEW_TEXT']), 0, 200)."..." : strip_tags($arItem['PREVIEW_TEXT']))?></p>
						<?endif;?>
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
	<p>По Вашему запросу ничего не найдено.</p>
<?endif;?>