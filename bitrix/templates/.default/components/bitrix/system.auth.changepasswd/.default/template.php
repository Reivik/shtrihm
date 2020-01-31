<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?ShowMessage($arParams["~AUTH_RESULT"]);?>
<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform" class="filter_form">
	<?if (strlen($arResult["BACKURL"]) > 0): ?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<? endif ?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="CHANGE_PWD">
	<div class="inputContainer">
		<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
	</div>
	<div class="inputContainer">
		<input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" placeholder="<?=GetMessage("AUTH_CHECKWORD")?>" />
	</div>
	<div class="inputContainer">
		<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_REQ")?>" />
	</div>
	<div class="inputContainer">
		<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" placeholder="<?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?>" />
	</div>
	<input type="submit" name="change_pwd" class="inpBtn" value="<?=GetMessage("AUTH_CHANGE")?>" />
	<div class="clear"></div>
	<p><a href="/login/"><b><?=GetMessage("AUTH_AUTH")?></b></a></p>
</form>