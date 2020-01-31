<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (count($arResult["ITEMS"]) < 1):?>
	<?return;?>
<?endif;?>

<ul class="articlesList">
<?foreach($arResult["ITEMS"] as $arItem):?>
<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('NEWS_ELEMENT_DELETE_CONFIRM')));
?>
	<li  id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		
		<div class="photo">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
			<?if(is_array($arItem["PREVIEW_PICTURE"])):?>
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" />
			<?else:?>
				<img src="/images/no_photo_59.jpg" />
			<?endif;?>
			</a>
		</div>
		
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="date"><?=date_convert($arItem["DISPLAY_ACTIVE_FROM"])?></div>
		<?endif?>
			
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<p>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></a>
			<?else:?>
				<?echo $arItem["NAME"]?>
			<?endif;?>
			</p>
		<?endif;?>
				
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
		<?endif;?>

	</li>
<?endforeach;?>
</ul>

<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>