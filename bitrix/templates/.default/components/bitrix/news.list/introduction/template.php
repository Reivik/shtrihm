<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) > 0):?>	
	<h2>Внедрения</h2>
	<table class="introduction_table">
		<tr>
			<th colspan="2">Название</th>
			<th>Адрес</th>
			<th colspan="2">Описание</th>					
		</tr>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<tr>				
				<td class="photo">
					<?if(!empty($arItem["PREVIEW_PICTURE"])):?>
						<img src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" />
					<?endif;?>
				</td>						
				<td><?=$arItem["NAME"]?></td>						
				<td><?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?></td>						
				<td><?=$arItem["PREVIEW_TEXT"]?></td>
				<td class="photo"><a class="inpBtn" href="<?=$arItem["DETAIL_PAGE_URL"]?>">Смотреть</a></td>	
			</tr>
		<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?endif;?>