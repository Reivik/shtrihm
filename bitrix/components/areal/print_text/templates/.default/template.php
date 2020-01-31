<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<h1><?=$arResult["NAME"]?></h1>
<?if(!empty($arResult["DETAIL_PICTURE"])):?>
	<img style="float: right; margin: 0 0 10px 10px;" src="<?=$arResult["DETAIL_PICTURE"]["src"]?>" width="<?=$arResult["DETAIL_PICTURE"]["width"]?>" height="<?=$arResult["DETAIL_PICTURE"]["height"]?>" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>" />
<?endif;?>
<?=$arResult["DETAIL_TEXT"]?>