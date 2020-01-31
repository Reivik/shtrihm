<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?foreach($arResult["ITEMS"] as $key => $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	$count = $key + 1;?>
<p id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?=$count?>. <a href="<?=$arItem['DISPLAY_PROPERTIES']['SITE']['VALUE']?>" target="_blank"><?=$arItem['NAME']?></a><br>
		<?=$arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']?>
		<br>
		<?=$arItem['DISPLAY_PROPERTIES']['ADRES']['VALUE']?>
	</p>
<?endforeach;?>
<?/*if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;*/?>