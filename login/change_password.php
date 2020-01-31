<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Восстановление пароля");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");?>
<?
if(isset($_REQUEST["change_password"]) && isset($_REQUEST["USER_CHECKWORD"]) && strlen($_REQUEST["USER_CHECKWORD"]) > 1) 
	$APPLICATION->IncludeComponent("bitrix:system.auth.changepasswd", ".default", array(), false);
else
	$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd", ".default", array(), false);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>