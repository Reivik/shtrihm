<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<table class="show_info">
		<tr>
			<th colspan="2">Компания</th>
			<th>Описание</th>
		</tr>				
		<?foreach($arResult['ITEMS'] as $arEmployee):?>
			<tr>
				<td class="photo">
					<?if(!empty($arEmployee['PROPERTIES']['SITE']['VALUE'])):?>
						<a href="<?=$arEmployee['PROPERTIES']['SITE']['VALUE']?>" title="<?=$arEmployee['NAME']?>" target="_blank">
					<?endif;?>
					<?if($arEmployee["PREVIEW_PICTURE"]["src"]):?>
						<img src="<?=$arEmployee["PREVIEW_PICTURE"]["src"]?>" alt="<?=$arEmployee['NAME']?>" title="<?=$arEmployee['NAME']?>" width="<?=$arEmployee["PREVIEW_PICTURE"]["width"]?>" height="<?=$arEmployee["PREVIEW_PICTURE"]["height"]?>" />
					<?else:?>
						<img src="/design/images/no-photo/pic102x102.png" width="102" height="102" alt="<?=$arEmployee["NAME"]?>" title="<?=$arEmployee["NAME"]?>" />
					<?endif;?>
					<?if(!empty($arEmployee['PROPERTIES']['SITE']['VALUE'])):?>
						</a>
					<?endif;?>
				</td>
				<td class="name">
					<strong><?=$arEmployee['NAME']?></strong>
				</td>
				<td class="text" align="justify">
					<div class="preview_news full">
						<?echo $arEmployee["PREVIEW_TEXT"];?><br />
						<?if(!empty($arEmployee['PROPERTIES']['SITE']['VALUE'])):?>
							<?if(stripos($arEmployee['PROPERTIES']['SITE']['VALUE'], "http://") === false && stripos($arEmployee['PROPERTIES']['SITE']['VALUE'], "https://") === false):?>			
								<p class="site"><b>Сайт компании:</b> <a href="http://<?=$arEmployee['PROPERTIES']['SITE']['VALUE']?>" title="<?=$arEmployee['NAME']?>" target="_blank"><?=$arEmployee['PROPERTIES']['SITE']['VALUE']?></a></p>
							<?else:?>
								<p class="site"><b>Сайт компании:</b> <a href="<?=$arEmployee['PROPERTIES']['SITE']['VALUE']?>" title="<?=$arEmployee['NAME']?>" target="_blank"><?=$arEmployee['PROPERTIES']['SITE']['VALUE']?></a></p>
							<?endif;?>
						<?endif;?>
					</div>
					<?if(strlen($arEmployee["PREVIEW_TEXT"]) > 145):?>
						<a href="#" class="showMorePreview">Подробнее</a>
						<a href="#" class="hideMorePreview">Свернуть</a>
					<?endif;?>
				</td>
			</tr>
		<?endforeach;?>
	</table>
<?else:?>
	<p>Нет доступной информации</p>
<?endif;?>
