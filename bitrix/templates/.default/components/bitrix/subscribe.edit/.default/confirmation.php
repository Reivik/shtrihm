<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get" class="filter_form">
	<h3><?echo GetMessage("subscr_title_confirm")?></h3>
	<div class="inputContainer">
		<input type="text" name="CONFIRM_CODE" value="<?echo $arResult["REQUEST"]["CONFIRM_CODE"];?>" size="20" placeholder="<?echo GetMessage("subscr_conf_code")?>" />
	</div>
	<p>
		<?echo GetMessage("subscr_conf_note1")?> <a title="<?echo GetMessage("adm_send_code")?>" href="<?echo $arResult["FORM_ACTION"]?>?ID=<?echo $arResult["ID"]?>&amp;action=sendcode&amp;<?echo bitrix_sessid_get()?>"><?echo GetMessage("subscr_conf_note2")?></a>.
	</p>
	<input type="submit" class="inpBtn" name="confirm" value="<?echo GetMessage("subscr_conf_button")?>" />	
	<input type="hidden" name="ID" value="<?echo $arResult["ID"];?>" />
	<?echo bitrix_sessid_post();?>
	<div class="clear"></div>
</form>
