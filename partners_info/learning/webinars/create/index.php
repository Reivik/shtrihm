<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("NO_LEFT_MENU", "N");?>
<?$APPLICATION->IncludeComponent("areal:vebinar.create", ".default");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>