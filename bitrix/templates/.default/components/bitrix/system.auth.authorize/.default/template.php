<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>
<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
	<?if (strlen($arResult["BACKURL"]) > 0):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<?endif?>
	<?foreach ($arResult["POST"] as $key => $value) {?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
	<?}?>
	<div class="inputContainer">
		<input type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
	</div>
	<div class="inputContainer">
		<input type="password" name="USER_PASSWORD" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />
	</div>
	<div class="clear"></div>
	<input type="submit" name="Login" class="orange_submit_small" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
	<div class="clear"></div>
	
	
	<?/*<div class="field">
		<label class="field-title"><?=GetMessage("AUTH_LOGIN")?></label>
		<div class="form-input"><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["LAST_LOGIN"]?>" class="input-field" /></div>
	</div>	
	<div class="field">
		<label class="field-title"><?=GetMessage("AUTH_PASSWORD")?></label>
		<div class="form-input"><input type="password" name="USER_PASSWORD" maxlength="50" class="input-field" />
			
		</div>
	</div>
	<div class="field field-button">
		<input type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
	</div>*/?>
	<?if ($arParams["NOT_SHOW_LINKS"] != "Y") {?>
		<noindex>
			<?if($arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y")
			{
				?>
				<div class="field">
				<a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_REGISTER")?></b></a><br />
				<?=GetMessage("AUTH_FIRST_ONE")?> <a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REG_FORM")?></a>
				</div>
				<?
			}
			?>
		<div class="field">
		<a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><b><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></b></a><br />
		<?=GetMessage("AUTH_GO")?> <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_GO_AUTH_FORM")?></a><br />
		<?=GetMessage("AUTH_MESS_1")?> <a href="<?=$arResult["AUTH_CHANGE_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_CHANGE_FORM")?></a>
		</div>
		</noindex>
	<?}?>
</form>
<?if($arResult["AUTH_SERVICES"]):?>
	<?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "", 
		array(
			"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
			"CURRENT_SERVICE"=>$arResult["CURRENT_SERVICE"],
			"AUTH_URL"=>$arResult["AUTH_URL"],
			"POST"=>$arResult["POST"],
		), 
		$component, 
		array("HIDE_ICONS"=>"Y")
	);?>
<?endif?>