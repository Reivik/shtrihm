<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка на сертификацию АСЦ");?>
<?$APPLICATION->IncludeComponent("areal:add_asc", ".default");?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>