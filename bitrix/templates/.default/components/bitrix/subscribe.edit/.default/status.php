<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=$arResult["FORM_ACTION"]?>" method="get">
	<h3><?echo GetMessage("subscr_title_status")?></h3>
	<p>
		<?if($arResult["SUBSCRIPTION"]["CONFIRMED"] <> "Y"):?>
			<p><?echo GetMessage("subscr_title_status_note1")?></p>
		<?elseif($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
			<p><?echo GetMessage("subscr_title_status_note2")?></p>
			<p><?echo GetMessage("subscr_status_note3")?></p>
		<?else:?>
			<p><?echo GetMessage("subscr_status_note4")?></p>
			<p><?echo GetMessage("subscr_status_note5")?></p>
		<?endif;?>
	</p>
	<?if($arResult["SUBSCRIPTION"]["CONFIRMED"] == "Y"):?>	
		<?if($arResult["SUBSCRIPTION"]["ACTIVE"] == "Y"):?>
			<input type="submit" name="unsubscribe" value="<?echo GetMessage("subscr_unsubscr")?>" />
			<input type="hidden" name="action" value="unsubscribe" />
		<?else:?>
			<input type="submit" name="activate" value="<?echo GetMessage("subscr_activate")?>" />
			<input type="hidden" name="action" value="activate" />
		<?endif;?>			
	<?endif;?>
	<input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
	<?echo bitrix_sessid_post();?>
</form>