<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<?foreach($arResult["ITEMS"] as $cell=>$arElement):?>
		<div class="item_list_catalog">
			<div class="photo">
				<table class="photo">
					<tr>
						<td>
							<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" title="<?=$arElement["NAME"]?>">
								<?if(!empty($arElement["PREVIEW_PICTURE"]["SRC"])):?>
									<img src="<?=$arElement["PREVIEW_PICTURE"]["SRC"]?>" width="<?=$arElement["PREVIEW_PICTURE"]["WIDTH"]?>" height="<?=$arElement["PREVIEW_PICTURE"]["HEIGHT"]?>" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
								<?else:?>
									<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$arElement["NAME"]?>" title="<?=$arElement["NAME"]?>" />
								<?endif;?>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="text">
				<h2><a href="<?=$arElement["DETAIL_PAGE_URL"]?>"><?=$arElement["NAME"]?></a></h2>
				<?if(!empty($arElement['PREVIEW_TEXT'])):?>
					<?if($arElement["PREVIEW_TEXT_TYPE"] == "text"):?>
						<p><?=(strlen($arElement['PREVIEW_TEXT']) > 200 ? substr($arElement['PREVIEW_TEXT'], 0, 200)."..." : $arElement['PREVIEW_TEXT'])?></p>
					<?elseif($arElement["PREVIEW_TEXT_TYPE"] == "html"):?>
						<p><?=(strlen(strip_tags($arElement['PREVIEW_TEXT'])) > 200 ? substr(strip_tags($arElement['PREVIEW_TEXT']), 0, 200)."..." : strip_tags($arElement['PREVIEW_TEXT']))?></p>
					<?endif;?>
				<?endif;?>
			</div>
			<div class="show">
				<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="view">Смотреть</a>
			</div>
			<div class="clear"></div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p>К сожалению в данном разделе пока нет решений.</p>
<?endif;?>
