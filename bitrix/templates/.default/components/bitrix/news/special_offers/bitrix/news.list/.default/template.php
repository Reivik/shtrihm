<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
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
<?else:?>
	<p><?=GetMessage("NO_ITEMS")?></p>
<?endif;?>