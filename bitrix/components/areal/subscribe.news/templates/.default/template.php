<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["IBLOCKS"])):?>
	<h1>Рассылка новостей компании Штрих-М</h1>
	<?foreach($arResult["IBLOCKS"] as $arIBlock):?>
		<?if(count($arIBlock["ITEMS"]) > 0):?>
			<h2><?=$arIBlock['NAME']?></h2>
			<table cellpadding="0" cellspacing="10" border="0">
				<?foreach($arIBlock["ITEMS"] as $arItem):?>
					<tr>
						<td class="info_block">
							<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
						</td>
						<td>
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><h3><?=$arItem["NAME"]?></h3></a>
							<h3><?=$arItem["DATE_ACTIVE_FROM"]?></h3>
							<p><?=$arItem["PREVIEW_TEXT"];?></p>							
						</td>
					</tr>
				<?endforeach;?>
			</table>
		<?endif;?>
	<?endforeach?>
<?endif;?>
