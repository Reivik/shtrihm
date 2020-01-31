<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $NavNum;
$NavNum = 0;
?>
<?if(count($arResult["ITEMS"]) > 0):?>
	<table>
		<tr>
			<th colspan="2"><?=GetMessage("NAME")?></th>
			<?if ($arResult["ITEMS"][0]["PROPERTIES"]["PARTNER"]["VALUE"]) {?>
			<th><?=GetMessage("PARTNER")?></th>
			<?}?>
		</tr>
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<tr>
			<td class="photo">
				<?if(!empty($arItem["PREVIEW_PICTURE"])):?>					
					<img class="photo" src="<?=$arItem["PREVIEW_PICTURE"]["src"]?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" width="<?=$arItem["PREVIEW_PICTURE"]["width"]?>" height="<?=$arItem["PREVIEW_PICTURE"]["height"]?>" />				
				<?else:?>
					<img src="/design/images/no-photo/pic117x117.png" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>" width="117" height="117" />		
				<?endif;?>
			</td>
			<td>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=$arItem["NAME"]?>"><?=$arItem["NAME"]?></a><br />			
				<strong><?=GetMessage("REGION")?>:</strong> <?=$arItem["PROPERTIES"]["REGION"]["VALUE"]?><br />	
				<strong><?=GetMessage("TOWN")?>:</strong> <?=$arItem["PROPERTIES"]["CITY"]["VALUE"]?><br />			
				<strong><?=GetMessage("ADDRESS")?>:</strong> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"]?>
			</td>
			<?if ($arItem["PROPERTIES"]["PARTNER"]["VALUE"]) {?>
			<td><a href="<?=$arItem["PROPERTIES"]["PARTNER"]["DETAIL_PAGE_URL"]?>" title="<?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"];?>"><?=$arItem["PROPERTIES"]["PARTNER"]["VALUE"];?></a></td>			
			<?}?>
		</tr>
	<?endforeach;?>
	</table>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p><?=GetMessage("NO_ITEM")?></p>
<?endif;?>