<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !$USER->IsAuthorized())
	$arResult["SHOW"] = false;
elseif(empty($arResult["PROPERTIES"]["OPEN"]["VALUE"]) && !in_array(UG_PO, CUser::GetUserGroup($USER->GetID())))
	$arResult["SHOW"] = false;
else 
	$arResult["SHOW"] = true;?>
<?if($arResult["SHOW"] == true):?>
	<h3><?=getDateText($arResult["DATE_ACTIVE_FROM"], $arResult["DATE_ACTIVE_TO"])?></h3>
	<?if(!empty($arResult["PREVIEW_TEXT"])):?>
		<p><?=$arResult["PREVIEW_TEXT"];?></p>
	<?endif;?>
<?endif;?>