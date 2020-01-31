<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(!empty($arResult["ITEMS"])):?>
	<p><?=GetMessage("DESCRIPTION");?></p>
	<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<li><a href="<?=$arItem["DETAIL_PAGE_URL"]?>" title="<?=GetMessage("MORE");?>"><?=$arItem["NAME"]?></a></li>				
		<?endforeach;?>
	</ul>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
<?else:?>
	<p><?=GetMessage("NO_ITEMS");?></p>
<?endif;?>

