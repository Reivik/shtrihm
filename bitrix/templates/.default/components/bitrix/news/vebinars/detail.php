<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "Y");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "N");
$APPLICATION->SetPageProperty("VEBINARS_LIST_LEFT", "N");
?>
<?if(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))):?>
	<?$APPLICATION->IncludeComponent("areal:vebinar.edit", ".default", array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"]));?>
<?else:?>
	<?$APPLICATION->IncludeComponent("areal:vebinar.partner.detail", ".default", array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"]));?>
	<p><a href="<?=$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["news"]?>"><?=GetMessage("T_NEWS_DETAIL_BACK")?></a></p>
<?endif;?>
