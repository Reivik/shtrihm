<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
$APPLICATION->SetPageProperty("SHOW_BANNERS", "N");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");?>

<?$APPLICATION->IncludeComponent("areal:main.register","new");?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>