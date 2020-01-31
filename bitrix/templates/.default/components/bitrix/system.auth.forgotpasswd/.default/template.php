<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?ShowMessage($arParams["~AUTH_RESULT"]);?>
<?if(!empty($_REQUEST["USER_EMAIL"])) {
	if(check_email($_REQUEST["USER_EMAIL"])) {
		$filter = Array("EMAIL" => $_REQUEST["USER_EMAIL"]);
		$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
		if($arUsr = $rsUsers->Fetch())
			ShowNote(GetMessage("AUTH_SUCCESS"));
		else ShowError(GetMessage("NO_USER"));
	}
	else {		
		ShowError(GetMessage("NO_EMAIL"));
	}	
}
?>
<form name="bform" method="post" target="_top" class="filter_form system" action="<?=$arResult["AUTH_URL"]?>">
	<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif;?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
	<div class="inputContainer">
		<input type="text" name="USER_EMAIL" value="<?=htmlspecialcharsEx($_REQUEST["USER_EMAIL"])?>" maxlength="255" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />
	</div>
	<input type="submit" class="orange_submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />

	<div class="clear"></div>
</form>
<p><a href="/login/"><?=GetMessage("AUTH_AUTH")?></a></p> 
