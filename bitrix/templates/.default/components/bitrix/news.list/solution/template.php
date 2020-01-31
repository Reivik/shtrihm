<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>	
	<h2>Внедрения</h2>	
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<div class="introduction_solution">
			<div class="photo">
				<table>
					<tr>
						<td>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>">
								<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
									<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" />
								<?else:?>
									<img src="/design/images/no-photo/pic117x117.png" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" width="117" height="117" />
								<?endif;?>
							</a>
						</td>
					</tr>
				</table>
			</div>
			<div class="text">
				<h3><?=$arItem["NAME"]?></h3>
				<p>Внедрение <span><?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"];?></span></p>
				<a class="inpBtn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Смотреть</a>
			</div>
		</div>
	<?endforeach;?>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?endif;?>