<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<div class="activity">
		<?foreach($arResult["ITEMS"] as $key => $arItem):?>
			<article <?if(($key+1)%2 == 0):?> class="right" <?endif;?> >
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
					<table class="article">
						<tr>
							<td colspan="2">
								<h3><?=$arItem["NAME"]?></h3>
							</td>
						</tr>
						<tr>
							<td class="img">							
								<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
									<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
								<?endif;?>							
							</td>
							<td class="details">							
								<div class="detail company">
									<label>Дата проведения:</label>
									<span><?=getDateText($arItem["DATE_ACTIVE_FROM"], $arItem["DATE_ACTIVE_TO"])?></span>
								</div>
								<div class="detail">
									<label>Место проведения:</label>
									<span class="place">г. <?=$arItem["TOWN"]?>, <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?></span>
								</div>
								<span class="btn">Подробнее</span>
							</td>						
						</tr>
					</table>
				</a>
			</article>
		<?endforeach;?>
		<div class="clear"></div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<?=$arResult["NAV_STRING"]?>
		<?endif;?>
	</div>
<?else:?>
	<p>Не найдено результатов, удовлетворяющих параметрам фильтра.</p>
<?endif;?>