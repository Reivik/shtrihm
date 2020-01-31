<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="post" class="filter_form">
	<?echo bitrix_sessid_post();?>
	<h3><?echo GetMessage("subscr_title_settings")?></h3>
	<div class="inputContainer">
		<input type="text" name="EMAIL" value="<?=$arResult["SUBSCRIPTION"]["EMAIL"]!=""?$arResult["SUBSCRIPTION"]["EMAIL"]:$arResult["REQUEST"]["EMAIL"];?>" size="30" maxlength="255" placeholder="<?echo GetMessage("subscr_email")?>" />
	</div>
	<?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
		<?if($arParams["EGAIS"] == "Y"):?>
			<input type="hidden" name="RUB_ID[]" value="2" />
			<input type="hidden" name="RUB_ID[]" value="3" />
			<?break;?>
		<?else: ?>
				<input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
		<?endif;?>
	<?endforeach;?>
	<input type="hidden" name="FORMAT" value="html" />
	<input type="submit" name="Save" value="<?echo ($arResult["ID"] > 0? GetMessage("subscr_upd"):GetMessage("subscr_add"))?>" />	
	<input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<?if($_REQUEST["register"] == "YES"):?>
		<input type="hidden" name="register" value="YES" />
	<?endif;?>
	<?if($_REQUEST["authorize"]=="YES"):?>
		<input type="hidden" name="authorize" value="YES" />
	<?endif;?>
	<div class="clear"></div>
</form>