<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if ($arResult["ITEMS"]<1):?>
	<p>На данный момент нет открытых вакансий</p>
<?else:?>	
	<ul>
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<li><a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a></li>
				<?else:?>
					<b><?echo $arItem["NAME"]?></b>
				<?endif;?>
			<?endif;?>		
		<?endforeach;?>
	</ul>
	<div class="clear"></div>
<?endif?>
