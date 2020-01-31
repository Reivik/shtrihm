<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(!empty($arResult["VEBINAR"])):?>
	<?if(!empty($_REQUEST["success_application"]) && $_REQUEST["success_application"] == "y"):?>	
		<?ShowNote("Ваша заявка принята к рассмотрению. Дождитесь ответа на e-mail.");?>
	<?elseif(!empty($_REQUEST["success_confirm"]) && $_REQUEST["success_confirm"] == "y"):?>	
		<?ShowNote("Ваше участие в вебинаре подтверждено.");?>
	<?endif;?>
	<?if(!empty($arResult["ERROR"])):?>
		<?ShowError(implode("<br />", $arResult["ERROR"]));?>
	<?endif;?>
	<div class="webinar_detail">
		<?if(!empty($arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"])):?>
			<img src="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["src"]?>" width="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["width"]?>" height="<?=$arResult["VEBINAR"]["PREVIEW_PICTURE"]["height"]?>" title="<?=$arResult["VEBINAR"]["NAME"]?>" alt="<?=$arResult["VEBINAR"]["NAME"]?>" />
		<?endif;?>
		<p>
			<strong>Дата проведения:</strong> <?=getDatewithTime($arResult["VEBINAR"]["DATE_ACTIVE_FROM"])?><br />
			<strong>Продолжительность:</strong> <?=$arResult["VEBINAR"]["DURATION"]?><br />
			<strong>Ведущий:</strong> <?=$arResult["VEBINAR"]["LEADING"]?><br />
			<?=$arResult["VEBINAR"]["PREVIEW_TEXT"]?>
		</p>
		<div class="clear"></div>
		<?if($arResult["INVITED"] == 1 && $arResult["STATUS"] == "application"):?>
			<p>Вы уже приглашены на этот вебинар. Регистрация подтвердит Ваше согласие участвовать.<br /><a href="<?=$APPLICATION->GetCurPageParam("confirm=y", array("application"), false)?>"><strong>Подтвердить</strong></a></p>
		<?endif;?>
		<?if($arResult["STATUS"] == "registered"):?>
			<p><strong>Вы зарегистрированы. Ждем вас на вебинаре <?=getDatewithTime($arResult["VEBINAR"]["DATE_ACTIVE_FROM"])?>.</strong></p>
			<?if(!empty($arResult["HREF_COMMIT"]) && $arResult["HREF_COMMIT_SHOW"] == true):?>
				<a class="orange_submit" id="to_bbb" href="<?=$arResult["HREF_COMMIT"]?>" target="_blank" title="Подключиться к вебинару">Подключиться к вебинару</a>
			<?endif;?>
		<?endif;?>
		<?if($arResult["INVITED"] == 0 && $arResult["STATUS"] != "registered"):?>
			<p>Вы не получили приглашение на данный вебинар. Мы будем рады рассмотреть Вашу заявку, но оставляем за собой право отказать Вам в участии.<br /><a href="<?=$APPLICATION->GetCurPageParam("application=y", array("confirm"), false)?>"><strong>Подать заявку</strong></a></p>
		<?endif;?>
	</div>
<?endif;?>