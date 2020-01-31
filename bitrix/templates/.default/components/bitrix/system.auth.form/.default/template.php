<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if($arResult["FORM_TYPE"] == "login"):?>
	<?if ($arResult['SHOW_ERRORS'] == 'Y' && $arResult['ERROR'])
		ShowMessage($arResult['ERROR_MESSAGE']);?>		
	<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="filter_form system">
		<h2><?=GetMessage("AUTH");?></h2>
		<?if($arResult["BACKURL"] <> ''):?>
			<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<?endif?>
		<?foreach ($arResult["POST"] as $key => $value):?>
			<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>
		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<div class="inputContainer">
			<input type="text" name="USER_LOGIN" value="<?=$arResult["USER_LOGIN"]?>" autocomplete="off" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
		</div>
		<div class="inputContainer">
			<input type="password" name="USER_PASSWORD" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>" />
		</div>
		<div class="clear"></div>
		<?if ($arResult["CAPTCHA_CODE"]):?>
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			<div class="inputContainer">
				<input type="text" name="captcha_word" value="" /></td>
			</div>
		<?endif?>
		<input type="submit" name="Login" class="orange_submit_small" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" />
		<div class="clear"></div>
	</form>
	<p><a class="href" href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a>&nbsp;<a class="href" href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></p> 		
<?else:?>
	<?if(in_array(UG_ADMIN, CUser::GetUserGroup($USER->GetID())) || in_array(UG_AKP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PP, CUser::GetUserGroup($USER->GetID())) || in_array(UG_PO, CUser::GetUserGroup($USER->GetID())) || in_array(UG_YC, CUser::GetUserGroup($USER->GetID()))):?>
		<?LocalRedirect("/personal/");?>
	<?elseif(in_array(UG_VEBINAR_CREATOR, CUser::GetUserGroup($USER->GetID()))):?>
		<?LocalRedirect("/vebinars/");?>
	<?else:?>
		<?LocalRedirect("/");?>
	<?endif;?>
<?endif?>